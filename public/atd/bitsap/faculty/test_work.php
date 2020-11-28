<?php
	require 'check_key.php';
	include 'crud.php';
	$crud = new crud();

	$sem_sub_id = $_GET['s'];
	$_SESSION['sem_sub_id'] = $sem_sub_id;
	$subject = $crud->getWhere('subject_name','sem_sub',"sem_sub_id = '$sem_sub_id'");
?>

<link rel="stylesheet" type="text/css" href="css/checkbox.css">

<div ng-app="testWork" ng-controller="testWorkCtrl">

<!-- Sidebar for Question Navigation -->
<div class="w3-sidebar w3-bar-block w3-padding" style="width:15%;background-color: #e6e6e6;">

  <h4 class="w3-bar-item w3-border-bottom w3-border-blue-gray">Question Menu</h4>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-repeat="i in total_quest | range" ng-click="display_question(i+1)">{{'Question '}}{{i+1}}</div>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-click="add_question()">Add Question <span class="w3-right">&#10133;</span></div>

  <div style="height: 100px;"></div>

</div>

<!-- Page Content for Question/Answer Display-->
<div class="w3-sidebar" style="width:85%;margin-left:15%">

<div class="w3-container w3-row w3-theme-l3">
	<h3 class="w3-col m9"><?=$subject[0]['subject_name'];?></h3>
	<div class="w3-col m3"><p>
	<div><b>Topic: </b><input class="w3-small w3-round-large w3-padding-small" type="text" ng-model="topic" placeholder="Please fill this FIRST"></div>
	</p></div>
</div>

<div class="w3-bar w3-theme-l4">
	<div href="#" class="uline w3-bar-item w3-padding w3-border-right w3-button w3-hover-green w3-text-green" ng-click="save_it()">Save this Question</div>

	<div href="#" class="uline w3-bar-item w3-padding w3-border-right w3-button w3-hover-green w3-text-green" ng-click="save_finish()">Save All & Finish</div>

	<div href="#" class="uline w3-bar-item w3-padding w3-border-right w3-button w3-hover-teal w3-text-teal" ng-click="co_map_show()">CO Mapping</div>

	<div href="#" class="uline w3-bar-item w3-padding w3-border-right w3-button w3-hover-teal w3-text-teal" ng-click="level_show()">Give Levels to Questions</div>

	<div href="#" class="uline w3-bar-item w3-padding w3-border-right w3-button w3-hover-red w3-text-red" ng-click="delete_it()" >Delete this Question</div>

	<span class="w3-bar-item w3-padding">Total Questions: {{total_quest}}</span>
</div>

<div class="w3-container w3-padding w3-theme-l5">
	<div class="w3-row w3-center">
		<div class="w3-col m6 w3-border-right" id="co_mapping" hidden>
			 <div class="w3-row-padding">
			  <div class="w3-col m3">
			    <input class="w3-input w3-border w3-round-large" type="text" placeholder="CO" ng-model='co'>
			  </div>
			  <div class="w3-col m3">
			    <input class="w3-input w3-border w3-round-large" type="text" placeholder="BT" ng-model='bt'>
			  </div>
			  <div class="w3-col m3">
			    <input class="w3-input w3-border w3-round-large" type="text" placeholder="PI" ng-model='pi'>
			  </div>
			  <div class="w3-col m3">
			    <button class="w3-btn w3-circle" style='font-size:20px;' ng-click="co_map_hide()">&#10006;</button>
			  </div>
			</div>
		</div>
		<div class="w3-col m6 w3-right" id="level" hidden>
			 <div class="w3-row-padding">
			  <div class="w3-col m4">
			    <p></p>
			  </div>
			  <div class="w3-col m4">
			    <select class="w3-input w3-border w3-round-large" ng-model='level_value'>
			    	<option disabled selected hidden>Select level</option>
			    	<option>1</option>
			    	<option>2</option>
			    	<option>3</option>
			    </select>
			  </div>
			  <div class="w3-col m4">
			    <button class="w3-btn w3-circle" style='font-size:20px;' ng-click="level_hide()">&#10006;</button>
			  </div>
			</div>
		</div>
	</div>
</div>

<div class="w3-container w3-padding-large w3-theme-l5">

<div>

<div class="w3-row">
	<h4 class="w3-col m9">Question: <span>{{qno}}</span></h4>
	<div class="w3-col m3 w3-row w3-small">
		<p >
			<input class="w3-col m5 w3-input w3-border w3-round-large" type="text" placeholder="+ve Marks" ng-model='posmark' />
			<input class="w3-col m7 w3-input w3-border w3-round-large" type="text" placeholder="-ve Marks default:0" ng-model='negmark'>
		</p>
	</div>
</div>

<textarea class="w3-input w3-border w3-section w3-round-large" ng-model='question'></textarea>

</div>

<div class="w3-row"> <!-- Option Div Starts -->
	
<div class="w3-section w3-col m6">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='a'>
        <span class="toggle__label">
          <span class="toggle__text">A</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
    <textarea class="w3-margin-top w3-input w3-border w3-round-large" style="width: 90%;" ng-model='option_a'></textarea>
</div>

<div class="w3-section w3-col m6">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='b'>
        <span class="toggle__label">
          <span class="toggle__text">B</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
    <textarea class="w3-margin-top w3-input w3-border w3-round-large" style="width: 90%;" ng-model='option_b'></textarea>
</div>

</div> <!-- Option Div Ends -->

<div class="w3-row"> <!-- Option Div Starts -->

<div class="w3-section w3-col m6">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='c'>
        <span class="toggle__label">
          <span class="toggle__text">C</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
    <textarea class="w3-margin-top w3-input w3-border w3-round-large" style="width: 90%;" ng-model='option_c'></textarea>
</div>

<div class="w3-section w3-col m6">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='d'>
        <span class="toggle__label">
          <span class="toggle__text">D</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
    <textarea class="w3-margin-top w3-input w3-border w3-round-large" style="width: 90%;" ng-model='option_d'></textarea>
</div>

</div>	<!-- Option Div Ends -->

</div> 

<div style="height: 100px;" class="w3-theme-l5"></div>
</div>
</div>
<?php
	require 'unset_key.php';
?>