<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'contact');
        $settings = SiteSetting::where('category', $category)->get();
        return view('admin.settings.index', compact('settings', 'category'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        
        foreach ($settings as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
