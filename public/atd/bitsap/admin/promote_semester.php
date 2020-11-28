<?php
	require 'check_key.php';

	$msg = '';
	$do = '';

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$msg = "Done Successfully";
		$do = 'disabled';
	}
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Semester Upgrade</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4">
			<div class="w3-card-2 w3-white w3-padding">
				<form method="post">
					<input type="submit" class="w3-btn w3-green" value='Upgrade' <?=$do?>/>
				</form>

				<h4 class="w3-text-indigo"><?=$msg?></h4>
				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>
	
</div>


<?php
	require 'unset_key.php';
?>