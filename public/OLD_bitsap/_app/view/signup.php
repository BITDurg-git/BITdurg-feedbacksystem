<style type="text/css">
	input[type='email']:focus, input[type='text']:focus, input[type=number]:focus,input[type='password']:focus, select:focus
		 { 
		 	outline: none ! important;
		 	border-bottom: 2px solid var(--theme);
		 }
</style>

<div class="w3-container w3-theme-d1">
		<h1 class="w3-center">BIT Self Assessment Portal</h1>
</div>

<div class="w3-container">
	<div style="height: 30px;"></div>

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
					<input class="w3-input w3-margin-bottom" type="text" name="name" required placeholder="Full Name" autofocus autocomplete='off'>

					<!--<label>University Roll No.</label> -->
					<input class="w3-input w3-margin-bottom" name="rollno" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "15" required placeholder="CSVTU Roll No.">

					<input class="w3-input w3-margin-bottom" type = "text" name="enrollno" maxlength = "8" required placeholder="CSVTU Enrollment No." autocomplete='off'>

					<!-- <label>Choose Semester:</label> -->
					<select class="w3-select w3-margin-bottom" name="sem" required>
					  <option value="" disabled selected>Semester</option>
					  <option value="1">1<sup>st</sup> Sem</option>
					  <option value="2">2<sup>nd</sup> Sem</option>
					  <option value="3">3<sup>rd</sup> Sem</option>
					  <option value="4">4<sup>th</sup> Sem</option>
					  <option value="5">5<sup>th</sup> Sem</option>
					  <option value="6">6<sup>th</sup> Sem</option>
					  <option value="7">7<sup>th</sup> Sem</option>
					  <option value="8">8<sup>th</sup> Sem</option>
					</select>

					<!--<label>Email</label> -->
					<input class="w3-input w3-margin-bottom" type="email" name="email" required placeholder="Email" autocomplete="off">

					<!--<label>Password</label> -->
					<input class="w3-input w3-margin-bottom" type="password" name="password" required placeholder="Password" autocomplete="off">

					<input class="w3-radio w3-margin-bottom" type="radio" name="section" value="A" id="a" required>
					<label for="a"> Sec-A</label>
					<input class="w3-radio w3-margin-bottom" type="radio" name="section" value="B" id="b" required>
					<label for="b"> Sec-B</label><br>
					

					<input type="submit" class="w3-btn w3-ripple w3-small w3-theme w3-round w3-margin-top" value="Submit">

				</form>
			</div>

			<div class="w3-col m4">
			</div>
		</div>

	</div>
</div>