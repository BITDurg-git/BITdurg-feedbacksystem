<?php
	include 'common.php';
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Create New Test</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4 w3-center">
			<div class="w3-card-2 w3-white w3-padding" ng-app="createTest" ng-controller="createTestCtrl">


				<div class="w3-dropdown-hover">

				    <button class="w3-btn w3-theme-l1">Select Semester</button>
				    <div class="w3-dropdown-content w3-bar-block w3-border">
				      
	     <?php
		for ($i=3; $i<=8 ; $i++)
		{ 
		?>
					<a href="<?php echo $res->action?>/faculty/create_test/:sem=<?php echo $i?>" class="w3-bar-item w3-button">
						<?php echo $i?>	
					</a>
		<?php
		}
		?>
					<a href="<?php echo $res->action?>/faculty/create_test/:sem=0" class="w3-bar-item w3-button">Common to All Semester</a>

				    </div>
				</div>

		<?php
			if(isset($res->sem))
			{
		?>


				<div>
					<h5 class="w3-padding"><?php echo ($res->sem > 0 && $res->sem < 9)?$res->sem.' Sem ':''; ?>Subjects :-</h5>


			<?php
			if($res->subject_list != '')
			{
			?>
					<ul class="w3-ul">

						<?php
						foreach($res->subject_list as $key => $data)
						{
						?>

					    <li style="padding: 0;">
					    	<a style="display: block;" class="w3-button" href="<?php echo $res->action?>/faculty/new_test_db/:id=<?php echo $data['sem_sub_id']; ?>">
					    		<?php echo $data['subject_name'];?>
					    	</a>
					    </li>

					    <?php
						}
					    ?>

				 	</ul>
			<?php
			}

			else
				echo "<b>No Subjects Found</b><br>";
			?>

				 	<br>

				 	<form method="post" action="<?php echo $res->action?>/faculty/create_test" class="w3-row">
				 		<div class="w3-col m8">
				 			<input type="text" name="subject" class="w3-input w3-border" required="" autocomplete="off">
				 			<input type="number" name="sem" value="<?php echo $res->sem?>" hidden>
				 		</div>
				 		<div class="w3-col m4">
				 			<input type="submit" name="add_sub" value="Add Subject" class="w3-btn w3-teal"/>
				 		</div>
				 	</form>
				</div>

		<?php
		}
		?>

				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>
	
</div>