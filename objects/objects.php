<?php
class Dashboard {
	/*
	General class for any config settings in the site
	 */
	public function __construct() {
		/*
		Null -> Null
		Sets up initial connection parameters
		 */
		require_once($_SERVER['DOCUMENT_ROOT'] . '/project-121/includes/connectvars.php');
		$this->dbc = mysqli_connect(HOST, USER, PASS, DATABASE)
		or die ("Error connecting to database");
	}

	public function attempt_login($username, $password) {
		/*
		str, hashed password -> bool
		 */
		$attempt_login_sql = "SELECT user_id FROM users WHERE username = '$username' AND password = '$password'";
		$result_attempt_login = mysqli_query($this->dbc, $attempt_login_sql)
		or die (mysqli_error($this->dbc));
		return (mysqli_num_rows($result_attempt_login) == 1) ? mysqli_fetch_row($result_attempt_login)[0] : false; 
	}

	public function sanitize($string) {
		/*
		Str -> Str
		Escapes any potential dangerous characters to form an SQL injection Attack
		 */
		return mysqli_real_escape_string($this->dbc, trim($string));
	}

	public function is_logged_in() {
		/*
		Null -> Boolean
		Checks if the current user is logged in
		 */
		return isset($_SESSION['user_id']) || isset($_COOKIE['user_id']);
	}
}


class Report extends Dashboard {
	/*
	General class for any report filed, needs to be referenced by its unique report id
	 */
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

class General_Comments extends Dashboard {
	//General class of comments to provide model functions to comments, two class of comments, inital comments and comments that are replies to comments
	public function __construct() {
		/*
		Null -> Null
		 */
		parent::__construct();
	}

	public function get_comment_info($comment_id) {
		/*
		Int -> Array()
		 */
		$get_all_info_sql = "SELECT comment_text, user_id, date_posted, parent_id FROM comments WHERE comment_id = '$comment_id'";
		$result_get_all_info = mysqli_query($this->dbc, $get_all_info_sql)
		or die (mysqli_error($this->dbc));
		return mysqli_fetch_array($result_get_all_info, mysqli_num);
	}
}


class Comments extends General_Comments {
	//Parent ID should be null
	public function __construct($comment_id) {
		/*
		int -> Null
		 */
		parent::__construct();
		$this->comment_id = $comment_id;
		list($this->comment_text, $this->author_id, $this->date_posted, $this->parent_ID) = parent::get_comment_info($comment_id);
	}
}

class Reply_Comment extends General_Comments {
	//Parent ID should be a valid int referenced in the comment database
	public function __construct($comment_id) {
		/*
		int -> Null
		 */
		parent::__construct();
		$this->comment_id = $comment_id;
		list($this->comment_text, $this->author_id, $this->date_posted, $this->parent_ID) = parent::get_comment_info($comment_id);
	}
}
?>
