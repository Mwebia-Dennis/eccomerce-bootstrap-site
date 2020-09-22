<?php
	
	require 'Dao/user_dao.php';
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

	if($user_info[0]['user__role'] != 'admin') {

		echo '<div style="text-align:center;font-size: 20px;">Sorry Pal You Are Not An Admin, contact admin
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


  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	  <a class="navbar-brand" href="shop.php">HappyFeetShop</a>
  	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  	    <span class="navbar-toggler-icon"></span>
  	  </button>
  	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  	    <div class="navbar-nav">
  	      <a class="nav-item nav-link active text-" href="shop.php">Shop <span class="sr-only">(current)</span></a>          
          <a class="nav-item nav-link" href="retailers.php">Sell</a>
          <a class="nav-item nav-link" href="admin.php">Admin</a>
  	      <a class="nav-item nav-link" href="cart.php" style="position: relative;"><i class="fas fa-shopping-cart"></i><span><?php
            //showing total amount of items in cart;

            $total_cart_items = (!empty($_SESSION['add_to_cart'])?sizeof($_SESSION['add_to_cart']):0);
            echo($total_cart_items);

          ?></span></a>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" style="margin: 5px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

              <?php

                if(isset($_SESSION['user_id'])) {

                  echo '
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="action.php?action=logout&from=admin_page">Logout</a>
                  ';
                }else {

                  echo '
                    <a class="dropdown-item" href="login.php">Login</a>
                    <a class="dropdown-item" href="signup.php">Sign Up</a>
                  ';
                }

              ?>
            </div>
          </div>
  	    </div>
  	  </div>

      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      
  	</nav>
  	<?php


  		if($is_logged_in == false){
  	?>

  	<div class="container d-flex justify-content-center">
  		
  		<form class="login_form" id="login_form" method="post" action="action.php?action=login&from=admin">
  			<p class="display-4 text-warning">Login</p>
		  <div class="form-group">
		    <label for="login_email">Email address</label>
		    <input type="email" class="form-control" id="login_email" required="required" name="email" aria-describedby="emailHelp">
		  </div>
		  <div class="form-group">
		    <label for="login_password">Password</label>
		    <input type="password" class="form-control" id="login_password" required="required" name="password">
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="keep_loggedin" name="keep_loggedin" checked="checked">
		    <label class="form-check-label" for="keep_loggedin" >Keep me logged in</label>
		  </div>
		  <button type="submit" class="btn btn-primary" name="login">Submit</button>
		</form>


  	</div>

  	<?php

  		}else {
  	?>

	<div class="container main_content">
		<div class="card main_card_container">
		  <h5 class="card-header"><span id="menu_controller"><i class="fas fa-bars"></i></span>Dashboard</h5>
		  <div class="card-body">
		    <div class="row">
			
				<div class="col-md-4" id="left_menu_nav">
					
					<ul>
						<li class="menu_list menu_active" onclick="loadData('load_main_dashboard')">Dashboard</li>
						<li class="menu_list" onclick="loadData('load_all_products')">All Products</li>
						<li class="menu_list" onclick="loadData('load_my_products')">My Products</li>
						<li class="menu_list" onclick="loadData('load_retailers_data')">Retailers</li>
						<li class="menu_list" onclick="loadData('load_sales_data')">Sales</li>
						<li class="menu_list"  onclick="loadData('load_add_new_product')">Add New Product</li>
					</ul>

				</div>
				<div class="col-md-8" id="content_container">	
					
					
					
				</div>
			</div>
		  </div>
		</div>
		
	</div>

	<?php 

		}
	?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/access_server.js"></script>

    <script type="text/javascript" src="js/admin.js"></script>
</body>
</html>
