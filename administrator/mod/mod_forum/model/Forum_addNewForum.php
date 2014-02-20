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
					
					
class model_Forum_addNewForum extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
		
			function uploadimage($file)
			{
			$model_Forum_addNewForum = new model_Forum_addNewForum();
			$config_var = new config();
					$error ="";
					for($a=0;$a<count($file['name']);$a++)
					{
					$fileinfo = pathinfo($file['name'][$a]);
				
						if(($fileinfo['extension']=="PNG" || $fileinfo['extension']=="png"|| $fileinfo['extension']=="JPG"|| $fileinfo['extension']=="jpg"|| $fileinfo['extension']=="gif"|| $fileinfo['extension']=="GIF"|| $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="JPEG") && $file['size'][$a]/(1024*1024) < 5)
						{
							$filename = microtime().".".$fileinfo['extension'];
							$filename = str_replace(" ","",$filename);
							if(move_uploaded_file($file['tmp_name'][$a],$config_var->UPLOAD_ROOT."forum/".$filename))
							{
								$url = $config_var->UPLOAD_ROOT."forum/" ;
								$thumbnail_path = $config_var->UPLOAD_ROOT."forum/thumbnail";
								$thumb = $model_Forum_addNewForum->createthumbnail($url,$thumbnail_path,$filename,'175',$file['type'][$a]);
								$data['error'][$a] = "";
								$data['filename'][$a] = $filename;
								$data['type'][$a] = $file['type'][$a];
								$data['size'][$a] = $file['size'][$a];
							}
							else
							{
								$data['error'][$a] = "Error uploading file";
							}
						}
						else
						{
							$data['error'][$a] = "Either file extension is not PNG, GIF,JPEG, JPG or file size greater than 5 MB";	
						}
					}
				return $data;
			}
			function createthumbnail($image_path,$thumb_path,$image_name,$thumb_width,$type) 
			{ 
			$src_img = $image_path.$image_name;
			$config_var = new config();
			if($type=='image/png'){
				$src_img = imagecreatefrompng($src_img); 
				}
			else if($type=='image/jpeg'){
			$src_img = imagecreatefromjpeg($src_img); 
			}
			else if($type=='image/gif'){
			$src_img = imagecreatefromgif($src_img); 
			}
			$origw=imagesx($src_img); 
				$origh=imagesy($src_img); 
				$new_w = $thumb_width;
				$diff=$origw/$new_w; 
				//$new_h=$new_w;
				$new_h = "175";	
				$dst_img = imagecreate($new_w,$new_h); 
				imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
				imagejpeg($dst_img, $thumb_path."/".$image_name); 
				return true; 
			} 
												
			function inserData($data)
			{
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->categoryTitle = @mysql_real_escape_string(stripslashes($data->categorytitle));
			  $this->categoryText = @mysql_real_escape_string(stripslashes($data->categoryText));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->subcategory = @mysql_real_escape_string(stripslashes($data->subcategory));
			  $this->createdDate = date('Y-m-d g:i:s');
			 /*echo "<pre>";
			 print_r($data);
			 die;*/
			$this->qry = "INSERT INTO topics(
					  topic_title,
					  topic_desc,
					  topic_cat,
					  topic_subcat,
					  topic_date,
					  status) VALUES
									('".$this->categoryTitle."',
									'".$this->categoryText."',
									'".$this->category."',
									'".$this->subcategory."',
									'".$this->createdDate."',
									'1')"; 
				$this->sql = $this->qry;
				if($this->query()){ 
				$topic_id= $this->insertid();
				foreach($data->filename as $filename)
				{
					$this->qry1 = "INSERT INTO topic_image(
					  topic_id,
					  image_name,
					  status) VALUES
									('".$topic_id."',
									'".$filename."',
									'1')"; 
				$this->sql = $this->qry1; $this->query(); 
				}/*echo "jshrjsm"; die;*/return true; }else{/*echo "jsm";die;*/ return false; }
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
		function checkRecords($data){
			$this->sql = "SELECT * FROM categories where category_name='".$data->categorytitle."'";	
			$this->query();
			return $this->loadAssoc();
		}
				
				
				
}
