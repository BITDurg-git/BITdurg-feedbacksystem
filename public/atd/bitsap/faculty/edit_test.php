<?php
	require 'check_key.php';
?>

<div class="w3-container" ng-app="createTest" ng-controller="createTestCtrl">

	<div class="w3-bar w3-center">
		<h3>Edit Test</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4">
			<div class="w3-card-2 w3-white w3-padding" >

				<select class="w3-select" ng-model="semester" ng-change="getSubject()">
					<option disabled selected hidden>Select Semester</option>
					<option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
				</select>

				<div ng-switch="subject" id="subject_display" class="w3-hide"> <!-- Hidden by default -->
					<h5 class="w3-padding">Subjects :-</h5>

					<p ng-switch-when="null"><b>No Subjects found!</b></p>

					<ul class="w3-ul w3-hoverable" ng-switch-default>
					    <li ng-repeat="x in subject">
					    	<a href="#" ng-click="showTest(x.sem_sub_id)">
					    	{{x.subject_name}}
					    	</a>
					    </li>
				 	</ul>

				</div>
				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>

	<div class="w3-row w3-margin"> <!-- class="w3-hide" -->

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8 w3-hide" ng-switch='testList' id="test_display">

			<p ng-switch-when="null" class="w3-center"><b>No Records found!</b></p>

			<table class="w3-table w3-hoverable w3-centered w3-white w3-card-2" ng-switch-default>
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Topic</th>
		        <th>Total Questions</th>
		        <th>Test ID</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tr ng-repeat='x in testList'>
		      <td>{{x.topic}}</td>
		      <td>{{x.tnoq}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-text-indigo">
		      	<a href="faculty.php?q=etw&&s={{x.sid}}" ng-if="x.uid == getCookie('userid')">Edit</a>
		      </td>
		    </tr>
		  </table>
			

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>
	
</div>

<?php
	require 'unset_key.php';
?>