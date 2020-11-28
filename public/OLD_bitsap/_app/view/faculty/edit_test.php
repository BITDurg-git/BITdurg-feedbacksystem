<?php
	include 'common.php';
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Edit Test</h3>
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
					<a href="<?php echo $res->action?>/faculty/edit_test/:sem=<?php echo $i?>" class="w3-bar-item w3-button">
						<?php echo $i?>	
					</a>
		<?php
		}
		?>
					<a href="<?php echo $res->action?>/faculty/edit_test/:sem=0" class="w3-bar-item w3-button">Common to All Semester</a>

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
					    	<a style="display: block;" class="w3-button" href="<?php echo $res->action?>/faculty/edit_test/:id=<?php echo $data['sem_sub_id']; ?>">
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
				</div>

		<?php
		}
		?>

				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>

	<?php 
	if(isset($res->id))
	{
	?>

	<div class="w3-row w3-margin"> <!-- class="w3-hide" -->

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8">

		<?php if($res->test_list == '') {?>

			<p class="w3-center"><b>No Records found!</b></p>

		<?php 
		} else 
		{
		?>

			<table class="w3-table w3-centered w3-white w3-card-2">
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Topic</th>
		        <th>Total Questions</th>
		        <th>Test ID</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <?php
		    foreach ($res->test_list as $key => $data)
		    {
		    ?>

		    <tr class="w3-hover-light-gray">
		      <td><?php echo $data['topic']; ?></td>
		      <td><?php echo $data['tnoq']; ?></td>
		      <td><?php echo $data['sid']; ?></td>
		      <td class="w3-text-indigo">
		      	<?php echo ($data['uid'] == $_SESSION['userid'])?"<a href='$res->action/faculty/edit_test_db/:id=".$data['sid']."' >Edit</a>":''; ?>
		      </td>
		    </tr>

		    <?php
			}?>

		  </table>
			
		<?php 
		}
		?>

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>

	<?php
	}
	?>
	
</div>