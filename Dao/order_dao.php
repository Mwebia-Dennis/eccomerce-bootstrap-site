<?php
	
	
	include 'QuerySql.php';
	/**
	 * all data relating to orders and transactions;
	 */
	class Order extends QueryMysql
	{
		
		public function setOrder($order_id, $payment_id,$product_id,$quantity, $price, $total,$ordered_by)
		{
			
			return $this->runQuery("INSERT INTO `product_order` (`id`, `order_id`, `payment_id`, `product_id`, `quantity`, `price`, `total`, `ordered_by`, `date_added`) VALUES (NULL, '".$order_id."', '".$payment_id."', '".$product_id."', '".$quantity."', '".$price."', '".$total."', '".$ordered_by."', current_timestamp())");
		}

		public function getAllOrder()
		{
			
			return $this->getAll('product_order');
		}

		public function getUnDeliveredProducts()
		{
			return $this->getData("SELECT * FROM product_order where status = 'undelivered' order by date_added desc");
		}



	}

?>