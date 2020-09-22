<?php
  
  include 'Dao/product_info.php';
  include 'Dao/functions.php';

  session_start();

  $product_details = new ProductsDetails();
  $product_array = array();

  if (isset($_GET['item'])) {    

    if ($_GET['item'] != "" && is_numeric($_GET['item'])) {
      
      $product_array = $product_details->getProduct($_GET['item']);
    }
    
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

    <style type="text/css">
      
      body{

        width: 100%;
        background-color: #f5f5f0;
        overflow-x: hidden; 
      }

      .main_body{

        width: 100%; 
        background-color: #f5f5f0;
      }

      .main_body .product {

        width: 100%;
        margin-top: 5px;
        display: inline-block;
        background-color: #fff;
        box-shadow: 2px 2px 10px #d3d3d3;
      }


      .main_body .product_details .product .more_images {

        width: 100%;
        padding-top: 50px;
        display: inline-flex;
        margin-bottom: 10px;
        cursor: pointer;
      }

      .main_body .product .more_images img{

        width: 60px;
        height: 60px;
        margin-left: 10px;
        margin-top: 20px;
        border: 1px solid rgba(0, 0, 0, .3 );
        padding: 10px;
      }

      .main_body .product .product_info {

        display: block;
        padding-left: 20px;
        margin-top: 20px;
      }

      .main_body .product .product_info .previewed_image {

        width: 90%;
        margin-right: 20px;
        height: 250px;
        margin-bottom: 20px;
      }

      .main_body .product .product_info .details h2 {

        color: #000;
        font-size: 40px;
        margin-top: 10px;
        opacity: .7;
        padding-left: 30px;
      } 

      .main_body .product .product_info .details span{

        margin-left: 12%;
        font-size: 15px;
        color: #3333cc;
      }

      .main_body .product .product_info hr {

        background-color: #d3d3d3;
        opacity: .6;
        margin: 30px 20px;
        width: 100%;
      }

      .main_body .product .product_info .item_price {

        font-size: 23px;
        opacity: .5;
        font-weight: bold;
        color: #000;
        margin-left: 10%;x
      }

      .main_body .product .product_info form{

        padding: 10px;
      }

      .main_body .adverts {

        width: 30%;
        margin-left: 5%;
      }

      .main_body .product .product_info form button{

        width: 90% !important;
        font-size: 15px;
        color: #fff;
        background-color: #333333;
        padding: 10px;
        border: 1px solid #333333;
        border-radius: 5px;
        position: relative;
        margin-top: 20px;
      }

      .main_body .product .product_info form button:hover {

        opacity: .7;
      }

      .main_body .product .product_info form button i{

        position: absolute;
        left: 20px;
        margin-top: 3px;
      }

      .main_body .product .product_info .share {

        text-align: left;
      }

      .main_body .product .product_info .share a {

        color: #000;
      }

      .main_body .product .product_info .share a i{

        font-size: 25px;
        cursor: pointer;
        margin-left: 5px;
        padding: 5px;
      }

      .main_body .product .product_info .share a i:hover {

        transform: scale(1.1);
      }

      .more_product_info {
        width: 100%;
        box-shadow: 2px 2px 10px #d3d3d3;
        background-color: #fff;
        margin-top: 10px;
        padding: 20px 3px;
      }

      .more_product_info .navigate_content {

        width: 100%;
        display: none !important;
      }

      .more_product_info .navigate_content .nav_btn {

        width: 80px;
        height: 55px;
        border: 1px solid #333333;
        background-color: #333333;
        opacity: .6;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: #fff;
      }

      .more_product_info .navigate_content .nav_btn:hover {

        opacity: 1.0;
        height: 60px;
      }

      .more_product_info .navigate_content .nav_btn_active {
        opacity: 1.0;
        height: 60px;
      }

      #content{

        width: 100%;
        padding: 10px 20px;
      }

      #content h2 {

        font-size: 20px;
        text-transform: uppercase;
      }

      #content p {

        font-size: 17px;
        font-weight: bold;
        color: #808080;
        line-height: 25px;
      }


      #content p span {

        font-weight: bold;
        font-size: 20px;
        margin: 10px;
      }

      #content p select {

        width: 430px;
        padding: 15px;
        font-size: 16px;
      }

      .header {

        font-size: 18px;
        font-weight: bold;
        padding: 2px 10px;
        margin: 10px 15px;
        border-bottom: 1px solid #d3d3d3;
      }

      .more_product_info select{

        display: block !important;
      }

      @media only screen and (min-width: 768px) {


        .main_body .product .more_images img{

          width: 90px;
          height: 90px; 
        }
        .main_body .product {

          width: 80%;
          margin-left: 7%;
          display: inline-flex;
        }
        .main_body .product_details .product .more_images {

          width: 20%;
          display: block;
        }
        .main_body .product .product_info .previewed_image {

          width: 50%;
          height: 400px;
        }
        .main_body .product .product_info {

          display: inline-flex;
        }

      .main_body .product .product_info {padding-left: 40px;}

      }
      .main_body .product .product_info form button{
        width: 300px;
        font-size: 17px;
      }

      .more_product_info .navigate_content {
        display: block !important;
      }
      .more_product_info .navigate_content .nav_btn {

        width: 150px;
      }
      .header {

        font-size: 26px;
      }
      .more_product_info {

        width: 80%;
        margin-left: 7%;
      }

      .more_product_info select{

        display: none !important;
        padding-top: 15px !important; 
        padding-bottom: 15px !important; 
      }


      
      
    </style>

    <title>Happy Feet Family</title>
  </head>
  <body>

    <?php include 'include/main_nav.php'; ?>



    <!--------------------------------------------product-details------------------------------>


    <div class="main_body">
      
      <div class="product">

            <div class="more_images">
              
              <?php

                if ($product_array[0]['image1'] != "") {
                 
                  echo('<img src='.$product_array[0]['image1'].' onclick="setPreviewImage(this)">') ;
                }
                if ($product_array[0]['image2'] != "") {
                 
                  echo('<img src='.$product_array[0]['image2'].' onclick="setPreviewImage(this)">') ;
                }
                if ($product_array[0]['image3'] != "") {
                 
                  echo('<img src='.$product_array[0]['image3'].' onclick="setPreviewImage(this)">') ;
                }

              ?>
            </div>
            
            

        <div class="product_info">

          <img src="<?php

            echo($product_array[0]['image1']);

          ?>" class="previewed_image" id="preview_image">

          
          <div class="details">
            
            <h2><?php

              echo($product_array[0]['item_name']);

            ?></h2>

            <span>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </span>

            <hr>

            <p class="item_price"><?php  echo('$.'.$product_array[0]["item_price"]); ?></p>

            <form method="POST" action="action.php?action=add">
              
              <input type="hidden" id="item_id" name="item_id" value="<?php echo($product_array[0]['id']);?>">
              <input type="hidden" name="price" value="<?php echo($product_array[0]['item_price']);?>">
              <input type="hidden" name="item_name" value="<?php echo($product_array[0]['item_name']);?>">
              <label for="quantity">Quantity:</label>
              <input type="text" name="quantity" value="1"><br>
              <button type="submit" name="add_to_cart"><i class="fas fa-shopping-cart"></i>ADD TO CART</button>

            </form>

            <p style="color: #3333cc; font-size: 13px; font-weight: bold;">Available in stock: <?php echo($product_array[0]["stock_amount"]);?></p>

            <p class="share">Share:

              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </p>
          </div>
        </div>


      </div>
    </div>


    <!--------------------------------more product details---------------------------->


    <div class="more_product_info">

      <h5 class="header">More Info</h5>


      <select class="form-control form-control-sm btn-secondary" id="more_info">
        <option value="product_details" selected>Product Details</option>
        <option value="delivery_info">Delivery Info</option>
        <option value="seller_info">Seller Info</option>
      </select>
      
      <div class="navigate_content">
        
        <button class="nav_btn nav_btn_active" value="product_details">Product Details</button>
        <button class="nav_btn" value="delivery_info">Delivery Info</button>
        <button class="nav_btn" value="seller_info">Seller Info</button>

      </div>
      <div id="content"></div>
    </div>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/product_page.js"></script>
    <script type="text/javascript" src="js/access_server.js"></script>
    <script type="text/javascript" src="js/search_queries.js"></script>

    <script type="text/javascript">
      
      function setPreviewImage(btn_context) {

        $('#preview_image').attr('src', $(btn_context).attr('src'));
        
      }
    </script>
  </body>
</html>