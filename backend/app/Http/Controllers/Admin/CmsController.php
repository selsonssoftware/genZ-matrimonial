<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    /**
     * Show CMS & Communication page.
     */
    public function index()
    {
        // Load the latest saved homepage banner.
        $banner = DB::table('cms_banners')
            ->orderByDesc('id')
            ->first();

        // Insert default banner only when the table has no banner.
        if (!$banner) {
            $id = DB::table('cms_banners')->insertGetId([
                'title' => 'Find your life partner',
                'subtitle' => 'A thoughtful match begins with a trusted profile.',
                'status' => 'Published',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $banner = DB::table('cms_banners')
                ->where('id', $id)
                ->first();
        }

        return view('admin.cms-communication', compact('banner'));
    }

    /**
     * Save homepage banner details.
     */
    public function updateBanner(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:Published,Draft,Archived'],
        ], [
            'title.required' => 'Banner title is required.',
            'title.max' => 'Banner title cannot exceed 255 characters.',
            'status.in' => 'Please select a valid banner status.',
        ]);

        $banner = DB::table('cms_banners')
            ->orderByDesc('id')
            ->first();

        $data = [
            'title' => trim($validated['title']),
            'subtitle' => trim($validated['subtitle'] ?? ''),
            'status' => $validated['status'],
            'updated_at' => now(),
        ];

        if ($banner) {
            DB::table('cms_banners')
                ->where('id', $banner->id)
                ->update($data);
        } else {
            $data['created_at'] = now();

            DB::table('cms_banners')->insert($data);
        }

        return redirect()
            ->route('admin.cms-communication')
            ->with('success', 'Homepage banner saved successfully.');
    }
}