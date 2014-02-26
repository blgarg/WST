<?php
	
class model_partygirls_addNewpartygirls extends JDatabaseMySQL{  			
	
          var $galleryTitle;
		  var $galleryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ 
		//  echo "<pre>"; print_r($_REQUEST); print_r($_FILES); die;
		  return ; }	
													
function uploadimage($file)
			{
			//echo "<pre>"; print_r($_REQUEST);print_r($_FILES); die;
			$config_var = new config();
					$error ="";
					//print_r($file); die;
					$fileinfo = pathinfo($file['name']);
					
					if(($fileinfo['extension']=="PNG" || $fileinfo['extension']=="png"|| $fileinfo['extension']=="JPG"|| $fileinfo['extension']=="jpg"|| $fileinfo['extension']=="gif"|| $fileinfo['extension']=="GIF"|| $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="JPEG") && $file['size']/(1024*1024) < 5)
					{
						$filename = microtime().".".$fileinfo['extension'];
						$filename = str_replace(" ","",$filename);
						if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."partygirls_images/".$filename))
						{
							$data['error'] = "";
							$data['filename'] = $filename;
							$data['type'] = $file['type'];
							$data['size'] = $file['size'];
						}
						else
						{
							$data['error'] = "Error uploading file";
						}
					}
					else
					{
						$data['error'] = "Either file extension is not PNG, GIF,JPEG, JPG or file size greater than 5 MB";
						
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
				
				//$new_width =$toWidth;
				//$new_height =$new_height;
				$new_width =$new_width;
				$new_height =$toHeight;
					
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
			
			function inserData($data)
			{
			// echo "<pre>"; print_r($data); die;
			// echo "<pre>"; print_r($_FILES['image_load']['name']); die;
			 $HelperOb = new Helper();
			  $config_var = new config();
			 $this->imagetitle = @mysql_real_escape_string(stripslashes($data->image_title));
			 $this->imagedata = @mysql_real_escape_string(stripslashes($data->image_data));
			$this->countryid = @mysql_real_escape_string(stripslashes($data->country_id));
			$this->city = @mysql_real_escape_string(stripslashes($data->city));
			$this->categoryid = @mysql_real_escape_string(stripslashes($data->category_id)); 
			 $this->thumbnail = @mysql_real_escape_string(stripslashes($data->image_thumbnail));
			$this->original_name = $_FILES['image_load']['name'];

		 $this->qry = "INSERT INTO party_girls_images(
					  
					  image_title,
					  image_data,
					  country_id,
					  city,
					  category_id,
					  image_thumbnail,
					  original_name,
					  status,
					  created_on,
					  modified_on) VALUES
									(
									'".$this->imagetitle."',
									'".$this->imagedata."',
									'".$this->countryid."',
									'".$this->city."',
									'".$this->categoryid."',
									'".$this->thumbnail."',
									'".$this->original_name."',
									'1',
									NOW(),
									NOW()
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
		    $this->sql = "SELECT * FROM countries order by country_name ASC";
			$this->query();
			return $this->loadAssoc();
		}	
		function categoryList(){
		    $this->sql = "SELECT * FROM categories where status='1' order by category_name ASC";
			$this->query();
			return $this->loadAssoc();
		}			

				
				
				
}
