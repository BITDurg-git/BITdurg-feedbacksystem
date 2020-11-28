<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if($_SESSION['type'] == 's')
{
	date_default_timezone_set('Asia/Kolkata');
	include '../crud.php';
	$crud = new crud();

	$goto = '';
	$postdata = file_get_contents("php://input");	//Codes to get POST data from AngularJs
    $request = json_decode($postdata);
	$goto = $request->q;

	switch ($goto)
	{
		case 'liveTestData':
			$sem = $_SESSION['sem'];
			$live = $crud->getWhere('online_test',"is_live = 1 AND LEFT(sid,1) = '$sem'");
			if($live != null)
			{
				foreach ($live as $key => $row)
				{
					$sql = "SELECT subject_name, topic FROM subject NATURAL JOIN sem_sub WHERE sid =  '".$row['sid']."'";
					$result = mysqli_query($GLOBALS['db'],$sql);
					$data = mysqli_fetch_assoc($result);
					$live[$key]['subject'] = $data['subject_name'];
					$live[$key]['topic'] = $data['topic'];
				}
			}
			echo json_encode($live);
		break;

		case 'takeTest':
			$_SESSION['sid'] = $request->test_id;
			echo json_encode(true);
		break;

		case 'subject_list':
			$sem = $_SESSION['sem'];
			$data = $crud->getWhere('subject_name','sem_sub_id','sem_sub','semester = '.$sem);
			echo json_encode($data);
		break;

		case 'test_record':
			$id = $request->sem_sub_id;
			$sql = "SELECT a.sid,date,score,topic,a.uid FROM student_test_record as a, subject as b WHERE a.sid = b.sid AND sem_sub_id = '$id' AND a.uid = '".$_SESSION['userid']."'";
			$r = mysqli_query($GLOBALS['db'],$sql);
			
			if($r != false && $r->num_rows != 0)
			{
				$i = 0;
				$data = null;
				while($value = mysqli_fetch_assoc($r))
				{
					$sql_tm = "SELECT SUM(posmark) as TM FROM `answer_bank` NATURAL JOIN response where uid = '".$_SESSION['userid']."' and sid = '".$value['sid']."'";

					$tm = mysqli_query($GLOBALS['db'],$sql_tm);
					$row = @mysqli_fetch_assoc($tm);

					$value['total_marks'] = $row['TM'];
					$data[$i] = $value;	$i++;
				}

				echo json_encode($data);
			}

			else
				echo json_encode(0);
		break;

		default:
		break;
	}
}
?>