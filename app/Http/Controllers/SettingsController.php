<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use stdClass;

class SettingsController extends Controller
{
    public function index()
    {
        $this->authorize('view', Setting::class);

        $settings = Setting::all();

        $psuedo_settings = new stdClass();

        foreach ($settings as $setting) {
            $psuedo_settings->{$setting->key} = $setting->value;
        }

        return view('settings.index', ['settings' =>  $psuedo_settings]);
    }

    public function update(SettingsFormRequest $request)
    {
        $this->authorize('update', Setting::class);

        foreach ($request->validated()  as $key => $value) {
            Setting::updateOrCreate(['key' => $key, 'value' => $value]);
        }

        return back();
    }
}
