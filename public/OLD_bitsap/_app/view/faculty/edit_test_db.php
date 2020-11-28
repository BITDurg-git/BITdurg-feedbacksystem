<?php

	include 'common.php';

	$crud = new crud();

	$sid = $res->id;
	$_SESSION['sid'] = $sid;

	$sem_sub_id = $crud->getWhere('sem_sub_id','test_creator',"sid = '$sid'")[0]['sem_sub_id'];
	$subject = $crud->getWhere('subject_name','sem_sub',"sem_sub_id = '$sem_sub_id'");
?>

<style type="text/css">
.overDiv
{
	width: 100%;
	height: 120%;
	background: rgba(0, 0, 0, 0.5);
	z-index: 100;
	top: 0;
	position: absolute;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo $res->public_folder_path; ?>/css/checkbox.css">

<div ng-app="testWork" ng-controller="testWorkCtrl">

<!-- Sidebar for Question Navigation -->
<div class="w3-sidebar w3-bar-block w3-padding" style="width:15%;background-color: #e6e6e6;">

  <h4 class="w3-bar-item w3-border-bottom w3-border-blue-gray">Question Menu</h4>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-repeat="i in total_quest | range" ng-click="display_question(i+1)">{{'Question '}}{{i+1}}</div>

  <div class="w3-bar-item w3-btn w3-section w3-round-large w3-theme-l3" ng-click="add_question()">Add Question <span class="w3-right">&#10133;</span></div>

  <div style="height: 100px;"></div>

</div>

<!-- Page Content for Question/Answer Display-->
<div class="w3-sidebar" style="width:85%;margin-left:15%;position: relative;">

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
		<div class="w3-col m6 w3-border-right" id="co_mapping">
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
		<div class="w3-col m6 w3-right" id="level">
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

<div class="overDiv">
	<div class="w3-row">
		<div class="w3-col w3-center" style="margin-top: 150px;">
			<button class="w3-btn w3-theme-l1 w3-round-large w3-large w3-ripple" ng-click='push_qid()'>Edit Q-No: {{qno}}</button>
		</div>
	</div>
</div>

<div style="height: 100px;" class="w3-theme-l5"></div>
</div>
</div>


<script>

$('#co_mapping').hide();
$('#level').hide();

var testWork = angular.module('testWork', []);
testWork.controller('testWorkCtrl', function($scope,$http)
{
	$scope.topic = "";
	$scope.total_quest = 1;
	$scope.qno = 1;		//Current Working Question No.

	$scope.co_mapping = false;
	$scope.level = false;

	$scope.co = '';
	$scope.bt = '';
	$scope.pi = '';
	$scope.level_value = 'Select level';

	$scope.posmark = '';
	$scope.negmark = '';

	$scope.question = '';
	$scope.option_a = '';
	$scope.option_b = '';
	$scope.option_c = '';
	$scope.option_d = '';

	$scope.a = false;
	$scope.b = false;
	$scope.c = false;
	$scope.d = false;

	$scope.overDiv = true;
	$scope.qid_list = [];
	$scope.deleted_q_list = [];
	$scope.no_of_qid_data = 0;

	$scope.quest_data = [];
	$scope.quest_data[0] = null;
	$scope.quest_data[1] = {
		qid: '',
		question: '',
		option_a : '',
		option_b : '',
		option_c : '',
		option_d : '',
		a : false,
		b : false,
		c : false,
		d : false,
		co: '',
		bt: '',
		pi: '',
		level: 'Select level',
		posmark: '',
		negmark: ''
	};

	$scope.add_question = function(){
		$scope.total_quest = $scope.total_quest + 1;

		$scope.quest_data[$scope.total_quest] = {
			qid: '',
			question: '',
			option_a : '',
			option_b : '',
			option_c : '',
			option_d : '',
			a : false,
			b : false,
			c : false,
			d : false,
			co: '',
			bt: '',
			pi: '',
			level: 'Select level',
			posmark: '',
			negmark: ''
		};

		$scope.display_question($scope.total_quest);
	}

	$scope.push_qid = function(){
		if($scope.qid_list.includes($scope.quest_data[$scope.qno].qid) == false)
			$scope.qid_list.push($scope.quest_data[$scope.qno].qid);

		$scope.display();
	}

	$scope.display = function(){
		$scope.question = $scope.quest_data[$scope.qno].question;
		$scope.option_a = $scope.quest_data[$scope.qno].option_a;
		$scope.option_b = $scope.quest_data[$scope.qno].option_b;
		$scope.option_c = $scope.quest_data[$scope.qno].option_c;
		$scope.option_d = $scope.quest_data[$scope.qno].option_d;

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

		if($scope.quest_data[$scope.qno].qid != '' && $scope.qid_list.includes($scope.quest_data[$scope.qno].qid) == false)
		{
			$scope.overDiv = true;
			$(".overDiv").show();
		}
		else
		{
			$scope.overDiv = false;
			$(".overDiv").hide();
		}
	}

	$scope.display_question = function(n){
		$scope.save();
		$scope.qno = n;
		//alert($scope.qid_list);
		$scope.display();
	}

	$scope.save = function(){
		$scope.quest_data[$scope.qno].question = JSON.parse(JSON.stringify($scope.question));
		$scope.quest_data[$scope.qno].option_a = JSON.parse(JSON.stringify($scope.option_a));
		$scope.quest_data[$scope.qno].option_b = JSON.parse(JSON.stringify($scope.option_b));
		$scope.quest_data[$scope.qno].option_c = JSON.parse(JSON.stringify($scope.option_c));
		$scope.quest_data[$scope.qno].option_d = JSON.parse(JSON.stringify($scope.option_d));

		$scope.quest_data[$scope.qno].a = JSON.parse(JSON.stringify($scope.a)); 
		$scope.quest_data[$scope.qno].b = JSON.parse(JSON.stringify($scope.b));
		$scope.quest_data[$scope.qno].c = JSON.parse(JSON.stringify($scope.c));
		$scope.quest_data[$scope.qno].d = JSON.parse(JSON.stringify($scope.d));

		$scope.quest_data[$scope.qno].co = JSON.parse(JSON.stringify($scope.co));
		$scope.quest_data[$scope.qno].bt = JSON.parse(JSON.stringify($scope.bt));
		$scope.quest_data[$scope.qno].pi = JSON.parse(JSON.stringify($scope.pi));
		$scope.quest_data[$scope.qno].level = JSON.parse(JSON.stringify($scope.level_value));

		$scope.quest_data[$scope.qno].posmark = JSON.parse(JSON.stringify($scope.posmark));
		$scope.quest_data[$scope.qno].negmark = JSON.parse(JSON.stringify($scope.negmark));

	}

	$scope.save_it = function(){
		$scope.save();
		alert("Saved Successfully");
	}

	$scope.delete_it = function(){
		if(confirm('Are you sure want to delete this Question?'))
		{
			if ($scope.total_quest > 1)
			{
				$scope.total_quest = $scope.total_quest - 1;

				if($scope.quest_data[$scope.qno].qid != '')
				{
					$scope.deleted_q_list.push($scope.quest_data[$scope.qno].qid);
					var n = $scope.qid_list.indexOf($scope.quest_data[$scope.qno].qid);
					$scope.qid_list.splice(n, 1);
					$scope.no_of_qid_data = $scope.no_of_qid_data - 1
				}

				$scope.quest_data.splice($scope.qno, 1);

				if($scope.qno <= $scope.total_quest)
				{
					$scope.display();
				}
				else
				{
					$scope.qno = $scope.total_quest;
					$scope.display();
				}

				alert("Deleted Successfully!");
			}
			else
			{alert('No More Allowed');}
			
		}
	}

	$scope.co_map_show = function(){
		$scope.co_mapping = true;
		$('#co_mapping').show();
	}

	$scope.co_map_hide = function(){
		$scope.co_mapping = false;
		$('#co_mapping').hide();
	}

	$scope.level_show = function(){
		$scope.level = true;
		$('#level').show();
	}

	$scope.level_hide = function(){
		$scope.level = false;
		$('#level').hide();
	}

	$scope.save_callback = function(){
		var arr = [];
		let l = $scope.qid_list.length;
		let m = $scope.no_of_qid_data;

		for (var i = 0; i < l; i++)
		{
			for(var j = 1; j <= m; j++)
			{
				if ($scope.qid_list[i] == $scope.quest_data[j].qid)
				{
					arr.push(j);
					break;
				}
			}
		}

		return arr;
	}

	$scope.save_finish = function(){

		$scope.save();	//To save the last Question into object

		//alert($scope.deleted_q_list);

		if(confirm("Are you sure?"))
		{
			var edited_quest_qno_list = $scope.save_callback();

			var temp_array = [
								$scope.topic,
								$scope.total_quest,
								$scope.co_mapping,
								$scope.level,
								$scope.no_of_qid_data
							];

			var data = {
						q: 'editTest',
						test_info: temp_array,
						qdata : $scope.quest_data,
						qno_list : edited_quest_qno_list,
						del_list : $scope.deleted_q_list
					};

			$http.post("<?php echo $res->action?>/faculty/serve", data)
			.then(function(response){
				//alert(response.data);
				if(response.data == 'true')
					window.location.href = "http://"+window.location.host+"<?php echo $res->action?>/faculty/submitted";
			});
		}
	}

	$scope.data_for_edit_test = function(){
		var result = null;
		
		var data = {q: 'dataEditTest'};

		$http.post("<?php echo $res->action?>/faculty/serve", data)
		.then(function(response){
			if(response.data == 0)
				alert("You are not Allowed to Edit this TEST");
			else
			{
				$scope.store_data(response.data);
				//alert(response.data);
			}
		});
	}

	$scope.store_data = function(result){
		$scope.topic = result.test_info[0]['topic'];
		$scope.total_quest = parseInt(result.test_info[0]['tnoq']);
		$scope.no_of_qid_data = parseInt(result.test_info[0]['tnoq']);

		if(parseInt(result.level) == 1)
		{
			$scope.level = true;
			$('#level').show();
		}

		for (var i = 1; i <= $scope.total_quest ; i++)
		{
			$scope.quest_data[i] = {
				qid: result.quest_data[i-1]['qid'],
				question: result.quest_data[i-1]['question'],
				option_a : result.quest_data[i-1]['a'],
				option_b : result.quest_data[i-1]['b'],
				option_c : result.quest_data[i-1]['c'],
				option_d : result.quest_data[i-1]['d'],
				a : result.ans_data[i-1]['answer'].includes('a'),
				b : result.ans_data[i-1]['answer'].includes('b'),
				c : result.ans_data[i-1]['answer'].includes('c'),
				d : result.ans_data[i-1]['answer'].includes('d'),
				co: '',
				bt: '',
				pi: '',
				level: parseInt(result.quest_data[i-1]['level']),
				posmark: result.ans_data[i-1]['posmark'],
				negmark: result.ans_data[i-1]['negmark']
			};
		}

		$scope.display();
	}

	$scope.data_for_edit_test();
});

testWork.filter('range', function(){
    return function(n) {
      var res = [];
      for (var i = 0; i < n; i++) {
        res.push(i);
      }
      return res;
    };
 });

</script>