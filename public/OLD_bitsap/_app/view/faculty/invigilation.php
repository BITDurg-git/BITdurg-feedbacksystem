<?php include 'common.php';?>

<style type="text/css">
	input[type='text']:focus
	 { 
	 	outline: none ! important;
	 	border: 2px solid blue ! important;
	 }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/customCB.css">
<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/loader.css">

<div class="w3-container" ng-app='invigilation' ng-controller='invigilationCtrl'>

	<div class="w3-bar w3-center">
		<h3>Invigilate Test(s)</h3>
	</div>

	<div class="w3-row w3-margin">

		<div class="w3-col m1"><p></p></div>

		<div class="w3-col m10 scroll">

			<table class="w3-table w3-white w3-card-2" ng-show='test_list'>

		      <tr class="w3-theme-l2">
		        <th>For Semester</th>
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Code</th>
		        <th>Attendence List</th>
		      </tr>

		    <tr ng-repeat='x in TL' class="w3-hover-light-gray">
		      <td>{{x.for_sem}}</td>
		      <td>{{x.subject}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-button w3-text-indigo" ng-click="open_list(x.for_sem,x.sid)">Open List</td>
		    </tr>

		  </table>
			

		</div>

		<div class="w3-col m1"><p></p></div>	

	</div>

	<div class="w3-bar w3-center" ng-show='invigilation_list'>
		<h4>List of {{sem}} Sem Students </h4>

	<div class="w3-row w3-center">
		<div class="w3-col m4"><p></p></div>
		<div class="w3-col m4">
			<input type="text" class="w3-input w3-border w3-round-xxlarge w3-padding" placeholder="Filter by name, id" ng-model='keyword'>
		</div>
		<div class="w3-col m4"><p></p></div>
	</div>

	<div class="w3-row w3-margin">

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8 w3-center">

			<table class="w3-table w3-white w3-card-2" ng-show='invigilation_list' >
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Student Name</th>
		        <th>Student ID</th>
		        <th>Section</th>
		        <th>Attendence</th>
		      </tr>
		    </thead>
		    <tr class="w3-hover-sand w3-border-bottom" ng-repeat="x in SL | filter:keyword | orderBy:'section'">
		      <td>{{x.name}}</td>
		      <td>{{x.uid}}</td>
		      <td>{{x.section}}</td>
		      <td>
		      	<input type="checkbox" id="{{x.uid}}" ng-click="give_attendence(x.uid)">
		      	<label for='{{x.uid}}'> <span class="{{x.uid}}">Absent</span></label>
		      	
		      </td>
		    </tr>
		  </table>
			

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>
	</div>
	
</div>

<div class="loader w3-center" hidden>
	
	<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

</div>

<script type="text/javascript">

var invigilation = angular.module('invigilation', []);
invigilation.controller('invigilationCtrl', function($scope,$http,$interval)
{
	$scope.invigilation_list = false;
	$scope.test_list = false;
	$scope.TL = null;
	$scope.SL = null;
	$scope.sem = 0;
	$scope.sid = null;

	$scope.attendence = null;

	$scope.live_test = function(arg = ''){
		var data = {q: 'liveTest'};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			if(response.data == 0)
			{
				$scope.test_list = false;
				if(arg == '')
					alert("No Records Found !!");
				else
					alert("Done");
			}
			else
			{
				$scope.TL = response.data;
				$scope.test_list = true;
			}
			//alert(response.data);
		});
	}

	$scope.live_test();

	$scope.open_list = function(sem, sid){
		$('.loader').show();


		$scope.sem = sem;
		$scope.sid = sid;
		$scope.invigilation_list = true;

		var data = {q: 'studentList', sem: sem};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			if(response.data == 0)
			{
				alert("No Records Found !!");
			}
			else
			{
				$scope.SL = response.data;
				$('body').css({'overflow' : 'hidden'});
				$scope.invigilation_list = true;
				$scope.check();
			}
		});
	}

	$scope.give_attendence = function(id){
		//alert(id);
		var data = {q: 'giveAttendence', id: id, sid: $scope.sid};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			if(response.data == 0)
			{
				alert("Failed!!");
			}
			else
			{
				if($('.' + id).text() == 'Absent' || $('.' + id).text() == 'Halt State')
					$('.' + id).text('Present');
				else
					$('.' + id).text('Absent');
			}
			//alert(response.data);
		});
	}

	$scope.check = function(){

		var run = $interval(function(){
			var data = {q: 'checkAttendence', sem: $scope.sem, sid: $scope.sid};
			$http.post("<?php echo $res->action?>/faculty/serve", data)
			.then(function(response){
				if(response.data == 0)
				{
					alert("Failed!!");
				}
				else
				{
					$scope.call_back(response.data);
					//$('.loader').hide();
				}
				
			});
		},2500,0);

		var x = $interval(function(){
			$('.loader').hide();
			$('body').css({'overflow' : 'auto'});
		},2700,1);
	}

	$scope.call_back = function(list){

		for(var value in list)
		{
			if(list[value].status == 0)
			{
				
				$('#' + list[value].uid).prop('checked', false);
				$('.' + list[value].uid).text('Absent');
			}

			else if(list[value].status == 1)
			{
				$('#' + list[value].uid).attr("disabled", false);
				$('#' + list[value].uid).prop('checked', true);
				$('.' + list[value].uid).text('Present');
			}

			else if(list[value].status == 2)
			{
				$('#' + list[value].uid).attr("disabled", true);
				$('.' + list[value].uid).text('Attempting Currently');
			}

			else if (list[value].status == 3)
			{
				$('#' + list[value].uid).attr("disabled", true);
				$('.' + list[value].uid).text('Finished');
			}

			else if(list[value].status == 4)
			{
				$('#' + list[value].uid).attr("disabled", false);
				$('#' + list[value].uid).prop('checked', false);
				$('.' + list[value].uid).text('Halt State');
				
			}
		}	
	}

	$scope.end_test = function(sid,sem){
		var data = {q: 'endTest',sid: sid, sem: sem};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			
			if(response.data == true || response.data == 'true')
			{
				$scope.live_test('end');
			}
		});
	}


});

</script>