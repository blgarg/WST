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
					
					
class model_bar_editbar extends JDatabaseMySQL
{  			
          var $tableName;
		  var $pageTitle;
		  var $pageMetaTagTitle;
		  var $pageMetaDes;
		  var $pageContents;
		  var $cat_id;
		  var $pageCats = 24;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		                     
         	function __construct(){}
		  	function initialize(){ return ;}	
													
			function getPageData($id)
			{	
				$this->sql = "SELECT * FROM bar_data WHERE id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			
			function saveData($data)
			{
			//echo "<pre>";print_r($data); die;
			
			  $this->image_data = @mysql_real_escape_string(stripslashes($data->image_data));
		      $this->bar_name = @mysql_real_escape_string(stripslashes($data->bar_name));
			  $this->web_site = @mysql_real_escape_string(stripslashes($data->web_site));
			  $this->bar_type = @mysql_real_escape_string(stripslashes($data->bar_type));
			  $this->bar_address = @mysql_real_escape_string(stripslashes($data->bar_address));
			  $this->bar_city = @mysql_real_escape_string(stripslashes($data->bar_city));
			  $this->bar_country = @mysql_real_escape_string(stripslashes($data->bar_country));
			  $this->working_hours = @mysql_real_escape_string(stripslashes($data->working_hours));
			  $this->no_of_staff= @mysql_real_escape_string(stripslashes($data->no_of_staff));
			  $this->image_name= @mysql_real_escape_string(stripslashes($data->image_name));
			  $this->bar_desc= @mysql_real_escape_string(stripslashes($data->bar_desc));
			  $this->facilities= @mysql_real_escape_string(stripslashes($data->facilities));
			  $this->Price_for_Sex= @mysql_real_escape_string(stripslashes($data->Price_for_Sex));
			  $this->rate= @mysql_real_escape_string(stripslashes($data->rate));
			  $this->thumbnail_name= @mysql_real_escape_string(stripslashes($data->thumbnail_name));
			  $this->id = @mysql_real_escape_string(stripslashes($data->cat_id));
			 
			if($data->image_data){
				$this->qry = "UPDATE bar_data SET
					 bar_name='".$this->bar_name."',
					 web_site='".$this->web_site."',
					 bar_type='".$this->bar_type."',
					 bar_address='".$this->bar_address."',
					 bar_city='".$this->bar_city."',
					 bar_country='".$this->bar_country."',
					 working_hours='".$this->working_hours."',
					 no_of_staff='".$this->no_of_staff."',
					 image_name='".$this->image_name."',
					 bar_desc='".$this->bar_desc."',
					 facilities='".$this->facilities."',
					 Price_for_Sex='".$this->Price_for_Sex."',
					 rate='".$this->rate."',
					 thumbnail_name='".$this->thumbnail_name."',
					  modified_on= NOW()
					 WHERE 
					 id=".$this->id; 
			}else{
			$this->qry = "UPDATE bar_data SET
					  bar_name='".$this->bar_name."',
					  web_site='".$this->web_site."',
					  bar_type='".$this->bar_type."',
					  bar_address='".$this->bar_address."',
					  bar_city='".$this->bar_city."',
					  bar_country='".$this->bar_country."',
					  working_hours='".$this->working_hours."',
					  no_of_staff='".$this->no_of_staff."',
					  bar_desc='".$this->bar_desc."',
					  facilities='".$this->facilities."',
					  Price_for_Sex='".$this->Price_for_Sex."',
					  rate='".$this->rate."',
					  modified_on= NOW()
                      WHERE 
					  id=".$this->id;
					 
				}
				
			$this->sql = $this->qry;
			$this->query();
			return $this->sql;
			 }	
			 	
			function getvarp(){ return; }
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
	
function uploadimage($file)
			{
			//echo "<pre>"; print_r($_REQUEST);print_r($_FILES); die;
			$config_var = new config();
					$error ="";
					//print_r($file); die;
					$fileinfo = pathinfo($file['name']);
					//print_r($fileinfo); die;
					if($_REQUEST['view']=='editbar')
					{
					$image_path = $config_var->UPLOAD_ROOT."bar_images/".$_REQUEST['old_img_name'] ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."bar_images/thumbnails/".$_REQUEST['old_img_name'] ;
					@unlink($image_path);
					@unlink($thumbnail_path);
					
						if(($fileinfo['extension']=="PNG" || $fileinfo['extension']=="png"|| $fileinfo['extension']=="JPG"|| $fileinfo['extension']=="jpg"|| $fileinfo['extension']=="gif"|| $fileinfo['extension']=="GIF"|| $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="JPEG") && $file['size'] < 1000000 )
						{
						$filename = microtime().".".$fileinfo['extension'];
						$filename = str_replace(" ","",$filename);
						
							if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."bar_images/".$filename))
							{
							$this->resizeImage($config_var->UPLOAD_ROOT."bar_images/".$filename, 230, 230, $config_var->UPLOAD_ROOT."bar_images/".$filename, $file);
								$data['error'] = "";
								$data['filename'] = $filename;
								$data['type'] = $file['type'];
								$data['size'] = $file['size'];
							}
							else
							{
								$data['error'] = "Error uploading file";
							}
						}else{
						$data['error'] = "Either file extension is not PNG, GIF,JPEG, JPG or file size greater than 1 MB";
						}
					}
					//print_r($data); die;
				return $data;
			}	
			//resize image function
			function resizeImage($originalImage,$toWidth,$toHeight,$path,$arr)
			{ 
			//echo "<pre>"; print_r($toHeight); die;
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
			// end resize image function
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
				$new_h=$new_w; 
				$dst_img = imagecreate($new_w,$new_h); 
				imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
				imagejpeg($dst_img, $thumb_path."/".$image_name); 
				return true; 
			} 
			function typeList(){
		    $this->sql = "SELECT * FROM type order by type_name ASC";
			$this->query();
			return $this->loadAssoc();
		}			
													
			
}
