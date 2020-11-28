<?php
if(!isset($_SESSION['type']) || $_SESSION['type'] != 's') 
{
  	echo "<h2>Unauthorized Access !!</h2>";
}


  if(!isset($_SESSION['sid']))
    die("<center><h3>Invalid Attempt</h3><center>\n</body>\n</html>");

  $crud = new crud();

  $sid = $_SESSION['sid'];
  $ar = explode("_", $sid);
  $sem_sub_id = $ar[0]."_".$ar[1];
  $Subject = $crud->getWhere('subject_name','sem_sub',"sem_sub_id = '$sem_sub_id'");
?>

<style type="text/css">
  .dot {
  height: 16px;
  width: 16px;
  background-color: #4ff227;
  border: 1px solid blue;
  border-radius: 50%;
  display: inline-block;
}
</style>

<div class="w3-container w3-theme-d1">
	<div class="w3-center"><h2>BIT Online Exam</h2></div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/cb.css">
<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/loader.css">

<div ng-app="exam" ng-controller="examCtrl">

<div class="w3-container w3-center" ng-show='start_btn'>
  <div class="w3-row" hidden>
      <!--Any Specific instruction for test can be list up here-->
  </div>
  <button ng-click='start_test()' class="w3-btn w3-teal w3-ripple w3-display-middle">Start Test</button>
</div>

<div ng-show='start_exam'>

<!-- Sidebar for Question Navigation -->
<div class="w3-sidebar w3-bar-block w3-padding w3-center" style="width:15%;background-color: #e6e6e6;">

  <h4 class="w3-bar-item w3-border-bottom w3-border-blue-gray w3-center">Navigate to</h4>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-repeat="i in total_quest | range" ng-click="display_question(i+1)" id="br{{i+1}}">
  {{'Q-No: '}}{{i+1}}
  <span id="b{{i+1}}" style="margin-bottom: -2px;"></span>

  <span id="m{{i+1}}" style="color: yellow; font-size: 18px; margin: -4px;" hidden>&#9650;</span>
  </div>

  <div style="height: 100px;"></div>

</div>

<!-- Page Content for Question/Answer Display-->
<div class="w3-sidebar w3-theme-l5" style="width:85%;margin-left:15%">

<div class="w3-container w3-row w3-theme-l3" id="quest_display_anchor">
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

<div class="w3-border-left w3-border-right w3-border-top">	<!-- Option Div -->

<div class="w3-section w3-border-bottom" id="show_a">
	<!-- Code for Custom CheckBox -->
    <div class="w3-row form-group">
      <div class="w3-col s1" style="padding: 14px 10px;">
        <input type="checkbox" ng-model='a' ng-click="upload_response('a')" id="a">
        <label for="a">A)</label>
      </div>
      <pre class="w3-col s11" ng-bind ='option_a'>Sample Text</pre>
    </div>
    <!-- Code Ends -->  
</div>

<div class="w3-section w3-border-bottom" id="show_b">
  <!-- Code for Custom CheckBox -->
    <div class="w3-row form-group">
      <div class="w3-col s1" style="padding: 14px 10px;">
        <input type="checkbox" ng-model='b' ng-click="upload_response('b')" id="b">
        <label for="b">B)</label>
      </div>
      <pre class="w3-col s11" ng-bind ='option_b'>Sample Text</pre>
    </div>
    <!-- Code Ends -->  
</div>

<div class="w3-section w3-border-bottom" id="show_c">
  <!-- Code for Custom CheckBox -->
    <div class="w3-row form-group">
      <div class="w3-col s1" style="padding: 14px 10px;">
        <input type="checkbox" ng-model='c' ng-click="upload_response('c')" id="c">
        <label for="c">C)</label>
      </div>
      <pre class="w3-col s11" ng-bind ='option_c'>Sample Text</pre>
    </div>
    <!-- Code Ends -->  
</div>

<div class="w3-section w3-border-bottom" id="show_d">
  <!-- Code for Custom CheckBox -->
    <div class="w3-row form-group">
      <div class="w3-col s1" style="padding: 14px 10px;">
        <input type="checkbox" ng-model='d' ng-click="upload_response('d')" id="d">
        <label for="d">D)</label>
      </div>
      <pre class="w3-col s11" ng-bind ='option_d'>Sample Text</pre>
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
  <a href="<?php echo $res->action?>/student" class="w3-btn w3-teal w3-ripple w3-display-middle">Go to Dashboard</a>
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

<!-- Loader Animation -->
<div class="loader w3-center" ng-show='loader'>
  
  <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

</div>


</div> <!-- App div Ends -->

<div><pre id="test"></pre></div>


<script type="text/javascript">

var exam = angular.module('exam', []);
exam.controller('examCtrl', function($scope,$http,$interval,$location,$anchorScroll)
{
  $scope.total_quest = 0;
  $scope.qno = 1;

  $scope.time_left = 'Invalid';
  $scope.time_left_update = 0;
  $scope.start_exam = false;
  $scope.start_btn = true;
  $scope.end = false;

  $scope.posmark = 0;
  $scope.negmark = 0;

  $scope.co_mapping = false;
  $scope.level = false;

  $scope.question = '';
  $scope.option_a = '';
  $scope.option_b = '';
  $scope.option_c = '';
  $scope.option_d = '';

  $scope.a = false;
  $scope.b = false;
  $scope.c = false;
  $scope.d = false;

  $scope.co = '';
  $scope.bt = '';
  $scope.pi = '';
  $scope.level_value = 0;

  $scope.second = 0;
  $scope.minute = 0;

  $scope.promise_time_update = '';
  $scope.promise_timer = ''; 

  $scope.score = 0;
  $scope.loader = false;

  $scope.quest_data = [];

  $scope.options_display = function(){
    var t;
    t = ($scope.option_a == '')?$("#show_a").hide():$("#show_a").show();
    t = ($scope.option_b == '')?$("#show_b").hide():$("#show_b").show();
    t = ($scope.option_c == '')?$("#show_c").hide():$("#show_c").show();
    t = ($scope.option_d == '')?$("#show_d").hide():$("#show_d").show();
    
  }


  $scope.display = function(){
    $scope.question = $scope.quest_data[$scope.qno].question;
    $scope.option_a = $scope.quest_data[$scope.qno].option_a;
    $scope.option_b = $scope.quest_data[$scope.qno].option_b;
    $scope.option_c = $scope.quest_data[$scope.qno].option_c;
    $scope.option_d = $scope.quest_data[$scope.qno].option_d;

    $scope.options_display();

    $scope.a = $scope.quest_data[$scope.qno].a;
    $scope.b = $scope.quest_data[$scope.qno].b;
    $scope.c = $scope.quest_data[$scope.qno].c;
    $scope.d = $scope.quest_data[$scope.qno].d;

    $scope.co = $scope.quest_data[$scope.qno].co;
    $scope.bt = $scope.quest_data[$scope.qno].bt;
    $scope.pi = $scope.quest_data[$scope.qno].pi;
    $scope.level_value = $scope.quest_data[$scope.qno].level;

    $scope.posmark = $scope.quest_data[$scope.qno].posmark;
    $scope.negmark = $scope.quest_data[$scope.qno].negmark;
  }

  $scope.save = function(){

    $scope.quest_data[$scope.qno].a = JSON.parse(JSON.stringify($scope.a)); 
    $scope.quest_data[$scope.qno].b = JSON.parse(JSON.stringify($scope.b));
    $scope.quest_data[$scope.qno].c = JSON.parse(JSON.stringify($scope.c));
    $scope.quest_data[$scope.qno].d = JSON.parse(JSON.stringify($scope.d));
  }

   $scope.gotoTop = function() {
    $location.hash('quest_display_anchor');
    $anchorScroll();
    };

  $scope.display_question = function(n){
    $scope.save();
    $scope.qno = n;
    $scope.display();
    $('#br' + n).addClass('w3-border w3-border-black');
    $scope.gotoTop();
  }

  $scope.time_update = function(){
    var data = {q: 'timeLeft', t: $scope.time_left_update};

    $http.post("<?php echo $res->action?>/exam/serve", data)
    .then(function(response){
      //alert(response.data)
    });
  }

  $scope.timer = function(){

    $scope.time_left = $scope.minute + " m : " + $scope.second + " s";

    if($scope.minute == 0 && $scope.second == 0)
    {
      $scope.time_left = 'EXPIRED';
      $scope.exam_end();
    }

    if($scope.second==0)
        {
            $scope.second = 60;
            $scope.minute = $scope.minute - 1;
            $scope.time_left_update = $scope.minute;
        }
        else
        {
            $scope.second = $scope.second-1;
        } 
  }

  $scope.start_timer = function(duration) {
      $scope.minute = duration; 
      $scope.time_left_update = duration;

      $scope.promise_timer = $interval($scope.timer, 1000);
      $scope.promise_time_update = $interval($scope.time_update, 10000);
  }


  $scope.start_test = function(){
    $scope.start_btn = false;
    $scope.loader = true;

    var x = $interval(function(){
      $scope.data_for_test();
    },1000,1);
    
    
  }


  $scope.data_for_test = function(){
    var data = {q: 'examData'};

    $http.post("<?php echo $res->action?>/exam/serve", data)
    .then(function(response){

     if(response.data == 0 || response.data == 3)
        alert("You are not allowed to Attempt this Test");

      else if(response.data == 2 || response.data == 4)
        alert("Get Your Attendence Again");

      else
      {
        $scope.store_data(response.data);
        $scope.start_exam = true;
      }

      //alert(response.data);
      
      $scope.loader = false;
    });
  }

  $scope.store_data = function(result){
    //$scope.topic = result.test_info[0]['topic'];
    $scope.total_quest = parseInt(result.test_info[0]['tnoq']);
    $scope.level = (result.test_info[0]['l0'] == 0)?true:false;
    //alert($scope.level);

    for (var i = 1; i <= $scope.total_quest ; i++)
    {
      $scope.quest_data[i] = {
        question: result.quest_data[i-1]['question'],
        option_a : result.quest_data[i-1]['a'],
        option_b : result.quest_data[i-1]['b'],
        option_c : result.quest_data[i-1]['c'],
        option_d : result.quest_data[i-1]['d'],
        a : false,
        b : false,
        c : false,
        d : false,
        co: '',
        bt: '',
        pi: '',
        level: result.quest_data[i-1]['level'],
        posmark: result.ans_data[i-1]['posmark'],
        negmark: Math.abs(result.ans_data[i-1]['negmark']),
        qid: result.quest_data[i-1]['qid'],
        multiple: result.quest_data[i-1]['multiple']
      };
    }

    //alert($scope.quest_data[1]);
    $scope.display();
    $scope.start_timer(parseInt(result.test_info[0]['duration']));
  }

  $scope.upload_response = function(opt){
    var status = 404;
      var response = '';

      switch(opt)
      {
        case 'a':
        status = $scope.a?0:1;
        response += (status == 1)?'a':'';
        break;

        case 'b':
        status = $scope.b?0:1;
        response += (status == 1)?'b':'';
        break;

        case 'c':
        status = $scope.c?0:1;
        response += (status == 1)?'c':'';
        break;

        case 'd':
        status = $scope.d?0:1;
        response += (status == 1)?'d':'';
        break;
      }

      if($scope.quest_data[$scope.qno].multiple == 1 && status == 1)
      {
        $scope.a = (opt == 'a')?true:false;
        $scope.b = (opt == 'b')?true:false;
        $scope.c = (opt == 'c')?true:false;
        $scope.d = (opt == 'd')?true:false;
      }

      else if($scope.quest_data[$scope.qno].multiple > 1)
      {

        //alert(status);
        response += ($scope.a && opt != 'a')?'a':'';
        response += ($scope.b && opt != 'b')?'b':'';
        response += ($scope.c && opt != 'c')?'c':'';
        response += ($scope.d && opt != 'd')?'d':'';

        response = response.split('').sort().join('');

      }

      //alert(response);

     if(response != '')
        $('#b' + $scope.qno).addClass('dot');
      else
        $('#b' + $scope.qno).removeClass('dot');

    var data = {
          q: 'uploadResponse',
          response: response,
          qid: $scope.quest_data[$scope.qno].qid
          };

    $http.post("<?php echo $res->action?>/exam/serve", data)
    .then(function(response){
      
      if(response.data == false)
        alert("Something's Wrong !! Contact Developer");
    });
  }

  $scope.exam_end = function(){
    $scope.quest_data = null;

    $interval.cancel($scope.promise_timer);
    $interval.cancel($scope.promise_time_update);

    document.getElementById('id01').style.display='none';

    var data = {q: 'examEnd', status : 'end'};

    $http.post("<?php echo $res->action?>/exam/serve", data)
    .then(function(response){

      $scope.score = response.data;
      $scope.start_exam = false;

      $scope.total_quest = 0;
      $scope.qno = 'NA';
      $scope.end = true;
    });
  }

  $scope.show_end_modal = function(){
      document.getElementById('id01').style.display='block';
  }

  $scope.review_mark = function(){
    $("#m" + $scope.qno).toggle();
  }


});

exam.filter('range', function(){
    return function(n) {
      var res = [];
      for (var i = 0; i < n; i++) {
        res.push(i);
      }
      return res;
    };
 });

</script>