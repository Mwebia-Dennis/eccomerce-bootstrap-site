	


//opening and closing menu bar 
$('#menu_controller').click(function(){

	if($('#left_menu_nav').css('display') == 'none') {

		$('#menu_controller').find('.fa').removeClass('.fa-bars');
		$('#menu_controller').find('.fa').addClass('.fa-times');
		$('#left_menu_nav').css('display', 'block');
	}else {

		$('#left_menu_nav').css('display', 'none');
		$('#menu_controller').find('.fa').removeClass('.fa-times');
		$('#menu_controller').find('.fa').addClass('.fa-bars');
	}

});

//toggling active class
var menu_list = document.getElementsByClassName("menu_list");
for (var i = 0; i < menu_list.length; i++) {
  menu_list[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("menu_active");
    current[0].className = current[0].className.replace(" menu_active", "");
    this.className += " menu_active";
  });
}


//content_container
var loader = '<p class="display-4 text-center"><i class="fas fa-spinner fa-spin"></i></p>';

//load dashboard initially
loadData('load_main_dashboard');

function loadData(action){

	$('#content_container').html("");
	$('#content_container').append(loader);

	var data_controller = {
		method: 'GET',
		url: 'include/load_dashboard.php?action='+action,
		callBackFunction: function(response) {
			$('#content_container').html(response);
		}
	}

	accessServer(data_controller);

}

function addProduct(){

	//console.log('click')

	$('#add_product').prop('disabled', true);
	$('#add_product').html("");
	$('#add_product').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');

	if($('#product_name').val() == "" || $('#product_price').val() == "" || $('#product_description').val() == "" || $('#stock_amount').val() == "" || $('#product_images').val() == ""){

		resetForm("All fields are required");
      	return false;
	}

   if (parseInt($("#product_images").get(0).files.length) > 3){

      resetForm("You are only allowed to upload a maximum of 3 files");
      return false;
   }

   formData = new FormData();
   	formData.append('product_name',$('#product_name').val());
   	formData.append('product_price',$('#product_price').val());
   	formData.append('product_description',$('#product_description').val());
   	formData.append('stock_amount',$('#stock_amount').val());
   	formData.append('category', $('#category').val());


   	for (var i = 0; i < $('#product_images')[0].files.length; ++i) {
	    formData.append('file[]', $('#product_images')[0].files[i]);
	}
	var data_controller = {
		method: 'POST',
		data: formData,
		url: 'include/action2.php?action=set_new_product',
		callBackFunction: function(response) {
			console.log(response);
			$('#add_product').html("Add Product");
			$('#add_product').prop('disabled', false);
			$('#product_name').val("");
			$('#product_price').val("");
			$('#product_description').val("");
			$('#stock_amount').val("");
			$('#product_images').val("");
			alert(response);
		}
	}

	accessServer(data_controller);

}
function resetForm(msg) {
	$('#error_msg_box').html(msg);
      $('#error_msg_box').css('display', 'block');
      $('#add_product').html("Add Product");
		$('#add_product').prop('disabled', false);
      clearErrorMsg();
}
function clearErrorMsg() {

	setTimeout(function() {

      	$('#error_msg_box').css('display', 'none');
		$('#error_msg_box').html("");

	}, 6000);
}