<?php

	include 'item.php';
	include 'Dao/authenticate.php';

	session_start();

	if (isset($_GET['action'])) {
		
		//when action is equal to add we add item to shopping cart;
		if ($_GET['action'] == 'add') {
			
			if (isset($_POST['add_to_cart'])) {
		
				$item_id = $_POST['item_id'];
				$price = $_POST['price'];
				$item_name = $_POST['item_name'];
				$quantity = $_POST['quantity'];

				$item = new Item( $item_id, $item_name, $price, $quantity);

				$product_array = array($item->getItem_id() => $item);

				$_SESSION['add_to_cart'] = (isset($_SESSION['add_to_cart']))? $_SESSION['add_to_cart'] : array();

				if (!empty($_SESSION['add_to_cart'])) {
					
					//our add to cart has some existing items;
					//check if item exists 
					if (in_array($item->getItem_id(), array_keys($_SESSION['add_to_cart']))) {

						//update quantity and price;
						$_SESSION['add_to_cart'][$item->getItem_id()]->setItem_quantity ($_GET['new_quantity']);

					} else {

		        //add up the item to the top of stack;
						$_SESSION['add_to_cart'] += $product_array;

					}
					
				} else {

					//no items so add our new item;
					$_SESSION['add_to_cart'] = $product_array;

		      
				}

				//prevent form resubmission;
			    header('location: cart.php');

			    exit();
		      
			}


		}
		
		//updating shopping cart values;
		else if ($_GET['action'] == 'update') {
			
			if (isset($_GET['item']) && isset($_GET['new_quantity']) && is_numeric($_GET['item']) && is_numeric($_GET['new_quantity'])) {
				


				//checking if item exists in array;
				if (isset($_SESSION['add_to_cart'][$_GET['item']]) && $_GET['new_quantity'] > 0) {

					$_SESSION['add_to_cart'][$_GET['item']]->setItem_quantity ($_GET['new_quantity']);
				}

				//prevent resubmission;
				header('location: cart.php');
				exit();
			}

		}
		//removing an item from cart;

		else if ($_GET['action'] == 'remove') {
			
			if ($_GET['item']) {

      			//remove item from shopping cart;
		      if (in_array($_GET['item'], array_keys($_SESSION['add_to_cart']))) {
		        
		        unset($_SESSION['add_to_cart'][$_GET['item']]);

		        header('location: cart.php');

		        exit();

		      } else{

		      	echo('Sorry could not find item in shopping cart');

		      }

		    }
	      
		}

		//logging in the user

		else if ($_GET['action'] == 'login') {

			if (isset($_POST['login'])) {
				
				$error = "";
				$error = ($_POST['email'] == "")?"Sorry email is required": "";
				$error = ($_POST['password'] == "")?"Sorry password is required": "";

				if ($error == "") {
					
					$authorizeUser = new AuthorizeUser();

					$user_id = $authorizeUser->getCustomer($_POST['email'], $_POST['password'])['session_id'];

					if ($user_id == "") {

						echo('<p style="background-color:ff3300; text-align:center;width: 400px;height:300px;font-size:20px;color:#fff;margin-left:20%;padding:10px;">'.$authorizeUser->getCustomer($_POST['email'], $_POST['password'])['error']);

					} else {
						echo($user_id);
						$_SESSION['user_id'] = $user_id;

						if (isset($_POST['keep_loggedin'])) {
							
							setcookie('user_id', $_SESSION['user_id'], time() + 60 * 60 * 24*30);//coookie set for 30 days
						}

						switch ($_GET['from']) {
							
							case 'main_login':
								header('location: shop.php');
								break;

							case 'retailer_login':
								header('location: retailers.php');
								break;
							case 'admin':
								header('location: admin.php');
								break;
							
							default:
								# code...
								break;
						}
						
						exit();
					}

				}else {

					header('location:login.php?error='.$error);
					exit();
				}



			} else {

			}
		}

		//sign up the user

		else if ($_GET['action'] == 'signup') {

			if (isset($_POST['signup'])) {
				
				$error = "";
				$error = ($_POST['f-name'] == "")?"Sorry first name is required": "";
				$error = ($_POST['l-name'] == "")?"Sorry last name is required": "";
				$error = ($_POST['email'] == "")?"Sorry email is required": "";
				$error = ($_POST['password'] == "")?"Sorry email is required": "";
				$error = ($_POST['phone-number'] == "")?"Sorry phone number is required": "";
				$error = ($_POST['city'] == "")?"Sorry city is required": "";

				if ($error == "") {
					
					$authorizeUser = new AuthorizeUser();

					$msg = $authorizeUser->registerPersonnel($_POST['f-name'], $_POST['l-name'], $_POST['email'], $_POST['password'], $_POST['phone-number'], $_POST['city']);
					echo($msg);

					if($msg = 'Successful Signup') {
						header('location: login.php');
						exit();
					}
				}else {

					header('location:login.php?error='.$error);
					exit();
				}



			}
		}

		//log out

		else if ($_GET['action'] == 'logout') {

			session_destroy();

			setcookie('user_id', "", time() - 60 * 60*24);

			switch ($_GET['from']) {
							
				case 'main_page':
					header('location: shop.php');
					break;

				case 'retailer_page':
					header('location: retailers.php');
					break;
				case 'admin_page':
					header('location: admin.php');
					break;
				
				default:
					# code...
					break;
			}
		}
	}
?>