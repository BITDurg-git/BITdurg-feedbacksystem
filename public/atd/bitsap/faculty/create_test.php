<?php
	require 'check_key.php';
?>

<div class="w3-container">

	<div class="w3-bar w3-center">
		<h3>Create New Test</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4">
			<div class="w3-card-2 w3-white w3-padding" ng-app="createTest" ng-controller="createTestCtrl">

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
					    	<a href="faculty.php?q=test_work&&s={{x.sem_sub_id}}">{{x.subject_name}}</a>
					    </li>
				 	</ul>

				 	<br>

				 	<div class="w3-row">
				 		<div class="w3-col m8">
				 			<input type="text" class="w3-input w3-border" ng-model='add_sub'>
				 		</div>
				 		<div class="w3-col m4">
				 			<button class="w3-btn w3-teal" ng-click="add_subject()">Add Subject</button>
				 		</div>
				 	</div>

				</div>
				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>
	
</div>

<?php
	require 'unset_key.php';
?>