function removeItemFromCart(item_id) {
    		
	if (item_id.length == 0) {

    return;

  } else {
    
    //checking browser compatibility;
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();

    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            //alert(this.responseText);

        }
    };
    xmlhttp.open("GET", "cart.php?action=remove&item=" + item_id, true);
    xmlhttp.send();

  };
}

var display_errors = document.getElementById('display_errors');
//updating the cart after quantity is changed;
var subtract_btns = document.getElementsByClassName('subtract_quantity');
var add_btns = document.getElementsByClassName('add_quantity');
var updated_inputs = document.getElementsByClassName('quantity_input');

for(var i = 0; i < updated_inputs.length; i++) {

  subtract_btns[i].addEventListener('click', function(){
    
    //get td which holds our button;
    var td = this.parentElement;
    var td_children = td.children;

    //subtract value and pass input in the same row as button which is the second child of td as a parameter;
    subtract_quantity(td_children[2]);

  });

  add_btns[i].addEventListener('click', function(){

    //get td which holds our button;
    var td = this.parentElement;
    var td_children = td.children;

    //subtract value and pass input ,in the same row as button which is the second child of td, as a parameter;
    add_quantity(td_children[2]);

  });

}

//updating cart on quantity change;

function update_cart(input_context) {


  var td = input_context.parentElement;
  var td_children = td.children;


  if (input_context.value != "") {

    var item_id = input_context.getAttribute('data_id'); 

    //show loading;
    td_children[0].style.display = 'block';

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();

    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {


        td_children[0].style.display = 'none';
        //preventing resubmission;
        location.reload();
      }
    };
    xmlhttp.open("GET", "action.php?action=update&new_quantity=" + input_context.value + "&item=" + item_id, true);
    xmlhttp.send();

  }else {

    input_context.value = "";
    return;
  }
}


function subtract_quantity(input_context) {
  
  if (parseInt(input_context.value) != 1) {

    input_context.value = parseInt(input_context.value) - 1;

    update_cart(input_context);

  } else {

    //if quantity is equal to one remove the product since subtracting gives 0 quantity;
    //todo remove product;

  }
}

function add_quantity(input_context) {
  
  if (input_context.value != 2) {

    input_context.value = parseInt(input_context.value) + 1;
    update_cart(input_context);
    
  } else {

    displayError('sorry you can only buy 2 items');
    
  }
}

function displayError(error) {

    display_errors.style.display = 'block';
    display_errors.innerHTML = error;

    setTimeout(function(){

      //remove error message after 3 seconds
      display_errors.style.display = 'none';
      display_errors.innerHTML = "";
      
    }, 3000);
}

//place_order button;
//open place order page;
document.getElementById('checkout').addEventListener('click', function() {

  window.open('razorpay/pay.php?checkout=manual', '_SELF');
});

document.getElementById('continue_shopping').addEventListener('click', function () {
  
  window.open('shop.php', '_SELF');
});

