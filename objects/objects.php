<?php
class Dashboard {
	public function __construct() {
		/*
		Null -> Null
		Sets up initial connection parameters
		 */
		require_once('../includes/connectvars.php');
		$this->dbc = mysqli_connect(HOST, USER, PASS, DATABASE)
		or die ("Error connecting to database");
	}

	public function sanitize($string) {
		/*
		Str -> Str
		Escapes any potential dangerous characters to form an SQL injection Attack
		 */
		return mysqli_real_escape_string($this->dbc, trim($string));
	}
}
class Report extends Dashboard {
	public function __construct($report_id) {
		/*
		Int -> Null
		Sets up object based on the report id
		 */
		parent::__construct();
		list($this->item_name, $this->state, $this->date_reported, $this->user_id, $this->location_string, $this->latitude, $this->longitude) = $this->fetch_all_info($report_id);
		$this->username = $this->get_the_username();
	}

	private function fetch_all_info($report_id) {
		/*
		Int -> Associatve Array
		 */
		$get_all_info_sql = "SELECT item_name, state, date_reported, user_id, location_string, latitude, longitude FROM reports WHERE report_id = '$report_id'";
		$result_get_all_info = mysqli_query($this->dbc, $get_all_info_sql)
		or die (mysqli_error($this->dbc));
		return mysqli_fetch_array($result_get_all_info);
	}

	private function get_the_username($user_id) {
		/*
		Int -> Str
		Fetches username based on unique user id
		 */
		$get_username_sql = "SELECT username FROM users WHERE user_id = '$user_id'";
		$result_get_username = mysqli_query($this->dbc, $get_username_sql)
		or die (mysqli_error($this->dbc));
	}
}

class Comments extends Report {
	public function __construct($comment_id) {

	}
}
?>
