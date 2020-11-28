<style type="text/css">
	input[type='text']:focus
		 { 
		 	outline: none ! important;
		 	border-bottom: 2px solid var(--theme);
		 }
</style>

	<div class="w3-container">
		<div style="height: 50px;"></div>

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

		<div class="w3-row w3-margin-top">

			<div class="w3-col m4">
				<p></p>
			</div>

			<div class="w3-col m4 w3-border w3-padding w3-white w3-round">
				<h3>Password recovery..</h3>
				<form class="w3-margin-top" method="post">

					<!--<label>Email</label> -->
					<input class="w3-input w3-margin-bottom" type="text" name="username" required placeholder="Username" autofocus autocomplete="off">

					<input type="submit" class="w3-btn w3-ripple w3-small w3-theme w3-round w3-margin-top" value="Submit">

				</form>
			</div>

			<div class="w3-col m4">
			</div>
		</div>
	</div>