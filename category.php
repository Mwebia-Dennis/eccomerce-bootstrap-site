<?php
	session_start();
  include('Dao/product_info.php');
  include 'Dao/functions.php';

  if(isset($_GET['category'])) {

    $allProducts = new ProductsDetails();
    $allProducts_array = $allProducts->getProductsByCategory($_GET['category']);
  }else {
    header('location: shop.php');
    exit();
  }

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

    <title>Shop</title>

    <style type="text/css">

      #card_total {

        position: absolute;
        font-size: 17px;
        color: #fff;
      }
		.container {

      margin-bottom: 30px;
    }

    .col-md-3 {position: relative;}

		.col-md-3 img{

			width: 150px;
			height: 150px;
			margin: 20px;
		}



    .col-md-3 img:hover{transform: scale(1.1);}
    
    
    .col-md-3 .overlay_right{

      position: absolute;
      left: 0;
      display: inline-block !important;
      top: 20px;
      opacity: 0;
      margin-left: 0;
      z-index: 1;
    }

    .col-md-3:hover .overlay_right{

      margin-left: 5%;
      opacity: 1.0;
      transition: .5s ease-in-out; 
    }


    .col-md-3 .overlay_right button{

      width: 35px;
      height: 35px;
      background-color: #000;
      border: 1px solid #000;
      border-radius: 3px;
      margin: 5px;
    }


    .col-md-3 .overlay_right .fas{

      font-size: 19px;
      color: #fff;
    }

		.col-md-3 .product_details {

			width: 100%;
		}

		.col-md-3 .product_details p{

      width: 70%;
      text-align: center;
      font-size: 18px;
		}


		.col-md-3 .product_details button:hover {

			opacity: .7;
		}

    footer{

        position: absolute;
        bottom: 0;
        background-color: #333333;
        width: 100%;
        left: 0;
      }
      
	</style>
  </head>
  <body>

  	<?php include 'include/main_nav.php'; ?>

    
   <div class="container">

    <small>Search results for: </small>
    <h4><?php echo $_GET['q']?></h4>

    <div class="row">

    <?php
      //print_r($allProducts_array);

      if (!empty($allProducts_array)) {

        foreach ($allProducts_array as $product) {
          
          echo '<div class="col-md-3">';
              
           echo' <a href="product.php?item='.$product['id'].'"><img src="'.$product['image1'].'" style="border-radius:5px;"></a>';
            echo '<div class="overlay_right">
              
              <button value="'.$product['id'].'" title="Quick view" onclick="viewProduct('.$product['id'].')"><i class="fas fa-eye"></i></button><br>
              <button value="'.$product['id'].'" title="Add to wishlist"><i class="fas fa-heart"></i></button>

            </div>
            <div class="product_details">';

              
              echo' 
              <p>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </p>
              <p> $'.$product['item_price'].'</p>
              <p><strong>'.$product['item_name'].'</strong></p>

              
            </div>
          </div> ';
          
        }
      } 
    ?>

    </div>
    
  
  </div>


  <!-----------------------------------footer------------------------------------------------>

  <?php

    include 'footer.php';

  ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/access_server.js"></script>
    <script type="text/javascript" src="js/search_queries.js"></script>


    <script type="text/javascript">
      
      function viewProduct(item_id){
        //console.log(item_id);
        location.href ='product.php?item='+item_id;
      }
    </script>
  </body>
</html>