<?php
	include 'common.php';
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
		        <th>For Semester</th>
		        <th>Subject</th>
		        <th>Topic</th>
		        <th>Code</th>
		        <th>Action</th>
		      </tr>

		    <tr ng-repeat='x in TL' class="w3-hover-light-gray">
		      <td>{{x.for_sem}}</td>
		      <td>{{x.subject}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-button w3-hover-red w3-text-red" ng-click="end_test(x.sid, x.for_sem)">End</td>
		    </tr>

		  </table>
			

		</div>

		<div class="w3-col m1"><p></p></div>	

	</div>
	
</div>

<script type="text/javascript">

var invigilation = angular.module('invigilation', []);
invigilation.controller('invigilationCtrl', function($scope,$http,$interval)
{
	$scope.test_list = false;
	$scope.TL = null;
	
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