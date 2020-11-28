<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index(){
        $this->authorize('viewAny',Setting::class);
        return view('admin.settings.index')->with([
            'settings' => Setting::all(),
            'instructions' => []
        ]);
    }

    public function store(Request $request){
        $this->authorize('viewAny',Setting::class);

        $settings = Setting::all();
        foreach ($settings as $setting) {
            $name = $setting->setting_name;
            $name = str_replace('_',' ',$name);
            $each_setting = Setting::where([['setting_name','=',$name]])->firstOrFail();
            $name = str_replace(' ','_',$name);
            $each_setting->value = $request->$name;
            $each_setting->update();
        };
        return redirect()->route('admin.settings.index')->withSuccess('Settings Saved');
    }
}
