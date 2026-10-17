<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    // Vendor list + search + status filter + KPI cards
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $status = $request->query('status', '');

        $query = DB::table('vendor as v')
            ->leftJoin('vendor_logins as vl', 'vl.vendor_id', '=', 'v.id')
            ->select(
                'v.id',
                'v.agent_name',
                'v.city',
                'v.status',
                'v.commission',
                'vl.email'
            )
            ->selectSub(function ($q) {
                $q->from('vendor_customer_assignments')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn(
                        'vendor_customer_assignments.vendor_id',
                        'v.id'
                    );
            }, 'customers_count');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('v.agent_name', 'like', "%{$search}%")
                  ->orWhere('v.city', 'like', "%{$search}%")
                  ->orWhere('vl.email', 'like', "%{$search}%")
                  ->orWhere('v.id', 'like', "%{$search}%");
            });
        }

        
if (in_array($status, ['Active', 'Pending', 'Suspended'], true)) {
    $query->where('v.status', $status);
}


        $vendors = $query->orderByDesc('v.id')->get();

        // KPIs use all database records, not just filtered records
        $totalVendors = DB::table('vendor')->count();

        $activeVendors = DB::table('vendor')
            ->where('status', 'Active')
            ->count();

            
$pendingVendors = DB::table('vendor')
    ->where('status', 'Pending')
    ->count();

$suspendedVendors = DB::table('vendor')
    ->where('status', 'Suspended')
    ->count();

        $totalCommission = DB::table('vendor')->sum('commission');

        
return view('admin.vendors', compact(
    'vendors',
    'search',
    'status',
    'totalVendors',
    'activeVendors',
    'pendingVendors',
    'suspendedVendors',
    'totalCommission'
));

    }

    // Create vendor + separate login in one transaction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agent_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            
'status' => [
    'required',
    Rule::in(['Active', 'Pending', 'Suspended'])
],

            'commission' => ['required', 'integer', 'min:0'],
            'email' => [
                'required', 'email', 'max:191',
                'unique:vendor_logins,email'
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($validated) {
            $vendorId = DB::table('vendor')->insertGetId([
                // Client profiles are stored in vendor_customer_assignments.
                // Keep the old NOT NULL column empty until legacy use is confirmed.
                'profile_id' => '',

                // Temporary compatibility values for required legacy columns.
                // Confirm vector_id/action meaning before production use.
                'vector_id' => 0,
                'agent_name' => $validated['agent_name'],
                'city' => $validated['city'],
                'status' => $validated['status'],
                'commission' => $validated['commission'],
                'action' => 'view',
            ]);

            DB::table('vendor_logins')->insert([
                'vendor_id' => $vendorId,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => $validated['status'] === 'Active' ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor created successfully.');
    }

    // Assign one existing member profile to a vendor
    public function assignProfile(Request $request, $vendorId)
    {
        $vendorExists = DB::table('vendor')
            ->where('id', $vendorId)
            ->exists();

        if (!$vendorExists) {
            return redirect()
                ->route('admin.vendors.index')
                ->withErrors(['vendor' => 'Vendor not found.']);
        }

        $validated = $request->validate([
            // Assumes member profiles are stored in profiles.profile_id.
            'profile_id' => [
                'required',
                'string',
                'max:255',
                'exists:profiles,profile_id',
                'unique:vendor_customer_assignments,profile_id',
            ],
        ]);

        DB::table('vendor_customer_assignments')->insert([
            'vendor_id' => $vendorId,
            'profile_id' => $validated['profile_id'],
            'assigned_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Client profile assigned successfully.');
    }



    
// Admin: View all vendor-profile assignments
public function assignments()
{
    $assignments = DB::table('vendor_customer_assignments as a')
        ->join('vendor as v', 'v.id', '=', 'a.vendor_id')
        ->leftJoin('profiles as p', function ($join) {
            if (DB::connection()->getDriverName() === 'mysql') {
                $join->whereRaw(
                    'p.profile_id COLLATE utf8mb4_general_ci = a.profile_id COLLATE utf8mb4_general_ci'
                );
            } else {
                $join->on('p.profile_id', '=', 'a.profile_id');
            }
        })
        ->select(
            'a.id',
            'a.vendor_id',
            'a.profile_id',
            'a.assigned_at',
            'v.agent_name',
            'v.city as vendor_city',
            'p.gender',
            'p.age',
            'p.city as profile_city'
        )
        ->orderByDesc('a.assigned_at')
        ->paginate(15);

    return view('admin.vendor-assignments', compact('assignments'));
}

}
