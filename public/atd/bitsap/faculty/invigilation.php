<?php
	require 'check_key.php';
?>

<link rel="stylesheet" type="text/css" href="css/customCB.css">

<style type="text/css">
		html, body
		{
		    height: 100%;
		    width: 100%;
		}

		.loader
		{
			width: 100%;
			height: 100%;
			background: rgba(255, 255, 255, 0.5);
			z-index: 100;
			top: 0;
			position: absolute;
		}


		.spinner
		{
			border: 15px solid #f2f2f2;
			border-right: 15px solid #666666;
			border-radius: 50%;
			width: 125px;
			height: 125px;

			position: relative;
			top: 40%;
			left: 45%;

			opacity: 1;

			-webkit-animation: spin 1s linear infinite;
		  	animation: spin 1s linear infinite;
		}

		@-webkit-keyframes spin {
		  0% { -webkit-transform: rotate(0deg); }
		  100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}

</style>

<div class="w3-container" ng-app='invigilation' ng-controller='invigilationCtrl'>

	<div class="w3-bar w3-center">
		<h3>Invigilate Test(s)</h3>
	</div>

	<div class="w3-row w3-margin">

		<div class="w3-col m1"><p></p></div>

		<div class="w3-col m10" style="overflow-x: auto;">

			<table class="w3-table w3-white w3-card-2" ng-show='test_list'>

		      <tr class="w3-theme-l2">
		        <th>Semester</th>
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Code</th>
		        <th>Attendence List</th>
		      </tr>

		    <tr ng-repeat='x in TL' class="w3-hover-light-gray">
		      <td>{{x.semester}}</td>
		      <td>{{x.subject}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-button w3-text-indigo" ng-click="open_list(x.semester,x.sid)">Open List</td>
		    </tr>

		  </table>
			

		</div>

		<div class="w3-col m1"><p></p></div>	

	</div>

	<div class="w3-bar w3-center" ng-show='invigilation_list'>
		<h4>List of {{sem}} Sem Students </h4>
	</div>

	<div class="w3-row w3-margin">

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8 w3-center">

			<table class="w3-table w3-white w3-card-2" ng-show='invigilation_list' >
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Student Name</th>
		        <th>Student ID</th>
		        <th>Attendence</th>
		      </tr>
		    </thead>
		    <tr class="w3-hover-sand w3-border-bottom" ng-repeat='x in SL'>
		      <td>{{x.name}}</td>
		      <td>{{x.uid}}</td>
		      <td>
		      	<input class="styled-checkbox" type="checkbox" id="{{x.uid}}" ng-click="give_attendence(x.uid)">
		      	<label for='{{x.uid}}'></label>
		      	<span class="{{x.uid}}">Absent</span>
		      </td>
		    </tr>
		  </table>
			

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>
	
</div>

<div class="loader" hidden>
	<div class="spinner"></div>
</div>

<?php
	require 'unset_key.php';
?>