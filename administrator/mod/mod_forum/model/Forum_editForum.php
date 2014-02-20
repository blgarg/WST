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
					
					
class model_Forum_editForum extends JDatabaseMySQL
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
		
			function checkRecords($data){
			$this->sql = "SELECT * FROM categories where category_name='". $data->categorytitle."' and id !='".$data->cat_id."'"; 
			$this->query();
			return $this->loadAssoc();		
		}
			
													
			function getPageData($data)
			{	
				$this->sql = "SELECT * FROM categories WHERE id='".$data['cat_id']."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			
			function uploadimage($file)
			{
			$model_Forum_addNewForum = new model_forum_editForum();
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
												
			
			function saveData($data)
			{
			  $this->categoryTitle = @mysql_real_escape_string(stripslashes($data->categorytitle));
			  $this->categoryText = @mysql_real_escape_string(stripslashes($data->categoryText));
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->subcategory = @mysql_real_escape_string(stripslashes($data->subcategory));
			  $this->cat_id = @mysql_real_escape_string(stripslashes($data->topic_id));
			 /* $this->sql= "SELECT * FROM mgl_main_category WHERE page_url='$this->page_title_link'";
			  $this->query();
			  $Rcdrs =  $this->getNumRows();
			  if($Rcdrs >=1){$this->page_title_link = $this->page_title_link."_1"; /*$this->pageTitle = $this->pageTitle."_1";*//*}	
			  */
			  $topic_id= $this->cat_id;
				foreach($data->filename as $filename)
				{
					$this->qry1 = "INSERT INTO topic_image(
					  topic_id,
					  image_name,
					  status) VALUES
									('".$topic_id."',
									'".$filename."',
									'1')"; 
				$this->sql = $this->qry1; 
				$this->query(); 
				}
			$this->qry = "UPDATE topics SET
					  topic_title='".$this->categoryTitle."',topic_desc='".$this->categoryText."',
					  topic_cat='".$this->category."',
					  topic_subcat='".$this->subcategory."'
                      WHERE 
					  topic_id='".$topic_id."'";
			$this->sql = $this->qry;
				if($this->query()){
				return $this->sql;}else{return $this->sql;}
			 }	
			 	
			function getvarp(){ return; }
													
			
}
