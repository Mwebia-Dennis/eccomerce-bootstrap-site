<?php
	
	include '../Dao/order_dao.php';	
	include '../Dao/product_info.php';
	include '../Dao/user_dao.php';
	include '../Dao/sellers_info.php';
	include '../Dao/functions.php';

	session_start();

	if (isset($_GET['action'])) {
		
		$productsDetails = new ProductsDetails();
		$seller_Info = new Seller_Info();
		$order = new Order();

		switch ($_GET['action']) {
			
			case 'load_add_new_product':

				$otherFunctions = new OtherFunctions();
				$categories = $otherFunctions->getProductCategory();
				//<!----------------------add new product------->
				echo '


					<div class="container">
						

						<h3 class="text-warning">Add New Product</h3>
						<form id="add_new_product" action="include/action2.php?action=set_new_product" method="POST">

						  <div class="form-group">
						    	<label for="product_name">Product Name</label>
						      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required="required">
						    </div>
						    <div class="form-group">
						    	<label for="product_price">Product Price</label>
						      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Product Price" required="required">
						    </div>
						    <div class="form-group">
						    	<label for="stock_amount">Stock Amount</label>
						      <input type="text" class="form-control" id="stock_amount" name="stock_amount" placeholder="Total Available Stock" required="required">
						    </div>
						  <div class="form-group">
						    <label for="product_description">Product Description</label>
						    <textarea class="form-control" id="product_description" name="product_description" rows="3" placeholder="Product Description" required="required"></textarea>
						  </div>

						  <div class="form-group">

						  	<label for="category">Product Category</label><br>
						  	<select class="form-control" id="category" name="category">
						  		';

						  		if(!empty($categories)){
						  			foreach ($categories as $value) {
						  				echo '<option value="'.$value['id'].'">'.$value['category_name'].'</option>';
						  			}
						  			
						  		}

						  		echo '
						  	</select>

						  </div>

						  <div class="form-group">

						  		<span>Choose Product Image</span>
						  	<div class="custom-file">
							    <input type="file" class="custom-file-input" name="file[]" multiple id="product_images">
							    <label class="custom-file-label" for="product_images" required="required">Choose Image </label>

							    <small class="text-info">You can choose upto 3 images</small>
							  </div>
						  </div>

						  

						  <div class="form-group">
						  	
						  	<div class="alert alert-danger" style="display:none;" id="error_msg_box"></div>
						  	<button class="btn btn-primary" id="add_product" onclick="addProduct()">Add Product</button>
						  </div>
						</form>
					</div>

				';
				break;

			case 'load_sales_data':

				$all_order = $order->getAllOrder();

				if (!empty($all_order)) {
					
					echo '


					<div class="container">
						
						<h4 class="text-warning">All sales</h4>

						<table class="table table-dark">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Product</th>
						      <th scope="col">Order Id</th>
						      <th scope="col">Payment Id</th>
						      <th scope="col">Quantity</th>
						      <th scope="col">Total</th>
						      <th scope="col">Bought By</th>
						    </tr>
						  </thead>
						  <tbody>

					';

					$i = 1;
					foreach ($all_order as $order_info) {
						
						//get user info
						$user_d = new UserDao($order_info['ordered_by']);
						$buyer_info = $user_d->getUser();
						$product_info = $productsDetails->getProduct($order_info['product_id']);
						
						//<!----------------------sales area------->
						echo '


								    <tr>
								      <th scope="row">'.$i.'</th>
								      <td>'.$product_info[0]['item_name'].'</td>
								      <td>'.$order_info['order_id'].'</td>
								      <td>'.$order_info['payment_id'].'</td>
								      <td>'.$order_info['quantity'].'</td>
								      <td>'.($product_info[0]['item_price'] * $order_info['quantity']).'</td>
								      <td>'.$buyer_info[0]['f_name'].' '.$buyer_info[0]['l_name'].'</td>
								    </tr>			    
								    

						';
						$i++;
					}

					echo '


							  </tbody>
							</table>

						</div>

					';
				}
				

				

				break;

			case 'load_retailers_data':

				$all_retailers = $seller_Info->getAllSellers();

				if (!empty($all_retailers)) {

					echo '

						<div class="container">
						
							<h4 class="text-warning">Retailers</h4>

					';
					
					foreach ($all_retailers as $retailer_array) {
						
						//<!----------------------retailers area------->





						echo '					

								<div class="card" style="margin-top: 10px;">
								  <div class="card-body">
								    

								    <div class="row">
								    	
								    	<div class="col-md-5"  style="border: none;">
								    		<img src="images/avatar.png" style="width:80%;margin-bottom: 10px;">
								    		<h5>'.$retailer_array['f_name'].' '.$retailer_array['l_name'].'</h5>
								    		<span>Since '.date('F j, Y', strtotime($retailer_array['date_added'])).'</span>
								    		<br><span class="text-info">Phone: '.$retailer_array['phone_number'].'</span>
								    		<br><h5 class="text-success">Business: '.$retailer_array['business_name'].'</h5>
								    	</div>
								    	<div class="col-md-5" style="border: none;">
								    		<h5 class="text-success" style="text-decoration: underline;">Products</h5>

								    		';

								    								//get retailers products;

											$retailers_products = $productsDetails->getUsersProducts($retailer_array['id']);

								    		if (!empty($retailers_products)) {
								    			
								    			foreach ($retailers_products as $product_info) {
								    				
								    				echo '
								    					<span class="card-text"><img src="'.$product_info['image1'].'" class="retailer_product_img">'.$product_info['item_name'].'</span><br>
								    				';
								    			}
								    		}							    		
								    		
								    	
								    	echo '	
								    		
								    	</div>

								    	<div class="col-md-2">
								    		
								    		<h5>Actions</h5>

								    		<a href="mailto:'.$retailer_array['email'].'" class="btn btn-primary" style="margin-bottom: 5px;"><i class="fas fa-envelope" style="margin-right: 5px;"></i> Mail</a>
								    		<a href="tel:'.$retailer_array['phone_number'].'"  class="btn btn-danger"><i class="fas fa-phone-volume" style="margin-right: 5px;"></i>Call</a>
								    	</div>

								    </div>
								    
								  </div>
								</div>
						';

					}
				}

			
				echo '</div>';

				break;

			case 'load_my_products':
				
				$my_products = $productsDetails->getUsersProducts($_SESSION['user_id']);

				if (!empty($my_products)) {
					
					echo '
						<div class="container">


							<h4 class="text-warning">My Products</h4>
						
							<div class="row">
					';

					foreach ($my_products as $product_array) {
						

						echo '

							<div class="col-md-3">
								<div class="card">
								  <img src="'.$product_array['image1'].'" class="card-img-top" alt="product image">
								  <div class="card-body">
								  	<p class="card-text">'.$product_array['item_name'].'</p>
								  	<a href="product.php?item='.$product_array['id'].'" style="font-size: 18px;margin: 5px;color: #000;"><i class="fas fa-eye"></i></a>
								    <span><i class="fas fa-trash"></i></span>
								  </div>
								</div>
							</div>

						';
					}
				}

				echo '
						</div>

					</div>

				';
				break;

			case 'load_all_products':

				$all_products = $productsDetails->getAllProducts(0);
				
				if(!empty($all_products)) {

					echo '



						<div class="container">
							
							<h4 class="text-warning">All Products</h4>
							<div class="row">
					';
					foreach ($all_products as $product_array) {
						
						echo '
									
									<div class="col-md-3">
										<div class="card">
										  <img src="'.$product_array['image1'].'" class="card-img-top" alt="product image">
										  <div class="card-body">
										  	<p class="card-text">'.$product_array['item_name'].'</p>
										  	<a href="product.php?item='.$product_array['id'].'" style="font-size: 18px;margin: 5px;color: #000;"><i class="fas fa-eye"></i></a>
										    <span><i class="fas fa-trash"></i></span>
										  </div>
										</div>
									</div>

								

						';
					}

					echo '

							</div>

						</div>
					';
				}
				
				break;

			case 'load_main_dashboard':

				$undelivered_array = $order->getUnDeliveredProducts();

				if(!empty($undelivered_array)) {


					echo '


							<div class="container">
								
							<h4 class="text-warning">Undelivered Products</h4>
					';
					foreach ($undelivered_array as $data) {
						
						//get users info

						$user_dao = new UserDao($data['ordered_by']);
						$user_info = $user_dao->getUser();
						$user_address = $user_dao->getUserAddress();
						$product_info = $productsDetails->getProduct($data['product_id']);

						//<!----------------------dashboard area------->
					
						echo '


								<div class="card" style="margin-top: 10px;">
								  <div class="card-body">
								    <h5 class="card-title text-center"><img src="images/avatar.png" style="width: 40px;height: 40px;border-radius: 50%;margin-right: 5px;">'.$user_info[0]['f_name'].' '.$user_info[0]['l_name'].'</h5>

								    <div class="row">
								    	
								    	<div class="col-md-6">
								    		<h5 class="text-success" style="text-decoration: underline;">Shipping Address</h5>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>Address: '.$user_address[0]['address'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>City: '.$user_address[0]['city'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>State: '.$user_address[0]['state_id'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>Zip: '.$user_address[0]['zip'].'</p>
								    	</div>
								    	<div class="col-md-6">
								    		<h5 class="text-success" style="text-decoration: underline;">Product: </h5>
								    		<p class="card-text">'.$product_info[0]['item_name'].'</p>

								    		<h5 class="text-success" style="text-decoration: underline;">Quantity: </h5>
								    		<p class="card-text">'.$data['quantity'].'</p>

								    		<h5 class="text-success" style="text-decoration: underline;">Total: </h5>
								    		<p class="card-text">$'.($data['quantity']*$data['price']).'</p>
								    	</div>

								    </div>
								    
								  </div>
								</div>					

						';
					}

					echo '

						</div>
					</div>
					';

				}else {
					echo 'sorry there are no undelivered products today';
				}

				
				break;

			case 'retailer_undelivered_products':
				
				$undelivered_array = $order->getUnDeliveredProducts();

				if(!empty($undelivered_array)) {


					echo '


							<div class="container">
								
							<h4 class="text-warning">Undelivered Products</h4>
					';
					foreach ($undelivered_array as $data) {
						
						//get users info

						$user_dao = new UserDao($data['ordered_by']);
						$user_info = $user_dao->getUser();
						$user_address = $user_dao->getUserAddress();

						$product_info = $productsDetails->getProduct($data['product_id']);

						//only show undelivered goods for this retailer only 
						if($product_info[0]['added_by'] == $_SESSION['user_id']) {
							//<!----------------------dashboard area------->
					
							echo '


								<div class="card" style="margin-top: 10px;">
								  <div class="card-body">
								    <h5 class="card-title text-center"><img src="images/avatar.png" style="width: 40px;height: 40px;border-radius: 50%;margin-right: 5px;">'.$user_info[0]['f_name'].' '.$user_info[0]['l_name'].'</h5>

								    <div class="row">
								    	
								    	<div class="col-md-6">
								    		<h5 class="text-success" style="text-decoration: underline;">Shipping Address</h5>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>Address: '.$user_address[0]['address'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>City: '.$user_address[0]['city'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>State: '.$user_address[0]['state_id'].'</p>
								    		<p class="card-text"><i class="far fa-check-circle" style="margin: 5px;"></i>Zip: '.$user_address[0]['zip'].'</p>
								    	</div>
								    	<div class="col-md-6">
								    		<h5 class="text-success" style="text-decoration: underline;">Product: </h5>
								    		<p class="card-text">'.$product_info[0]['item_name'].'</p>

								    		<h5 class="text-success" style="text-decoration: underline;">Quantity: </h5>
								    		<p class="card-text">'.$data['quantity'].'</p>

								    		<h5 class="text-success" style="text-decoration: underline;">Total: </h5>
								    		<p class="card-text">$'.($data['quantity']*$data['price']).'</p>
								    	</div>

								    </div>
								    
								  </div>
								</div>					

							';
						}
						
					}

					echo '

						</div>
					</div>
					';

				}else {
					echo 'sorry there are no undelivered products today';
				}

				break;

			case 'load_retailers_sales_data':

				$all_order = $order->getAllOrder();

				if (!empty($all_order)) {
					
					echo '


					<div class="container">
						
						<h4 class="text-warning">All sales</h4>

						<table class="table table-dark">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Product</th>
						      <th scope="col">Order Id</th>
						      <th scope="col">Payment Id</th>
						      <th scope="col">Quantity</th>
						      <th scope="col">Total</th>
						      <th scope="col">Bought By</th>
						    </tr>
						  </thead>
						  <tbody>

					';

					$i = 1;
					foreach ($all_order as $order_info) {
						
						//get user info
						$user_d = new UserDao($order_info['ordered_by']);
						$buyer_info = $user_d->getUser();
						$product_info = $productsDetails->getProduct($order_info['product_id']);

						//only display this retailers data

						if($product_info[0]['added_by'] == $_SESSION['user_id']){
						
							//<!----------------------sales area------->
							echo '


									    <tr>
									      <th scope="row">'.$i.'</th>
									      <td>'.$product_info[0]['item_name'].'</td>
									      <td>'.$order_info['order_id'].'</td>
									      <td>'.$order_info['payment_id'].'</td>
									      <td>'.$order_info['quantity'].'</td>
									      <td>'.($product_info[0]['item_price'] * $order_info['quantity']).'</td>
									      <td>'.$buyer_info[0]['f_name'].' '.$buyer_info[0]['l_name'].'</td>
									    </tr>			    
									    

							';

							$i++;
						}

					}

					echo '


							  </tbody>
							</table>

						</div>

					';
				}
				

				

				break;
			
			default:
				
				exit();
				break;
		}
	}

?>