<?php
// Routing for Faculty Account


// AngularJs Async Call Route Service ===========================================================

$route->post('/faculty/serve',function($req,$res){
	$res->logic('faculty-serve.php');
});

// Ends =========================================================================================


// Test Creation Route =====================================================================
$route->get('/faculty/create_test',function($req,$res){

	$crud = new Crud();

	if(isset($req->sem))
	{
		$sem = intval($req->sem);
		$data = $crud->getWhere('subject_name','sem_sub_id','sem_sub','semester = '.$sem);
		$req->subject_list = $data;
	}

	$req->show = 'faculty/create_test.php';
    $res->view('main.php',$req);

});

$route->post('/faculty/create_test',function($req,$res){

	$crud = new Crud();

	if(isset($_POST['sem']))
	{
		$req->sem = intval($_POST['sem']);
		$sem = intval($req->sem);
		$data = $crud->getWhere('sem_sub_id','sem_sub','semester = '.$sem);
		$n = @count($data) + 1;
		$temp = $crud->insert(
		'semester', $sem,
		'subject_name', "'".$_POST['subject']."'",
		'sem_sub_id', "'".$sem."_".$n."'",
		'sem_sub'
		);

		header("location: $req->action/faculty/create_test/:sem=$sem");
	}
	else
		echo "Something went wrong";;

});

$route->get('/faculty/new_test_db',function($req,$res){

	if(!isset($req->id))
	{
		echo '<h2>No subject selected !!</h2>';
	}
	else
	{
		$req->show = 'faculty/new_test_db.php';
    	$res->view('main.php',$req);
	}
});

$route->get('/faculty/submitted',function($req,$res){

	echo "<center><h3>Test Created/Modified Successfully !!</h3><br>
	<a href='http://10.0.4.7/bitsap'>Go to Dashboard</a></center>";

	/*$req->show = 'faculty/dash.php';
    $res->view('main.php',$req);*/

});


// Test Creation Route Ends =====================================================================



// Test Editing Route ===========================================================================

$route->get('/faculty/edit_test',function($req,$res){

	$crud = new Crud();

	if(isset($req->sem))
	{
		$sem = intval($req->sem);
		$data = $crud->getWhere('subject_name','sem_sub_id','sem_sub','semester = '.$sem);
		$req->subject_list = $data;
	}

	if(isset($req->id))
	{
		$sem_sub_id = $req->id;
		$data = $crud->getWhere('topic','sid','tnoq','uid', 'test_creator', "sem_sub_id = "."'".$sem_sub_id."'");
		$req->test_list = $data;
	}

	$req->show = 'faculty/edit_test.php';
    $res->view('main.php',$req);

});

$route->get('/faculty/edit_test_db',function($req,$res){

	if(!isset($req->id))
	{
		echo '<h2>No subject selected !!</h2>';
	}
	else
	{
		$req->show = 'faculty/edit_test_db.php';
    	$res->view('main.php',$req);
	}
});


// Test Editing Route Ends ========================================================================


// Conduct test Route =============================================================================

$route->get('/faculty/conduct_test',function($req,$res){

	$crud = new Crud();

	if(isset($req->sem))
	{
		$sem = intval($req->sem);
		$data = $crud->getWhere('subject_name','sem_sub_id','sem_sub','semester = '.$sem);
		$req->subject_list = $data;
	}

	if(isset($req->id))
	{
		$sem_sub_id = $req->id;
		$data = $crud->getWhere('topic','sid','tnoq','uid', 'test_creator', "sem_sub_id = "."'".$sem_sub_id."'");
		$req->test_list = $data;
	}

	$req->show = 'faculty/conduct_test.php';
    $res->view('main.php',$req);

});

// Ends ============================================================================================


// Invigilation Route ==============================================================================

$route->get('/faculty/invigilation',function($req,$res){

	$req->show = 'faculty/invigilation.php';
    $res->view('main.php',$req);

});

// Ends =============================================================================================



// Live Test Route ==============================================================================

$route->get('/faculty/live_test',function($req,$res){

	$req->show = 'faculty/live_test.php';
    $res->view('main.php',$req);

});

// Ends =============================================================================================


// Student Report Route ==============================================================================

$route->get('/faculty/student_report',function($req,$res){

	$req->show = 'faculty/student_report.php';
    $res->view('main.php',$req);

});

// Ends =============================================================================================

?>