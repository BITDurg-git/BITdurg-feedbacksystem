<?php

return [
    
    'boolean' => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'role' => [
        '10' => 'Admin',
        '5' => 'Student',
        '7' => 'Teacher Incharge'
    ],
    
    'status' => [
        '1' => 'Active',
        '0' => 'Inactive',
    ],

    'avatar' => [
        'public' => '/storage/avatar/',
        'folder' => 'avatar',
        
        'width'  => 400,
        'height' => 400,
    ],
    'feedback-forms' => [
        'public' => '/storage/feedback-forms/',
        'folder' => 'feedback-forms',
    ],
    'semesters' => [
        '1'=>'1',
        '2'=>'2',
        '3'=>'3',
        '4'=>'4',
        '5'=>'5',
        '6'=>'6',
        '7'=>'7',
        '8'=>'8',
        '9' => '9'
    ],
    'main_elective' => [
        '0' => 'Main',
        '1' => 'Elective'
    ],
    'theory_lab' => [
        '0' => 'Theory',
        '1' => 'Lab'
    ],
    'groups' => [
        'A'=>'A',
        'B'=>'B',
        'C'=>'C',
        'P'=>'P',
        'Q'=>'Q'
    ],
    'sections' => [
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'E' => 'E',
        'F' => 'F',
        'G' => 'G',
        'H' => 'H',
        'I' => 'I',
        'J' => 'J',
        'K' => 'K',
        'L' => 'L'
    ],

    /*
    |------------------------------------------------------------------------------------
    | ENV of APP
    |------------------------------------------------------------------------------------
    */
    'APP_ADMIN' => 'admin',
    'APP_TOKEN' => env('APP_TOKEN', 'admin123456'),
];
