<?php

  	include 'Dao/product_info.php';
  	include 'Dao/sellers_info.php';

	if ($_GET['action'] == 'load_content' && isset($_GET['content_type']) && $_GET['content_type'] != "") {

		switch ($_GET['content_type']) {
			case 'product_details':
			
				if ($_GET['item'] != "" && is_numeric($_GET['item'])) {
	  
	  				$product_details = new ProductsDetails();
	  				$product = array();
			      $product = $product_details->getProduct($_GET['item']);

			      $product_specifications = explode(",", $product[0]['item_description']);

			      echo '<h2>'.$product[0]['item_name'].'</h2>';

			      for ($i=0; $i < sizeof($product_specifications); $i++) { 
			      	
			      	echo '<p> <span>&#10003;</span>'.$product_specifications[$i].'</p>';
			      }
			    }
				break;

			case 'delivery_info':

				echo ' 
					<h2 style="color: #3333cc;">Free delivery around Mumbai</h2>
					<p>

						<select>

							<option selected>Choose Your Town To View Cost</option>
							<option>sorry this feature is not available, Coming soon</option>
						</select>
					</p>

					<p>Delivery within 3 days from day of order</p>
					<p>Return Policy: return within 7 days after delivery</p>
					<p>1 Year warranty</p>
					<p><a href="#">Terms</a> & <a href="#">Conditons</a> Apply</p>
				';


				break;

			case 'seller_info':

				if ($_GET['item'] != "" && is_numeric($_GET['item'])) {
					
					$seller = new Seller_Info();
					$seller_info = $seller->getSpecificSellerInfo($_GET['item']);

					echo '

						<h2> Name: '.$seller_info[0]['f_name'].' '.$seller_info[0]['l_name'].'</h2>
						<h3>Company: '.$seller_info[0]['business_name'].'</h3>
						<p style="color: #3333cc;">100% trusted seller</p>
						<p>Contact:
						<br>

						email: '.$seller_info[0]['email'].'<br>
						phone number: '.$seller_info[0]['phone_number'].'<br>
						city: '.$seller_info[0]['city'].'<br>
						</p>

					';
				}
				break;
		}
	}

?>

