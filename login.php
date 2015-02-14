<html ng-app="login">
<head>
<script src="angularjs\angular.min.js"></script>
<script src="angularjs\login.js"></script>
</head>
<body>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '\project-121\objects\objects.php');
$bad_login = false;
if (isset($_POST['submit'])) {
	$bad_login = false;
	$dashboard = new Dashboard();
	$entered_username = $dashboard->sanitize($_POST['username']);
	$entered_password = sha1($dashboard->sanitize($_POST['password']));
	if ($dashboard->attempt_login($entered_username, $entered_password)) {
		//Login was good, assign session superglobal and create a cookie based on unique user id
		$user_id = $dashboard->attempt_login;
		$_SESSION['user_id'] = $user_id;
		setcookie('user_id', $user_id, 3600);
		header('Location:index.php');
	}
	else {
		$bad_login = true;
	}
}
?>
<html>
<div ng-controller="loginForm" ng-init="loginattempt('<?php echo $bad_login;?>')">
{{message}}
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label for="username">Username</label>
<input type="text" name="username"><br/>
<label for="password">Password</label>
<input type="password" name="password">
<input type="submit" name="submit" value="Login">
</form>
</div>
</html>
