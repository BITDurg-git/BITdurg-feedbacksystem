<?php
	include 'common.php';
?>

<style type="text/css">
	input[type='text']:focus
	 { 
	 	outline: none ! important;
	 	border: 2px solid blue ! important;
	 }
</style>

<div class="w3-container">
<div ng-app="report" ng-controller="reportCtrl">

	<div class="w3-bar w3-center">
		<h3>Report</h3>
	</div>

	<div class="w3-row">
		<div class="w3-col m3"><p></p></div>

		<div class="w3-col m6">

			<div class="w3-card-2 w3-white w3-padding">

				<select class="w3-select w3-center" ng-model="semester" ng-change="getSubject()">
					<option disabled selected hidden>Select Semester</option>
					<option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
				</select>

				<div class="w3-row w3-center w3-margin">
					<div>
						<button class="w3-btn w3-indigo w3-ripple" ng-click='getReport()'>Get Student's Report</button>
					</div>
				</div>
				
			</div>

		</div>

		<div class="w3-col m3"><p></p></div>
	</div>

	<br>

	<div class="w3-row w3-center" ng-show='byStud'>
		<div class="w3-col m4"><p></p></div>
		<div class="w3-col m4">
			<input type="text" class="w3-input w3-border w3-round-xxlarge w3-padding" placeholder="Enter keyword to search" ng-model='keyword'>
		</div>
		<div class="w3-col m4"><p></p></div>
	</div>

	<br>

	<div class="w3-row" ng-show='byStud'>
		<div class="w3-col m1"><p></p></div>

		<div class="w3-col m10 scroll">
			
			<table class="w3-table w3-hoverable w3-centered w3-white w3-card-2">

				<tr class="w3-theme-l2">
					<th>Name</th>
					<th>ID</th>
					<th>Subject</th>
					<th>Topic</th>
					<th class="w3-btn" ng-click="orderByMe('date')">Date</th>
					<th class="w3-btn" ng-click="orderByMe('score')">Score Obtained</th>
					<th>Total Marks</th>
					<th>Percentage</th>
				</tr>

				<tr ng-repeat='x in rep_by_stud | filter:keyword | orderBy:myOrderBy:toggle'>
					<td>{{x.name}}</td>
					<td>{{x.uid}}</td>
					<td>{{x.subject}}</td>
					<td>{{x.topic}}</td>
					<td>{{x.date}}</td>
					<td>{{x.score}}</td>
					<td>{{x.total_marks}}</td>
					<td>{{x.score / x.total_marks * 100 | number : 2}}</td>
				</tr>

			</table>

		</div>

		<div class="w3-col m1"><p></p></div>
	</div>

</div>
</div>

<script type="text/javascript">

// Code for Student_report.php

var report = angular.module('report', []);
report.controller('reportCtrl', function($scope,$http)
{
	$scope.semester = 'Select Semester';
	$scope.rep_by_stud = null;
	$scope.byStud = false;
	$scope.keyword = '';
	$scope.toggle = false;

	$scope.getReport = function(){
		
		if($scope.semester == 'Select Semester')
			alert("Pick a Semester !");
		else
		{
			var data = {q: 'reportByStudent', sem : $scope.semester};

			$http.post("<?php echo $res->action?>/faculty/serve", data)
			.then(function(response){
				if(response.data == 0)
				{
					$scope.rep_by_stud = null;
					$scope.byStud = false;
					alert("No Record Found !");
				}
				else
				{
					$scope.rep_by_stud = response.data;
					$scope.byStud = true;
				}
			});

		}
	}

	$scope.orderByMe = function(x){
		 $scope.myOrderBy = x;
		 $scope.toggle = ($scope.toggle == true)?false:true;
	}
});

</script>