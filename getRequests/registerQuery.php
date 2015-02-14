<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/project-121/objects/objects.php');
if (isset($_GET['username'])) {
	$dashboard = new Dashboard();
	$username = $dashboard->sanitize($_GET['username']);
	$sql_check_username_exists = "SELECT user_id FROM users WHERE username = '$username'";
	$result_check_if_username_exists = mysqli_query($dashboard->dbc, $sql_check_username_exists)
	or die (mysqli_error($dashboard->dbc));
	$status = (mysqli_num_rows($result_check_if_username_exists) > 0) ? True : False;
	$array_result = array('Exists:' => $status);
	print(json_encode($array_result));
}
?>