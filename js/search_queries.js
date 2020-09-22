
$('#search_bar').keyup(function(){

	searchQuery($(this).val());
});


function searchQuery(query){

	$('#search_result').html('<p style="text-align:center;font-size: 20px;"><strong><i class="fas fa-spinner fa-spin"></i></strong></p>')
	if(query == "") {
		return false;
	}

	var data_controller = {
		method: 'GET',
		url: '/web-dev/shop/include/action2.php?action=search_query&q='+query,
		callBackFunction: function(response) {
			if(response == "") {
				$('#search_result').html("0 results found");
			}else {
				$('#search_result').html(response);
			}
			
		}
	}

	accessServer(data_controller);

}