<?php
class booksStore_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'add_new_book':
/*				echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$model_booksStore_addNewBook = new model_booksStore_addNewBook();
				global $config_var;
				$objects = new stdClass();
				if(isset($_REQUEST['royality']))
				{
				$objects->royality = @$_REQUEST['royality'];
				$objects->writer = @$_REQUEST['writer'];
				}
				if(isset($_REQUEST['books-category']))
				{
				$objects->category = @$_REQUEST['category'];
				}
				$objects->book_name = @$_REQUEST['book_name'];
				$objects->book_author = @$_REQUEST['book_author'];
				$objects->book_price = @$_REQUEST['book_price'];
				$objects->desc = @$_REQUEST['desc'];
				$objects->quantity = @$_REQUEST['quantity'];
				
				$random = rand(5,25);
				$book_imagetitle='';
				
				if(@$_FILES['file1']['name'] !=''){
						
						$book_imagetitle = $random.'_'.$_FILES['file1']['name'];
											
						$book_imagetitle_tmp = $_FILES['file1'][tmp_name];
												
						$emp_image_small_tmpurl = $config_var->UPLOAD_ROOT.'books/small/'.$book_imagetitle;
						$emp_image_employee_tmpurl = $config_var->UPLOAD_ROOT.'books/medium/'.$book_imagetitle;
						$real_image_path = $config_var->UPLOAD_ROOT.'books/original/'.$book_imagetitle;
						
				if(move_uploaded_file($book_imagetitle_tmp,$real_image_path)){ 

					 require_once($config_var->LIB_ROOT.'Helper.php'); 
					 Helper::resizeImage($real_image_path,60,70,$emp_image_small_tmpurl,$_FILES['file1']);
					 Helper::resizeImage($real_image_path,185,170,$emp_image_employee_tmpurl,$_FILES['file1']);
					}
				 }
				// echo "<pre>"; print_r($_REQUEST);die('rohjihithih');
				if($model_booksStore_addNewBook->inserData($objects,$book_imagetitle)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=1');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				break;
				case 'add_book_cart':
				global $config_var;
				$objects = new stdClass();
				$model_check_quantity = new model_booksStore_bookdetail();
				$values=$model_check_quantity->books_available($_REQUEST);
				if($values>=1)
				{
				$store_values_cart=new model_booksStore_bookdetail();
				
				$store_values_cart->addtocart(base64_decode($_REQUEST['book_id']),$_REQUEST['quantity']);
				@header('Location:index.php?mod=mod_booksStore&view=sellBooks&m=2&s=6');
				}
				else if($values==0)
				{
				setcookie("cook_quantity",$_REQUEST['quantity'],time()+60*60);
				$id_book=$_REQUEST['book_id'];
				@header('Location:index.php?mod=mod_booksStore&view=bookdetail&book_id='.$id_book.'&m=2&r=4');
				}
				
				break;
				case 'edit_agent':
/*			echo "<pre>";
				print_r($_REQUEST);
				die;*/
				global $config_var;
				$objects = new stdClass();
				$model_agents_editAgent = new model_agents_editAgent();
				$objects->agent_name = @$_REQUEST['agent_name'];
				$objects->dob = @$_REQUEST['dob'];
				$objects->addr1 = @$_REQUEST['addr1'];
				$objects->country = @$_REQUEST['country'];
				$objects->state = @$_REQUEST['state'];
				$objects->city = @$_REQUEST['city'];
				$objects->phone = @$_REQUEST['phone'];
				$objects->mobile = @$_REQUEST['mobile'];
				$objects->book_id = @$_REQUEST['book_id'];
				if($model_agents_editAgent->saveData($objects)){
				@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=2');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=5');
					exit();
						 }
				break;
				
				

				case 'delete':
				$model_book_delete = new model_booksStore_default();
				$objects = new stdClass();
				$objects->emp_id = @$_REQUEST['book_id'];
				$modelIds = '0';
				if(count($objects->emp_id)>0){
					for($i=0;$i<count($objects->emp_id);$i++){
						$modelIds .= ','.$objects->emp_id[$i];
					}
					
				}
				if($model_book_delete->deleteData($modelIds)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=3');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=3');
				 }
				 
				break;
				
				case 'activate':
				$model_book_active = new model_booksStore_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['book_id'];
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}
				
			
				if($model_book_active->changeStatus($modelIds,'activate')){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=4');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=5');
				 }
				break;

				case 'deactivate':
				$model_book_deactive = new model_booksStore_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['book_id'];
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}

				if($model_book_deactive->changeStatus($modelIds,'deactivate')){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=5');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=5');
				 }
				break;
				
				case 'remove_all_books':
				$remove_books=new model_booksStore_seeCart();
				$remove_books->remove_all_books();
				@header('Location:?mod=mod_booksStore&view=seeCart&m=2');
				break;
				
				case 'delete_books_cart':
				$remove_particular_book=new model_booksStore_seeCart();
				$remove_particular_book->remove_product($_REQUEST['pid']);
				@header('Location:?mod=mod_booksStore&view=seeCart&m=2');
				break;
				
				case 'update_books_quantity':
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=intval($_REQUEST['product'.$pid]);
				$ava_qty=intval($_REQUEST['avai_qty'.$pid]);
				if($q>0 && $q<=$ava_qty){
					$_SESSION['cart'][$i]['qty']=$q;
					@header('Location:?mod=mod_booksStore&view=seeCart&m=2');
					}
					/*else{
					echo "jshrjsm";
					die;
					//$msg='Some proudcts not updated!, quantity must be a number less than given quantity';
						}*/
				}
				
				case 'issue_book_cart':
				global $config_var;
				$objects = new stdClass();
				$model_check_quantity = new model_booksStore_bookissue_detail();
				$values=$model_check_quantity->books_available($_REQUEST);
				if($values>=1)
				{
				$store_issue_cart=new model_booksStore_bookissue_detail();
				
				$store_issue_cart->issuetocart(base64_decode($_REQUEST['book_id']),$_REQUEST['quantity']);
				@header('Location:index.php?mod=mod_booksStore&view=issueBooks&m=4&s=6');
				}
				else if($values==0)
				{
				setcookie("cook_quantity",$_REQUEST['quantity'],time()+60*60);
				$id_book=$_REQUEST['book_id'];
				@header('Location:index.php?mod=mod_booksStore&view=bookissue_detail&book_id='.$id_book.'&m=4&r=4');
				}
				
				break;
				case 'clear_issue_cart':
				/*echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$remove_books=new model_booksStore_issue();
				$remove_books->remove_all_books();
				@header('Location:?mod=mod_booksStore&view=issue&m=4');
				break;
				case 'update_issue_cart':
				$max=count($_SESSION['issue_cart']);
				for($i=0;$i<$max;$i++){
				$pid=$_SESSION['issue_cart'][$i]['productid'];
				$q=intval($_REQUEST['product'.$pid]);
				$ava_qty=intval($_REQUEST['avai_qty'.$pid]);
				if($q>0 && $q<=$ava_qty){
					$_SESSION['issue_cart'][$i]['qty']=$q;
					@header('Location:?mod=mod_booksStore&view=issue&m=4');
					}
				}
				break;	
				case 'delete_issue_cart':
				$remove_particular_issue=new model_booksStore_issue();
				$remove_particular_issue->remove_product($_REQUEST['pid']);
				@header('Location:?mod=mod_booksStore&view=issue&m=4');
				break;
			}
	  }
	  
	  function unlink_function($id){
		
		$this->sql ='SELECT imagehdpi,imageshdpi,imageldpi,imagemdpi,imagexhdpi FROM mgl_models WHERE emp_id= "'.$id.'" ';
			$this->query();
			return $this->loadAssoc();
		 }  
  
	  
}




?>