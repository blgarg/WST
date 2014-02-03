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
					
					
class model_travel_gallery extends JDatabaseMySQL
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
				$this->sql = "SELECT * FROM travel_guide WHERE id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			function typeList()
			{
				$this->sql = "select * from type";
				$this->query();
				
				return $this->loadAssoc();
				
			}
			function saveData($data)
			{
			  
		      $this->place_name = @mysql_real_escape_string(stripslashes($data->place_name));
			  $this->address = @mysql_real_escape_string(stripslashes($data->address));
			  $this->city = @mysql_real_escape_string(stripslashes($data->city));
			  $this->country = $data->country_name;
			  $this->type = $data->type;
			  $this->working_hours = $data->working_hours;
			  $this->description = @mysql_real_escape_string(stripslashes($data->description));
			  $this->image_data = @$data->image_data;
			  $this->thumb_image = @$data->image_thumb;
			  $this->id = $data->id;
			  $this->thumbnail = @mysql_real_escape_string(stripslashes($data->image_thumbnail));
			if($data->editTravel==1){
				
				$this->qry = "UPDATE travel_guide SET
					  place_name='".$this->place_name."',
					  address='".$this->address."',
					  city='".$this->city."',
					  country='".$this->country."',
					  type='".$this->type."',working_hours='".$this->working_hours."',
					  description = '".$this->description."',image_data='".$this->image_data."',
					  thumb_image = '".$this->thumb_image."',modified_on=now()
                      WHERE 
					  id=".$this->id; 
			}else{
						$this->qry = "UPDATE travel_guide SET
					  place_name='".$this->place_name."',
					  address='".$this->address."',
					  city='".$this->city."',
					  country='".$this->country."',
					  type='".$this->type."',working_hours='".$this->working_hours."',
					  description = '".$this->description."',modified_on=now()
                      WHERE 
					  id=".$this->id; 
				}
			$this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
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
			
			$config_var = new config();
					$error ="";
				
					$fileinfo = pathinfo($file['name']);
					
					if(isset($_REQUEST['editTravel']) && $_REQUEST['editTravel']==1)
					{
					$image_path = $config_var->UPLOAD_ROOT."travel/".$_REQUEST['old_img_name'] ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."travel/thumbs/".$_REQUEST['old_img_name'] ;
					@unlink($image_path);
					@unlink($thumbnail_path);
					
						if(($fileinfo['extension']=="PNG" || $fileinfo['extension']=="png"|| $fileinfo['extension']=="JPG"|| $fileinfo['extension']=="jpg"|| $fileinfo['extension']=="gif"|| $fileinfo['extension']=="GIF"|| $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="JPEG") && $file['size'] < 5000000 )
						{
							$filename = microtime().".".$fileinfo['extension'];
							$filename = str_replace(" ","",$filename);
							
							if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."travel/".$filename))
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
						}else{
						$data['error'] = "Either file extension is not PNG, GIF,JPEG, JPG or file size greater than 5 MB";
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
				$new_h=$new_w; 
				$dst_img = imagecreate($new_w,$new_h); 
				imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
				imagejpeg($dst_img, $thumb_path."/".$image_name); 
				return true; 
			} 
			
													
			
}
