<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;
$getCatById=$model->getCatById($_REQUEST['id']);
if(isset($_REQUEST['sub_cat']) && !empty($_REQUEST['sub_cat']))
{
$getSubCatById=$model->getSubCatById($_REQUEST['sub_cat']);
$getForumSubCatById=$model->getForumSubCatById($_REQUEST['sub_cat']);
$getMainForumById = $model->getMainForumById($_REQUEST['sub_cat']);
}

$getTopicById = $model->getTopicById($_REQUEST['topic_id']);
$getAllTopicImagesId = $model->getAllTopicImagesId($_REQUEST['topic_id']);
?>
<div class="body_wrapper">
  <div id="breadcrumb" class="breadcrumb">
    <ul class="floatcontainer">
        <li class="navbithome"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default" accesskey="1"><img alt="Home" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/navbit-home.png" title="Home"></a></li>
      <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default">Forum</a></li>
      <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $_REQUEST['id'];?>"><?php echo ucfirst($getCatById[0]['cat_name']);?></a></li>
     <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>"><?php echo ucfirst($getSubCatById[0]['sub_cat_name']);?></a></li>
      <li class="navbit lastnavbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=detail&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>"><?php echo ucfirst($getTopicById[0]['topic_title']);?></a></li>
    </ul>
    <hr>
  </div>
  
  <!-- Start worldsextraveler Programming -->
  <div align="center" style="margin-bottom: 10px;margin-top: 10px;" class="isg_background_border_banner"> 
    <!--<font color=red><b>[Add Invocation Code for Banner #2 Here]</b></font>--> 
    
  </div>
  <!-- Start wst Programming --> 
  
  <!-- Start worldsextraveler Programming -->
  <div style="float:left;padding-top:0px;" id="content_container">
    <div id="content">
      <div style="margin-top:0px!important;" class="pagetitle" id="pagetitle">
        <h1> Thread: <span class="threadtitle"><a title="Reload this Page" href="#"><?php echo $getTopicById[0]['topic_title'];?></a></span> </h1>
		<div class="postlist restrain" id="postlist">
        <ol start="1" class="posts" id="posts">
         <?php if(count($getTopicById)>0){?>
                    	<?php $a=1;for($s=0; $s<count($getTopicById); $s++){	$count=$s+$a;
						if(!empty($DataSet['result'][$j]['post_by']))
						 {
							$getUserName=$model->getUserName($$getTopicById[$s]['topic_by']);
							$username=$getUserName[0]['first_name']." ".$getUserName[0]['last_name'];
						 }
						 
						 $getTotalPost=$model->getTotalPost($getTopicById[$s]['post_by']);
						 $getAllPostImagesId=$model->getAllPostImagesId($getTopicById[$s]['post_id']);
						 
						?>
		  <li id="post_771752" class="postbitlegacy postbitim postcontainer"> 
            <!-- see bottom of postbit.css for .userinfo .popupmenu styles -->
            
            
            <div class="postdetails">
              
              <div>
                <div class="postrow">
                  <div>
                    <div id="post_message_771752" class="restore"><?php echo nl2br($getTopicById[$s]['topic_desc']);?></div>
					<br/>
					<div><?php for($k=0;$k<count($getAllTopicImagesId);$k++)
					{
					?>
							<a href="#" onclick="attachments('<?php echo $config_var->WEB_URL?>/showimage.php?image=<?php echo $config_var->UPLOAD_URL."forum/";?><?php echo $getAllTopicImagesId[$k]['image_name'];?>','<?php echo $getTopicById[$s]['post_title'];?>')" ><img src="<?php echo $config_var->UPLOAD_URL."forum/thumbnail/";?><?php echo $getAllTopicImagesId[$k]['image_name'];?>" width="80" height="80" style="border: 2px solid #666666" /></a>
					<?php }?> </div>
                  </div>
                </div>
                <div class="cleardiv"></div>
              </div>
            </div>
          </li>
          <?php } }?>
        </ol>
      </div>
	  
        <div style="margin-bottom:5px;" class="above_postlist" id="above_postlist"><?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){ ?> <a id="newreplylink_top" class="newcontent_textcontrol" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=post&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>&topic_id=<?php echo $_REQUEST['topic_id'];?>"><span>+</span> Add Report</a> <img alt="" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/progress.gif" id="progress_newreplylink_top" style="display:none"> <?php }?>
          <div style="margin-top:15px;" class="pagination_top" id="pagination_top">
            <div class="postpagestats" id="postpagestats_above"> <?php print $DataSet['nav'];?></div>
          </div>
        </div>
      </div>
      <div>&nbsp;</div>
      <!--<font color=red><b>[Add Invocation Code for Banner #9 Here]</b></font>--> 
      
      <!-- Start wst Programming -->
      <div class="postlist restrain" id="postlist">
        <ol start="1" class="posts" id="posts">
         <?php if(count($DataSet['result'])>0){?>
                    	<?php $a=1;for($j=0; $j<count($DataSet['result']); $j++){	$count=$j+$a;
						if(!empty($DataSet['result'][$j]['post_by']))
						 {
							$getUserName=$model->getUserName($DataSet['result'][$j]['post_by']);
							$username=$getUserName[0]['first_name']." ".$getUserName[0]['last_name'];
						 }
						 
						 $getTotalPost=$model->getTotalPost($DataSet['result'][$j]['post_by']);
						 $getAllPostImagesId=$model->getAllPostImagesId($DataSet['result'][$j]['post_id']);
						 
						?>
		  <li id="post_771752" class="postbitlegacy postbitim postcontainer"> 
            <!-- see bottom of postbit.css for .userinfo .popupmenu styles -->
            
            <div class="posthead"> <span class="postdate old"> <span class="date"><?php echo date('d-m-y H:i',strtotime($DataSet['result'][$j]['post_date']));?></span> </span> <span class="nodecontrols"> <a class="postcounter" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=showthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>&topic_id=<?php echo $_REQUEST['topic_id'];?>#post<?php echo $count;?>" name="post<?php echo $count;?>">#<?php echo $count;?></a><a name="2" id="postcount771752"></a> </span> </div>
            <div class="postdetails">
              <div class="userinfo">
                <div class="username_container">
                  <div class="popupmenu memberaction" id="yui-gen15"> <a title="<?php echo ucfirst($username);?>" href="#" class="username offline popupctrl" id="yui-gen17"><strong><?php echo ucfirst($username);?></strong></a>
                    
                  </div>
                  </div>
                <dl class="userinfo_extra">
                  <dt>Reports</dt>
                  <dd><?php echo count($getTotalPost);?></dd>
                </dl>
                
                <!-- Start worldsextraveler Programming --> 
                <br>
                <br>
                <br>
                
                <!-- Start wst Programming --> 
              </div>
              <div class="postbody">
                <div class="postrow">
                  <h2 class="title icon"> <?php echo $DataSet['result'][$j]['post_title'];?> </h2>
                  <div>
                    <div id="post_message_771752" class="restore"><?php echo nl2br($DataSet['result'][$j]['post_content']);?></div>
					<div><?php for($i=0;$i<count($getAllPostImagesId);$i++)
					{
					?>
							<a href="#" onclick="attachments('<?php echo $config_var->WEB_URL?>/showimage.php?image=<?php echo $config_var->UPLOAD_URL."forum/";?><?php echo $getAllPostImagesId[$i]['image_name'];?>','<?php echo $DataSet['result'][$j]['post_title'];?>')" ><img src="<?php echo $config_var->UPLOAD_URL."forum/thumbnail/";?><?php echo $getAllPostImagesId[$i]['image_name'];?>" width="100" height="100" style="border: 2px solid #666666" /></a>
					<?php }?> </div>
                  </div>
                </div>
                <div class="cleardiv"></div>
              </div>
            </div>
            <div class="postfoot"> 
              <!-- <div class="postfoot_container"> -->
              <div class="textcontrols floatcontainer"> <?php /*?><span class="postcontrols"> <img alt="" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/progress.gif" id="progress_771752" style="display:none"> <a rel="nofollow" href="newreply.php?do=newreply&amp;p=771752" class="newreply" id="qrwq_771752">Reply With Quote</a> <span class="seperator">&nbsp;</span> <?php */?>
                <!-- </div> --> 
              </div>
            </div>
            <hr>
          </li>
          <?php } }else{?><li id="post_771752" class="postbitlegacy postbitim postcontainer">
		  <div class="posthead"> <span class="postdate old"> <span class="date">Posts</span> </span> <span class="nodecontrols"> </span> </div>
            <div class="postdetails">
            <div class="postdetails" style="font-weight:bold;" align="center"><strong>No Records Exist!</strong></div>
           </div> 
            <hr>
          </li>
		  
		  <?php }?>
        </ol>
        <div class="separator"></div>
        <div class="postlistfoot"> </div>
      </div>
     <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){ ?> <div class="noinlinemod below_postlist" id="below_postlist"> <a id="newreplylink_bottom" class="newcontent_textcontrol" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=post&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>&topic_id=<?php echo $_REQUEST['topic_id'];?>"><span>+</span> Add Report</a>
        <div class="pagination_bottom" id="pagination_bottom"> </div>
      </div>
	  <?php }?>
      
      
      <?php print $DataSet['nav'];?>
      
      
    </div>
  </div>
  <div align="center" style="margin-left: 10px; margin-bottom:10px; margin-top:0px; height:1230px; width: 180px; float: right;" class="isg_background_border_banner"> 
    <!--<font color=red><b>[Add Invocation Code<br>for Banner #8 Here]</b></font>--> 
    
  </div>
  <!-- Start wst Programmng --> 
  
  <!-- Start worldsextraveler Programming -->
  <div align="center" style="float:left;width:100%;margin-bottom:10px;" class="isg_background_border_banner"> 
    <!--<font color=red><b>[Add Invocation Code for Banner #6 Here]</b></font>--> 
    
  </div>
  <!-- Start wst Programming --> 
  
</div>
