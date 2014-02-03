<?php
class theme extends JDatabaseMySQL{
	var $user_blocks;
	var $blocksTitles =array();
	var $blocksContents = array();
	var $_result;

	
function siteHeadertab(){

				//$idUser = @$session->getVar("userAccountID");
				$userblog = @$_REQUEST['userblog'];
				$sql = mysql_query("SELECT * FROM mgl_users WHERE `site_domain`= '$userblog'");
				$UserData = mysql_fetch_array($sql);
				$idUser = $UserData['user_id'];

			    $this->sql = "SELECT * FROM custom_tab WHERE `user_id`= '$idUser' and `Actions`= '1'";
				$this->query();
				$this->result = $this->getArray();
				return $this->result;
	} 

function sitefootertab(){

				$userblog = @$_REQUEST['userblog'];
				$page =@$_REQUEST['catId'];
				$sql = mysql_query("SELECT * FROM mgl_users WHERE `site_domain`= '$userblog'");
				$UserData = mysql_fetch_array($sql);
				$idUser = $UserData['user_id'];

			    $this->sql = "SELECT * FROM footer_article WHERE `user_id`= '$idUser' and `page_id`= '$page' and `headline_show`= '1'";
				$this->query();
				$this->result = $this->getArray();
				return $this->result;
	} 

	function getpages(){
						
						$pageId = '';
						if(isset($_REQUEST['page']) && @$_REQUEST['page'] != ''){
							$pageId = ' AND page_id= "'.$_REQUEST['page'].'"';
						}
						   $this->sql = "SELECT * FROM  `mgl_pages` WHERE Actions != 0  ".$pageId." ";
						   $this->query();
						   $getPagedata = $this->loadAssoc();
						   
						   return $getPagedata;
						
						}
	function pagedetails($cat_id){
	
						   $this->sql = "SELECT * FROM  `mgl_pages` WHERE `categories`= '$cat_id' order by page_title ASC";
						   $this->query();
						   $pageDetails = $this->loadAssoc();	
						   return $pageDetails;
						
						}



	function blogSiteAllLinks(){
				$blogALLtabLinks = @$_REQUEST['ALLtabLinks'];
							
			   $this->sql = "SELECT * FROM mgl_links WHERE 	categories= '$blogALLtabLinks'"; 
					
					$this->query();
					$this->_result = $this->loadAssoc();
					$this->blocksTitles = $this->_result;
					return $this->blocksTitles;
			} 

		
	function top_navigation(){
				//$session = new session();
				//$idUser = @$session->getVar("userAccountID");
								
				$userblog = @$_REQUEST['userblog'];
				$this->sql = "SELECT cat_id FROM mgl_page_categories WHERE `cat_id` in('43')"; 
				$this->query();
				$UserData = $this->getArray();
				
				$idUser= $UserData['cat_id'];
				/*$this->sql = "SELECT * FROM mgl_user_block WHERE user_id ='$idUser'";
				$this->query();
				$this->_result = $this->getArray();*/
				
			   	$this->sql = "SELECT * FROM mgl_pages WHERE `categories`= '$idUser' AND `Actions`= '1' ORDER by page_id DESC"; 
					
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
			} 

		function HomePage_artical(){
	
				$this->sql = "SELECT cat_id FROM mgl_page_categories WHERE `cat_id` in('45')"; 
				$this->query();
				$Cat_Data = $this->getArray();
				
				$CAT_ID= $Cat_Data['cat_id'];
			   	$this->sql = "SELECT * FROM mgl_pages WHERE `categories`= '$CAT_ID' AND `Actions`= '1' ORDER by page_id DESC"; 
					
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
			} 

			function singlePage_artical(){
						
						$SinglePage = @$_REQUEST['more']; 
						$this->sql = "SELECT * FROM mgl_pages WHERE `page_id`= '$SinglePage' AND `Actions`= '1'"; 
							$this->query();
							$this->result = $this->getArray();
							return $this->result;
					} 
				
	function get_start_limits($tablename,$pagesize)
	{
	$str="select * from $tablename where `Actions`= '1'";
	$rs=mysql_query($str);
    $totalrecords=mysql_num_rows($rs);
    $totalpages=ceil($totalrecords/$pagesize);
	$id=isset($_REQUEST["p"])?$_REQUEST["p"]:1;
	$startlimit=($id-1)*$pagesize;
	$vaue=array();
	$vaue[0]['totalpage']=$totalpages;
	$vaue[1]['startlimit']=$startlimit;
	return $vaue;
	}
	
	function get_pages_link($totalpages,$startlimit)
	{
	
	 if(@$_REQUEST['p']>0)
	   {
	   $paging="";
	   $i=$_REQUEST['p']-1;
	   if($i!=0)
	   {
	   $paging="<a href='./?page=".$_REQUEST['page']."&p=$i'>< PREV</a>";
	   }
	    $paging=$paging."&nbsp;&nbsp;";
	   }
	   
	  for($i=1;$i<=$totalpages;$i++)
	   {
	   
	   @$paging=$paging."<a href='./?page=".$_REQUEST['page']."&p=$i'>".$i."</a>";
	   @$paging=$paging."&nbsp;&nbsp;";
	   }
	  
	   if(@$_REQUEST['p']<$totalpages)
	   {
	   $i=@$_REQUEST['p']+1;
	   if(!isset($_REQUEST['p']))
	   {
	   $i=$i+1;
	   }
	   if($i!=$totalpages+1)
	   {
	     if($totalpages!=1)
	   {
	   $paging=$paging."<a href='./?page=".$_REQUEST['page']."&p=$i'>NEXT ></a>";
	   }
	   }
	   $paging=$paging."&nbsp;&nbsp;";
	   }
	
	 return @$paging;
	   
	 }
	
		
	function get_all_writerlist()
	{
		$tablename="mgl_writers";
		$pagesize=9;
		$startlimit=theme::get_start_limits($tablename,$pagesize);
		$page_link=theme::get_pages_link($startlimit[0]['totalpage'],$startlimit[1]['startlimit']);
		$start=$startlimit[1]['startlimit'];
	$this->sql = "SELECT * FROM mgl_writers WHERE `Actions`= '1' order by writer_id desc limit $start,$pagesize"; 
					$this->query();
					$this->result = $this->loadAssoc();
					$val=array();
					$val[0]['result']=$this->result;
					$val[1]['page_link']=$page_link;
					return $val;
					//return $this->result;
	}	
	
 function checkwriterlogged($id)
	{
		
		$this->sql = "SELECT * FROM mgl_writers WHERE `writer_id`= '$id' ";
		
		$this->query();
		$this->result = $this->loadAssoc();
		
		return $this->result;
	} 
	
	
	
	function get_royality_prices($id)
	{
	$this->sql = "SELECT sum(`book_qty`) as quantities,sum(`writer_amt`) as totals FROM mgl_sell_books WHERE `writer_id`= '$id' and `writer_amt`!='0.00'"; 
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
	}
	function get_booksstart_limits($tablename,$pagesize)
	{
	$str="select * from $tablename where `party_id`= '0' and `Actions`= '1'";
	$rs=mysql_query($str);
    $totalrecords=mysql_num_rows($rs);
    $totalpages=ceil($totalrecords/$pagesize);
	$id=isset($_REQUEST["p"])?$_REQUEST["p"]:1;
	$startlimit=($id-1)*$pagesize;
	$vaue=array();
	$vaue[0]['totalpage']=$totalpages;
	$vaue[1]['startlimit']=$startlimit;
	return $vaue;
	}
	function get_all_bookslist()
	{
	$tablename="mgl_books_info";
		$pagesize=9;
		$startlimit=theme::get_booksstart_limits($tablename,$pagesize);
		$page_link=theme::get_pages_link($startlimit[0]['totalpage'],$startlimit[1]['startlimit']);
		$start=$startlimit[1]['startlimit'];
		$this->sql = "SELECT * FROM mgl_books_info WHERE `party_id`= '0' ORDER by book_id DESC limit $start,$pagesize"; 
					$this->query();
					$this->result = $this->loadAssoc();
					$val=array();
					$val[0]['result']=$this->result;
					$val[1]['page_link']=$page_link;
					return $val;
					
					
	/*$this->sql = "SELECT * FROM mgl_books_info WHERE `party_id`= '0' ORDER by book_id DESC"; 
					
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;*/
	}	
		function get_particular_writer($id)
		{
		$this->sql = "SELECT writer_name FROM mgl_writers WHERE `writer_id`= '$id'"; 
					
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
		}	
			function page_content(){
			
			
						//$session = new session();
						//$idUser = @$session->getVar("userAccountID");
										
						$pageid = @$_REQUEST['pageid'];
						$this->sql = "SELECT * FROM  mgl_pages WHERE `page_id` in('$pageid')"; 
						$this->query();
						
							$this->result = $this->loadAssoc();
							return $this->result;
					} 
	
		function country(){
	
	
				//$session = new session();
				//$idUser = @$session->getVar("userAccountID");
								
				$pageid = @$_REQUEST['pageid'];
				$this->sql = "SELECT * FROM country"; 
				$this->query();
				
					$this->result = $this->loadAssoc();
					return $this->result;
			} 
			
	function getHomeBannerVideo(){
		$config_var = new config();
		$banner = '';
		$this->qry = "SELECT * FROM mgl_homepage WHERE home_id = '1' ";
		$this->sql = $this->qry;
		$this->query();
		$homeData =  $this->getArray(); 
		$pointList = unserialize($homeData['home_list']);
		$pointList_headling = $pointList['listTitle'];
		$pointList_description =  $pointList['listDesc'];
		$video_link = $homeData['home_video'];
		$video_settings = unserialize($homeData['other_settings']);
		
		$youtubeId = explode("/",$video_link);
		$youtubeId = explode("/",$youtubeId[3]);
		$youtubeId = explode("=",$youtubeId[0]);
		$youtubeId = explode("&",$youtubeId[1]);
		$youtubeId = $youtubeId[0];
		
		if($video_settings['isPlay'] == 1){
			$VideoUrl ='http://www.youtube.com/v/'.$youtubeId.'&autoplay=1&loop=1';}
		else{$VideoUrl ='http://www.youtube.com/v/'.$youtubeId;}  
		
		$banner .='<div class="banner"> 
         	   <div class="clear pT10" style="height:60px;">
               		<h1>'.ucfirst($homeData['home_heading']).'</h1>
               </div>  
               <div class="video"> <embed width="'.$video_settings['video_width'].'" height="'.$video_settings['video_height'].'" wmode="transparent" type="application/x-shockwave-flash" src="'.$VideoUrl.'"></div> 
    		<div class="fr">
                   <ul class="Check fr">';
				    for($i=1;$i<=5;$i++){
                        $banner .='<li><span class="Label">'.ucfirst($pointList_headling[$i]).'</span>'.ucfirst($pointList_description[$i]).'</li>';
						}
             
			 $banner .='</ul>
                   <span class="clear get_start fr"><a href="'.$config_var->WEB_URL.'#signup" class=""><img src="'.$config_var->WEB_TPL_URL.'images/get_start.png" alt="#" width="275" height="49" border="0"/></a></span>
             </div>
         </div>';
		 return $banner;
		}
function checkwriter()
{
$writername=trim($_REQUEST['writername']);
$writerpwd=md5(@$_REQUEST['writerpwd']);
$str="select writer_id from mgl_writers where writer_name='$writername' and `Actions`= '1' and pwd='$writerpwd'";
$rs=mysql_query($str);
$val=mysql_num_rows($rs);
	if($val==1)
	{
	$row=mysql_fetch_array($rs);
	$_SESSION['special_writerid']=$row['writer_id'];
	return $row['writer_id'];
	}
	else
	{
	return 0;
	}
}	
function get_particular_writerlist($id)
	{
	$this->sql = "SELECT * FROM mgl_writers WHERE writer_id=$id"; 
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
					//return $this->result;
	}
	function get_all_bookslist_writer($id){
	$tablename="mgl_books_info";
		$pagesize=9;
		$startlimit=theme::get_booksstart_limitsforwriters($tablename,$pagesize,$id);
		$page_link=theme::get_pages_link($startlimit[0]['totalpage'],$startlimit[1]['startlimit']);
		$start=$startlimit[1]['startlimit'];
		$this->sql = "SELECT * FROM mgl_books_info WHERE royality_writer_id=$id ORDER by book_id DESC limit $start,$pagesize"; 
					$this->query();
					$this->result = $this->loadAssoc();
					$val=array();
					$val[0]['result']=$this->result;
					$val[1]['page_link']=$page_link;
					return $val;
	}	
	function get_numberofbooks_sold($writerid,$bookid){
	$row=mysql_fetch_array(mysql_query("SELECT sum(book_qty) as quantity FROM `mgl_sell_books` WHERE `writer_id`=$writerid and `book_id`=$bookid group by book_id"));
	return $row['quantity'];
	}
	function get_numberofbooks_amount($writerid,$bookid){
	$row=mysql_fetch_array(mysql_query("SELECT sum(writer_amt) as writerroyality FROM `mgl_sell_books` WHERE `writer_id`=$writerid and `book_id`=$bookid group by book_id"));
	return $row['writerroyality'];
	}
	function get_state($id){
	$str="select * from mgl_states where state_id=$id";
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);	
	return $row["state"];
	}
	function get_district($id){
	$str="select * from mgl_districts where distict_id=$id";
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	return $row["district"];
	}
	function get_writer_name($id){
	$str="select * from mgl_writers where writer_id=$id";
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	return $row["writer_name"];
	}
	function get_booksstart_limitsforwriters($tablename,$pagesize,$id)
	{
	$str="select * from $tablename where royality_writer_id=$id and `Actions`= '1'";
	$rs=mysql_query($str);
    $totalrecords=mysql_num_rows($rs);
    $totalpages=ceil($totalrecords/$pagesize);
	$id=isset($_REQUEST["p"])?$_REQUEST["p"]:1;
	$startlimit=($id-1)*$pagesize;
	$vaue=array();
	$vaue[0]['totalpage']=$totalpages;
	$vaue[1]['startlimit']=$startlimit;
	return $vaue;
	}
function getAweber_form(){
	$user_blog= isset($_GET['userblog'])?$_GET['userblog']:'';
	if(isset($user_blog) && $user_blog !=''){
		$this->sql = "SELECT * FROM mgl_users WHERE `site_domain`= '$user_blog'"; 
		$this->query();
		$this->result = $this->getArray();
		$user_id = $this->result['user_id'];
	}else{
		$user_id = 1;
	}
	$this->sql = "SELECT * FROM mgl_aweber WHERE aweber_user_id  = '$user_id' ";
	$this->query();
	$this->_resultSet =  $this->getArray();
	$var = unserialize($this->_resultSet['aweber_form_var']);
	$aweberForm = '<form method="post" action="'.$var['action'].'" target="_blank" onsubmit="return doSubmit();">
	<input type="hidden" name="meta_web_form_id" value="'.$var['meta_web_form_id'].'" />
	<input type="hidden" name="meta_split_id" value="'.$var['meta_split_id'].'" />
	<input type="hidden" name="listname" value="'.$var['listname'].'" />
	<input type="hidden" name="redirect" value="'.$var['redirect'].'" id="redirect_a560f33f51245f63f32371a99b145ce3" />
	<input type="hidden" name="meta_adtracking" value="'.$var['meta_adtracking'].'" />
	<input type="hidden" name="meta_redirect_onlist" value="'.$var['meta_redirect_onlist'].'" />
	<input type="hidden" name="meta_message" value="1" />
	<input type="hidden" name="meta_required" value="'.$var['meta_redirect_onlist'].'" />
	<input type="hidden" name="meta_tooltip" value="'.$var['meta_required'].'" />
	 <input type="text" class="access_text_box"  value="Enter email" name="email" onfocus="clearfield()" id = "email" />
     <input type="submit" class="access_btn"  value=""/>
	</form>';
	
		
	return $aweberForm ;
}		
		
		
}

$theme = new theme();
?>
<script>
	function doSubmit(){
	
	email = $('#email').val();
	    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		if(email=='Enter email')
		{
		  alert('Please enter the email address');
		   return false;
		}else if(email == '') {
		alert('Please enter the valid email');
        return false;
	    } else if( !emailReg.test( email ) ) {
		alert('Please enter the valid email');
        return false;
	    } else {
	        return true;
	    }

	
	}
	
	
	</script>
<script>
function clearfield(){
 if($('#email').val()=='Enter email'){
  $('#email').val('');
 }
}
</script>
<?php 
if(isset($_REQUEST['create_session']) && $_REQUEST['create_session']='writers'){
$theme2 = new theme();
$value=$theme2->checkwriter();
if($value!=0)
{
header('location:./?page=writerlist');
}
else
{
header('location:./?page=writerlist&r=1');
}
}

/*if(isset($_REQUEST['destroy_session']) && $_REQUEST['destroy_session']='writers'){
echo "jshrjsm";
die;
unset($_SESSION['special_writerid']);
header('location:./?page=writerlist');

}*/

?>