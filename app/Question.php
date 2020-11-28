<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question','theory_lab'
    ];

    public static function rules($update = false, $id = null){
        if(!$update)
            return [
                'question' => 'required:unique,questions',
                'theory_lab' => 'required|numeric|in:0,1'
            ];

        return [
            'question' => "required:unique,questions,question,$id",
            'theory_lab' => 'required|numeric|in:0,1'
        ];
    }
}
