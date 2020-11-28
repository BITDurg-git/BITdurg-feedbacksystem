<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        array_push($data,[
            'setting_name' => 'System Status',
            'value' => '1'
        ]);
        array_push($data,[
            'setting_name' => 'Principal Email Id',
            'value' => 'mailshubhamk@gmail.com'
        ]);
        array_push($data,[
            'setting_name' => 'Total Feedback Count',
            'value' => '25'
        ]);
        array_push($data,[
            'setting_name' => 'Send Mail To Principal',
            'value' => '1'
        ]);
        array_push($data,[
            'setting_name' => 'Send Mail To HOD',
            'value' => '1'
        ]);
        array_push($data,[
            'setting_name' => 'Demo Mode',
            'value' => '1'
        ]);
        array_push($data,[
            'setting_name' => 'Accademic Session',
            'value' => '2019-20'
        ]);
        Setting::insert($data);
    }
}
