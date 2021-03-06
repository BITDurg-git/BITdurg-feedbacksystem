<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
  <a href="<?php echo $res->action?>/student/livetest" class="w3-bar-item w3-button">Live Test(s)</a>
  <a href="<?php echo $res->action?>/student/report" class="w3-bar-item w3-button">View Report</a>
  <a href="<?php echo $res->action?>/student/profile" class="w3-bar-item w3-button">Profile</a>
</div>

<!-- Dashboard Header -->
<header class="w3-bar w3-theme">
	<div>
		<button style="margin-top: 5px;" class="w3-btn w3-xxlarge w3-left" onclick="w3_open()">&#9776;</button>
		<h2 class="w3-left" id="header-title"><a class="w3-btn w3-text-white" href="<?php echo $res->action?>/student">Dashboard</a></h2>
		<h4 class="w3-right w3-padding">
			<a href="<?php echo $res->action?>/logout" class="w3-btn w3-light-gray w3-medium w3-round w3-ripple">Log out</a>
		</h4>
	</div>
</header>

<!-- Page Content -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
     
<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>
