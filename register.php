<html ng-app="register">
<head>
<script src="angularjs\angular.min.js"></script>
<script src="angularjs\register.js"></script>
</head>
<body>
<?php
?>
<div ng-controller="registerForm">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label for="username">Username</label>
<input type="text" name="username" ng-model="username">
{{usernameMessage}}<br/>
<label for="password">Password</label>
<input type="password" name="password"><br/>
<strong>Contact Info</strong><em><font size="2">&nbsp;&nbsp;&nbsp;*How you wish to be contacted for lost or found items</em></font><br/>
<label for="email">Email:</label>
<input type="email" name="email"><br/>
<label for="phonenumber">Phone No.</label>
<input type="tel" name="phone"><br/>
<input type="submit" value="Register" name="submit">
</form>
</div>
</body>
</html>
