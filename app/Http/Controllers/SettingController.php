<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        $checkboxes = ['wa_notif_aktif', 'email_notif_aktif', 'system_active'];
        foreach ($checkboxes as $checkbox) {
            if (!$request->has($checkbox)) {
                $data[$checkbox] = '0';
            } else {
                $data[$checkbox] = '1';
            }
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        ActivityLog::log("Mengubah pengaturan sistem PPDB");

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}


