<?php

	require 'Dao/user_dao.php';
  include 'Dao/functions.php';
	session_start();	

	$is_logged_in = false;

	if (!isset($_SESSION['user_id'])) {

	    if (isset($_COOKIE['user_id'])) {

	        $_SESSION['user_id'] = $_COOKIE['user_id'];

	    }else {
	        header('location: login.php');
	        exit();
	    }
	    
	}

	$is_logged_in = true;
	$user_dao = new UserDao($_SESSION['user_id']);
	$user_info = $user_dao->getUser();

	if($user_info[0]['user__role'] != 'retailer') {

		echo '<div style="text-align:center;font-size: 20px;">Sorry Pal You Are Not A Retailer, contact admin
		<br><a href="shop.php">Return To Shop</a></div>';

		return false;
	}



?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!---fontawesome---->
    <script src="https://kit.fontawesome.com/fe39f99d95.js" crossorigin="anonymous"></script>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>


  <?php include 'include/main_nav.php'; ?>


	<div class="container main_content">
		<div class="card main_card_container">
		  <h5 class="card-header"><span id="menu_controller"><i class="fas fa-bars"></i></span>Dashboard</h5>
		  <div class="card-body">
		    <div class="row">
			
				<div class="col-md-4" id="left_menu_nav">
					
					<ul>
						<li class="menu_list menu_active" onclick="loadData('retailer_undelivered_products')">Dashboard</li>
						<li class="menu_list" onclick="loadData('load_my_products')">My Products</li>
						<li class="menu_list" onclick="loadData('load_retailers_sales_data')">Sales</li>
						<li class="menu_list"  onclick="loadData('load_add_new_product')">Add New Product</li>
					</ul>

				</div>
				<div class="col-md-8" id="content_container">	
					
					
					
				</div>
			</div>
		  </div>
		</div>
		
	</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/access_server.js"></script>

    <script type="text/javascript" src="js/admin.js"></script>


</body>
</html>
