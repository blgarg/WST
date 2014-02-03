<?php



					
class model_upcoming_editupcoming extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = ''; 
		   var $originalBanner = '';
		  var $thumbbanner ='';
		  var $mediumbanner = '';   
		         
          function __construct(  ){ 
		              
			}   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){
			//echo "<pre>"; print_r($_REQUEST); 		print_r($_FILES);			die;
			
				return true;
				}	
				
				
				
				function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}
				function uploadImage($file,$existingFile){
				 $config_var = new config();
				$fileinfo = pathinfo($file['name']);
				if(($fileinfo['extension']=="jpg" || $fileinfo['extension']=="jpeg"|| $fileinfo['extension']=="png" || $fileinfo['extension']=="gif") && $file['size'] < 1000000)
				{
					$filename = microtime().".".$fileinfo['extension'];
					$filename = str_replace(" ","",$filename);
					if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."upcoming/".$filename))
					{
						$this->resizeImage($config_var->UPLOAD_ROOT."upcoming/".$filename, 370, 230, $config_var->UPLOAD_ROOT."upcoming/".$filename, $file);	
							$data1['error'] = 0;
							$data1['filename'] = $filename;
							$data1['type'] = $file['type'];
							$data1['size'] = $file['size'];
							@unlink($existingFile);
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
				
				function resizeImage($originalImage,$toWidth,$toHeight,$path,$arr)
			{ /*echo "<pre>";
				print_r($originalImage);
				print_r($toWidth);
				print_r($toHeight);
				print_r($path);
				print_r($arr); die;*/
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
			function saveData($data){
			
			 $this->country = $data->country;
			  $this->old_img_name = $data->old_img_name;
			  $this->video_name = $data->video_image;
			  $this->imageData = $data->imageData;
			if($data->video_image)  {
			$this->qry ="UPDATE `wst`.`upcoming_image` SET `image_data` = '".$this->imageData."',
						`image_name` = '".$this->video_name."',
						`country_id` = '".$this->country."',
						`orig_img_name` = '".$this->old_img_name."' WHERE `upcoming_image`.`id` =1";}
			else{
			$this->qry ="UPDATE `wst`.`upcoming_image` SET `country_id` = '".$this->country."'
									 WHERE `upcoming_image`.`id` =1"; 
			}						
					$this->sql = $this->qry;		
					if($this->query()){return $this->sql;}else{return $this->sql;}
			}
			function getRecord(){
				$this->sql = "select * from upcoming_image where id='1'"; 
				$this->query();
				$result_set = $this->loadAssoc();
				return $result_set; 
				}
				function getCountryList($id){
				$this->sql = "select * from countries";  
				$this->query();
				$result_set = $this->loadAssoc();
				return $result_set; 
				}
				function getCountryName($id){
				$this->sql = "select * from countries where id = '".$id."'";  
				$this->query();
				$result_set = $this->loadAssoc();
				return $result_set; 
				}
			function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile) {
			global $config_var;
			//	echo $SourceFile =  __DIR__ . $SourceFile ;
				//echo $DestinationFile =  __DIR__ . $DestinationFile;
				//echo "asdf".$SourceFile ; die;
				/*echo "<pre>";
				print_r($_SERVER['DOCUMENT_ROOT'].'/wst/'); die;*/
				   list($width, $height) = getimagesize($SourceFile);
					$image_p = imagecreatetruecolor($width, $height);
					$image = imagecreatefromjpeg($SourceFile);
				   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
				   $black = imagecolorallocate($image_p, 225, 225, 225);
				   $black = 0x00FFFFFF;
				   $font = $config_var->WEB_ROOT.'arial.ttf';
				   $font_size = 17;
				   imagettftext($image_p, $font_size, 0, 5, 25, $black, $font, $WaterMarkText);
				   if ($DestinationFile<>'') {
					  imagejpeg ($image_p, $DestinationFile, 100);
				   } else {
					  header('Content-Type: image/jpeg');
					  imagejpeg($image_p, null, 100);
				   };
				   imagedestroy($image);
				   imagedestroy($image_p);
		}
			
			
	
}
						
						
						
