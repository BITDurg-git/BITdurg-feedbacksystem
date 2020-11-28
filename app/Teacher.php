<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Teacher extends Model
{
    protected $fillable = ['teacher_name','avatar','department_name','email_id','emp_id'];

    public static function rules($update = false, $id = null){
        if(!$update)
        return [
            'teacher_name' => 'required',
            'department_name' => 'required|numeric|in:'.Auth::user()->department_name,
            'avatar' => 'image',
            'email_id' => 'required|email|unique:teachers',
            'emp_id' => 'required|unique:teachers'
        ];

        return [
            'teacher_name' => "required",
            'department_name' => 'required|numeric|in:'.Auth::user()->department_name,
            'avatar' => 'image',
            'email_id' => "required|email|unique:teachers,email_id,$id",
            'emp_id' => "required|unique:teachers,emp_id,$id"
        ];
    }

    public function getAvatarAttribute($value){
        if($value)
            return config('variables.avatar.public').$value;

        if (!$value) {
            return 'http://placehold.it/160x160';
        }
    }

    public function setAvatarAttribute($photo)
    {
        $this->attributes['avatar'] = move_file($photo, 'avatar');
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }

    public static function scopeAll(){
        return $query->latest('updated_at')->get();
    }
}
