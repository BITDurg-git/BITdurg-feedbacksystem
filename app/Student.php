<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Student;

class Student extends Model
{
    protected $fillable = [
        'name','user_id','feedback_name','urn','feedback_status','e1_id','e2_id','e3_id','e4_id','e5_id','e6_id','e7_id','e8_id','e9_id','e10_id'
    ];

    public static function rules($update = false, $id = null){
        if(!$update)
            return [
                'name' => 'required',
                'user_id' => 'required',
                'feedback_name' => 'required',
                'urn' => 'required|unique:students',
                'feedback_status' => 'required',
                'e1_id' => '',
                'e2_id' => ''
            ];
    }

    public static function scopeFeedbackList($query){
        return $query->latest('updated_at')->where([['user_id','=',Auth::user()->id]])->get();
    }

    public function scopeHasFeedbackAuth($query,$id){
        return $query->where([['user_id','=',Auth::user()->id],['feedback_name','=',$id],['feedback_status','=','0']])->firstOrfail();
    }

    public function getFeedback(){
        return $this->belongsTo('App\FeedbackForm','feedback_name');
    }

    public function e1(){
        return $this->belongsTo('App\Subject','e1_id');
    }

    public function e2(){
        return $this->belongsTo('App\Subject','e2_id');
    }

    public function e3(){
        return $this->belongsTo('App\Subject','e3_id');
    }

    public function e4(){
        return $this->belongsTo('App\Subject','e4_id');
    }

    public function e5(){
        return $this->belongsTo('App\Subject','e5_id');
    }

    public function e6(){
        return $this->belongsTo('App\Subject','e6_id');
    }

    public function e7(){
        return $this->belongsTo('App\Subject','e7_id');
    }

    public function e8(){
        return $this->belongsTo('App\Subject','e8_id');
    }

    public function e9(){
        return $this->belongsTo('App\Subject','e9_id');
    }

    public function e10(){
        return $this->belongsTo('App\Subject','e10_id');
    }
}
