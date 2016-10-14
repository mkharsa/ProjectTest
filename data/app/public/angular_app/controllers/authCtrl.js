bda.controller('authCtrl',['$scope',
	function($scope){
		//login operation
		$scope.signin=function(){
			console.log("clicked");
		}
		//forget password btn click
		$scope.isforget=false;
		$scope.forget=function(){
			isforget=true;
		}


	}
]);