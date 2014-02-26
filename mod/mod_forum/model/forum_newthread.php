<?php

class model_forum_newthread extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				$this->tb_name = 'topics';
				echo $this->where = ' where 1 and status=1 and topic_by!="0" and topic_subcat="'.$_REQUEST['sub_cat'].'" ';
				$this->where .=' order by topic_id desc';
				$this->adjacents = '1';
				$this->page = '?mod=mod_forum&view=display&id='.$_REQUEST['id'].'&sub_cat_id='.$_REQUEST['sub_cat'].'';
				$this->pageLimit = '1';
				return $this->get_page_nav_front();				
			}	
			
			function uploadimage($file)
			{
			$model_Forum_newthread = new model_Forum_newthread();
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
								$thumb = $model_Forum_newthread->createthumbnail($url,$thumbnail_path,$filename,'175',$file['type'][$a]);
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
			  $this->categoryText = $data->categoryText;
			  $this->category = @mysql_real_escape_string(stripslashes($data->category));
			  $this->subcategory = @mysql_real_escape_string(stripslashes($data->subcategory));
			  $this->createdDate = date('Y-m-d g:i:s');
			
			$this->qry = "INSERT INTO topics(
					  topic_title,
					  topic_desc,
					  topic_cat,
					  topic_subcat,
					  topic_by,
					  topic_date,
					  status) VALUES
									('".trim(addslashes($this->categoryTitle))."',
									'".trim(addslashes($this->categoryText))."',
									'".$this->category."',
									'".$this->subcategory."',
									'".$_SESSION['user_id']."',
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
					$_data = $this->get_page_nav_front();  
					$this->cur = $_data['result'];
					$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
			function numRow(){
					$this->setQuery($this->qry);
					$array_aa = $this->getNumRows();
					return $array_aa;
				}

			
			//Fetch Sub Cat name
			function getCatById($id){
		  	$this->sql = "SELECT * from `forum_categories` where cat_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
			
				//Fetch Sub Cat name
			function getSubCatById($id){
		  
		   $this->sql = "SELECT * from `forum_sub_categories` where sub_cat_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getMainForumById($id){
		  		$this->sql = "SELECT * from `topics` where topic_by=0 and topic_subcat='".$id."'";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
			
		function getForumSubCatById($id){
		  		$this->sql = "SELECT topic_title from `topics` where topic_subcat=$id limit 5";
			  if($this->query()){
				 return $this->loadResultArray();
			   }
		}
		
		function getAllForumSubCatById($id){
		  		$this->sql = "SELECT * from `topics` where topic_subcat=$id order by topic_id desc";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getMainPostById($id){
		  		$this->sql = "SELECT * from `posts` where topic_id=$id  order by post_id desc";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
			function getAllPostSubCatById($id){
		  		$this->sql = "SELECT * from `posts` where topic_id=$id order by post_id desc ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getAllPostImagesId($id){
		  		$this->sql = "SELECT * from `posts_image` where topic_id=$id  ";
			  if($this->query()){
				 return $this->loadResultArray();
			   }
		}
		
		function getUserName($id){
		  		$this->sql = "SELECT * from `users` where id=$id ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
			}
