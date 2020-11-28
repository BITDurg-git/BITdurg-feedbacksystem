var exam = angular.module('exam', []);
exam.controller('examCtrl', function($scope,$http,$interval)
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

	$scope.quest_data = [];


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

	$scope.save = function(){

		$scope.quest_data[$scope.qno].a = JSON.parse(JSON.stringify($scope.a)); 
		$scope.quest_data[$scope.qno].b = JSON.parse(JSON.stringify($scope.b));
		$scope.quest_data[$scope.qno].c = JSON.parse(JSON.stringify($scope.c));
		$scope.quest_data[$scope.qno].d = JSON.parse(JSON.stringify($scope.d));
	}

	$scope.display_question = function(n){
		$scope.save();
		$scope.qno = n;
		$scope.display();
	}

	$scope.time_update = function(){
		var data = {q: 'timeLeft', t: $scope.time_left_update};

		$http.post("./serve.php", data)
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
		$scope.data_for_test();
	}


	$scope.data_for_test = function(){
		var data = {q: 'examData'};

		$http.post("./serve.php", data)
		.then(function(response){

			if(response.data == 0 || response.data == 3)
				alert("You are not allowed to Attempt this Test");

			else if(response.data == 2 || response.data == 4)
				alert("Get Your Attendence Again");

			else
			{
				$scope.store_data(response.data);
				//code to update status of exam must be written here
				$scope.start_btn = false;
				$scope.start_exam = true;
			}

			//alert(response.data);

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
				qid: result.quest_data[i-1]['qid']
			};
		}

		//alert($scope.quest_data[1]);
		$scope.display();
		$scope.start_timer(parseInt(result.test_info[0]['duration']));
	}

	$scope.upload_response = function(opt){
		//alert(opt);
		var status = null;

		switch(opt)
		{
			case 'a':
			status = ($scope.a)?0:1;
			break;

			case 'b':
			status = ($scope.b)?0:1;
			break;

			case 'c':
			status = ($scope.c)?0:1;
			break;

			case 'd':
			status = ($scope.d)?0:1;
			break;
		}

		var data = {
					q: 'uploadResponse',
					option : opt,
					status : status,
					qid: $scope.quest_data[$scope.qno].qid
					};

		$http.post("./serve.php", data)
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

		$http.post("./serve.php", data)
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