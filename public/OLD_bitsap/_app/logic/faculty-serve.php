<?php
if($_SESSION['type'] == 'f')
{
	date_default_timezone_set('Asia/Kolkata');
	
	$crud = new crud();

	$goto = '';
	$postdata = file_get_contents("php://input");	//Codes to get POST data from AngularJs
    $request = json_decode($postdata);
	$goto = $request->q;

	switch ($goto)
	{
		case 'createTest':
			if(!isset($_SESSION['sem_sub_id']))
			{
				echo "You might be trying to insert same data again";
				break;
			}

			$sem_sub_id = $_SESSION['sem_sub_id'];
			$_SESSION['sem_sub_id'] = null;
			
			$data = $crud->getWhere('test_creator', "sem_sub_id = '$sem_sub_id'");
			//print_r($data);
			$n = @count($data) + 1;
			$code = $sem_sub_id.'_'.$n;

			$topic = $request->test_info[0];
			$tnoq = intval($request->test_info[1]);

			$insert_into_test_creator = $crud->insert(
				'sem_sub_id',"'$sem_sub_id'",
				'topic',"'$topic'",
				'sid',"'$code'",
				'tnoq',$tnoq,
				'total',$tnoq,
				'uid', "'".$_SESSION['userid']."'",
				'test_creator'
				);

			$insert_into_test_modification_detail = null;

			if($insert_into_test_creator == true)
			{
				$date = date("Y-m-d H:i:s");

				$insert_into_test_modification_detail = $crud->insert(
				'uid', "'".$_SESSION['userid']."'",
				'sid', "'$code'",
				'date_created', "'$date'",
				'test_modification_detail'
				);
			}

			$insert_into_QB = NULL;

			if ($insert_into_test_modification_detail == true)
			{
				# code to upload question data to Question Bank
				//$temp1 = true;

				$l1 = $l2 = $l3 = 0;

				for ($j= 1; $j<=$tnoq; $j++)	//loop runs to upload data of each Qst
				{
					$multiple = 0;
					$answer = '';

					for ($i= 'a'; $i <= 'd'; $i++)
					{ 
						if($request->qdata[$j]->{$i})
						{
							$multiple++;
							$answer .= $i;
						}
					}

					$level = 0;

					if(intval($request->test_info[3]) == 1)
					{
						$level = intval($request->qdata[$j]->level);
						$t = ($level == 1) ? $l1++ : (($level == 2 ? $l2++: $l3++));
					}

					$insert_into_QB = $crud->insert(
						'sid', "'$code'",
						'qno', $j,
						'qid', "'".$code."_".$j."'",
						'level', $level,
						'question', "'".$request->qdata[$j]->question."'",
						'a', "'".$request->qdata[$j]->option_a."'",
						'b', "'".$request->qdata[$j]->option_b."'",
						'c', "'".$request->qdata[$j]->option_c."'",
						'd', "'".$request->qdata[$j]->option_d."'",
						'multiple', $multiple,
						'question_bank'
						);

					if($insert_into_QB == true)
					{
						$insert_into_AB = $crud->insert(
						'qid', "'".$code."_".$j."'",
						'answer', "'$answer'",
						'posmark',floatval($request->qdata[$j]->posmark),
						'negmark',floatval($request->qdata[$j]->negmark),
						'answer_bank'
						);
					}
				}

				$insert_into_level = null;

				if($insert_into_AB)
				{
					$insert_into_level = $crud->insert(
					'sid',"'$code'",
					'is_level_present', intval($request->test_info[3]),
					'level'
					);

					if (intval($request->test_info[3]) == 1)
					{
						$update_level_count = $crud->update(
							'level',
							"l1", $l1,
							'l2', $l2,
							'l3', $l3,
							"sid = '$code'"
						);
					}
				}
			}

			echo json_encode($insert_into_level);
			break;

		case 'dataEditTest':
			$sid = $_SESSION['sid'];
			$test_data = $crud->getWhere('test_creator',"sid = '$sid'");

			//class Data {}

			if($test_data[0]['uid'] == $_SESSION['userid'])
			{
				$level = $crud->getWhere('level',"sid = '$sid'")[0]['is_level_present'];
				$quest_bank = $crud->getWhere('question_bank', "sid = '$sid'");
				$ans_bank = null;
				$i=0;

				foreach ($quest_bank as $key => $row)
				{
					$temp = $crud->getWhere('answer_bank', "qid = '".$row['qid']."'");
					$ans_bank[$i] = $temp[0];
					$i++;
				}

				$result = new Data();
				$result->test_info = $test_data;
				$result->quest_data = $quest_bank;
				$result->ans_data = $ans_bank;
				$result->level = $level;

				echo json_encode($result);
			}
			else
				echo false;
			break;

		case 'editTest':
			if(!isset($_SESSION['sid']))
			{
				echo "Something went wrong. Refresh the page and try again";
				break;
			}

			$sid = $_SESSION['sid'];
			$_SESSION['sid'] = null;
			
			$data = $crud->getWhere('test_creator', "sid = '$sid'");

			$topic = $request->test_info[0];
			$tnoq = intval($request->test_info[1]);

			$update_test_creator = $crud->update(
				'test_creator',
				'topic',"'$topic'",
				'tnoq',$tnoq,
				"sid = '$sid'"
				);

			

			$update_test_modification_detail = false;

			if($update_test_creator == true)
			{
				$date = date("Y-m-d H:i:s");

				$update_test_modification_detail = $crud->update(
				'test_modification_detail',
				'date_modified', "'$date'",
				"sid = '$sid'"
				);
			}

			$update_AB = false;
			$insert_into_level = false;

			$l1 = $l2 = $l3 = 0;

			// Edits Updates codes -----

			if($update_test_modification_detail == true && count($request->qno_list) != 0)
			{
				foreach ($request->qno_list as $key => $j)
				{
					$multiple = 0;
					$answer = '';

					for ($i= 'a'; $i <= 'd'; $i++)
					{ 
						if($request->qdata[$j]->{$i})
						{
							$multiple++;
							$answer .= $i;
						}
					}

					$level = 0;

					if(intval($request->test_info[3]) == 1)
					{
						$level = intval($request->qdata[$j]->level);
						$t = ($level == 1) ? $l1++ : (($level == 2 ? $l2++: $l3++));
					}

					$update_QB = $crud->update(
						'question_bank',
						'level', $level,
						'question', "'".$request->qdata[$j]->question."'",
						'a', "'".$request->qdata[$j]->option_a."'",
						'b', "'".$request->qdata[$j]->option_b."'",
						'c', "'".$request->qdata[$j]->option_c."'",
						'd', "'".$request->qdata[$j]->option_d."'",
						'multiple', $multiple,
						"qid = '".$request->qdata[$j]->qid."'"
						);

					if($update_QB == true)
					{
						$update_AB = $crud->update(
						'answer_bank',
						'answer', "'$answer'",
						'posmark',floatval($request->qdata[$j]->posmark),
						'negmark',floatval($request->qdata[$j]->negmark),
						"qid = '".$request->qdata[$j]->qid."'"
						);
					}
					
				}				
			}

			// code to insert new q-a data

			$no_of_qid_present = intval($request->test_info[4]);
			$total_no_of_q_present_earlier = intval($crud->getWhere('total', 'test_creator' , "sid = '$sid'")[0]['total']);

			$update_total = $crud->update(
				'test_creator',
				'total', $total_no_of_q_present_earlier + $tnoq - $no_of_qid_present,
				"sid = '$sid'"
			);


			$insert_into_QB = false;
			$insert_into_AB = false;

			if ($update_test_modification_detail == true && ($no_of_qid_present != $tnoq))
			{
				# code to upload question data to Question Bank
				$temp = $total_no_of_q_present_earlier;
				

				for ($j= $no_of_qid_present + 1; $j<=$tnoq; $j++)	//loop runs to upload data of each Qst
				{
					$multiple = 0;
					$answer = '';
					$temp++;

					for ($i= 'a'; $i <= 'd'; $i++)
					{ 
						if($request->qdata[$j]->{$i})
						{
							$multiple++;
							$answer .= $i;
						}
					}

					$level = 0;

					if(intval($request->test_info[3]) == 1)
					{
						$level = intval($request->qdata[$j]->level);
						$t = ($level == 1) ? $l1++ : (($level == 2 ? $l2++: $l3++));
					}

					$insert_into_QB = $crud->insert(
						'sid', "'$sid'",
						'qno', $temp,
						'qid', "'".$sid."_".$temp."'",
						'level', $level,
						'question', "'".$request->qdata[$j]->question."'",
						'a', "'".$request->qdata[$j]->option_a."'",
						'b', "'".$request->qdata[$j]->option_b."'",
						'c', "'".$request->qdata[$j]->option_c."'",
						'd', "'".$request->qdata[$j]->option_d."'",
						'multiple', $multiple,
						'question_bank'
						);

					if($insert_into_QB == true)
					{
						$insert_into_AB = $crud->insert(
						'qid', "'".$sid."_".$temp."'",
						'answer', "'$answer'",
						'posmark',floatval($request->qdata[$j]->posmark),
						'negmark',floatval($request->qdata[$j]->negmark),
						'answer_bank'
						);
					}
				}
			}

			// codes to delete q-a

			$delete = false;

			if(count($request->del_list) != 0)
			{
				foreach ($request->del_list as $key => $id)
				{
					$delete = $crud->delete(
						'question_bank',
						"qid = '$id'"
					);

					$delete = $crud->delete(
						'answer_bank',
						"qid = '$id'"
					);
				}
			}



			$update_level = false;
			if($update_AB || $insert_into_AB || $delete)
			{
				$update_level = $crud->update(
				'level',
				'is_level_present', intval($request->test_info[3]),
				"l1", $l1,
				'l2', $l2,
				'l3', $l3,
				"sid = '$sid'"
				);
			}

			echo json_encode($update_level);
			break;

		case 'startTest':
			$sid = $request->sid;
			$_SESSION['sid'] = $sid;

			$level_info = $crud->getWhere('level',"sid = '$sid'");
			echo json_encode($level_info[0]);
			break;


		case 'onlineTestDetailsSubmit':
			$sid = $_SESSION['sid'];
			$check = $crud->getWhere('is_live','live_test_detail',"sid = '$sid' AND for_sem = ".$request->sem." AND is_live = 1");

			if(isset($check[0]['is_live']))
			{
				echo json_encode($request->sem);
				break;
			}

			$date = date("Y-m-d H:i:s");
			$result = $crud->insert(
				'sid', "'".$_SESSION['sid']."'",
				'date_conducted', "'".$date."'",
				'is_live', 1,
				'duration',$request->time,
				'l0',intval($request->l0),
				'l1',intval($request->l1),
				'l2',intval($request->l2),
				'l3',intval($request->l3),
				'tnoq',intval($request->l0)+intval($request->l1)+intval($request->l2)+intval($request->l3),
				'for_sem',intval($request->sem),
				'live_test_detail'
			);

			echo json_encode($result);
			break;

		case 'liveTest':
			error_reporting(E_ERROR | E_PARSE);
			$sid = $crud->getWhere('sid','for_sem','live_test_detail',"is_live = 1");
			if($sid == null)
			{
				echo json_encode(0);
				break;
			}
			$data = $sid;
			$t = null;
			$s = null;
			$i = 0;
			foreach ($sid as $key => $value)
			{
				$m = $crud->getWhere('sem_sub_id','topic','test_creator',"sid = '".$value['sid']."'");
				$t[$i] = $m[0];
				$data[$i]['topic'] = $t[$i]['topic'];
				$i++;
			}

			$i = 0;

			foreach ($t as $key => $value)
			{
				$s = $crud->getWhere('sem_sub',"sem_sub_id = '".$value['sem_sub_id']."'");
				$data[$i]['subject'] = $s[0]['subject_name'];
				//$data[$i]['semester'] = $s[0]['semester'];
				$i++;
			}
			if(isset($data[0]['sid']))
				echo json_encode($data);
			else
				echo json_encode(0);
			break;

		case 'studentList':
			$stud_list = $crud->getWhere('uid','name','section','user',"semester = ".intval($request->sem));

			if(isset($stud_list[0]['uid']))
				echo json_encode($stud_list);
			else
				echo json_encode(0);
			break;

		case 'giveAttendence':	// 1 means Allowed to Attempt
			$s = $crud->getWhere('status','student_test_record',"uid = '".$request->id."' AND sid = '".$request->sid."'");
			if($s != null)
			{
				if($s[0]['status'] != 1)
				{
					$r = $crud->update(
						'student_test_record',
						'status',1,
						"uid = '".$request->id."' AND sid = '".$request->sid."'"
					);

					echo "4";
				}

				elseif ($s[0]['status'] == 1)
				{
					$r = $crud->delete('student_test_record', "uid = '".$request->id."' AND sid = '".$request->sid."'");
					echo "Deleted";
				}
			}
			else
			{
				$date = date("Y-m-d H:i:s");
				$r = $crud->insert(
					'uid',"'".$request->id."'",
					'sid',"'".$request->sid."'",
					'date', "'$date'",
					'status',1,
					'student_test_record'
				);

				echo "1";
			}
			break;

		case 'checkAttendence':
			$stud_list = $crud->getWhere('uid','user',"semester = ".intval($request->sem));
			$i = 0;
			foreach ($stud_list as $key => $value)
			{
				$a = $crud->getWhere('status', 'student_test_record', "uid = '".$value['uid']."' AND sid = '".$request->sid."'");

				if(isset($a[0]['status']))
					$stud_list[$i]['status'] = $a[0]['status'];
				else
					$stud_list[$i]['status'] = 0;

				$i++;
			}

			echo json_encode($stud_list);
			break;

		case 'endTest':
			$r = $crud->update(
						'live_test_detail',
						'is_live',0,
						"sid = '".$request->sid."' AND is_live = 1 AND for_sem = ".intval($request->sem)
					);
			echo json_encode($r);
			break;

		case 'reportByStudent':
			error_reporting(E_ERROR | E_PARSE);
			$data = $crud->getWhere('student_test_record', "LEFT(sid,1) = '".$request->sem."' AND status = 3");

			if($data == null)
			{
				echo json_encode(0);
				break;
			}

			$i=0;

			foreach ($data as $key => $value)
			{
				$sql_tm = "SELECT SUM(posmark) as TM FROM `answer_bank` NATURAL JOIN student_response where uid = '".$value['uid']."' and sid = '".$value['sid']."'";

				$tm = mysqli_query($GLOBALS['db'],$sql_tm);
				$row = @mysqli_fetch_assoc($tm);

				$data[$i]['total_marks'] = $row['TM'];

				$sub_top = "SELECT topic, subject_name FROM `test_creator` NATURAL JOIN sem_sub WHERE sid = '".$value['sid']."'";

				$st = mysqli_query($GLOBALS['db'],$sub_top);
				$row = @mysqli_fetch_assoc($st);

				$data[$i]['subject'] = $row['subject_name'];
				$data[$i]['topic'] = $row['topic'];

				$name = $crud->getWhere('name', 'user', "uid = '".$value['uid']."'");

				$data[$i]['name'] = $name[0]['name'];
				$i++;
			}
			echo json_encode($data);
			break;
		
		default:
			echo json_encode($goto);
			break;
	}
}

?>