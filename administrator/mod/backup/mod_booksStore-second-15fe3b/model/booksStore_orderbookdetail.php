<?php
session_start();
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
					
					
class model_booksStore_orderbookdetail extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
			function books_available($arr)
			{
				$str= "SELECT * FROM mgl_books_info WHERE quantities>='".$arr['quantity']."' and book_id='".base64_decode($arr['book_id'])."'";
				$rs=mysql_query($str);
				$result=mysql_num_rows($rs);
				return $result;
			}
			function getBookData($data)
			{	
				$this->sql = "SELECT * FROM mgl_books_info WHERE book_id='".base64_decode($data['book_id'])."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			function get_royalitywriter($id)
			{
				$this->sql = "SELECT writer_name FROM mgl_writers WHERE writer_id='".$id."'";
				
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
			}
			function get_book_category($id)
			{
				$this->sql = "SELECT cat_title FROM mgl_books_categories WHERE cat_id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
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

			function addtoorder($pid,$q){
			if($pid<1 or $q<1) return;
			
		if(is_array($_SESSION['order'])){
		
			
			if(model_booksStore_orderbookdetail::product_exists($pid,$q)) return;
			$max=count($_SESSION['order']);
			$_SESSION['order'][$max]['productid']=$pid;
			$_SESSION['order'][$max]['qty']=$q;
			}
		else{
			$_SESSION['order']=array();
			$_SESSION['order'][0]['productid']=$pid;
			$_SESSION['order'][0]['qty']=$q;
			}
				}	
		function product_exists($pid,$qty){
		$pid=intval($pid);
		$max=count($_SESSION['order']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['order'][$i]['productid']){
			$_SESSION['order'][$i]['qty']=$qty;
				$flag=1;
				break;
			}
		}
		return $flag;
	}
				
				
}
