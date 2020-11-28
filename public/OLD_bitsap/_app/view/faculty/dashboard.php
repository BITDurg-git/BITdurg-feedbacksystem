<?php
	include 'common.php';
?>

<div class="w3-container">

	<br>
	<br>
	
	<div class="w3-row w3-center">

		<div class="w3-col m2">
			<p></p>
		</div>
		
		<div class="w3-col m2">
			
				<a href="<?php echo $res->action?>/faculty/create_test" class='w3-btn w3-large w3-ripple w3-border w3-round'>
				<img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Create New Test</a>
			
		</div>

		<div class="w3-col m1">
			<p></p>
		</div>

		
		<div class="w3-col m2">
			
				<a href="<?php echo $res->action?>/faculty/conduct_test" class='w3-btn w3-large w3-ripple w3-border w3-round'>
				 <img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Conduct Online Test</a>
			
		</div>

		<div class="w3-col m1">
			<p></p>
		</div>

		<div class="w3-col m2">
			<a href="<?php echo $res->action?>/faculty/invigilation" class='w3-btn w3-large w3-ripple w3-border w3-round'>
				<img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Invigilation</a>
		</div>

		<div class="w3-col m2">
			<p></p>
		</div>

	</div>

	<div class="w3-row w3-center w3-margin-top">
		
		<div class="w3-col m2">
			<p></p>
		</div>
		
		<div class="w3-col m2">
			
				<a href="<?php echo $res->action?>/faculty/edit_test" class='w3-btn w3-large w3-ripple w3-border w3-round'>
					<img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Edit Test</a>
		</div>

		<div class="w3-col m1">
			<p></p>
		</div>

		<div class="w3-col m2">
			
				<a href="<?php echo $res->action?>/faculty/student_report" class='w3-btn w3-large w3-ripple w3-border w3-round'>
					<img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Student's Report</a>
		</div>

		<div class="w3-col m1">
			<p></p>
		</div>


		<div class="w3-col m2">
			
				<a href="<?php echo $res->action?>/faculty/live_test" class='w3-btn w3-large w3-ripple w3-border w3-round'>
					<img src="_public/img/ct.png" class="w3-round w3-border" alt="CT" style="width:95%; height:200px; margin-bottom: 2px;"><br>Live Test(s)</a>
		</div>

		<div class="w3-col m2">
			<p></p>
		</div>


	</div>

</div>