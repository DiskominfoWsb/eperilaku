<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class HomeController extends Controller
{
    public function dashboard()
    {
        return inertia()->render('Dashboard');
    }

    public function frontend()
    {
        $setting = Setting::first();

        return inertia()->render('Welcome', [
            'setting' => $setting,
        ]);
    }
}
