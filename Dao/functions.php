<?php
	

	
	require_once 'QuerySql.php';
	/**
	 * 
	 */
	class OtherFunctions extends QueryMysql
	{
		
		public function getStates(){
			
			return $this->getData("SELECT * FROM `states` order by state ASC");
		}
		public function getStatesName($state_id){
			
			return $this->getData("SELECT state FROM `states` where id = ".$state_id." limit 1");
		}

		public function getProductCategory()
		{
			return $this->getAll("product_category");
		}

		public function searchProducts($query) {
			return $this->getData("SELECT * FROM `products_info` where item_name like '%".$query."%' ORDER by date_added DESC");
		}
		
	}

?>