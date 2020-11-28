<style type="text/css">
	input[type='text']:focus, input[type='password']:focus
	{ 
		outline: none ! important;
		border-bottom: 2px solid var(--theme);
	}

	.bit_img
	{
		width: 60%;
		height: 80px;
	}

	@media screen and (max-width: 800px)
	{
		.bit_img
		{
			width: 100%;
			height: 60px;
		}
	}
</style>

<div class="w3-theme-d2" style="height: 10px;"></div>
<div class="w3-container w3-theme w3-center">
	<img src="_public/img/bit.png" alt="BIT Durg Online Test Portal" class="bit_img">
</div>
<div class="w3-theme-d2" style="height: 10px;"></div>

<div style="height: 80px;"></div>

<div class="w3-container">
<div class="w3-row">
	<div class="w3-col m7"><p></p></div>
	<div class="w3-col m3">

		<div class="w3-card w3-padding w3-white w3-round">
		<h3 class="w3-margin-bottom">Sign in</h3>
		<form method="post" action="<?php echo $res->action;?>/login">
			<p>
				<label>Username: </label>
				<input class="w3-input" type="text" name="usr" autocomplete="off" maxlength="25" required autofocus>
			</p>
			<p>
				<label>Password: </label>
				<input class="w3-input" type="password" name="pwd" maxlength="25" required>
			</p>
			<p>
				<input type="submit" name="submit" value="Login" class="w3-round w3-btn w3-theme w3-ripple w3-small" style="outline: none;">
			</p>
		</form>
		<a href="<?php echo $res->action;?>/signup" class="w3-small w3-text-theme">Sign up</a><br>
		<a href="<?php echo $res->action;?>/forgot-password" class="w3-small w3-text-theme">Forgot password</a>
		</div>

	</div>
	<div class="w3-col m2"><p></p></div>
</div>
</div>