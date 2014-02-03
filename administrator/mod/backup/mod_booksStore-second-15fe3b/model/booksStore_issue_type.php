<?php
session_start();
/*                  $this->tb_name = 'mgl_seo_pages_content';
					$this->where = '';
					$this->adjacents = '3';
					$this->page = 'index.php?mod=mod_dashboard';
					$this->pageLimit = '5'; 
					*/
					
/*                 FOR PAGINATION INITIALIZATION THE ABOVE VARIABLES
				   1. Call $data = $this->get_page_nav();
				   2. abovce functions returns array of three values 
				   		a. query result = $data[result]
						b. total number of records = $data[records] 
						c. Navigation  =  $data[nav] 
					*/
					
/*                 Load records from database 
				   $Data = $this->get_page_nav();  
				   $this->cur = $Data['result'];
 				   $result_set = $this->loadAssoc();	

				    */		
					
					
class model_booksStore_issue_type extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
			function get_product_name($pid){
			$result=mysql_query("select * from mgl_books_info where book_id=$pid");
			$row=mysql_fetch_array($result);
			return($row);
		}
		function check_is_quantity_available()
		{
		$max=count($_SESSION['issue_cart']);
			  for($i=0;$i<$max;$i++){
			  $pid=$_SESSION['issue_cart'][$i]['productid'];
			  $q=$_SESSION['issue_cart'][$i]['qty'];
			  $Books=model_booksStore_issue_type::get_product_name($pid);
			  if($Books['quantities']<$q)
			  	{
				return 0;
				//@header('Location:index.php?mod=mod_booksStore&view=issue_type&m=4&r=5');
				}
				else
				{
				return 1;
				}
			  }
		}
		function issue_emp_books($data)
		{
		$values=model_booksStore_issue_type::check_is_quantity_available();
		if($values==1)
		{
		 $HelperOb = new Helper();
			  $config_var = new config();
			  $totalamount=number_format(model_booksStore_issue_type::get_order_total(),2,".",",");
			  $this->issue_user_id=@mysql_real_escape_string(stripslashes($data->select2));
			  $this->createdDate = date('Y-m-d g:i:s');
			  $this->newid='0';
			  $this->qry = "INSERT INTO mgl_total_amount(
					  issue_id,
					  total_amt,
					  amt_date,
					  issue_user_id
					  ) VALUES
									('".$this->newid."',
									'".$totalamount."',
									'".$this->createdDate."',
									'".$this->issue_user_id."'
									)";
				
				$this->sql = $this->qry;
				$this->query();
				$value=mysql_insert_id();
			  $max=count($_SESSION['issue_cart']);
			  for($i=0;$i<$max;$i++){
					$pid=$_SESSION['issue_cart'][$i]['productid'];
					$q=$_SESSION['issue_cart'][$i]['qty'];
					$Books=model_booksStore_issue_type::get_product_name($pid);
					$new_quantity=$Books['quantities']-$q;
					//extract($row);
					if($q==0) continue;
					 $this->qry="INSERT INTO mgl_issue_book(
					  emp_detail_id,
					  book_id,
					  book_qty,
					  book_name,
					  date_issued,
					  book_price,
					  issue_type
					  ) VALUES
									('".$value."',
									'".$pid."',
									'".$q."',
									'".$Books['book_name']."',
									'".$this->createdDate."',
									'".$Books['book_price']."',
									'1'
									);";
									$this->sql = $this->qry;
					$this->query();
					$this->qry = "update mgl_books_info set quantities='".$new_quantity."' WHERE book_id=".$pid;
					$this->sql = $this->qry;
					$this->query();
					}
					unset($_SESSION['issue_cart']);
			  return true; 
				}
			else if($values==0)
			{
			@header('Location:index.php?mod=mod_booksStore&view=issue_type&m=4&r=5');
			}	
						
		
		}
		function issue_books($data)
		{
		$values=model_booksStore_issue_type::check_is_quantity_available();
		if($values==1)
		{
			  $HelperOb = new Helper();
			  $config_var = new config();
			  $this->createdDate = date('Y-m-d g:i:s');
			  $this->person_name = @mysql_real_escape_string(stripslashes($data->person_name));
			  $this->detail = @mysql_real_escape_string(stripslashes($data->detail));
			  $this->newid='1';
			  $this->qry = "INSERT INTO mgl_gift_books(
					  issue_id,
					  person_name,
					  person_detail
					  ) VALUES
									('".$this->newid."',
									'".$this->person_name."',
									'".$this->detail."'
									)";
				
				$this->sql = $this->qry;
				$this->query();
				$value=mysql_insert_id();
			  $max=count($_SESSION['issue_cart']);
			  for($i=0;$i<$max;$i++){
					$pid=$_SESSION['issue_cart'][$i]['productid'];
					$q=$_SESSION['issue_cart'][$i]['qty'];
					$Books=model_booksStore_issue_type::get_product_name($pid);
					$new_quantity=$Books['quantities']-$q;
					//extract($row);
					if($q==0) continue;
					 $this->qry="INSERT INTO mgl_issue_book(
					  issue_user_id,
					  book_id,
					  book_qty,
					  book_name,
					  date_issued,
					  book_price,
					  issue_type
					  ) VALUES
									('".$value."',
									'".$pid."',
									'".$q."',
									'".$Books['book_name']."',
									'".$this->createdDate."',
									'".$Books['book_price']."',
									'2'
									);";
									$this->sql = $this->qry;
					$this->query();
					$this->qry = "update mgl_books_info set quantities='".$new_quantity."' WHERE book_id=".$pid;
					$this->sql = $this->qry;
					$this->query();
					}
					unset($_SESSION['issue_cart']);
			  return true; 
			  }
			  else if($values==0)
			{
			@header('Location:index.php?mod=mod_booksStore&view=issue_type&m=4&r=5');
			}	
		
		}
		function get_order_total(){
		$max=count($_SESSION['issue_cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['issue_cart'][$i]['productid'];
			$q=$_SESSION['issue_cart'][$i]['qty'];
			$price=model_booksStore_issue_type::get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
		function get_price($pid){
			$result=mysql_query("select book_price from mgl_books_info where book_id=$pid");
			$row=mysql_fetch_array($result);
			return $row['book_price'];
		}
			function books_available($arr)
			{
				$str= "SELECT * FROM mgl_books_info WHERE quantities>='".$arr['quantity']."' and book_id='".base64_decode($arr['book_id'])."'";
				$rs=mysql_query($str);
				$result=mysql_num_rows($rs);
				return $result;
			}
			function getBookData($data)
			{	
				$this->sql = "SELECT * FROM mgl_books_info WHERE book_id='".base64_decode($data['book_id'])."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			function get_royalitywriter($id)
			{
				$this->sql = "SELECT writer_name FROM mgl_writers WHERE writer_id='".$id."'";
				
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
			}
			function get_book_category($id)
			{
				$this->sql = "SELECT cat_title FROM mgl_books_categories WHERE cat_id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
			}
			function employee_list()
			{
				$this->sql = "SELECT * FROM mgl_users where is_active=1 and user_role='user'";
				$this->query();
				return $this->loadAssoc();
			}
			function inserData($data)
			{
				/*echo "<pre>";
				print_r($data);
				die;*/
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->writer = @mysql_real_escape_string(stripslashes($data->writer));
			  $this->book_name = @mysql_real_escape_string(stripslashes($data->book_name));
			  $this->book_author = @mysql_real_escape_string(stripslashes($data->book_author));
			  $this->book_price = @mysql_real_escape_string(stripslashes($data->book_price));
			  $this->desc = @mysql_real_escape_string(stripslashes($data->desc));
			  $this->phone = "jshrjsm";
			  $this->quantity = @mysql_real_escape_string(stripslashes($data->quantity));
			  $this->createdDate = date('Y-m-d g:i:s');
/*		 echo "<pre>";
			 print_r($data);
			 die;*/
			  $this->qry = "INSERT INTO mgl_books_info(
					  want_royality,
					  royality_writer_id,
					  book_name,
					  book_author,
					  book_price,
					  description,
					  upload_image,
					  quantities,
					  book_cat_id,
					  created_Date,
					  Actions) VALUES
									('".$this->royality."',
									'".$this->writer."',
									'".$this->book_name."',
									'".$this->book_author."',
									'".$this->book_price."',
									'".$this->desc."',
									'".$this->phone."',
									'".$this->quantity."',
									'".$this->category."',
									'".$this->createdDate."',
									'1'
									)";
				
				$this->sql = $this->qry;
				if($this->query()){ /*echo "jshrjsm"; die;*/return true; }else{/*echo "jsm";die;*/return false; }
			}
													
													 function getvarp(){
									                 //$this->_result = mysql_query($this->qry);
											                $_data = $this->get_page_nav();  
													        $this->cur = $_data['result'];
 													        $result_set = $this->loadAssoc();
															return array('result'=>$result_set,'nav'=>$_data['nav']);
									                }
													
													
													function numRow(){	
													                     $this->setQuery($this->qry);
																	     $array_aa = $this->getNumRows();
														                        return $array_aa;
																				
																				}			
				  
				
					
		    function uploadBanner($imgarr,$imgId)
			{ 
				 
				 $helper = new Helper();
				 $config_var = new config();
				 $time = time();
				 $tempPath = $imgarr['tmp_name'];
				 $FileName = $imgarr['name'];
				 
				 
		         $this->originalBanner = $config_var->UPLOAD_ROOT.'newsBanner/originalImg/'.$imgId."_img".".";
		         $this->thumbbanner =$config_var->UPLOAD_ROOT.'newsBanner/thumbs/'.$imgId."_img".".";
		  	     $this->mediumbanner = $config_var->UPLOAD_ROOT.'newsBanner/resizedImg/'.$imgId."_img".".";
				 $ext = $helper->getUploadFileExtension($imgarr['name']);
				 
				 move_uploaded_file($tempPath,$this->originalBanner.$ext);
				 
				 $helper->resizeImage($this->originalBanner.$ext, 80, 80, $this->thumbbanner.$ext, $imgarr);
				 $helper->resizeImage($this->originalBanner.$ext,732,360, $this->mediumbanner.$ext, $imgarr);
				 return $time."_".".".$ext;
				
			}
			
			function countryList(){
		    $this->sql = "SELECT * FROM country order by name ASC";	
			$this->query();
			return $this->loadAssoc();
		}			

			function issuetocart($pid,$q){
			if($pid<1 or $q<1) return;
		
		if(is_array($_SESSION['issue_cart'])){
			if(model_booksStore_bookissue_detail::product_exists($pid,$q)) return;
			$max=count($_SESSION['issue_cart']);
			$_SESSION['issue_cart'][$max]['productid']=$pid;
			$_SESSION['issue_cart'][$max]['qty']=$q;
			}
		else{
			$_SESSION['issue_cart']=array();
			$_SESSION['issue_cart'][0]['productid']=$pid;
			$_SESSION['issue_cart'][0]['qty']=$q;
			}
	}	
		function product_exists($pid,$qty){
		$pid=intval($pid);
		$max=count($_SESSION['issue_cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['issue_cart'][$i]['productid']){
			$_SESSION['issue_cart'][$i]['qty']=$qty;
				$flag=1;
				break;
			}
		}
		return $flag;
	}
				
				
}
