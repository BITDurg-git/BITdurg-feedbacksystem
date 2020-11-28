<?php
// App data to access common data inside every route get/post function
$app_data = new Data();

$app_data->action = (root_dir_name == '')?'':'/'.root_dir_name;

if(isset($_SERVER['HTTPS']))
{
	if($_SERVER['HTTPS'] == 'on')
		$h = 'https://';
}
else
	$h = 'http://';

$app_data->public_folder_path = $h.$_SERVER['HTTP_HOST'].$app_data->action.'/_public';
$app_data->title = 'BITSAP';

// For routing
$route = new Router(true, $app_data);

$route->get('',function($req,$res){

	if(isset($_SESSION['userid']) == false)			// if user is not logged in
	{
		$req->show = 'homepage.php';
    	$res->view('main.php',$req);
	}
	else 											// if user is logged in
	{
		header("location: $req->action/user");
	}

});

$route->post('/login',function($req,$res){

	$res->logic('login.php');							//logic() func to import files from logic folder
	$obj = new Login();

	if($obj->doLogin($_POST['usr'],$_POST['pwd']))		// checking if credential entered by user match
	{
		header("location: $req->action/user");
	}
	else 												//if don't match, redirect to homepage
	{
		header("location: $req->action/");
	}
});

$route->get('/logout',function($req,$res){

	session_unset();		//Unsetting the Session

	if(session_destroy()) 	//Destroys the Session
	{
		header("location: $req->action/");
	}
});


$route->get('/user',function ($req,$res){				// Redirecting user to their corresponding acc

	if(isset($_SESSION['userid']))
	{
		switch ($_SESSION['type'])
		{
			case 's':
				header("location: $req->action/student");
				break;

			case 'f':
				header("location: $req->action/faculty");
				break;

			case 'a':
				header("location: $req->action/admin");
				break;
			
			default:
				echo "Something went wrong !!";
				break;
		}
	}
	
});

$route->get('/student',function($req,$res){
	
	if(isset($_SESSION['userid']))
	{
		if($_SESSION['type'] == 's')
		{
			$req->show = 'student/dashboard.php';
    		$res->view('main.php',$req);
		}
	}
	else 												//if not logged in, redirect to homepage
	{
		header("location: $req->action/");
	}
});

$route->get('/faculty',function($req,$res){
	
	if(isset($_SESSION['userid']))
	{
		if($_SESSION['type'] == 'f')
		{
			$req->show = 'faculty/dashboard.php';
    		$res->view('main.php',$req);
		}
	}
	else 												//if not logged in, redirect to homepage
	{
		header("location: $req->action/");
	}
});

$route->get('/admin',function($req,$res){
	
	if(isset($_SESSION['userid']))
	{
		if($_SESSION['type'] == 'a')
		{
			$req->show = 'admin/dashboard.php';
    		$res->view('main.php',$req);
		}
	}
	else 												//if not logged in, redirect to homepage
	{
		header("location: $req->action/");
	}
});

if(isset($_SESSION['userid']))							//include routing files for
{														//corresponding user
	switch ($_SESSION['type'])
	{
		case 's':
			include 'route/student.php';
			break;

		case 'f':
			include 'route/faculty.php';
			break;

		case 'a':
			include 'route/admin.php';
			break;
		
		default:
			echo "Something went wrong !!";
			break;
	}
}

$route->get('/signup',function($req,$res){

	$req->show = 'signup.php';
    $res->view('main.php',$req);
});

$route->post('/signup',function($req,$res){

	$crud = new Crud();
	$flag = false;
	$msg = '';
	$color = 'white';

	foreach ($_POST as $key => $value){
		if(empty($value))
		{
			$flag = true;
			break;
		}

		$_POST[$key] = trim($_POST[$key]);
	}

	if(!$flag)
	{
		$data1 = $crud->getWhere('user', "uid = '".$_POST['rollno']."'");
		$data2 = $crud->getWhere('user', "email = '".$_POST['email']."'");

		if(@count($data1) > 0 || @count($data1) > 0)
		{
			$msg = "User already exists";
			$color = 'red';
		}
		else
		{
			$i =false;
			$i = $crud->insert(
				'uid',"'".$_POST['rollno']."'",
				'name',"'".$_POST['name']."'",
				'type',"'s'",
				'email',"'".$_POST['email']."'",
				'password',"'".$_POST['password']."'",
				'enroll_no',"'".$_POST['enrollno']."'",
				'section',"'".$_POST['section']."'",
				'semester',intval($_POST['sem']),
				'user'
			);

			if($i)
			{
				$msg = "Registration successfull !!";
				$color = 'green';
			}
		}
	}
	else
	{
		$msg = "All fields are required. Please go back and fill again.";
		$color = 'yellow';
	}


	$req->msg = $msg;
	$req->color = $color;
	$req->show = 'signup.php';
	$res->view('main.php',$req);
});


$route->get('/new-faculty-reg',function($req,$res){
	$req->show = 'new-faculty-reg.php';
	$res->view('main.php',$req);
});

$route->post('/new-faculty-reg',function($req,$res){

	$crud = new Crud();
	$flag = false;
	$msg = '';
	$color = 'white';

	foreach ($_POST as $key => $value){
		if(empty($value))
		{
			$flag = true;
			break;
		}

		$_POST[$key] = trim($_POST[$key]);
	}

	if(!$flag)
	{
		$data = $crud->getWhere('user', "email = '".$_POST['email']."'");

		if(@count($data) > 0)
		{
			$msg = "Username already exists";
			$color = 'red';
		}
		else
		{
			$i =false;
			$i = $crud->insert(
				'uid',"'".$_POST['username']."'",
				'name',"'".$_POST['name']."'",
				'type',"'f'",
				'email',"'".$_POST['email']."'",
				'password',"'".$_POST['password']."'",
				'user'
			);

			if($i)
			{
				$msg = "Registration successfull !! <br> Get approved by admin to log in to account";
				$color = 'green';
			}
		}
	}
	else
	{
		$msg = "All fields are required. Please go back and fill again.";
		$color = 'yellow';
	}


	$req->msg = $msg;
	$req->color = $color;
	$req->show = 'new-faculty-reg.php';
	$res->view('main.php',$req);
});


$route->get('/forgot-password',function($req,$res){
	$req->show = 'forgot-password.php';
	$res->view('main.php',$req);
});


$route->post('/forgot-password',function($req,$res){

	$crud = new Crud();
	$flag = false;
	$msg = '';
	$req->color = 'red';

	foreach ($_POST as $key => $value){
		if(empty($value))
		{
			$flag = true;
			break;
		}

		$_POST[$key] = trim($_POST[$key]);
	}

	if(!$flag)
	{
		$data = $crud->getWhere('user',"uid = '".$_POST['username']."'");

		if(@count($data) == 1)
		{
			$mail = new Mail();
			$t = $mail->send_mail(
				$data[0]['email'],
				$data[0]['uid'],
				$data[0]['password']
			);

			if($t == 1)
			{
				$req->msg = 'Details have been sent to registered email';
				$req->color = 'green';
			}

		}
		else
			$req->msg = 'Invalid Details';

	}
	else
		$req->msg = 'Invalid Details';

	$req->show = 'forgot-password.php';
	$res->view('main.php',$req);
});





$route->get('/test',function($req,$res){
	$req->show = 'test.php';
	$res->view('main.php',$req);
});




// Keep below check function at the end of app.php file always
$route->end_check(function($res){
	$res->view('not-found.html');
});
?>