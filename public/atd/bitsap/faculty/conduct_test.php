<?php
	require 'check_key.php';
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
		<h3>Conduct Test</h3>
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
		      <td id="{{x.sid}}">{{x.tnoq}}</td>
		      <td>{{x.sid}}</td>
		      <td class="w3-text-indigo">
		      	<a href="javascript:void(0);" ng-if="x.uid == getCookie('userid')" ng-click="start_test(x.sid)">Start Test</a>
		      </td>
		    </tr>
		  </table>
			

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>

<!-- Modal to Set Exam Details -->

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
	require 'unset_key.php';
?>