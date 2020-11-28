<?php
	require 'check_key.php';
	include 'crud.php';

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];

		#get Qid based on sid and uid
		#then get QnA corresponding to that Qid
		#also check whether student attepmted correct ans or not

		$crud = new crud();

		$topic = $crud->getWhere('topic','subject', "sid = '$id'");
		$uid = $_SESSION['userid'];
		$qid_set = $crud->getWhere('qid','response','response', "uid = '$uid' AND sid = '$id'");

		echo '<div class="w3-container">';
		echo '<h3 class="w3-center">'.$topic[0]['topic'].'</h3>';
		$i = 1;
		if(!empty($qid_set))
		{
			foreach ($qid_set as $key => $value)
			{
				# code...
				$qid = $value['qid'];
				$q_data = $crud->getWhere('question_bank', "qid = '$qid'");
				$a_data = $crud->getWhere('answer_bank', "qid = '$qid'");
?>

<div class="w3-border w3-margin">
	<div class="w3-row w3-padding">
		<h4 class="w3-col m8">Question No: <?=$i?></h4>
		<div class="w3-col m4 w3-padding">
			<span>+<?=$a_data[0]['posmark']?>/-<?=$a_data[0]['posmark']?></span>
			<span>
				<?php
				if($q_data[0]['level'] != 0)
					echo "Level: ".$q_data[0]['level'];
				?>
			</span>
		</div>
	</div>

	<div class="w3-border-top">
		
		<div class="w3-padding"><pre><?=htmlspecialchars($q_data[0]['question'])?></pre></div>

		<div>
			<pre class="w3-border-top w3-padding">A)<?=$q_data[0]['a']?></pre>
			<pre class="w3-border-top w3-padding">B)<?=$q_data[0]['b']?></pre>
			<pre class="w3-border-top w3-padding">C)<?=$q_data[0]['c']?></pre>
			<pre class="w3-border-top w3-border-bottom w3-padding">D)<?=$q_data[0]['d']?></pre>
		</div>

		<p class="w3-padding">Correct Answer : <?=$a_data[0]['answer']?></p>
		<p class="w3-padding">Your Answer: <?=$value['response']?></p>

		<?php

		if ($value['response'] == null || $value['response'] =='')
		{
			$flag = -1;
		}
		else
		{
			$answer = $a_data[0]['answer'];

			if(strlen($answer) == strlen($value['response']))
			{
				$a = str_split($answer);
				$b = str_split($value['response']);
				$n = count(array_intersect($a, $b));

				if($n == strlen($answer))
				{
					$flag = 1;
				}
				else
				{
					$flag = 0;
				}
			}
			else
			{
				$flag = 0;
			}
		}

		if($flag > 0)
		{
			echo "<p class='w3-text-green w3-padding'><b>Attempted Correctly</b></p>";
		}
		elseif($flag == 0)
		{
			echo "<p class='w3-text-red w3-padding'><b>Wrong Attempt</b></p>";
		}
		else
		{
			echo "<p class='w3-text-blue w3-padding'><b>Not Attempted</b></p>";
		}

		?>
	</div>

</div>

<br>

<?php
				$i++;
			}
		}
	}
	echo '</div>';
	require 'unset_key.php';
?>