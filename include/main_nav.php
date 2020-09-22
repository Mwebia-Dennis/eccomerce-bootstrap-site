<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	  <a class="navbar-brand" href="shop.php">HappyFeetShop</a>
  	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  	    <span class="navbar-toggler-icon"></span>
  	  </button>
  	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  	    <div class="navbar-nav">
  	      <a class="nav-item nav-link active text-" href="shop.php">Shop <span class="sr-only">(current)</span></a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Shop By Category
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <?php

                $otherFunctions = new OtherFunctions();
                $categories = $otherFunctions->getProductCategory();
                if(!empty($categories)) {

                  foreach ($categories as $value) {
                    echo '<a class="dropdown-item" href="/web-dev/shop/category.php?category='.$value['id'].'&q='.$value['category_name'].'">'.$value['category_name'].'</a>';
                  }
                }


              ?>
              
            </div>
          </div>          
          <a class="nav-item nav-link" href="retailers.php">Sell</a>
          <a class="nav-item nav-link" href="cart.php" style="position: relative;"><i class="fas fa-shopping-cart"></i><spanx><?php
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
                    <a class="dropdown-item" href="action.php?action=logout&from=main_page">Logout</a>
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

      <form class="form-inline dropdown search_form">
        <input class="form-control mr-sm-2" type="search" placeholder="Search for products" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Search" id="search_bar">
        <div class="dropdown-menu" aria-labelledby="search_bar" id="search_result">
          0 results found
        </div>
      </form>
      
  	</nav>