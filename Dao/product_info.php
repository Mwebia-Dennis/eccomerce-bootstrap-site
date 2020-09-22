<?php
	
	include 'connection.php';
	require_once 'QuerySql.php';
	/**
	 * getting products from db;
	 */
	class ProductsDetails extends QueryMysql
	{
		
		private $error = '';
		function __construct()
		{
			# code...
		}

		public function get_error()
		{
			return $this->error;
		}

		public function set_error($error)
		{
			$this->error = $error;
		}

		//function to get all products from db;
		public function getAllProducts($startFrom=0)
		{
			
			global $conn;

			return $this->getData("SELECT * FROM `products_info` WHERE 1 ORDER BY date_added LIMIT 12 OFFSET ".$conn->real_escape_string($startFrom));;
		}

		//get specific product as per id;
		public function getProduct($product_id)
		{

			global $conn;

			return $this->getData('SELECT * FROM products_info WHERE id = '.$conn->real_escape_string($product_id).' LIMIT 1');
		}

		public function setProduct($item_name,$item_des, $item_price, $image1,$added_by, $category,$stock_amount, $image2, $image3) {

			global $conn;
			
			return $this->runQuery("INSERT INTO `products_info` (`id`, `item_name`,`item_description` ,`item_price`, `image1`, `added_by`, `category`,`date_added`, `stock_amount`, `image2`, `image3`) VALUES (NULL, '".$conn->real_escape_string($item_name)."', '".$conn->real_escape_string($item_des)."', '".$conn->real_escape_string($item_price)."', '".$conn->real_escape_string($image1)."', '".$conn->real_escape_string($added_by)."','".$conn->real_escape_string($category)."', current_timestamp(), '".$conn->real_escape_string($stock_amount)."', '".$conn->real_escape_string($image2)."', '".$conn->real_escape_string($image3)."');");
		}

		public function getUsersProducts($user_id) {

			return $this->getData('SELECT * FROM products_info WHERE added_by = '.$user_id);
		}
		//function to get all products from db;
		public function getProductsByCategory($category)
		{
			
			global $conn;

			return $this->getData("SELECT * FROM `products_info` WHERE category = '".$category."' ORDER BY date_added LIMIT 12 OFFSET 0");
		}

	}

?>