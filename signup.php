<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/signup.css">

    <title>Sign Up</title>
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
          <a class="nav-item nav-link" href="login.php">Sell</a>
          <a class="nav-item nav-link" href="login.php">Admin</a>
          <a class="nav-item nav-link" href="cart.php" style="position: relative;"><i class="fas fa-shopping-cart"></i><span><?php
            //showing total amount of items in cart;

            $total_cart_items = (!empty($_SESSION['add_to_cart'])?sizeof($_SESSION['add_to_cart']):0);
            echo($total_cart_items);

  

          ?></span></a>
        </div>
      </div>
    </nav>

    <div class="container">
      
      <div class="signup_form">
        
        <div class="signup-top">

          <h2>Sign Up</h2>
          <h3>Fill out this form and
          <br>lets start shopping</h3>
        </div>

        <form method="post" action="action.php?action=signup">

          <div class="form-group">
            <label for="f-name">Enter your First Name:</label>
           <input type="text" name="f-name" placeholder="Eg: Joe" class="input" required="required" id="f-name">
          </div>

          <div class="form-group">

            <label for="l-name">Enter your Last Name:</label>
              <input type="text" name="l-name" placeholder="Eg: Brown" class="input" required="required" id="l-name">
          </div>

          <div class="form-group">

            <label for="email">Enter your Email Address:</label>
              <input type="email" name="email" placeholder="Eg. example@example.com" class="input" required="required" id="email">
          </div>

          <div class="form-group">

            <label for="password">Enter your Password:</label>
              <input type="password" name="password" placeholder="Password" class="input" required="required" id="password">
          </div>

          <div class="form-group">
            
             <label for="phone-number">Enter your Phone Number:</label>
              <input type="text" name="phone-number" placeholder="eg. +2547 12 345678" class="input" required="required" id="phone-number">            
          </div>


          <div class="form-group">

            <label for="city">Enter your City:</label>
              <input type="text" name="city" placeholder="City" class="input" required="required" id="city">
          </div>

          <div class="form-group">
            <label id="terms-label"><input type="checkbox" name="terms" required="required" id="terms">I accept the <a href="#">Terms of use</a> &amp 
              <a href="#">Privacy policy</a> </label>
          </div>

          <div class="form-group">
            <p class="text">Already have an account?  <a href="login.php">Log in</a> </p>
          </div>

          <div class="form-group">
              <input type="submit" name="signup" value="Sign Up" class="sign-up-btn">            
          </div>

        </form>
      </div>
    </div>


     <!-----------------------------------footer------------------------------------------------>

  <?php

    include 'footer.php';

  ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>

  
</html>
