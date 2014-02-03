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
					
					
class model_video_addNewVideo extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
													
			// upload video
			function resizeImage($originalImage,$toWidth,$toHeight,$path,$arr)
			{ 
				ini_set("memory_limit", "256M"); 
				$imgType = $arr['type'];
				// Get the original geometry and calculate scales
				list($width, $height) = getimagesize($originalImage);
				if($width < $toWidth){
					$toWidth = $width;
				}
				if($height < $toHeight){
					$toHeight = $height;
				}
				if($toWidth != 0){
				$xscale=$width/$toWidth;}
				if($toHeight != 0){
				$yscale=$height/$toHeight;}
				// Recalculate new size with default ratio
				if ($yscale>$xscale){
					$new_width = round($width * (1/$yscale));
					$new_height = round($height * (1/$yscale));
				}
				else 
				{
					$new_width = round($width * (1/$xscale));
					$new_height = round($height * (1/$xscale));
				}
				
				$new_width =$toWidth;
				$new_height =$new_height;
					
				// Resize the original image
				$imageResized = imagecreatetruecolor($new_width, $new_height);
				if ($imgType =="image/gif"){
					$imageTmp = imagecreatefromgif($originalImage);
					imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagegif($imageResized, $path);
				}
				elseif($imgType =="image/png")
				{
					$imageTmp = imagecreatefrompng($originalImage);
					imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagegif( $imageResized,$path);
				} 
				else {
					//$imageTmp  = imagecreatefromjpeg(TEMP_PATH.$originalImage);
					$imageTmp  = imagecreatefromjpeg($originalImage);
					imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($imageResized,$path);
				}
				
				return $imageResized;
			
			}
			function uploadImage($file)
			{
				$config_var = new config();
				$fileinfo = pathinfo($file['name']);
			if(($fileinfo['extension']=="jpg" || $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="png" || $fileinfo['extension']=="gif") && $file['size'] < 1000000)
				{
					$filename = microtime().".".$fileinfo['extension'];
					$filename = str_replace(" ","",$filename);
					
					if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."videos/images/".$filename))
					{
							$this->resizeImage($config_var->UPLOAD_ROOT."videos/images/".$filename, 220, 162, $config_var->UPLOAD_ROOT."videos/images/".$filename, $file);
							$data1['error'] = 0;
							$data1['filename'] = $filename;
							$data1['type'] = $file['type'];
							$data1['size'] = $file['size'];
					}
					else
					{
						$data1['error'] = "Error uploading file";
					}
				}
				else
				{
					$data1['error'] = "File type error";
				}
				return $data1;
			}
			function uploadVideo($file)
			{
					$config_var = new config();
					$error ="";
					$fileinfo = pathinfo($file['name']);
					
					if(($fileinfo['extension']=="wmv") && $file['size'] < 500000000)
					{
						$filename = microtime().".".$fileinfo['extension'];
						$playerfilename = microtime();
						$filename = str_replace(" ","",$filename);
						
						if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."videos/".$filename))
						{
							$data['error'] = "";
							$data['filename'] = $filename;
							$data['type'] = $file['type'];
							$data['size'] = $file['size'];
							$srcFile  = $config_var->UPLOAD_ROOT."videos/".$filename;
							$new_file = explode("wmv", $filename);
							$destFile = $config_var->UPLOAD_ROOT."videos/flv_videos/".$new_file[0]."flv";
							
							/*echo exec("/usr/bin/ffmpeg -i $srcFile $destFile 2>&1", $output);
							echo exec("/usr/bin/ffmpeg -i $srcFile  -ab 56 -ar 44100 -b 900000 -s 3500x2000 -f flv $destFile");
							*/
							echo exec("/usr/bin/ffmpeg -async 1 -i $srcFile -f flv -b 700k -qscale 0 -ab 160k -ar 44100 $destFile");
						}
						else
						{
							$data['error'] = "Error uploading file";
						}
					}
					else
					{
						$data['error'] = "Either file extension is not flv, mp4 or file size greater than 500 MB";
					}
				return $data;
			}
			function inserData($data)
			{
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->video_data = $data->video_data;
			  $this->country_id = @mysql_real_escape_string(stripslashes($data->country_id));
			  $this->category_id = @mysql_real_escape_string(stripslashes($data->category_id));
			  $this->video_title = @mysql_real_escape_string(stripslashes($data->video_title));	
			  
			   $this->qry = "INSERT INTO videos(
					  video_data,
					  video_title,
					  video_name,
					  image,
					  category_id,
					  country_id,
					  created_on,
					  modified_on,
					  status
					 ) VALUES
									('".$this->video_data."',
									'".$this->video_title."',
									'".$data->video_name."',
									'".$data->video_image."',	
									'".$data->category."',
									'".$data->country."',
									'".date("Y-m-d h:i:s")."',
									'".date("Y-m-d h:i:s")."',
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
			
			function getCountry()
			{
				$this->sql = "Select * from countries order by country_name ASC";
				$this->query();
				return $this->loadAssoc();
			}
					
			function getCategory()
			{
				$this->sql = "select * from categories";
				$this->query();
				return $this->loadAssoc();
			}
				
				
				
}
