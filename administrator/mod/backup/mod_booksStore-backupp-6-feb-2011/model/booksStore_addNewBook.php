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
					
					
class model_booksStore_addNewBook extends JDatabaseMySQL{  			
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
			function get_all_categories()
			{
				$this->sql = "SELECT * FROM mgl_books_categories";
				$this->query();
				return $this->loadAssoc();
			}										
			function inserData($data,$imgtitle)
			{
				/*echo "<pre>";
				print_r($data);
				die;*/
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
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
					  created_Date,
					  Actions) VALUES
									('".$this->royality."',
									'".$this->writer."',
									'".$this->book_name."',
									'".$this->book_author."',
									'".$this->book_price."',
									'".$this->desc."',
									'".$imgtitle."',
									'".$this->quantity."',
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

				
				
				
}
