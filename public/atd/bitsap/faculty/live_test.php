<?php
	require 'check_key.php';
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Live Test(s)</h3>
	</div>

	<div class="w3-row w3-margin" ng-app='invigilation' ng-controller='invigilationCtrl'>

		<div class="w3-col m1"><p></p></div>

		<div class="w3-col m10" style="overflow-x: auto;" ng-show='test_list'>

			<table class="w3-table w3-white w3-card-2" ng-show='test_list'>

		      <tr class="w3-theme-l2">
		        <th>Semester</th>
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Code</th>
		        <th>Action</th>
		      </tr>

		    <tr ng-repeat='x in TL' class="w3-hover-light-gray">
		      <td>{{x.semester}}</td>
		      <td>{{x.subject}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-button w3-hover-red w3-text-red" ng-click="end_test(x.sid)">End</td>
		    </tr>

		  </table>
			

		</div>

		<div class="w3-col m1"><p></p></div>	

	</div>
	
</div>

<?php
	require 'unset_key.php';
?>