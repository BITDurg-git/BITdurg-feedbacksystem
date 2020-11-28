<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION['type']) || $_SESSION['type'] != 's') 
{
  	header("location: index.php");
}
include 'header.php';
include 'crud.php';
$crud = new crud();

  if(!isset($_SESSION['sid']))
    die("<center><h3>Invalid Attempt</h3><center>\n</body>\n</html>");

  $sid = $_SESSION['sid'];
  $ar = explode("_", $sid);
  $sem_sub_id = $ar[0]."_".$ar[1];
  $Subject = $crud->getWhere('subject_name','sem_sub',"sem_sub_id = '$sem_sub_id'");
?>
<script type="text/javascript" src="js/sanitize.js"></script>
<script type="text/javascript" src="js/exam.js"></script>

<div class="w3-container w3-theme-d1">
	<div class="w3-center"><h2>BIT Online Exam</h2></div>
</div>

<link rel="stylesheet" type="text/css" href="css/checkbox.css">

<div ng-app="exam" ng-controller="examCtrl">

<div class="w3-container w3-center" ng-show='start_btn'>
  <div class="w3-row">
    <p>
      <!--Any Specific instruction for test can be list up here-->
    </p>
  </div>
  <button ng-click='start_test()' class="w3-btn w3-teal w3-display-middle">Start Test</button>
</div>

<div ng-show='start_exam'>

<!-- Sidebar for Question Navigation -->
<div class="w3-sidebar w3-bar-block w3-padding" style="width:15%;background-color: #e6e6e6;">

  <h4 class="w3-bar-item w3-border-bottom w3-border-blue-gray w3-center">Navigate to</h4>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-repeat="i in total_quest | range" ng-click="display_question(i+1)">
  {{'Question '}}{{i+1}}
  <span id="m{{i+1}}" style="color: yellow; font-size: 18px; margin-left: 5px;" hidden>&#9650;</span>
  </div>

  <div style="height: 100px;"></div>

</div>

<!-- Page Content for Question/Answer Display-->
<div class="w3-sidebar w3-theme-l5" style="width:85%;margin-left:15%">

<div class="w3-container w3-row w3-theme-l3">
	<h3 class="w3-col m8"><?=$Subject[0]['subject_name']?></h3>
	<div class="w3-col m4 w3-large"><p>Time Left: <span ng-bind='time_left'></span></p></div>
</div>

<div>
  <div class="w3-bar w3-theme-l4 w3-row">

    <div class="w3-col m8">
      <div class="w3-bar-item w3-button w3-hover-yellow w3-amber" ng-click='review_mark()'>Mark/Unmark for Review</div>
      
      <div class="w3-bar-item w3-button w3-green w3-hover-teal" ng-click='show_end_modal()'>Finish & Submit</div>
    </div>
    
    <div class="w3-bar-item w3-col m4">Code: <?=$sid?></div>
  </div>
</div>

<div class="w3-container w3-padding-large w3-theme-l5">

<div class="w3-margin-bottom w3-border">

<div class="w3-row w3-border-bottom w3-padding">
	<h5 class="w3-col m8">Question: <span>{{qno}}</span></h5>
	<div class="w3-col m4 w3-row w3-center">
		<p class="w3-col m3">
			+<span ng-bind='posmark'></span>  
			 -<span ng-bind='negmark'></span>
		</p>
    <p class="w3-col m4" ng-show='level'>
      Level : <span ng-bind='level_value'></span>
    </p>
	</div>
</div>

<div class="w3-padding"><pre ng-bind='question'></pre></div>

<div style="height: 40px;"></div>

</div>

<div style="height: 40px;"></div>

<div class="w3-border">	<!-- Option Div -->

<div class="w3-section w3-border-bottom w3-padding">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='a' ng-click="upload_response('a')">
        <span class="toggle__label">
          <span class="toggle__text">A)
          <pre style="width: 90%;" ng-bind ='option_a'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</pre>
      	</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->  
</div>

<div class="w3-section w3-border-bottom w3-padding">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='b' ng-click="upload_response('b')">
        <span class="toggle__label">
          <span class="toggle__text">B)
          <pre class="w3-section" style="width: 90%;" ng-bind ='option_b'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</pre>
      	</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
</div>

<div class="w3-section w3-border-bottom w3-padding">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='c' ng-click="upload_response('c')">
        <span class="toggle__label">
          <span class="toggle__text">C)
          <pre class="w3-section" style="width: 90%;" ng-bind ='option_c'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</pre>
      	</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
</div>

<div class="w3-section w3-padding">
	<!-- Code for Custom CheckBox -->
    <div class="page__toggle">
      <label class="toggle">
        <input class="toggle__input" type="checkbox" ng-model='d' ng-click="upload_response('d')">
        <span class="toggle__label">
          <span class="toggle__text">D)
          <pre class="w3-section" style="width: 90%;" ng-bind ='option_d'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</pre>
      	</span>
        </span>
      </label>
    </div>
    <!-- Code Ends -->
</div>
	
</div> <!-- Option Div Ends -->
	
</div> 

<div style="height: 100px;" class="w3-theme-l5"></div>
</div>
</div>

<div ng-show='end'>
  <p>
    <h3 class="w3-center">
      Your Score = {{score}}
    </h3>
  </p>
</div>


<!-- Modal to confirm End/Submit -->

<div id="id01" class="w3-modal w3-round-large">
    <div class="w3-modal-content w3-animate-top w3-card-4">

      <div class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>

        <div class="w3-center">

        <h3>Are you Sure ?</h3>
        <p>You still have <b>{{time_left}}</b> left</p>
        <button ng-click='exam_end()' class="w3-button w3-orange w3-hover-deep-orange w3-round-large">Yes, Submit the Test</button>
        <button onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-light-green w3-hover-green w3-round-large">No, Go back</button>

        </div>

        <p></p>
      </div>

    </div>
  </div>

  <!-- Modal ends -->



</div> <!-- App div Ends -->

<?php
include 'footer.php';


/*
SELECT * FROM tableName
WHERE Country = 'USA'
ORDER BY RAND()
LIMIT 4;
*/
?>