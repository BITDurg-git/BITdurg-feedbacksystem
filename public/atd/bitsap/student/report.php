<?php
	require 'check_key.php';
?>

<div class="w3-container" ng-app = 'report' ng-controller = 'reportCtrl'>

	<div class="w3-bar w3-center">
		<h3>Performance Record</h3>
	</div>

	<div class="w3-row">

		<div class="w3-col m4"><p></p></div>

		<div class="w3-col m4">
			<div class="w3-card-2 w3-white w3-padding">

				<div>
					<h5 class="w3-margin-left">Subjects :-</h5>

					<ul class="w3-ul w3-hoverable">
					    <li ng-repeat = 'x in sub_list'>
					    	<a href="javascript:void();" ng-click="load_test_record(x.sem_sub_id,x.subject_name)">{{x.subject_name}}</a>
					    </li>
				 	</ul>
				</div>
				
			</div>
		</div>

		<div class="w3-col m4"><p></p></div>

	</div>

	<div class="w3-row w3-margin"> <!-- class="w3-hide" -->

		<div class="w3-col m2"><p></p></div>

		<div class="w3-col m8" ng-show = 'rec_tab'>

			<h3 class="w3-center">{{subname}}</h3>

			<table class="w3-table w3-white w3-card-2">
		    <thead>
		      <tr class="w3-theme-l2">
		        <th>Test ID</th>
		        <th>Topic</th>
		        <th>Date</th>
		        <th>Marks Obtained</th>
		        <th>Total Marks</th>
		        <th>Action</th>
		      </tr>
		    </thead>

		    <tr ng-repeat = 'x in test_record' class="w3-hover-light-gray">
		      <td>{{x.sid}}</td>
		      <td>{{x.topic}}</td>
		      <td>{{x.date}}</td>
		      <td>{{x.score}}</td>
		      <td>{{x.total_marks}}</td>
		      <td class="w3-hover-teal w3-button w3-text-indigo"><a href="student.php?q=QnA&&id={{x.sid}}">View QnA</a></td>
		    </tr>

		  </table>
			

		</div>

		<div class="w3-col m2"><p></p></div>	

	</div>
	
</div>

<?php
	require 'unset_key.php';
?>