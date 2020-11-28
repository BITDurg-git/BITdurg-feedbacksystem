<?php
	require 'check_key.php';
?>

<div class="w3-container" ng-app='liveTest' ng-controller='liveTestCtrl'>

	<div class="w3-bar w3-center">
		<h3>Live Test(s)</h3>
	</div>

	<div class="w3-row w3-margin">

		<div class="w3-col m3"><p></p></div>

		<div class="w3-col m6">

			<table class="w3-table w3-white w3-card-2">
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Duration</th>
		        <th>Test ID</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tr class="w3-hover-light-gray" ng-repeat='x in liveTestData'>
		      <td>{{x.subject}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.duration}} Minutes</td>
		      <td>{{x.sid}}</td>
		      <td ng-click="take_test(x.sid)" class="w3-button w3-text-indigo"><a href="javascript:void(0);">Take Test</a></td>
		    </tr>
		    
		  </table>
			

		</div>

		<div class="w3-col m3"><p></p></div>	

	</div>
	
</div>

<?php
	require 'unset_key.php';
?>