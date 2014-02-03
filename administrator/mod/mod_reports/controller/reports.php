<?php
class reports_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  //echo "<pre>";	print_r($_REQUEST);	die;
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
				if($q>$ava_qty)
				{
				$error_msg=1;
				}
				if($q>0 && $q<=$ava_qty){
					$_SESSION['issue_cart'][$i]['qty']=$q;
					/*echo "jshrjsm";
					die;*/
					if($error_msg==1)
					{
					@header('Location:?mod=mod_booksStore&view=issue&m=4&r=6');
					}
					else
					{
					@header('Location:?mod=mod_booksStore&view=issue&m=4&s=10');
					}
					}
					else
					{
					@header('Location:?mod=mod_booksStore&view=issue&m=4&r=6');
					}
					
				}
				break;	
				case 'delete_issue_cart':
				$remove_particular_issue=new model_booksStore_issue();
				$remove_particular_issue->remove_product($_REQUEST['pid']);
				@header('Location:?mod=mod_booksStore&view=issue&m=4');
				break;
				case 'purchase_new_book':
				$model_booksStore_purchaseBooks = new model_booksStore_purchaseBooks();
				global $config_var;
				$objects = new stdClass();
				$objects->business_type=@$_REQUEST['business_type'];
				$objects->party=@$_REQUEST['party'];
				$objects->sell=@$_REQUEST['sell'];
				if(isset($_REQUEST['royality']))
				{
				$objects->royality = @$_REQUEST['royality'];
				$objects->writer = @$_REQUEST['writer'];
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
				if($model_booksStore_purchaseBooks->inserData($objects,$book_imagetitle)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=1');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				 break;
				 case 'edit_purchase_book':
				 $model_booksStore_purchaseBooks = new model_booksStore_editpurchaseBooks();
				global $config_var;
				$objects = new stdClass();
				$objects->business_type=@$_REQUEST['business_type'];
				$objects->party=@$_REQUEST['party'];
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
				$objects->book_purchase_price = @$_REQUEST['book_price'];
				$objects->book_sell_price = @$_REQUEST['sell_price'];
				$objects->desc = @$_REQUEST['desc'];
				$objects->quantity = @$_REQUEST['quantity'];
				$objects->action_type=@$_REQUEST['action_type'];
				if(@$_REQUEST['action_type']==1)
				{
				$objects->add_quantity=@$_REQUEST['check_quantity']+@$_REQUEST['quantity_add'];
				}
				else if(@$_REQUEST['action_type']==2)
				{
				$check_qty=$_REQUEST['check_quantity'];
				if($check_qty<@$_REQUEST['quantity_decrease'])
				{
				$_REQUEST['quantity_decrease'];
				$reqid=$_REQUEST['book_id'];
				@header('Location:index.php?mod=mod_booksStore&view=editpurchaseBooks&m=6&book_id='.$reqid.'&r=4');
				echo "jshrjsm";die;
				}
				$objects->decrease_quantity=@$_REQUEST['check_quantity']-@$_REQUEST['quantity_decrease'];
				}
				else if(@$_REQUEST['action_type']=="")
				{
				$check_qty=$_REQUEST['check_quantity'];
				$objects->old_quantity=@$check_qty;
				}
				
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
					 if($model_booksStore_purchaseBooks->updateData($objects,$book_imagetitle)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=2');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				 }
				 else
				 {
				 if($model_booksStore_purchaseBooks->updateData_withoutimg($objects)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=2');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				 }
				// echo "<pre>"; print_r($_REQUEST);die('rohjihithih');
				break;
				case 'edit_book_info':
				$model_booksStore_purchaseBooks = new model_booksStore_editBook();
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
				$objects->book_sell_price = @$_REQUEST['sell_price'];
				$objects->desc = @$_REQUEST['desc'];
				$objects->quantity = @$_REQUEST['quantity'];
				$objects->action_type=@$_REQUEST['action_type'];
				if(@$_REQUEST['action_type']==1)
				{
				$objects->add_quantity=@$_REQUEST['check_quantity']+@$_REQUEST['quantity_add'];
				}
				else if(@$_REQUEST['action_type']==2)
				{
				$check_qty=$_REQUEST['check_quantity'];
				if($check_qty<@$_REQUEST['quantity_decrease'])
				{
				$_REQUEST['quantity_decrease'];
				$reqid=$_REQUEST['book_id'];
				@header('Location:index.php?mod=mod_booksStore&view=editBook&m=6&book_id='.$reqid.'&r=4');
				echo "jshrjsm";die;
				}
				$objects->decrease_quantity=@$_REQUEST['check_quantity']-@$_REQUEST['quantity_decrease'];
				}
				else if(@$_REQUEST['action_type']=="")
				{
				$check_qty=$_REQUEST['check_quantity'];
				$objects->old_quantity=@$check_qty;
				}
				
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
					 if($model_booksStore_purchaseBooks->updateData($objects,$book_imagetitle)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=2');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				 }
				 else
				 {
				 if($model_booksStore_purchaseBooks->updateData_withoutimg($objects)){
					@header('Location:index.php?mod=mod_booksStore&view=default&m=1&s=2');}else{@header('Location:index.php?mod=mod_booksStore&view=default&m=1&r=1');
				 }
				 }
				break;
				case 'issue_gift_books':
				$model_booksStore_issueBooks = new model_booksStore_issue_type();
				global $config_var;
				$objects = new stdClass();
				$objects->person_name = @$_REQUEST['person_name'];
				$objects->detail = @$_REQUEST['detail'];
				if($model_booksStore_issueBooks->issue_books($objects)){
					@header('Location:index.php?mod=mod_booksStore&view=issueBooks&m=4&s=7');}else{@header('Location:index.php?mod=mod_booksStore&view=issue_type&m=4&r=5');
				 }
				 break;
				 case 'issue_emp_books':
				 $model_booksStore_issueBooks = new model_booksStore_issue_type();
					global $config_var;
					$objects = new stdClass();
					$objects->select2 = @$_REQUEST['select2'];
					if($model_booksStore_issueBooks->issue_emp_books($objects)){
					@header('Location:index.php?mod=mod_booksStore&view=issueBooks&m=4&s=8');}else{@header('Location:index.php?mod=mod_booksStore&view=issue_type&m=4&r=5');
				 }
				 break;
				 case 'generate_bill':
				 $model_booksStore_sellBooks = new model_booksStore_sell_books();
					global $config_var;
					$objects = new stdClass();
					$objects->business_type = @$_REQUEST['select'];
					$objects->party_id = @$_REQUEST['party'];
					if($model_booksStore_sellBooks->issue_sell_books($objects)){
					@header('Location:index.php?mod=mod_booksStore&view=sellBooks&m=2&s=8');}else{@header('Location:index.php?mod=mod_booksStore&view=sell_books&m=2&r=5');
				 }
				 break;
				case 'add_book_order':
				$order_books=new model_booksStore_orderbookdetail();
				$order_books->addtoorder(base64_decode($_REQUEST['book_id']),$_REQUEST['quantity']);
				@header('Location:index.php?mod=mod_booksStore&view=NewOrder&m=7&s=6');
				exit();
				break;
				case 'clear_order_cart':
				/*echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$remove_books=new model_booksStore_seeOrder();
				$remove_books->remove_all_books();
				@header('Location:?mod=mod_booksStore&view=seeOrder&m=7');
				break;
				case 'update_order_cart':
				$max=count($_SESSION['order']);
				for($i=0;$i<$max;$i++){
				$pid=$_SESSION['order'][$i]['productid'];
				$q=intval($_REQUEST['product'.$pid]);
				$ava_qty=intval($_REQUEST['avai_qty'.$pid]);
				if($q>0){
					$_SESSION['order'][$i]['qty']=$q;
					@header('Location:?mod=mod_booksStore&view=seeOrder&m=7&s=10');
					}
					else
					{
					@header('Location:?mod=mod_booksStore&view=seeOrder&m=7&r=6');
					}
					
				}
				break;	
				case 'delete_order_cart':
				$remove_particular_issue=new model_booksStore_seeOrder();
				$remove_particular_issue->remove_product($_REQUEST['pid']);
				@header('Location:?mod=mod_booksStore&view=seeOrder&m=7');
				break;
				case 'generate_order':
				$model_booksStore_generateOrders = new model_booksStore_generateOrders();
				global $config_var;
				$objects = new stdClass();
				$objects->academy = @$_REQUEST['select'];
				$objects->current_cart_price = @$_REQUEST['current_cart_price'];
				if($model_booksStore_generateOrders->issue_generate_order($objects)){
				@header('Location:index.php?mod=mod_booksStore&view=NewOrder&m=7&s=11');}else{@header('Location:index.php?mod=mod_booksStore&view=NewOrder&m=7&r=5');
				 }
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