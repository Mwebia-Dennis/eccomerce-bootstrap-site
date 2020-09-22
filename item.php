<?php

	class Item
	{

		private $item_id, $item_name, $item_price, $quantity;

		
		function __construct($item_id, $item_name, $item_price, $quantity)
		{
			$this->item_id = $item_id;
			$this->item_name = $item_name;
			$this->item_price = $item_price;
			$this->quantity = $quantity;
		}

		public function getItem_id ()
		{
			return $this->item_id;
		}

		public function getItem_name ()
		{
			return $this->item_name;
		}

		public function getItem_price ()
		{
			return $this->item_price;
		}

		public function getItem_quantity ()
		{
			return $this->quantity;
		}

		public function setItem_quantity ($quantity)
		{
			$this->quantity = $quantity;
		}
	}

?>