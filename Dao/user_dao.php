<?php

	include 'connection.php';
	require_once 'QuerySql.php';
	/**
	 * all actions related with users;
	 */
	class UserDao extends QueryMysql
	{
		
		private $user_id;
		function __construct($user_id)
		{
			
			$this->user_id = $user_id;
		}

		public function getUser()
		{
			
			return $this->getData("SELECT * FROM users WHERE id = ".$this->user_id." limit 1");
		}

		public function getUserAddress() {

			return $this->getData("SELECT * FROM `user_address` where user_id = ".$this->user_id." limit 1;");
		}

		public function setUserAddress($user_id, $address, $city, $state_id, $zip_code) {

			global $conn;

			$result = false;

			if($this->executeQuery("SELECT id FROM `user_address` where user_id=".$conn->real_escape_string($this->user_id)) > 0) {
				//update data

				$result = $this->runQuery("UPDATE `user_address` SET user_id = ".$conn->real_escape_string($this->user_id).", address = '".$conn->real_escape_string($address)."', city = '".$conn->real_escape_string($city)."', state_id = '".$conn->real_escape_string($state_id)."', zip = '".$conn->real_escape_string($zip_code)."' where user_id=".$conn->real_escape_string($this->user_id));

			}else {
				//set new data
				$result = $this->runQuery("INSERT INTO `user_address` (`id`, `user_id`, `address`, `city`, `state_id`, `zip`, `date_added`) VALUES (NULL, '".$conn->real_escape_string($this->user_id)."', '".$conn->real_escape_string($address)."', '".$conn->real_escape_string($city)."', '".$conn->real_escape_string($state_id)."', '".$conn->real_escape_string($zip_code)."', current_timestamp())");
			}
			return $result;

		}
	}

?>