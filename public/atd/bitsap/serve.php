<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if($_SESSION['type'] == 's')
{
	date_default_timezone_set('Asia/Kolkata');
	include 'crud.php';
	$crud = new crud();

	$goto = '';
	$postdata = file_get_contents("php://input");	//Code to get POST data from AngularJs
    $request = json_decode($postdata);
	$goto = $request->q;

	switch ($goto)
	{
		case 'examData':

			$attendence = $crud->getWhere('status', 'student_test_record',
				"uid = '".$_SESSION['userid']."' AND sid = '".$_SESSION['sid']."'"
			);

			if(isset($attendence[0]['status']))
			{
				if($attendence[0]['status'] == 1)
				{
					$update = $crud->update(
						'student_test_record',
						'status', 2,
						"uid = '".$_SESSION['userid']."' AND sid = '".$_SESSION['sid']."'");

					
				}
				else if ($attendence[0]['status'] == 2 || $attendence[0]['status'] == 4)
				{
					$update = $crud->update(
						'student_test_record',
						'status', 4,
						"uid = '".$_SESSION['userid']."' AND sid = '".$_SESSION['sid']."'");
					break;
				}

				else
				{
					echo json_encode(intval($attendence[0]['status']));
					break;
				}
			}
			else
			{
				echo json_encode(0);
				break;
			}



			$sid = $_SESSION['sid'];
			$online_test = $crud->getWhere('online_test',"sid = '$sid' AND is_live = 1");
			/*if($online_test[0]['is_live'] != 1)
			{
				echo json_encode(0);
				break;
			}*/
			
			$total_no_of_q = $online_test[0]['tnoq'];
			$quest_bank = [];
			$QL_1 = null;
			$QL_2 = null;
			$QL_3 = null;

			if($online_test[0]['l0'] != 0)
			{
				$n = $online_test[0]['l0'];
				$quest_bank = $crud->getWhere('question_bank', "sid = '$sid' ORDER BY RAND() LIMIT $n");
			}
			else
			{
				if($online_test[0]['l1'] != 0)
				{
					$n = $online_test[0]['l1'];
					$QL_1 = $crud->getWhere('question_bank', "sid = '$sid' AND level = 1 ORDER BY RAND() LIMIT $n");

					$quest_bank = array_merge($quest_bank, $QL_1);
				}

				if($online_test[0]['l2'] != 0)
				{
					$n = $online_test[0]['l2'];
					$QL_2 = $crud->getWhere('question_bank', "sid = '$sid' AND level = 2 ORDER BY RAND() LIMIT $n");

					$quest_bank = array_merge($quest_bank, $QL_2);
				}

				if($online_test[0]['l3'] != 0)
				{
					$n = $online_test[0]['l3'];
					$QL_3 = $crud->getWhere('question_bank', "sid = '$sid' AND level = 3 ORDER BY RAND() LIMIT $n");

					$quest_bank = array_merge($quest_bank, $QL_3);
				}
				
			}

			$ans_bank = null;
			$i=0;

			foreach ($quest_bank as $key => $row)
			{
				$temp = $crud->getWhere('posmark','negmark','answer_bank', "qid = '".$row['qid']."'");
				$ans_bank[$i] = $temp[0];
				$i++;
			}

			class Data {}

			$result = new Data();
			$result->test_info = $online_test;
			$result->quest_data = $quest_bank;
			$result->ans_data = $ans_bank;

			$response_check = false;

			foreach ($quest_bank as $key => $value)
			{
				$response_check = $crud->insert(
					'uid',"'".$_SESSION['userid']."'",
					'sid',"'".$sid."'",
					'qid',"'".$value['qid']."'",
					'response'
				);

				if($response_check == false)
					break;
			}

			if($response_check)
				echo json_encode($result);
			//else
				//echo json_encode(0);
			break;

		case 'uploadResponse':
			if(!isset($request->qid))
				break;
			$t = 'null';
			$response = $crud->getWhere('response','response',"qid = '".$request->qid."' AND uid = '".$_SESSION['userid']."'");
			$option_values = str_split($response[0]['response']);
			switch ($request->status)
			{
				case 1:
					$t = $crud->update(
						'response',
						'response', "'".$response[0]['response'].$request->option."'",
						"qid = '".$request->qid."' AND uid = '".$_SESSION['userid']."'"
					);
					break;

				case 0:
					unset($option_values[array_search($request->option, $option_values)]);
					$b = array_values($option_values);

					$t = $crud->update(
						'response',
						'response', "'".implode('',$b)."'",
						"qid = '".$request->qid."' AND uid = '".$_SESSION['userid']."'"
					);
					break;
				
				default:
					# code...
					break;
			}
			echo json_encode($t);
			break;

		case 'examEnd':
			$sid = 0;
			$score = 0;
			if($request->status == 'end')
			{
				$sid = $_SESSION['sid'];
				$update = $crud->update(
						'student_test_record',
						'status', 3,
						"uid = '".$_SESSION['userid']."' AND sid = '".$_SESSION['sid']."'");
				$_SESSION['sid'] = null;
			}

			//Score Evaluation Begins :-

			$response = $crud->getWhere('response', "sid = '$sid' AND uid = '".$_SESSION['userid']."'");

			foreach ($response as $key => $value)
			{
				if ($value['response'] == null || $value['response'] =='')
				{
					//do nothing
				}
				else
				{
					$answer = $crud->getWhere('answer_bank',"qid = '".$value['qid']."'");

					if(strlen($answer[0]['answer']) == strlen($value['response']))
					{
						$a = str_split($answer[0]['answer']);
						$b = str_split($value['response']);
						$n = count(array_intersect($a, $b));

						if($n == strlen($answer[0]['answer']))
						{
							$score += floatval($answer[0]['posmark']);
						}
						else
						{
							$score -= abs(floatval($answer[0]['negmark']));
						}
					}
					else
					{
						$score -= abs(floatval($answer[0]['negmark']));
					}
				}
			}

			$update = $crud->update(
						'student_test_record',
						'score', $score,
						"uid = '".$_SESSION['userid']."' AND sid = '$sid'");

			echo json_encode($score);
			break;

		case 'timeLeft':
				$update = $crud->update(
						'student_test_record',
						'time_left', intval($request->t),
						"uid = '".$_SESSION['userid']."' AND sid = '".$_SESSION['sid']."'");
				echo "done";
			break;

		default:
			break;
	}
}

?>