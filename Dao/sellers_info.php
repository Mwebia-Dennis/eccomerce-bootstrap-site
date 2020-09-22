<?php

	
	include 'connection.php';

	require_once 'QuerySql.php';
	/**
	 * class used to get sellers info;
	 */
	class Seller_Info extends QueryMysql
	{
		private $error;

		public function get_error()
		{
			return $this->error;
		}	

		public function getSpecificSellerInfo($item_id)
		{
			global $conn;
			$seller = array();

			if ($item_id == "") {
				
				$error = "Sorry can not load Seller information";
			} else {

				//getting sellers id;
				$sql = 'SELECT added_by FROM `products_info` WHERE id = '.$conn->real_escape_string($item_id).' LIMIT 1';

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {

					$row = $result->fetch_assoc();

					//getting sellers info;
					$sql = 'SELECT * FROM users WHERE id = '.$row['added_by'].' LIMIT 1';

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						$seller[] = $result->fetch_assoc();
					}
					
				} else {

					$seller[] = array(
						'id' => '0', 
						'f_name' => 'HappyFeetFamily',
						'l_name' => 'ltd',
						'phone_number' => '0123456789',
						'email' => 'info@happyfeetfamily.com',
						'city' => 'Mumbai',
						'business_name' => 'HappyFeetFamily'
					);
				}

			}

			return $seller;
		}

		public function getAllSellers()
		{
			
			return $this->getData("SELECT * FROM `users` WHERE user__role = 'retailer' order by date_added desc");
		}
	}
?>