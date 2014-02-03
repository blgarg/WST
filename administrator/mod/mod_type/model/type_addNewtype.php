<?php
	
					
					
class model_type_addNewtype extends JDatabaseMySQL{  			
	
          var $galleryTitle;
		  var $galleryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ 
		//  echo "<pre>"; print_r($_REQUEST); print_r($_FILES); die;
		  return ; }	
													
			
			
			
			function insertData($data)
			{
			 //echo "<pre>"; print_r($data); die;
			 
			 $HelperOb = new Helper();
			  $config_var = new config();
			 $this->title = @mysql_real_escape_string(stripslashes($data->title));
			 

			$this->qry = "INSERT INTO type(
					
					  type_name,
					  status) VALUES
									(
									'".$this->title."',
									
									'1'
									)"; 
				
				$this->sql = $this->qry;
				if($this->query()){ return true; }else{ return false; }
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
		    $this->sql = "SELECT * FROM countries order by country_name ASC";
			$this->query();
			return $this->loadAssoc();
		}	
		function categoryList(){
		    $this->sql = "SELECT * FROM categories where status='1' order by category_name ASC";
			$this->query();
			return $this->loadAssoc();
		}	
		function checkRecords($text){
			$this->sql = "SELECT * FROM type where type_name='". $text."'";
			$this->query();
			return $this->loadAssoc();		
		}
		

				
				
				
}
