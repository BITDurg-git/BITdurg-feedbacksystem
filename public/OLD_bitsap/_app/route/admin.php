<?php
// Routing for Admin Account


$route->get('/admin/faculty_registration',function($req,$res){

	$crud = new Crud();

	if(isset($req->id))
	{
		$id = trim($req->id);
		$u = $crud->update(
			'user',
			'semester', '-1',
			"uid = '$id'"
		);

		header("location: $req->action/admin/faculty_registration");
	}

	$data = $crud->getWhere('user', "type = 'f' AND semester <= -2");

	if(@count($data) > 0)
	{
		$req->data = $data;
	}

	$req->show = 'admin/faculty_registration.php';
	$res->view('main.php',$req);

});


$route->get('/admin/edit-student-info',function($req,$res){

	$req->rowno = 2;
	$req->show = 'admin/edit-student-info.php';
	$res->view('main.php',$req);

});

$route->post('/admin/edit-student-info',function($req,$res){

	$crud = new Crud();
	$req->rowno = 0;
	$req->color = 'red';

	if(isset($_POST['row-2']) && !empty($_POST['uid']))
	{
		// Do some processing/validation and then display next results
		$data = $crud->getWhere('semester', 'user', "uid =  '".trim($_POST['uid'])."'");
		if(@count($data) == 1)
			$req->rowno = 3;
		else
		{
			$req->msg = 'User doesnot exists !!';
			$req->rowno = 2;
		}
	}

	if(isset($_POST['row-3']) && !empty($_POST['new_uid']))
	{
		//Update the required data and display status msg

		$old_id = trim($_POST['old_uid']);
		$new_id = trim($_POST['new_uid']);

		$check_1 = $crud->getWhere('semester', 'user', "uid = '$new_id'");

		if(@count($check_1) < 1)
		{
			$check_2a = $crud->update(
				'user',
				'uid',"'$new_id'",
				"uid = '$old_id'"
			);
			$check_2b = $crud->update(
				'student_test_record',
				'uid',"'$new_id'",
				"uid = '$old_id'"
			);
			$check_2c = $crud->update(
				'student_response',
				'uid',"'$new_id'",
				"uid = '$old_id'"
			);

			if($check_2a || $check_2b || $check_2c)
			{
				$req->rowno = 2;
				$req->msg = "Username updated successfully to $new_id";
				$req->color = 'green';
			}
			else
				$req->msg = 'Something went wrong';
		}
		else
			$req->msg = 'User already exists';

	}

	$req->show = 'admin/edit-student-info.php';
	$res->view('main.php',$req);

});

?>