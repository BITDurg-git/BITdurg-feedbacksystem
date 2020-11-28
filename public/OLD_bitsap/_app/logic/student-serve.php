<?php

if($_SESSION['type'] == 's')
{
	date_default_timezone_set('Asia/Kolkata');
	
	$crud = new crud();

	$goto = '';
	$postdata = file_get_contents("php://input");	//Codes to get POST data from AngularJs
    $request = json_decode($postdata);
	$goto = $request->q;

	switch ($goto)
	{
		case 'subject_list':
			$sem = intval($_SESSION['sem']);
			$data = $crud->getWhere('subject_name','sem_sub_id','sem_sub','semester <= '.$sem);
			echo json_encode($data);
		break;

		case 'test_record':
			$id = $request->sem_sub_id;
			$sql = "SELECT a.sid,date,score,topic,a.uid FROM student_test_record as a, test_creator as b WHERE a.sid = b.sid AND sem_sub_id = '$id' AND a.uid = '".$_SESSION['userid']."'";
			$r = mysqli_query($GLOBALS['db'],$sql);
			
			if($r != false && $r->num_rows != 0)
			{
				$i = 0;
				$data = null;
				while($value = mysqli_fetch_assoc($r))
				{
					$sql_tm = "SELECT SUM(posmark) as TM FROM `answer_bank` NATURAL JOIN student_response where uid = '".$_SESSION['userid']."' and sid = '".$value['sid']."'";

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