<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name', 'department_code', 'department_hod_name', 'department_hod_email', 'hod_emp_id'
    ];

    public static function rules($update = false, $id = null)
    {
        if(!$update)
        return  $commun = [
                    'department_name'    => "required|unique:departments",
                    'department_code' => "required|unique:departments",
                    'department_hod_name' => "required",
                    'department_hod_email' => 'required|unique:departments',
                    'hod_emp_id' => 'required|unique:departments'
                ];
        return $commun = [
            'department_name'    => "required|unique:departments,department_name,$id",
            'department_code' => "required|unique:departments,department_code,$id",
            'department_hod_name' => "required",
            'department_hod_email' => "required|unique:departments,department_hod_email,$id",
            'hod_emp_id' => "required|unique:departments,hod_emp_id,$id"
        ];
    }
}
