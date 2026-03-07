<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AdminSettingsController extends AdminController
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');

        $sysInfo = [
            'laravel_version' => app()->version(),
            'php_version'     => phpversion(),
            'environment'     => config('app.env'),
            'debug_mode'      => config('app.debug') ? 'Enabled' : 'Disabled',
            'timezone'        => config('app.timezone'),
            'db_connection'   => config('database.default'),
            'cache_driver'    => config('cache.default'),
            'session_driver'  => config('session.driver'),
        ];

        return view('admin.settings', compact('settings', 'sysInfo'));
    }

    public function save(Request $request)
    {
        if (!auth()->user()->hasPermission('settings.view')) {
            return redirect()->back()->with('error', 'You do not have permission to change settings.');
        }

        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings')->with('success', 'Settings saved successfully.');
    }
}