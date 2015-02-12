<?php
require_once('../objects/objects.php');
$dashboard = new dashboard();
if (isset($_POST['submit']) && !empty($_POST['item_name'])) {
	$location_string = $dashboard->sanitize($_POST['location_string']);
	$item_name = $dashboard->sanitize($_POST['item_name']);
	$latitude; //Need to code these
	$longitude; //Need to code these
	$insert_into_reports_sql = "INSERT INTO reports (item_name, state, date_reported, user_id, location_string, latitude, longitude) VALUES('$item_name, 0, CURDATE(), '$user_id', '$location_string', '$latitude', '$longitude')";
	$result_into_reports = mysqli_query($this->dbc, $insert_into_reports_sql)
	or die (mysqli_error($this->dbc));

}
?>
<html>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><p>
Item Name
<input type="text" name="item_name">
Building
<!-- Select options to be populated based on college, name for now is location_string-->
<input type="submit" name="submit" value="Report Item">
</p>
</form>