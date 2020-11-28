<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['setting_name','value'];

    public static function rules($update = false, $id = null){
        if(!$update)
            return [
                'setting_name' => 'required|unique:settings',
                'value' => 'required'
            ];

            return [
                'setting_name' => 'required|unique:settings',
                'value' => 'required'
            ];
    }
}
