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
					
					
class model_cms_addNewPage extends JDatabaseMySQL{  			
          var $modelName;
		  var $birthdate;
		  //var $birthplace;
		  var $stats;
		  var $counrty;
		  var $deceased;
		  var $Photographer;
		  var $CauseDeath;
		  var $pageCats = 24;
		  var $createdDate = '0000-00-00 00:00:00';
		  var $updatedDate = '0000-00-00 00:00:00';
		  var $qry = '';  
		  var $_result = '';  
		  var $originalBanner = '';
		  var $thumbbanner ='';
		  var $mediumbanner = '';   
		  var $check = '';                 
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
													
			function inserData($data)
			{
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->pageTitle = @mysql_real_escape_string(stripslashes($data->title));
			  $this->pageText = @mysql_real_escape_string(stripslashes($data->text));
			  $this->pageTags = @mysql_real_escape_string(stripslashes($data->tags));
			  $this->tagsdesc = @mysql_real_escape_string(stripslashes($data->desc));
			  $this->page_title_link = str_replace(" ","-",$this->pageTitle);
			  $this->page_title_link = str_replace("?","",$this->page_title_link);
			  $this->page_title_link = str_replace("'","",$this->page_title_link);
			  $this->createdDate = date('Y-m-d g:i:s');
			  $this->qry = "INSERT INTO mgl_pages(
					  page_title,
					  created_Date,
					  page_content,
					  page_meta_tags,
                      meta_desc,
                      page_url,
                      Actions) VALUES
									('".$this->pageTitle."',
									'".$this->createdDate."',
									'".$this->pageText."',
									'".$this->pageTags."',
									'".$this->tagsdesc."',
									'".$this->page_title_link."',
									'1'
									)";
				
				$this->sql = $this->qry;
				if($this->query()){ /*echo "jshrjsm"; die;*/return true; }else{/*echo "jsm";die;*/ return false; }
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
