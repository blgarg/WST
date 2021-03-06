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
					
					
class model_video_editVideo extends JDatabaseMySQL
{  			
          var $tableName;
		  var $pageTitle;
		  var $pageMetaTagTitle;
		  var $pageMetaDes;
		  var $pageContents;
		  var $writer_id;
		  var $pageCats = 24;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		                     
         	function __construct(){}
		  	function initialize(){ return ;}	
													
			function getPageData($data)
			{	
				 $this->sql = "SELECT * FROM videos WHERE id='".$data."'";
				$this->query();
				return $this->loadAssoc();	
			}
			function getCountry()
			{
				$this->sql = "Select * from countries";
				$this->query();
				return $this->loadAssoc();
			}
			function getCategory()
			{
				$this->sql = "select * from categories";
				$this->query();
				return $this->loadAssoc();
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
			function saveData_withimg($data,$imgpath)
			{

			  $this->emp_type = @mysql_real_escape_string(stripslashes($data->emp_type));
			  $this->fName = @mysql_real_escape_string(stripslashes($data->fName));
			  $this->lName = @mysql_real_escape_string(stripslashes($data->lName));
			  $this->rTitle = @mysql_real_escape_string(stripslashes($data->rTitle));
			  $this->dob = @mysql_real_escape_string(stripslashes($data->dob));
			  $this->jdate = @mysql_real_escape_string(stripslashes($data->jdate));
			  $this->addr1 = @mysql_real_escape_string(stripslashes($data->addr1));
			  $this->country = @mysql_real_escape_string(stripslashes($data->country));
			  $this->state = @mysql_real_escape_string(stripslashes($data->state));
			  $this->city = @mysql_real_escape_string(stripslashes($data->city));
			  $this->phone = @mysql_real_escape_string(stripslashes($data->phone));
			  $this->mobile = @mysql_real_escape_string(stripslashes($data->mobile));
			  $this->writer_id = @mysql_real_escape_string(stripslashes($data->writer_id));
			  $this->royality = @mysql_real_escape_string(stripslashes($data->royality));
			  if($this->royality=='')
			  {
			  $this->royality=0;
			  }
			 /* $this->sql= "SELECT * FROM mgl_writers WHERE page_url='$this->page_title_link'";
			  $this->query();
			  $Rcdrs =  $this->getNumRows();
			  if($Rcdrs >=1){$this->page_title_link = $this->page_title_link."_1"; /*$this->pageTitle = $this->pageTitle."_1";*//*}	
			  */
			 /* echo "UPDATE mgl_writers SET
					  emp_type='".$this->emp_type."',
                      emp_lname='".$this->lName."',
					  emp_fname='".$this->fName."',
                      emp_rtitle='".$this->rTitle."',
					  emp_dob='".$this->dob."',
                      emp_joining='".$this->jdate."',
					  addr1='".$this->addr1."',
                      emp_country='".$this->country."',
					  emp_state='".$this->state."',
                      emp_city='".$this->city."',
					  emp_phone='".$this->phone."',
					  img_title='".$imgpath."',	
					  royality_writer='".$this->royality."',	
                      emp_mobile='".$this->mobile."'
					  WHERE 
					  writer_id=".$this->writer_id;
					  die;*/
				$this->qry = "UPDATE mgl_writers SET
					  emp_type='".$this->emp_type."',
                      emp_lname='".$this->lName."',
					  emp_fname='".$this->fName."',
                      emp_rtitle='".$this->rTitle."',
					  emp_dob='".$this->dob."',
                      emp_joining='".$this->jdate."',
					  addr1='".$this->addr1."',
                      emp_country='".$this->country."',
					  emp_state='".$this->state."',
                      emp_city='".$this->city."',
					  emp_phone='".$this->phone."',
					  img_title='".$imgpath."',	
					  royality_writer='".$this->royality."',	
                      emp_mobile='".$this->mobile."'
					  WHERE 
					  writer_id=".$this->writer_id;
			
			$this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
			 }
			function saveData($data)
			{
				/*echo "<pre>";
				print_r($data);
				echo die;*/
			  $this->video_title = @mysql_real_escape_string(stripslashes($data->video_title));
			  $this->video_data = $data->video_data;
			  $this->country_id = $data->country;
			  $this->category_id = $data->category;
			  echo $this->id = $data->video_id;
			  $this->qry = "UPDATE videos SET video_title='".$this->video_title."'";
			  if($data->editVideo==1)
			  {
						$this->qry .="
							,video_data='".$this->video_data."'
							,video_name = '".$data->video_name."'
							";
			  }	
			  if($data->imageFlag==1)
			  {
				$this->qry .= ",image='".$data->image."'";
			  }
			  $this->qry .=",category_id='".$this->category_id."'
							,country_id='".$this->country_id."'
							
							,modified_on='now()'		
							WHERE id = ".$this->id;
			  
				
			
			 $this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
			 }	
			 	
			function getvarp(){ return; }
			function editVideoImage($file,$existingFile)
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
							@unlink($config_var->UPLOAD_ROOT."videos/images/".$existingFile);
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
			
			function getOldVideoData($id){
					$this->sql = "select video_data from videos where id=".$id; 
					$this->query();
					$result_set = $this->loadAssoc();
					$videoData = unserialize($result_set[0]['video_data']);
					return $videoData; 
			}
}
