<?php

	require($_SERVER['DOCUMENT_ROOT'].'/web-dev/shop/Dao/user_dao.php');
	require($_SERVER['DOCUMENT_ROOT'].'/web-dev/shop/Dao/product_info.php');
	require($_SERVER['DOCUMENT_ROOT'].'/web-dev/shop/Dao/functions.php');
	session_start();

	if (isset($_GET['action'])) {
		
		switch ($_GET['action']) {
			case 'set_address':
					
					$user_dao = new UserDao($_SESSION['user_id']);

					echo ($user_dao->setUserAddress($_SESSION['user_id'], $_POST['address'], $_POST['city'], $_POST['state_id'], $_POST['zip_code']))?'successful':'failed';
				break;

			case 'set_new_product':

				$productsDetails = new ProductsDetails();
				//adding product to db
				if (isset($_FILES['file'])) {

					$fileCount = count($_FILES["file"]['name']);

					$images = [];
					
					//only allow maximum 3 images;
					if($fileCount > 3)  {

						echo 'Maximum number of images is 3';
						exit();
					}

					for ($i=0; $i < $fileCount; $i++) { 
						
						$errors= [];
						 $file_size =$_FILES['file']['size'][$i];
				          $file_tmp =$_FILES['file']['tmp_name'][$i];
				          $file_type=$_FILES['file']['type'][$i];
				          $file_name = $_FILES['file']['name'][$i];
				          
				          //echo $file_name;
				          //echo $file_type;
				    
				          $file_ext = explode('.',$file_name);
				          $file_ext=strtolower(end($file_ext));
				          
				          $images_ext= array("jpeg","jpg","png");

				          if(in_array($file_ext,$images_ext)=== false){
                    
			                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			                    
			                }
			                  
			                if($file_size > 10097152){
			                    
			                    $errors[]='File size must not exceed 10 MB';
			                }

			                 if(empty($errors)==true){
    
					            $target_dir = "images/";
					            try{
					                
					                $new_dir = $target_dir.md5(uniqid()).$file_name;
					               
					               if(move_uploaded_file($file_tmp,"../".$new_dir)){
					    
					               		$images[] = $new_dir;
					               }else {
					               	exit();
					               }
					                
					            }catch(Exception $e){
					                

					                echo 'failed';
					                exit();
					            }
					          }else{
					             
					             foreach ($errors as $key => $value) {
					               echo $value;
					             }
					             exit();
					          }
					}

					//upload details to db

					
					//since image 2 and 3 are optional we need to check them;
					$image2 = (isset($images[1]))?$images[1]:"";
					$image3 = (isset($images[2]))?$images[2]:"";
					echo ($productsDetails->setProduct($_POST['product_name'],$_POST['product_description'], $_POST['product_price'], $images[0],$_SESSION['user_id'],$_POST['category'], $_POST['stock_amount'], $image2, $image3))?
					'Successfully added the image':'Failed, something went wrong could not add image';

				}else {

					echo 'Failed, You need at least one image to sell the product. Try again later.';
				}


				break;

			case 'search_query':
				
				$otherFunctions = new OtherFunctions();
				$search_result = $otherFunctions->searchProducts($_GET['q']);
				if(!empty($search_result)) {

					foreach ($search_result as $value) {
						echo '<a class="dropdown-item" href="../shop/product.php?item='.$value['id'].'"><img src="'.$value['image1'].'" style="width: 40px;height:40px;margin-right: 7px;">'.$value['item_name'].'</a>';
					}
				}
				break;
		}
	}

?>