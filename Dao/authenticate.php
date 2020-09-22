<?php

	include 'connection.php';

	/**
	 * base class AuthenticateUsers used to authenticate users ;
	 */
	class AuthenticateUsers
	{

		protected $error;

		public function get_error()
		{
			return $this->error;
		}

		function __construct()
		{
			# code...
		}

		public function setCustomer($query)
		{
			
			global $conn;
			$result = $conn->query($query);

			return ($result)?$conn->insert_id:""; 
		}

		public function getCustomer($email, $password)
		{

			global $conn;

			$session_id = "";

			$sql = "SELECT * FROM users WHERE email = '".$conn->real_escape_string($email)."' limit 1";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				$row = $result->fetch_assoc();

				$db_email = $row['email'];
				$db_password = $row['password'];
				$id = $row['id'];

				$salt = "thankyouforloggingintooursite".$id;
				$salt_and_password = $salt.$password;

				if ($db_email == $email && password_verify($salt_and_password, $db_password)) {
					
					$session_id = $id;
				}else{
					$error = "wrong user email and password";
				}
			} else {

				$error = "Sorry user does not exist, Don't hesitate <br><a href='signup.php'>Sign Up Today</a>";
			}

			$msg = array('session_id' => $session_id,'error' =>$error);

			return $msg;
		}
	}

	/**
	 * used to authorize users only;
	 *takes isAdmin which when 0 then its admin if 1 then its retailer;
	 *default isAdmin = 0;
	 */
	class AuthorizeUser extends AuthenticateUsers
	{
		function __construct()
		{

		}

		public function registerPersonnel($f_name, $l_name, $email, $password, $phone_number, $city)
		{
			global $conn;
			$sql = "";
			//set our query to insert into users table;

			$sql = "SELECT `id` FROM users WHERE email = '".$email."' limit 1";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				$error = "Sorry user already exists";
			} else {

				
				$sql = "INSERT INTO `users` (`id`, `f_name`, `l_name`, `phone_number`, `email`, `business_name`, `id_number`, `city`, `password`, `user__role`, `date_added`) VALUES (NULL, '".$conn->real_escape_string($f_name)."'
				, '".$conn->real_escape_string($l_name)."', '".$conn->real_escape_string($phone_number)."'
				, '".$conn->real_escape_string($email)."', NULL, NULL, '".$conn->real_escape_string($city)."', '".$conn->real_escape_string($password)."','user', current_timestamp())";
			}

			$msg = "";
			$last_id = $this->setCustomer($sql);

			if ($last_id != "") {
				//update password;
				$salt = "thankyouforloggingintooursite".$last_id;
				$salt_and_password = $salt.$password;
				$hashed_password = password_hash($salt_and_password, PASSWORD_DEFAULT);

				//update user password with the hashed password;
				$sql = "UPDATE users SET password = '".$hashed_password."' WHERE id = '".$last_id."'";

				$result = $conn->query($sql);

				if ($result) {
					$msg = 'Successful Signup';
				}else {
					$this->error = "failed update";
				}

			}else {

				$this->error = "Sorry could not Sign You Up, try again later sql =   ".$sql;
			}

			return ($this->get_error() == "")?$msg: $this->get_error();
		}

		
	}

?>