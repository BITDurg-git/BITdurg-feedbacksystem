<?php
	require 'check_key.php';
?>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
  <a href="student.php?q=live_test" class="w3-bar-item w3-button">Live Test(s)</a>
  <a href="student.php?q=report" class="w3-bar-item w3-button">View Report</a>
  <a href="student.php?q=profile" class="w3-bar-item w3-button">Profile</a>
</div>

<!-- Dashboard Header -->
<header class="w3-bar w3-theme">
	<div >
		<button class="w3-button w3-xxlarge w3-left" onclick="w3_open()">&#9776;</button>
		<h2 class="w3-left" id="header-title"><a href="student.php">Dashboard</a></h2>
		<h4 class="w3-right w3-padding">
			<a href="logout.php" class="w3-btn w3-amber w3-medium w3-round-large">Log out</a>
		</h4>
	</div>
</header>

<!-- Page Content -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<?php
include 'student/route.php';
?>
     
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

<?php
	require 'unset_key.php';
?>