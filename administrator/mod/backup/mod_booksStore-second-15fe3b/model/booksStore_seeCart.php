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


					
class model_booksStore_seeCart extends JDatabaseMySQL{  			
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
			
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= ' and Actions='.$_REQUEST['cmbStatus'];
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (page_title like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				
				$this->tb_name = 'mgl_books_info';
				$this->where = ' where 1 '.$this->searchCondition.' ORDER BY book_id DESC';
			    //$this->where = 'ORDER BY bannerId DESC';
				$this->adjacents = '1';
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
				$this->page = 'index.php?mod=mod_booksStore&view=default&m=1&d=5&creteria='.trim($_REQUEST['creteria']).'&hdnSearch='.$_REQUEST['hdnSearch']."&cmbStatus=".$_REQUEST['cmbStatus'];
				}else{
				$this->page = 'index.php?mod=mod_booksStore&view=default&m=1&d=5';
				}
				$this->pageLimit = '2';
				// $this->_result = mysql_query($this->qry);
                     return $this->get_page_nav();
				}	
				
				
				function remove_all_books()
				{
				unset($_SESSION['cart']);
				return 1;
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
			
									
				function deleteData($ids){
					$this->qry = "delete FROM mgl_books_info WHERE book_id  in(".$ids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				function changeStatus($modelIds,$type){
				
				//echo $type; die;
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update mgl_books_info set Actions='".$typeval."' WHERE book_id in(".$modelIds.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				
				
				function deleteUploadedImages($id,$ext){
				$config_var = new config();
		         $this->originalBanner = $config_var->UPLOAD_ROOT.'newsBanner/originalImg/'.$id."_img".".$ext";
		         $this->thumbbanner =$config_var->UPLOAD_ROOT.'newsBanner/thumbs/'.$id."_img".".$ext";
		  	    $this->mediumbanner = $config_var->UPLOAD_ROOT.'newsBanner/resizedImg/'.$id."_img".".$ext";
				
		    if($id !=''){
				//UNLINK PREVIOUS UPOADED IMAGES
			if(file_exists($this->originalBanner)) unlink($this->originalBanner);
			if(file_exists($this->thumbbanner)) unlink($this->thumbbanner);
			if(file_exists($this->mediumbanner)) unlink($this->mediumbanner);
			}
			return true;
		}
		
		function get_product_name($pid){
			$result=mysql_query("select * from mgl_books_info where book_id=$pid");
			$row=mysql_fetch_array($result);
			return($row);
		}
		function get_price($pid){
			$result=mysql_query("select book_price from mgl_books_info where book_id=$pid");
			$row=mysql_fetch_array($result);
			return $row['book_price'];
		}
		function remove_product($pid){
			$pid=intval($pid);
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				if($pid==$_SESSION['cart'][$i]['productid']){
					unset($_SESSION['cart'][$i]);
					break;
				}
			}
			$_SESSION['cart']=array_values($_SESSION['cart']);
		}
		function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=model_booksStore_seeCart::get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}

}
						
						
						
