<style type="text/css">
	input[type='email']:focus, input[type='text']:focus, input[type=password]:focus
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
				<h2>Register Here...</h2>
				<form class="w3-margin-top" method="post">

					<!--<label>Name</label> -->
					<input class="w3-input w3-margin-bottom" type="text" name="name" required placeholder="Full Name" autofocus>

					<!--<label>Email</label> -->
					<input class="w3-input w3-margin-bottom" type="email" name="email" required placeholder="Email" oninput="show_username(this.value);">

					<p class="pl-2" id="show_uname" hidden></p>

					<!--<label>Password</label> -->
					<input class="w3-input w3-margin-bottom" type="password" name="password" required placeholder="Password">

					<input type="text" id="username" name="username" hidden/>
					

					<input type="submit" class="w3-btn w3-ripple w3-small w3-theme w3-round w3-margin-top" value="Submit">

				</form>
			</div>

			<div class="w3-col m4">
			</div>
		</div>

	</div>

<script type="text/javascript">
	function show_username(email)
	{
		var u = document.getElementById('show_uname');
		if(email != '' && email.includes('@'))
		{
			s = email;
			s = s.slice(0, s.indexOf('@',0));

			document.getElementById('username').value = s;

			u.innerHTML = ' Username: ' + s;
			u.hidden = false;
		}
		else
		{
			document.getElementById('username').value = '';
			u.hidden = true;
		}
	}
</script>