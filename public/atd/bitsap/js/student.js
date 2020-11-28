


var liveTest = angular.module('liveTest', []);
liveTest.controller('liveTestCtrl', function($scope,$http)
{
	$scope.liveTestData = null;

	$scope.fetch_live_test_data = function() {

		var data = {q: 'liveTestData'};

		$http.post("./student/serve.php", data)
		.then(function(response){
			$scope.liveTestData = response.data;
			//alert(response.data);
		});
	}

	$scope.fetch_live_test_data();

	$scope.take_test = function(arg) {
		var data = {q: 'takeTest', test_id : arg};
		//alert(data.test_id);

		$http.post("./student/serve.php", data)
		.then(function(response){
			if(response.data);
				window.location.href = "/otp/exam.php";
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


var report = angular.module('report', []);
report.controller('reportCtrl', function($scope,$http)
{
	$scope.sub_list = null;
	$scope.test_record = null;
	$scope.subname = '';
	$scope.rec_tab = false;

	$scope.subject_list = function(){
		var data = {q: 'subject_list'};
		$http.post("./student/serve.php", data)
		.then(function(response){
			$scope.sub_list = response.data;
			//alert(response.data);
		});
	}

	$scope.subject_list();

	$scope.load_test_record = function(id,subname){
		//alert(id);
		$scope.subname = subname;
		var data = {q: 'test_record', sem_sub_id: id};

		$http.post("./student/serve.php", data)
		.then(function(response){
			if(response.data != 0)
			{
				$scope.test_record = response.data;
				$scope.rec_tab = true;
			}
			else
			{
				$scope.rec_tab = false;
				alert("No record found!");
			}
			
			//alert(response.data);
		});
	}
});