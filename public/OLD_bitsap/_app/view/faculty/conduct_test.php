<?php
	include 'common.php';
?>

<style type="text/css">
	input[type='number']:focus
	{ 
		outline: none ! important;
		border-bottom: 2px solid blue;
	}
</style>

<div class="w3-container" ng-app="createTest" ng-controller="createTestCtrl">

	<div class="w3-bar w3-center">
		<h3>Edit Test</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4 w3-center">
			<div class="w3-card-2 w3-white w3-padding" ng-app="createTest" ng-controller="createTestCtrl">


				<div class="w3-dropdown-hover">

				    <button class="w3-btn w3-theme-l1">Select Semester</button>
				    <div class="w3-dropdown-content w3-bar-block w3-border">
				      
	     <?php
		for ($i=3; $i<=8 ; $i++)
		{ 
		?>
					<a href="<?php echo $res->action?>/faculty/conduct_test/:sem=<?php echo $i?>" class="w3-bar-item w3-button">
						<?php echo $i?>	
					</a>
		<?php
		}
		?>
					<a href="<?php echo $res->action?>/faculty/conduct_test/:sem=0" class="w3-bar-item w3-button">Common to All Semester</a>

				    </div>
				</div>

		<?php
			if(isset($res->sem))
			{
		?>


				<div>
					<h5 class="w3-padding"><?php echo ($res->sem > 0 && $res->sem < 9)?$res->sem.' Sem ':''; ?>Subjects :-</h5>


			<?php
			if($res->subject_list != '')
			{
			?>
					<ul class="w3-ul">

						<?php
						foreach($res->subject_list as $key => $data)
						{
						?>

					    <li style="padding: 0;">
					    	<a style="display: block;" class="w3-button" href="<?php echo $res->action?>/faculty/conduct_test/:id=<?php echo $data['sem_sub_id']; ?>">
					    		<?php echo $data['subject_name'];?>
					    	</a>
					    </li>

					    <?php
						}
					    ?>

				 	</ul>
			<?php
			}

			else
				echo "<b>No Subjects Found</b><br>";
			?>

				 	<br>
				</div>

		<?php
		}
		?>

				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>

	<?php 
	if(isset($res->id))
	{
	?>

	<div class="w3-row w3-margin"> <!-- class="w3-hide" -->

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8">

		<?php if($res->test_list == '') {?>

			<p class="w3-center"><b>No Records found!</b></p>

		<?php 
		} else 
		{
		?>

			<table class="w3-table w3-hoverable w3-centered w3-white w3-card-2">
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Topic</th>
		        <th>Total Questions</th>
		        <th>Test ID</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <?php
		    foreach ($res->test_list as $key => $data)
		    {
		    ?>

		    <tr>
		      <td><?php echo $data['topic']; ?></td>
		      <td id="<?php echo $data['sid']; ?>"><?php echo $data['tnoq']; ?></td>
		      <td><?php echo $data['sid']; ?></td>
		      <td class="w3-text-indigo">
		      	<?php echo ($data['uid'] == $_SESSION['userid'])?"<a href='#' ng-click=\"start_test('".$data['sid']."')\">Start Test</a>":''; ?>
		      </td>
		    </tr>

		    <?php
			}?>

		  </table>
			
		<?php 
		}
		?>

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>


	<!-- Modal -->

	<div id="modal01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Set Exam Details</h2>
      </header>
      <div class="w3-container w3-center w3-margin-bottom">

        <div class="w3-row" ng-show='testDetails.l1 > 0'>
        	<div class="w3-col m2 w3-padding">Level 1: </div>
        	<div class="w3-col m5"><input type="number" class="w3-input" ng-model='l1'></div>
        	<div class="w3-col m5 w3-padding"> Out of {{testDetails.l1}} Questions</div>
        </div>
        <div class="w3-row" ng-show='testDetails.l2 > 0'>
        	<div class="w3-col m2 w3-padding">Level 2: </div>
        	<div class="w3-col m5"><input type="number" class="w3-input" ng-model='l2'></div>
        	<div class="w3-col m5 w3-padding"> Out of {{testDetails.l2}} Questions</div>
        </div>
        <div class="w3-row" ng-show='testDetails.l3 > 0'>
        	<div class="w3-col m2 w3-padding">Level 3: </div>
        	<div class="w3-col m5"><input type="number" class="w3-input" ng-model='l3'></div>
        	<div class="w3-col m5 w3-padding"> Out of {{testDetails.l3}} Questions</div>
        </div>

        <div class="w3-row" ng-show='testDetails.is_level_present == 0'>
        	<div class="w3-col m2 w3-padding">Select: </div>
        	<div class="w3-col m5"><input type="number" class="w3-input" ng-model='l0'></div>
        	<div class="w3-col m5 w3-padding"> Out of {{tnoq}} Questions</div>
        </div>

        <div class="w3-row">
        	<div class="w3-col m2 w3-padding">For Semester: </div>
        	<div class="w3-col m5"><input type="number" class="w3-input" min="3" max="8" ng-model='semester'></div>
        	<div class="w3-col m5 w3-padding"></div>
        </div>

        <p class="w3-row">
        	<div class="w3-col m3 w3-padding">Time Duration of Exam: </div>
        	<div class="w3-col m4"><input type="number" class="w3-input" placeholder="in Minutes" ng-model='time'></div>
        	<div class="w3-col m5"></div>
        </p>
      </div>
      <footer class="w3-container w3-teal">
        <p><button class="w3-btn w3-orange" ng-click='online_test_details_submit()'>Submit</button></p>
      </footer>
    </div>
    </div>

    <script>
	// Get the modal
	var modal = document.getElementById('modal01');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	</script>

	<?php
	}
	?>
	
</div>

<script type="text/javascript">

var createTest = angular.module('createTest', []);
createTest.controller('createTestCtrl', function($scope,$http)
{

	$scope.semester = null;
    $scope.testDetails = null;
    $scope.tnoq = 0;

    $scope.l0 = 0;
    $scope.l1 = 0;
    $scope.l2 = 0;
    $scope.l3 = 0;
    $scope.time = null;
	
	$scope.start_test = function(arg) {				//for conduct_test.php
		var data = {q: 'startTest', sid : arg};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){

			$scope.testDetails = response.data;
			$scope.tnoq = $('#' + $scope.testDetails.sid).text();
			document.getElementById('modal01').style.display='block';
		});
	}

	$scope.online_test_details_submit = function() {

		var data = {q: 'onlineTestDetailsSubmit', l0 : $scope.l0, l1 : $scope.l1, l2 : $scope.l2, l3 : $scope.l3, time : $scope.time, sem : $scope.semester};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			if(response.data == 'true')
			{
				alert("Test Started Successfully. Check in the Live Test(s) Section");
				document.getElementById('modal01').style.display='none';
			}
			else if(parseInt(response.data) > 0)
			{
				alert("This test is already live for " + response.data + " semester");
				document.getElementById('modal01').style.display='none';
			}
			else
				alert("Something went wrong. Failed to start test");
		});
	}

});
</script>