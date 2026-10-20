<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MatrimonyMasterController extends Controller
{
    private const RASI_OPTIONS = [
        'Mesham',
        'Rishabam',
        'Mithunam',
        'Kadagam',
        'Simmam',
        'Kanni',
        'Thulam',
        'Viruchigam',
        'Dhanusu',
        'Magaram',
        'Kumbam',
        'Meenam',
    ];

    private const NAKSHATRA_OPTIONS = [
        'Ashwini',
        'Bharani',
        'Karthigai',
        'Rohini',
        'Mirugasirisham',
        'Thiruvathirai',
        'Punarpoosam',
        'Poosam',
        'Ayilyam',
        'Magam',
        'Pooram',
        'Uthiram',
        'Hastham',
        'Chithirai',
        'Swathi',
        'Visakam',
        'Anusham',
        'Kettai',
        'Moolam',
        'Pooradam',
        'Uthiradam',
        'Thiruvonam',
        'Avittam',
        'Sathayam',
        'Poorattathi',
        'Uthirattathi',
        'Revathi',
    ];

    private const GOTHRAM_OPTIONS = [
        'Agastya',
        'Atri',
        'Bharadwaja',
        'Bhrigu',
        'Gargya',
        'Gautama',
        'Harita',
        'Jamadagni',
        'Kashyapa',
        'Kaushika',
        'Kaundinya',
        'Kanva',
        'Parashara',
        'Sandilya',
        'Vashishta',
        'Vishwamitra',
    ];

    private const VERIFICATION_STATUSES = [
        'pending',
        'approved',
        'rejected',
        'update_requested',
    ];

    private function validatedFilters(Request $request): array
    {
        return $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'religion' => ['nullable', 'string', 'max:100'],
            'community' => ['nullable', 'string', 'max:255'],
            'rasi' => ['nullable', 'string', 'max:100'],
            'nakshatra' => ['nullable', 'string', 'max:100'],
            'gothram' => ['nullable', 'string', 'max:100'],
            'age_from' => ['nullable', 'integer', 'min:18', 'max:100'],
            'age_to' => ['nullable', 'integer', 'min:18', 'max:100'],
            'height_from' => ['nullable', 'numeric', 'min:50', 'max:250'],
            'height_to' => ['nullable', 'numeric', 'min:50', 'max:250'],
            'marital_status' => ['nullable', 'array'],
            'marital_status.*' => ['string', 'max:50'],
            'education' => ['nullable', 'string', 'max:150'],
            'city' => ['nullable', 'string', 'max:100'],
            'vendor_id' => ['nullable', 'integer', 'exists:vendor,id'],
            'status' => ['nullable', Rule::in(self::VERIFICATION_STATUSES)],
            'photo_only' => ['nullable', 'boolean'],
            'sort' => ['nullable', Rule::in(['newest', 'oldest', 'age_asc', 'age_desc'])],
        ]);
    }

    private function whereProfileIdsMatch(Builder $query, string $leftColumn, string $rightColumn): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            $query->whereRaw(
                "{$leftColumn} COLLATE utf8mb4_general_ci = {$rightColumn} COLLATE utf8mb4_general_ci"
            );

            return;
        }

        $query->whereColumn($leftColumn, $rightColumn);
    }

    private function profilesQuery(array $filters)
    {
        $vendorName = DB::table('vendor_customer_assignments as assignment')
            ->join('vendor as assigned_vendor', 'assigned_vendor.id', '=', 'assignment.vendor_id')
            ->select('assigned_vendor.agent_name');
        $this->whereProfileIdsMatch($vendorName, 'assignment.profile_id', 'p.profile_id');

        $query = DB::table('profiles as p')
            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
            ->select([
                'p.id',
                'p.profile_id',
                'p.gender',
                'p.age',
                'p.height',
                'p.religion',
                'p.caste',
                'p.community',
                'p.city',
                'p.marital_status',
                'p.verification_status',
                'u.name as member_name',
                'u.member_id',
            ])
            ->addSelect([
                'profile_image' => DB::table('profile_photos as photos')
                    ->select('photos.image')
                    ->whereColumn('photos.profile_id', 'p.profile_id')
                    ->orderByDesc('photos.is_primary')
                    ->orderByDesc('photos.id')
                    ->limit(1),
                'rasi' => DB::table('horoscope_details as horoscope')
                    ->select('horoscope.rasi')
                    ->whereColumn('horoscope.profile_id', 'p.profile_id')
                    ->orderByDesc('horoscope.id')
                    ->limit(1),
                'nakshatra' => DB::table('horoscope_details as horoscope')
                    ->select('horoscope.star')
                    ->whereColumn('horoscope.profile_id', 'p.profile_id')
                    ->orderByDesc('horoscope.id')
                    ->limit(1),
                'gothram' => DB::table('horoscope_details as horoscope')
                    ->select('horoscope.gothram')
                    ->whereColumn('horoscope.profile_id', 'p.profile_id')
                    ->orderByDesc('horoscope.id')
                    ->limit(1),
                'qualification' => DB::table('education_details as education')
                    ->select('education.qualification')
                    ->whereColumn('education.profile_id', 'p.profile_id')
                    ->orderByDesc('education.id')
                    ->limit(1),
                'vendor_name' => $vendorName
                    ->orderByDesc('assignment.id')
                    ->limit(1),
            ]);

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($builder) use ($search) {
                $builder->where('u.name', 'like', "%{$search}%")
                    ->orWhere('u.member_id', 'like', "%{$search}%")
                    ->orWhere('p.profile_id', 'like', "%{$search}%")
                    ->orWhere('u.phone', 'like', "%{$search}%");
            });
        }

        foreach (['religion' => 'p.religion', 'city' => 'p.city'] as $filter => $column) {
            if (!empty($filters[$filter])) {
                $query->where($column, $filters[$filter]);
            }
        }

        if (!empty($filters['community'])) {
            $query->where(function ($builder) use ($filters) {
                $builder->where('p.community', $filters['community'])
                    ->orWhere('p.caste', $filters['community']);
            });
        }

        foreach (['rasi' => 'rasi', 'nakshatra' => 'star', 'gothram' => 'gothram'] as $filter => $column) {
            if (!empty($filters[$filter])) {
                $query->whereExists(function ($subquery) use ($filters, $filter, $column) {
                    $subquery->selectRaw('1')
                        ->from('horoscope_details as horoscope_filter')
                        ->whereColumn('horoscope_filter.profile_id', 'p.profile_id')
                        ->where("horoscope_filter.{$column}", $filters[$filter]);
                });
            }
        }

        if (!empty($filters['age_from'])) {
            $query->where('p.age', '>=', $filters['age_from']);
        }
        if (!empty($filters['age_to'])) {
            $query->where('p.age', '<=', $filters['age_to']);
        }
        if (!empty($filters['height_from'])) {
            $query->whereRaw('CAST(p.height AS DECIMAL(6, 2)) >= ?', [$filters['height_from']]);
        }
        if (!empty($filters['height_to'])) {
            $query->whereRaw('CAST(p.height AS DECIMAL(6, 2)) <= ?', [$filters['height_to']]);
        }

        if (!empty($filters['marital_status'])) {
            $query->whereIn('p.marital_status', $filters['marital_status']);
        }

        if (!empty($filters['education'])) {
            $query->whereExists(function ($subquery) use ($filters) {
                $subquery->selectRaw('1')
                    ->from('education_details as education_filter')
                    ->whereColumn('education_filter.profile_id', 'p.profile_id')
                    ->where('education_filter.qualification', $filters['education']);
            });
        }

        if (!empty($filters['vendor_id'])) {
            $query->whereExists(function ($subquery) use ($filters) {
                $subquery->selectRaw('1')
                    ->from('vendor_customer_assignments as assignment_filter')
                    ->where('assignment_filter.vendor_id', $filters['vendor_id']);
                $this->whereProfileIdsMatch($subquery, 'assignment_filter.profile_id', 'p.profile_id');
            });
        }

        if (!empty($filters['status'])) {
            $query->where('p.verification_status', $filters['status']);
        }

        if (!empty($filters['photo_only'])) {
            $query->whereExists(function ($subquery) {
                $subquery->selectRaw('1')
                    ->from('profile_photos as photo_filter')
                    ->whereColumn('photo_filter.profile_id', 'p.profile_id');
            });
        }

        switch ($filters['sort'] ?? 'newest') {
            case 'oldest':
                $query->orderBy('p.id');
                break;
            case 'age_asc':
                $query->orderBy('p.age')->orderByDesc('p.id');
                break;
            case 'age_desc':
                $query->orderByDesc('p.age')->orderByDesc('p.id');
                break;
            default:
                $query->orderByDesc('p.id');
        }

        return $query;
    }

    public function index(Request $request)
    {
        $filters = $this->validatedFilters($request);
        $profiles = $this->profilesQuery($filters)
            ->get();

        $databaseReligions = DB::table('profiles')
            ->whereNotNull('religion')
            ->where('religion', '<>', '')
            ->distinct()
            ->orderBy('religion')
            ->pluck('religion');
        $religions = collect([
            'Hindu',
            'Christian',
            'Muslim',
            'Jain',
            'Sikh',
            'Buddhist',
            'Other',
        ])->merge($databaseReligions)
            ->filter(fn ($religion) => is_string($religion) && trim($religion) !== '')
            ->unique(fn ($religion) => mb_strtolower(trim($religion)))
            ->values();
        $communities = DB::table('profiles')
            ->select('community as name')
            ->whereNotNull('community')
            ->where('community', '<>', '')
            ->union(
                DB::table('profiles')
                    ->select('caste as name')
                    ->whereNotNull('caste')
                    ->where('caste', '<>', '')
            )
            ->orderBy('name')
            ->pluck('name');
        $horoscopeOptions = [
            'rasis' => $this->mergeOptions(
                self::RASI_OPTIONS,
                DB::table('horoscope_details')->whereNotNull('rasi')->where('rasi', '<>', '')
                    ->distinct()->orderBy('rasi')->pluck('rasi')->all()
            ),
            'nakshatras' => $this->mergeOptions(
                self::NAKSHATRA_OPTIONS,
                DB::table('horoscope_details')->whereNotNull('star')->where('star', '<>', '')
                    ->distinct()->orderBy('star')->pluck('star')->all()
            ),
            'gothrams' => $this->mergeOptions(
                self::GOTHRAM_OPTIONS,
                DB::table('horoscope_details')->whereNotNull('gothram')->where('gothram', '<>', '')
                    ->distinct()->orderBy('gothram')->pluck('gothram')->all()
            ),
        ];
        $maritalStatuses = DB::table('profiles')
            ->whereNotNull('marital_status')
            ->where('marital_status', '<>', '')
            ->distinct()
            ->orderBy('marital_status')
            ->pluck('marital_status');
        $educations = DB::table('education_details')
            ->whereNotNull('qualification')
            ->where('qualification', '<>', '')
            ->distinct()
            ->orderBy('qualification')
            ->pluck('qualification');
        $cities = DB::table('profiles')
            ->whereNotNull('city')
            ->where('city', '<>', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');
        $vendors = DB::table('vendor')
            ->select('id', 'agent_name')
            ->orderBy('agent_name')
            ->get();

        return view('admin.matrimonymasterdata', compact(
            'profiles',
            'filters',
            'religions',
            'communities',
            'horoscopeOptions',
            'maritalStatuses',
            'educations',
            'cities',
            'vendors'
        ));
    }

    private function mergeOptions(array $defaults, array $databaseValues)
    {
        return collect($defaults)
            ->merge($databaseValues)
            ->filter(fn ($value) => is_string($value) && trim($value) !== '')
            ->unique(fn ($value) => mb_strtolower(trim($value)))
            ->values();
    }

    public function export(Request $request): StreamedResponse
    {
        $filters = $this->validatedFilters($request);
        $query = $this->profilesQuery($filters);

        return response()->streamDownload(function () use ($query) {
            $output = fopen('php://output', 'w');
            fputcsv($output, [
                'Member ID',
                'Name',
                'Age',
                'Height',
                'Religion',
                'Community',
                'Rasi',
                'City',
                'Status',
                'Vendor',
            ]);

            foreach ($query->cursor() as $profile) {
                fputcsv($output, [
                    $profile->member_id ?: $profile->profile_id,
                    $profile->member_name,
                    $profile->age,
                    $profile->height,
                    $profile->religion,
                    $profile->community ?: $profile->caste,
                    $profile->rasi,
                    $profile->city,
                    $profile->verification_status,
                    $profile->vendor_name,
                ]);
            }

            fclose($output);
        }, 'matrimony-members-' . now()->format('Y-m-d-His') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function bulkReview(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['required', 'integer', 'distinct', 'exists:profiles,id'],
            'decision' => ['required', Rule::in(self::VERIFICATION_STATUSES)],
        ]);

        DB::table('profiles')
            ->whereIn('id', $validated['ids'])
            ->update([
                'verification_status' => $validated['decision'],
                'reviewed_by' => Auth::guard('admin')->id(),
                'reviewed_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.matrimonymasterdata', $request->query())
            ->with('success', count($validated['ids']) . ' profile(s) updated.');
    }
}
