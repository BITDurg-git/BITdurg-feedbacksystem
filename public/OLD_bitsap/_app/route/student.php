<?php
// Routing for Student Account


// AngularJs Async Call Route Service =======================

$route->post('/student/serve',function($req,$res){
	$res->logic('student-serve.php');
});

// Ends ====================================================


// Live Test Route =======================================

$route->get('/student/livetest',function($req,$res){

	$req->show = 'student/livetest.php';
    $res->view('main.php',$req);

});

// Ends ===================================================


//Route to store sid before starting test ==================

$route->get('/student/sid_for_test',function($req,$res){
	
	if(isset($req->sid))
	{
		$_SESSION['sid'] = $req->sid;
		header("location: $req->action/exam");
	}

	else
		echo "<h3>Something went wrong !!</h3>";
});

// Ends ====================================================


// Route to start exam =====================================

$route->get('/exam',function($req,$res){

	$req->show = 'student/exam.php';
    $res->view('main.php',$req);

});

// Ends ===================================================

// AngularJs Async Call Route Service for Exam ============

$route->post('/exam/serve',function($req,$res){
	$res->logic('exam-serve.php');
});

// Ends ====================================================


//Route for report ========================================

$route->get('/student/report',function($req,$res){
	
	$req->show = 'student/report.php';
    $res->view('main.php',$req);

});

// Ends ====================================================


//Route for QnA report =====================================

$route->get('/student/qna',function($req,$res){
	
	$req->show = 'student/qna.php';
    $res->view('main.php',$req);

});

// Ends ====================================================

?>