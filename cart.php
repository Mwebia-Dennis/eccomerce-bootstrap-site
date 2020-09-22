<?php

	include 'item.php';  
  include 'Dao/functions.php';
	session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <!---fontawesome---->
    <script src="https://kit.fontawesome.com/fe39f99d95.js" crossorigin="anonymous"></script>

    <style type="text/css">
    	
    	.container {

    		margin-top: 30px;
    	}

    	footer{

    		position: absolute;
    		bottom: 0;
    		background-color: #333333;
    		width: 100%;
    		left: 0;
    	}

      .cart-buttons{

        width: 200px;
        padding: 10px 0;
        background-color: #000;
        border: 1px solid #000;
        border-radius: 3px;
        font-size: 13px;
        float: right;
        margin-right: 30px;
        color: #ffffff;
        text-align: center;
        line-height: 20px;
      }


      .cart-buttons:hover {

        background-color: rgba(0, 0, 0, .6);
      }

      .cart-alert {

        width: 50%;
        height: 200px;
        padding: 30px;
        margin-left: 20%;
        border: 1px solid #ffc2b3;
        background-color: #333333;
        color: #fff;
        border-radius: 10px;

      }
      .total {
        width: 100%;

      }
      .total p{
        text-align: center;
        margin-right:30px;
        font-weight: bold;
        font-size: 19px;
      }

      td button {

        width: 27px;
        height: 27px;
        border-radius: 3px;
        border: 1px solid #d3d3d3;
        background-color: #fff;
        color: #000;
        box-shadow: 2px 2px 5px #d3d3d3;
        text-align: center;
      }

      td input {

        width: 27px;
        height: 27px;
        text-align: center;
        margin: 1px 5px;
        box-shadow: 2px 2px 5px #d3d3d3;  
        border: 1px solid #d3d3d3;     
      }

      td .quantity_error {

        color: #ff4d4d;
        font-size: 15px;
      }


      /*---------------------displaying errors-------------------------*/
      .alert{

        text-align: center;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
      }

    </style>

    <title>Shopping Cart</title>
  </head>
  <body>

  	<?php include 'include/main_nav.php'; ?>

    <!---------------------displaying errors------------------------->

    <div class="alert alert-danger" id="display_errors" style="display: none;"></div>

    <!---------------------displaying our cart------------------------->
  	<div class="container">
	
	<?php
		//session_unset();

    $total = 0;

		if (!empty($_SESSION['add_to_cart'])) {

	      echo '
	      <table class="table table-striped">
	        <thead>
	          <tr>
	            <th scope="col">#</th>
	            <th scope="col">Product name</th>
	            <th scope="col">Price</th>
	            <th scope="col">Quantity</th>
              <th scope = "col">Sub Total: </th>
	          </tr>
	        </thead>
	        <tbody>
	        ';

	        $i = 1;
	        foreach ($_SESSION['add_to_cart'] as $item) {
	          

            $subtotal = $item->getItem_price() * $item->getItem_quantity();
            $total += $subtotal;
	          echo '<tr>
	            <th scope="row">'.$i.'</th>
	            <td>'.$item->getItem_name().'</td>
	            <td> $'.$item->getItem_price().'</td>
	            <td>

                <div class="spinner-border" style= "width: 20px; height:20px;display:none;" role="status">
                  <span class="sr-only">Loading...</span>
                </div>

                <button class="subtract_quantity">-</button>
                <input class="quantity_input" type = "text" value = "'.$item->getItem_quantity().'" oninput = "update_cart(this)"  data_id = "'.$item->getItem_id ().'">
                <button class="add_quantity">+</button></td>

              <td> $'.$subtotal.'</td>
	            <td><a href="action.php?action=remove&item='.$item->getItem_id ().'" class="btn btn-sm-3 btn-danger">Remove</a>
	          </tr>
	          <tr>';

	          $i++;
	        }
	          
	        echo'

	        </tbody>

	      </table>

        <div class="total">

          <p>Total: $'.$total.'</p>
        </div>

        <button class="cart-buttons" id="continue_shopping">Continue Shopping.</button>
        <button class="cart-buttons" id="checkout">Checkout.</button>
        '

        ;

				
			} else {

        echo'

          <div class="cart-alert">
            <p style="text-align:center;font-size: 20px;">Sorry Your Shopping Cart Is Empty, <br>
            Dont Worry Though, <a href="shop.php"> Lets start Shopping</a></p>
          </div>
        ';
      }
	?>



  <!-----------------------------------footer------------------------------------------------>

  <?php

    include 'footer.php';

  ?>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/cart.js?v=0.0.3"></script>
    <script type="text/javascript" src="js/access_server.js"></script>
    <script type="text/javascript" src="js/search_queries.js"></script>
  </body>
</html>