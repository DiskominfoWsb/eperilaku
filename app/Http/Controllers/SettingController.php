<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Setting::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $setting = Setting::first();

        return inertia()->render('Setting/SetApplication', [
            'setting' => $setting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSettingRequest $request)
    {
        $setting = Setting::first();
        //
        if ($request->logo) {
            $extension = $request->file('logo')->getClientOriginalExtension();
            $newLogoName = 'logo.'.$extension;

            if (File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }

            $request->logo->move(public_path(), $newLogoName);

            $setting->logo = $newLogoName;
            $setting->save();

            return redirect()->back();
        }

        if ($request->frontend_background) {
            $extension = $request->file('frontend_background')->getClientOriginalExtension();
            $newFrontendBackgroundName = 'background.'.$extension;

            if (File::exists(public_path($setting->frontend_background))) {
                File::delete(public_path($setting->frontend_background));
            }

            $request->frontend_background->move(public_path(), $newFrontendBackgroundName);

            $setting->frontend_background = $newFrontendBackgroundName;
            $setting->save();

            return redirect()->back();
        }

        $setting->name = $request->name;
        $setting->description = $request->description;
        $setting->alamat = $request->alamat;
        $setting->phone = $request->phone;
        $setting->save();

        return redirect()->back();
    }
}
