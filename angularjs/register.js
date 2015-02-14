var url = 'localhost/project-121/getRequests/registerQuery.php';
var registerMod = angular./**
*  Module
*
* Module for handling the registration form
*/
module('register', []).
config(function($provide) {
	$provide.provider('getUsername', function() {
		$this.get = function () {
			return function(username) {
				var getSuffx = '?username=' + username;
				$http.get(url + getSuffix).
					success(function(exists) {
						return exists;
				}).
					error(function(){

				});
			};
		};
	}
});

registerMod.controller('registerForm', ['$scope', 'getUsername', function($scope) {
	$scope.usernameMessage = '';
	$scope.$watch('username', function(newValue, oldValue) {
		if (getUsername(newValue)) {
			$scope.usernameMessage = 'Username exists';
		}
		else {
			$scope.message = '';
		}
	});
}]);

