<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin','as' => 'admin' . '.', 'middleware'=>['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dash');
    Route::resource('users', 'UserController');
    Route::resource('departments','DepartmentController');
    Route::resource('courses','CourseController');
    Route::resource('subjects','SubjectController');
    Route::resource('teachers','TeacherController');
    Route::resource('batches','BatchController');
    Route::resource('relations','RelationController');
    Route::resource('questions','QuestionController');
    Route::resource('feedback-forms','FeedbackFormController');
    Route::get('feedback-sessions','FeedbackSessionController@index')->name('feedback-sessions.index');
    Route::get('feedback-sessions/create','FeedbackSessionController@create')->name('feedback-sessions.create');
    Route::post('feedback-sessions/create', 'FeedbackSessionController@startFeedback')->name('feedback-sessions.start-feedback');
    Route::delete('feedback-sessions/stop/{id}', 'FeedbackSessionController@stopFeedback')->name('feedback-sessions.stop-feedback');
    Route::get('feedback-forms/report/{id}/{attendence}','FeedbackController@report')->name('feedback-forms.report');
    Route::get('feedback-forms/report/{id}/{attendence}/print','FeedbackController@printReport')->name('feedback-forms.print-report');
    Route::get('settings','SettingController@index')->name('settings.index');
    Route::post('settings','SettingController@store')->name('settings.store');
    Route::get('feedback-forms/{id}/{attendence}/send-mail','FeedbackController@sendMail')->name('feedback-forms.send-mail');
    Route::get('feedback-sessions/{id}','FeedbackSessionController@view')->name('feedback-sessions.view');

    Route::get('student/edit/{id}','StudentController@edit')->name('students.edit');
    Route::put('student/edit/{id}','StudentController@update')->name('students.update');

    Route::get('/export','ExportController@create');
    Route::post('/export','ExportController@generate');
});

Route::group(['prefix' => 'student','as' => 'student' . '.', 'middleware'=>['auth', 'Role:5']], function () {
    Route::get('dashboard','DashboardController@student')->name('dashboard.index');
    Route::get('/feedback/{id}','FeedbackController@initiateFeedback');
    Route::post('feedback/{id}','FeedbackController@storeFeedback');
    Route::get('/thankyou',function(){
        return view('student.feedback.thank-you');
    })->name('thank-you');
});
Route::get('/',function(){
    return redirect()->route('student.dashboard.index');
});
