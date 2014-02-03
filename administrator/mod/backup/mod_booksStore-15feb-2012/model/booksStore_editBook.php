<?php
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
					
					
class model_booksStore_editBook extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
			function get_all_writers()
			{
			   	$this->sql = "SELECT * FROM mgl_writers";
				$this->query();
				return $this->loadAssoc();
			}
			function get_data_withid($data)
			{
			$bookid=base64_decode($data['book_id']);
			$this->sql = "SELECT * FROM mgl_books_info where book_id=".$bookid;	
			$this->query();
			return $this->loadAssoc();
			}
			function get_all_categories()
			{
				$this->sql = "SELECT * FROM mgl_books_categories";
				$this->query();
				return $this->loadAssoc();
			}	
			function updateData($data,$imgpath)
			{
			
			$HelperOb = new Helper();
			  $config_var = new config();
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->writer = @mysql_real_escape_string(stripslashes($data->writer));
			  if($this->writer=='')
			  {
			  $this->writer =0;
			  $this->royality=0;
			  }
			  $this->book_name = @mysql_real_escape_string(stripslashes($data->book_name));
			  $this->book_author = @mysql_real_escape_string(stripslashes($data->book_author));
			  $this->book_sell_price = @mysql_real_escape_string(stripslashes($data->book_sell_price));
			  $this->desc = @mysql_real_escape_string(stripslashes($data->desc));
			  $this->phone = "jshrjsm";
			  $this->quantity = @mysql_real_escape_string(stripslashes($data->quantity));
			  $this->createdDate = date('Y-m-d g:i:s');
			  $this->bookid=base64_decode($_REQUEST['book_id']);
			  $this->decrease_quantity = @mysql_real_escape_string(stripslashes($data->decrease_quantity));
			  if($data->action_type==1)
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->add_quantity));
			  }
			  else if($data->action_type==2)
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->decrease_quantity));
			  }
			  else
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->old_quantity));
			  }
				  $this->qry = "UPDATE mgl_books_info SET
				      want_royality='".$this->royality."',
					  royality_writer_id='".$this->writer."',
                      book_name='".$this->book_name."',
					  book_author='".$this->book_author."',
                      book_price='".$this->book_sell_price."',
					  description='".$this->desc."',
					  upload_image='".$imgpath."',
                      quantities='".$this->new_quantity."',
					  accept_book='1'
					  WHERE 
					  book_id=".$this->bookid;
			
			$this->sql = $this->qry;
				if($this->query()){/*echo "jshrjsm"; die;*/return $this->sql;}else{/*echo "jshr"; die;*/return $this->sql;}
			  /*echo "<pre>";

			 print_r($data);
			 die;*/
			
			}
			function updateData_withoutimg($data)									
			{
			$HelperOb = new Helper();
			  $config_var = new config();
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->writer = @mysql_real_escape_string(stripslashes($data->writer));
			  if($this->writer=='')
			  {
			  $this->writer =0;
			  $this->royality=0;
			  }
			  $this->book_name = @mysql_real_escape_string(stripslashes($data->book_name));
			  $this->book_author = @mysql_real_escape_string(stripslashes($data->book_author));
			  $this->book_sell_price = @mysql_real_escape_string(stripslashes($data->book_sell_price));
			  $this->desc = @mysql_real_escape_string(stripslashes($data->desc));
			  $this->phone = "jshrjsm";
			  $this->quantity = @mysql_real_escape_string(stripslashes($data->quantity));
			  $this->createdDate = date('Y-m-d g:i:s');
			  $this->bookid=base64_decode($_REQUEST['book_id']);
			  $this->decrease_quantity = @mysql_real_escape_string(stripslashes($data->decrease_quantity));
			  if($data->action_type==1)
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->add_quantity));
			  }
			  else if($data->action_type==2)
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->decrease_quantity));
			  }
			  else
			  {
			  $this->new_quantity=@mysql_real_escape_string(stripslashes($data->old_quantity));
			  }
			  $this->qry = "UPDATE mgl_books_info SET
			  		  want_royality='".$this->royality."',
					  royality_writer_id='".$this->writer."',
                      book_name='".$this->book_name."',
					  book_author='".$this->book_author."',
                      book_price='".$this->book_sell_price."',
					  description='".$this->desc."',
					  quantities='".$this->new_quantity."',
					  accept_book='1'
					  WHERE 
					  book_id=".$this->bookid;
/*			echo "UPDATE mgl_books_info SET
					  royality_writer_id='".$this->writer."',
                      book_name='".$this->book_name."',
					  book_author='".$this->book_author."',
                      book_price='".$this->book_sell_price."',
					  description='".$this->desc."',
					  quantities='".$this->new_quantity."',
					  accept_book='1'
					  WHERE 
					  book_id=".$this->bookid;
					  die;*/
			$this->sql = $this->qry;
				if($this->query()){/*echo "jshrjsm"; die;*/return $this->sql;}else{/*echo "jshr"; die;*/return $this->sql;}
			  /*echo "<pre>";
			 print_r($data);
			 die;*/
			}
			function inserData($data,$imgtitle)
			{
			  $HelperOb = new Helper();
			  $config_var = new config();
			  $this->business_type = @mysql_real_escape_string(stripslashes($data->business_type));
			  $this->party = @mysql_real_escape_string(stripslashes($data->party));
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->writer = @mysql_real_escape_string(stripslashes($data->writer));
			  $this->book_name = @mysql_real_escape_string(stripslashes($data->book_name));
			  $this->book_author = @mysql_real_escape_string(stripslashes($data->book_author));
			  $this->party_price = @mysql_real_escape_string(stripslashes($data->book_price));
			  $this->desc = @mysql_real_escape_string(stripslashes($data->desc));
			  $this->phone = "jshrjsm";
			  $this->quantity = @mysql_real_escape_string(stripslashes($data->quantity));
			  $this->createdDate = date('Y-m-d g:i:s');
/*		 echo "<pre>";
			 print_r($data);
			 die;*/
			  $this->qry = "INSERT INTO mgl_books_info(
					  want_royality,
					  business_id,
					  party_id,
					  royality_writer_id,
					  book_name,
					  book_author,
					  party_price,
					  description,
					  upload_image,
					  quantities,
					  book_cat_id,
					  created_Date,
					  purchase_type,
					  Actions) VALUES
									('".$this->royality."',
									'".$this->business_type."',
									'".$this->party."',
									'".$this->writer."',
									'".$this->book_name."',
									'".$this->book_author."',
									'".$this->party_price."',
									'".$this->desc."',
									'".$imgtitle."',
									'".$this->quantity."',
									'".$this->category."',
									'".$this->createdDate."',
									'1',
									'1'
									)";
				
				$this->sql = $this->qry;
				if($this->query()){ $id=mysql_insert_id();
				 $this->qry = "INSERT INTO tb_book_report(
					  book_id,
					  book_price,
					  quantity,
					  userid,
					  created_Date) VALUES
									('".$id."',
									'".$this->party_price."',
									'".$this->quantity."',
									'',
									'".$this->createdDate."'
									)";
									$this->sql = $this->qry;
									$this->query();
				return true; }else{/*echo "jsm";die;*/return false; }
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
			function get_all_businesstype()
			{
			$this->sql = "SELECT * FROM mgl_business_categories order by business_cat_title ASC";	
			$this->query();
			return $this->loadAssoc();
			}		

				
				
				
}
