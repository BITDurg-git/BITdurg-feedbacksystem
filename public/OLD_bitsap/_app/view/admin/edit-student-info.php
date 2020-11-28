<?php
	include 'common.php';
?>

<style type="text/css">
	input[type='email']:focus, input[type='text']:focus,input[type=number]:focus
		 { 
		 	outline: none ! important;
		 	border-bottom: 2px solid var(--theme);
		 }
</style>

	<div class="w3-container">

		<div style="height: 50px;"></div>


		<!-- Row-1 for displaying any messages -->
		<div class="w3-row">

			<div class="w3-col m4">
				<p></p>
			</div>

			<div class="w3-col m4">
				<?php if (isset($res->msg)){ ?>
				<p class="w3-border w3-padding w3-white w3-round w3-text-<?=$res->color?>">
					<?=$res->msg?>
				</p>
				<?php } ?>
			</div>

			<div class="w3-col m4">
			</div>
		</div>


		<!-- Row-2 for entering student's username -->
		<?php if($res->rowno == 2){?>
		<div class="w3-row w3-margin-top">

			<div class="w3-col m4">
				<p></p>
			</div>

			<div class="w3-col m4 w3-border w3-padding w3-white w3-round">
				<h3>Edit details of...</h3>
				<form class="w3-margin-top" method="post">

					<!--<label>Name</label> -->
					<input class="w3-input w3-margin-bottom" type="number" name="uid" required placeholder="Username" autofocus>

					<input type="submit" class="w3-btn w3-ripple w3-small w3-theme w3-round w3-margin-top" name="row-2" value="Submit">

				</form>
			</div>

			<div class="w3-col m4">
			</div>
		</div>
		<?php }?>



		<!-- Row-3 for editing student's username -->
		<?php if($res->rowno == 3){?>
		<div class="w3-row w3-margin-top">

			<div class="w3-col m4">
				<p></p>
			</div>

			<div class="w3-col m4 w3-border w3-padding w3-white w3-round">
				<h3>Reset username...</h3>
				<form class="w3-margin-top" method="post">

					<p class="pl-2">Current Roll No: <?=$_POST['uid']?></p>

					<!--<label>Name</label> -->
					<input class="w3-input w3-margin-bottom" type="number" name="new_uid" required placeholder="New Roll Number" autofocus>

					<input type="number" name="old_uid" hidden value="<?=$_POST['uid']?>">

					<input type="submit" class="w3-btn w3-ripple w3-small w3-theme w3-round w3-margin-top" name="row-3" value="Submit">

				</form>
			</div>

			<div class="w3-col m4">
			</div>
		</div>
		<?php }?>

	</div>