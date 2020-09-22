<?php

  if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
  }


  if (isset($_SESSION['user_id'])) {
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
    <link rel="stylesheet" type="text/css" href="css/signup.css">

    <title>Login</title>
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

              <h2>Sign In</h2>
              <h3>Login To Your HappyFeet Account</h3>
            </div>

            <form method="post" action="action.php?action=login&from=main_login">

              <div class="form-group">

                <label for="email">Enter your Email Address:</label>
                  <input type="email" name="email" placeholder="Eg. example@example.com" class="input" required="required" id="email">
              </div>

              <div class="form-group">

                <label for="password">Enter your Password:</label>
                  <input type="password" name="password" placeholder="Password" class="input" required="required" id="password">
              </div>

              <div class="form-group">
                <label id="terms-label"><input type="checkbox" name="keep_loggedin" id="terms" checked="checked">Keep me logged in</label>
              </div>

              <div class="form-group">
                <p class="text">Forgot Password  <a href="#">Click Here</a></p>
                <p class="text">Dont have an account?  <a href="signup.php">Create One</a> </p>
              </div>

              <div class="form-group">
                  <input type="submit" name="login" value="Log In" class="sign-up-btn">            
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