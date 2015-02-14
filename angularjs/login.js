var login = angular./**
*  Module
*
* Login module to handle all login requests and dyamnically display results. Soon implement AJAX calls
*/
module('login', []);

login.controller('loginForm', ['$scope', function($scope) {
	$scope.message = '';
	$scope.loginattempt = function(badLogin) {
		if (badLogin) {
			$scope.message = 'Incorrect username or password';
		}
		else {
			$scope.message = '';
		}
	}
}]);

