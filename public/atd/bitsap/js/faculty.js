// All the codes for All Faculty Apps goes here -----------//


// Codes for create_test.php App & edit_test.php App--------//

var createTest = angular.module('createTest', []);
createTest.controller('createTestCtrl', function($scope,$http)
{
    $scope.semester = 'Select Semester';
    $scope.subject = '';
    $scope.testList = null;
    $scope.add_sub = null;
    $scope.testDetails = null;
    $scope.tnoq = 0;

    $scope.l0 = 0;
    $scope.l1 = 0;
    $scope.l2 = 0;
    $scope.l3 = 0;
    $scope.time = null;

    $scope.getSubject = function(){
    	var data = {q: 'getSubName', sem : $scope.semester};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			$scope.subject = response.data;
			//alert(response.data);
		});

		$('#subject_display').removeClass("w3-hide");
    }

    $scope.add_subject = function() {
    	if($scope.add_sub != null)
    	{
    		var data = {q: 'addSubject', sub : $scope.add_sub , sem : $scope.semester};
    		$http.post("./faculty/serve.php", data)
			.then(function(response){
				$scope.getSubject();
				$scope.add_sub = null;
				if(response.data != 1)
					alert("Failed to add");
			});
    	}
    	else
    		alert("Enter a subject");
    }

    $scope.showTest = function(subject_id) {
		var data = {q: 'getTest', sem_sub_id : subject_id};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			$scope.testList = response.data;
			//alert(response.data);
		});
		
		$('#test_display').removeClass("w3-hide");
	}

	$scope.edit = function(id)	{
		alert(id);
	}

	$scope.start_test = function(arg) {				//for conduct_test.php
		var data = {q: 'startTest', sid : arg};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			if(response.data == 0)
				alert("This Test is Already Live !!");
			else
			{
				$scope.testDetails = response.data;
				$scope.tnoq = $('#' + $scope.testDetails.sid).text();
				document.getElementById('modal01').style.display='block';
			}
		});
	}

	$scope.online_test_details_submit = function() {

		var data = {q: 'onlineTestDetailsSubmit', l0 : $scope.l0, l1 : $scope.l1, l2 : $scope.l2, l3 : $scope.l3, time : $scope.time};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			if(response.data == 'true')
			{
				alert("Test Started Successfully. Check in the Live Test(s) Section");
				document.getElementById('modal01').style.display='none';
			}
			else
				alert("Something went wrong. Failed to start test");
		});
	}

	$scope.getCookie = function(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
});

// Code Ends --//


// Code for test_work.php App to create test for the first time ------//

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

	$scope.quest_data = [];
	$scope.quest_data[0] = null;
	$scope.quest_data[1] = {
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
	}

	$scope.display_question = function(n){
		$scope.save();
		$scope.qno = n;
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

	$scope.save_finish = function(){

		$scope.save();	//To save the last Question into object

		if(confirm("Are you sure?"))
		{
			var temp_array = [$scope.topic, $scope.total_quest, $scope.co_mapping, $scope.level];
			var data = {q: 'createTest', test_info: temp_array, qdata : $scope.quest_data};

			$http.post("./faculty/serve.php", data)
			.then(function(response){
				alert(response.data);
			});
		}
	}

	$scope.data_for_edit_test = function(){
		var result = null;
		var url_string = window.location.href;
		var url = new URL(url_string);
		var c = url.searchParams.get("q");
		if(c == 'etw')
		{
			var data = {q: 'dataEditTest'};

			$http.post("./faculty/serve.php", data)
			.then(function(response){
				if(response.data == 0)
					alert("You are not Allowed to Edit this TEST");
				else
				{
					$scope.store_data(response.data);
				}
			});
		}
	}

	$scope.store_data = function(result){
		$scope.topic = result.test_info[0]['topic'];
		$scope.total_quest = parseInt(result.test_info[0]['tnoq']);

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
				level: 'Select level',
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

//Code ends ---//

// Code for EDIT (add, delete, edit) an already created test in edit_test_work.php----//


// Code for Invigilation.php

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

	$scope.live_test = function(){
		var data = {q: 'liveTest'};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			if(response.data == 0)
			{
				$scope.test_list = false;
				alert("No Records Found !!");
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

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			if(response.data == 0)
			{
				alert("No Records Found !!");
			}
			else
			{
				$scope.SL = response.data;
				$scope.invigilation_list = true;
				$scope.check();
			}
		});
	}

	$scope.give_attendence = function(id){
		//alert(id);
		var data = {q: 'giveAttendence', id: id, sid: $scope.sid};

		$http.post("./faculty/serve.php", data)
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
			$http.post("./faculty/serve.php", data)
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

	$scope.end_test = function(sid){
		var data = {q: 'endTest',sid: sid};

		$http.post("./faculty/serve.php", data)
		.then(function(response){
			
			if(response.data == true || response.data == 'true')
			{
				$scope.live_test();
			}
		});
	}


});


//Code Ends


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

			$http.post("./faculty/serve.php", data)
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