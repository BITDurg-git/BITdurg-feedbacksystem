<?php

return [
    'departments_create' => [
        'Department name is the name of the college branch. It must be unique.',
        'Department code is the code of the respective branch. It must also be unique.'
    ],
    'courses_create' => [
        'Course name is all available course in your department. It must be unique.',
        'Semester Count is the total number of semester that is available in that course.'
    ],
    'subject_create' => [
        'All fields are mandatory.',
        'Subject Code refers to the unique code of subject as given in CSVTU syllabus. Eg. Use "322513( 22 )" for Operating System.',
        'Department Name is the name of branch to which this subject belongs.',
        'Select Course as the course to which the subject belongs.',
        'Select semester to which the subject belongs.',
        'In "Main/Elective" select "Main" if the subject belongs to main/core subject of the semester & select "Elective"
        if the subject is optional.',
        'Select "Lab" if the subject is practical and "Theory" if the subject is Theory subject.'
    ],
    'teacher_create' => [
        'Please enter teacher name without Mr/Mrs/Prof etc.',
        'Department Name as the name of the department to which the teacher belongs.',
        'Avatar is the display picture of the teacher. It is optional. If not provided, the system uses the
        default picture. However is it recommended to upload the picture for a better feedback experience.'
    ],
    'batch_create' => [
        'Batch creation is the same as creating batch for a course in a particular department.',
        'To every batch creation these is assigned a batch code. For example: "BE_CSE_3_A" which indicates
        the batch of BE 3rd Semester Computer Science Department Section A.'
    ],
    'relation_create' => [
        '"Teacher-Subject Relation Mapping" refers to assigning teacher to a particular subject in a 
        particular batch.',
        'If you do not find any subject/teacher/batch listed, please go to respective section and add it.',
        'Please make sure to map before feedback session and kindly avoid any modification later.'
    ],
    'question_create' => [
        'Select if the question is for lab feedback or theory.'
    ],
    'feedback_create_all' => [
        'Import Excel Format: <a download href="/sample.xlsx">Format.xlsx</a>',
        'Dont use percentage symbol in attendence column',
        'Attendence must be numeric',
        'URN must be numeric format',
        'If URN has not been assigned to student use college roll number.'
    ],
    'feedback_create_fyr' => [
        'Import Excel Format: <a download href="/sample_fyr.xlsx">Format.xlsx</a>',
        'Dont use percentage symbol in attendence column',
        'Attendence must be numeric',
        'URN must be numeric format',
        'If URN has not been assigned to student use college roll number.'
    ],
    'session_create' => [
        
    ]
];