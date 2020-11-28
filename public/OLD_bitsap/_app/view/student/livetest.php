<?php
	include 'common.php';
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Live Test(s)</h3>
	</div>

	<?php

		$crud = new crud();

		$sem = intval($_SESSION['sem']);
		$live = $crud->getWhere('live_test_detail',"is_live = 1 AND for_sem = $sem");
		if($live != null)
		{
			foreach ($live as $key => $row)
			{
				$sql = "SELECT subject_name, topic FROM test_creator NATURAL JOIN sem_sub WHERE sid =  '".$row['sid']."'";
				$result = mysqli_query($GLOBALS['db'],$sql);
				$data = mysqli_fetch_assoc($result);
				$live[$key]['subject'] = $data['subject_name'];
				$live[$key]['topic'] = $data['topic'];
			}
	?>

	<div class="w3-row w3-margin">

		<div class="w3-col m3"><p></p></div>

		<div class="w3-col m6">

			<table class="w3-table w3-white w3-card-2">
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Duration</th>
		        <th>Test ID</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <?php
		    	foreach ($live as $key => $data)
		    	{
		    ?>
		    <tr class="w3-hover-light-gray" ng-repeat='x in liveTestData'>
		      <td><?php echo $data['subject']; ?></td>
		      <td><?php echo $data['topic']; ?></td>
		      <td><?php echo $data['duration']; ?> Minutes</td>
		      <td><?php echo $data['sid']; ?></td>
		      <td><a href="<?php echo $res->action;?>/student/sid_for_test/:sid=<?php echo $data['sid']; ?>" class="w3-text-indigo">Take Test</a></td>
		    </tr>


			<?php } ?>
		    
		  	</table>
			

		</div>

		<div class="w3-col m3"><p></p></div>	

	</div>

	<?php
		}
		else
		{
	?>

	<script type="text/javascript"> alert('No tests are live currently');</script>

	<?php } ?>
	
</div>
