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
?>
<div class="MainWraper">
<div class="body_wrapper">
  <div id="breadcrumb" class="breadcrumb">
    <ul class="floatcontainer">
        <li class="navbithome"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default" accesskey="1"><img title="Home" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/navbit-home.png" alt="Home"></a></li>
      <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default">Forum</a></li>
      <li class="navbit" <?php if(!isset($_REQUEST['sub_cat']) && empty($_REQUEST['sub_cat'])){?>style="background-image:none;" <?php }?>><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $_REQUEST['id'];?>"><?php echo ucfirst($getCatById[0]['cat_name']);?></a></li>
    <?php if(isset($_REQUEST['sub_cat']) && !empty($_REQUEST['sub_cat'])){?>  <li class="navbit lastnavbit"><span><?php echo ucfirst($getSubCatById[0]['sub_cat_name']);?></span></li> <?php }?>
    </ul>
    <hr>
  </div>
  
  <!-- Start worldsextraveler Programming -->
  <div class="isg_background_border_banner" align="center" style="margin-bottom: 10px;margin-top: 10px;"> 
    <!--<font color=red><b>[Add Invocation Code for Banner #2 Here]</b></font>--> 
    
  </div>
  <!-- End worldsextraveler Programming -->
  
  <div id="content_container" style="float:left;padding-top:0px;">
    <div id="content">
      <div id="pagetitle" class="pagetitle" style="width:100%;"> 
        
        <!-- Start worldsextraveler Programming -->
        <h1>Forum: <span class="forumtitle"><?php echo ucfirst($getSubCatById[0]['sub_cat_name']);?></span></h1>
        <p class="description"><?php echo @implode(", ",$getForumSubCatById);?></p>
        <div id="above_threadlist" style="float:right;vertical-align:top; width:100%;">
         <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){ ?> <div style="float:left;margin-top:5px;"> <a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=newthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>" rel="nofollow" style="margin-top:5px" class="newcontent_textcontrol" id="newthreadlink_top"><span>+</span> Post New Thread</a> </div> <?php }?>
          </div>
      </div>
      
      <!--<font color=red><b>[Add Invocation Code for Banner #9 Here]</b></font>--> 
      
      <!-- End worldsextraveler Programming -->
      
      
      <div id="threadlist" class="threadlist">
          <h2 class="hidden">Threads in This Forum</h2>
          <div> 
            
            <!-- worldsextraveler Programming start -->
            <div class="worldsextraveler_wideheader" style="width:100%;text-align:center;font-size:medium;"> <b>Main Forum Threads</b> </div>
            <!-- worldsextraveler Programming end -->
            <div class="threadlisthead table">
              <div> <span class="threadinfo"> <span class="threadtitle" style="margin-left:47px;"> 
                <!-- Begin worldsextraveler Changes --> 
                <a href="#" rel="nofollow">Thread Title</a> 
                <!-- End worldsextraveler Changes --> 
                </span> </span> 
                
                <!-- Begin worldsextraveler Changes --> 
                <span class="threadstats td"><a href="#" rel="nofollow">Reports</a></span> 
                <!-- Begin worldsextraveler Changes --> 
                <span class="threadlastpost td"><a href="#" rel="nofollow">Last Report By<img title="Reverse Sort Order" class="sortarrow" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/sortarrow-asc.png" alt="Reverse Sort Order" border="0"> </a></span> </div>
            </div>
            <ol id="stickies" class="stickies">
             <?php for($i=0;$i<count($getMainForumById);$i++)
			 { 
			 $getMainPostById=$model->getMainPostById($getMainForumById[$i]['topic_id']);
			 if(!empty($getMainForumById[$i]['topic_by']))
			 {
			 	$getUserName=$model->getUserName($getMainPostById[0]['post_by']);
				$username=$getUserName[0]['first_name']." ".$getUserName[0]['last_name'];
			 }
			 else
			 {
			 	$username="Admin";
			 }
			 
			 $getAllPostSubCatById = $model->getAllPostSubCatById($getMainForumById[$i]['topic_id']);
			 
			 ?>
			  <li class="threadbit " id="<?php echo $getMainForumById[$i]['topic_id'];?>">
                <div class="rating0 sticky">
                  <div class="threadinfo" title=""> 
                    <!--  status icon block --> 
                    <a class="threadstatus" rel="vB::AJAX"></a> 
                    
                    <!-- title / author block -->
                    <div class="inner">
                      <div>
                        <h3 class="threadtitle"> <a class="title" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=showthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>&topic_id=<?php echo $getMainForumById[$i]['topic_id'];?>" id="thread_title_2141"><?php echo $getMainForumById[$i]['topic_title'];?></a> </h3>
                      </div>
                      <div class="threadmeta">
                        <p class="threaddesc"></p>
                        <div class="author"> </div>
                      </div>
                    </div>
                    <!-- iconinfo -->
                    <div class="threaddetails td" style="margin-top:10px;">
                      <div> </div>
                    </div>
                  </div>
                  <!-- threadstats -->
                  
                  <ul class="threadstats td alt" title="">
                    <li><a href="#" onclick="who('<?php echo $getMainForumById[$i]['topic_id'];?>','<?php echo $getMainForumById[$i]['topic_title'];?>'); return false;" class="understate"><?php echo count($getAllPostSubCatById);?></a> Reports</li>
                  </ul>
                  
                  <!-- lastpost -->
                  <div class="threadlastpost td">
                    <div class="lastpostby hidden">Last Report By</div>
                    <div style="float:left; margin-top:5px !important;">
                      <div id="yui-gen15" class="popupmenu memberaction"> <strong><?php echo $username;?></strong>
                      </div>
                    </div>
                    <div style="float:left;margin-left:10px; margin-top:6px;"><?php if(!empty($getMainPostById[0]['post_date'])){ echo date("d-m-Y H:i",strtotime($getMainPostById[0]['post_date']));}?> </div>
                  </div>
                  <div id="archives_2141" style="clear:all;float:left;width:100%;margin-bottom:10px;margin-top:-10px;display:none;"> </div>
                </div>
              </li>
			 <?php }?>
            </ol>
            
            <!-- worldsextraveler Programming start -->
            <div class="worldsextraveler_wideheader" style="width:100%;text-align:center;font-size:medium;">
              <div style="font-size:5px;">&nbsp;</div>
              <?php if(count($DataSet['result'])>0){?> <b>User Threads</b> </div> 
            <div class="threadlisthead table">
              <div> <span class="threadinfo"> <span class="threadtitle" style="margin-left:50px;"> 
                <!-- Begin worldsextraveler Changes --> 
                <a href="#" rel="nofollow">Thread Title</a> 
                <!-- End worldsextraveler Changes --> 
                </span> </span> 
                
                <!-- Begin worldsextraveler Changes --> 
                <span class="threadstats td"><a href="#" rel="nofollow">Reports</a></span> 
                <!-- Begin worldsextraveler Changes --> 
                <span class="threadlastpost td"><a href="#" rel="nofollow">Last Report By<img title="Reverse Sort Order" class="sortarrow" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/sortarrow-asc.png" alt="Reverse Sort Order" border="0"> </a></span> </div>
            </div><?php }?>
            <!-- worldsextraveler Programming end -->
            <ol id="threads" class="threads">
			 <?php if(count($DataSet['result'])>0){?>
                    	<?php for($j=0; $j<count($DataSet['result']); $j++){	
							$getAllPostSubCatById = $model->getAllPostSubCatById($DataSet['result'][$j]['topic_id']);
							$getAllPostImagesId = $model->getAllPostImagesId($DataSet['result'][$j]['topic_id']);
							$username="";
							if($getAllPostSubCatById[0]['post_by']!=0)
							{
								$getUserName=$model->getUserName($getAllPostSubCatById[0]['post_by']);
								$username=$getUserName[0]['first_name']." ".$getUserName[0]['last_name'];
							}
							
						?>
              <li class="threadbit  attachments" id="thread_374">
                <div class="rating0 nonsticky">
                  <div class="threadinfo" title=""> 
                    <!--  status icon block --> 
                    <a class="threadstatus" rel="vB::AJAX"></a> 
                    
                    <!-- title / author block -->
                    <div class="inner">
                      <div>
                        <h3 class="threadtitle"> <a class="title" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=showthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>&topic_id=<?php echo $DataSet['result'][$j]['topic_id'];?>" id="thread_title_374"><?php echo ucfirst($DataSet['result'][$j]['topic_title']);?></a> </h3>
                      </div>
                      <div class="threadmeta">
                        <p class="threaddesc"></p>
                        <div class="author"> </div>
                      </div>
                    </div>
                    <!-- iconinfo -->
                    <div class="threaddetails td" style="margin-top:10px;">
                      <div> <span class="understate"><?php echo count($getAllPostImagesId);?> photos</span> </div>
                    </div>
                  </div>
                  <!-- threadstats -->
                  
                  <ul class="threadstats td alt" title="">
                    <li><span class="understate"><?php echo count($getAllPostSubCatById);?> Reports</span></li>
                  </ul>
                  
                  <!-- lastpost -->
                  <div class="threadlastpost td">
                    <div class="lastpostby hidden">Last Report By</div>
                    <div style="float:left; margin-top:5px !important;">
                      <div id="yui-gen18" class="popupmenu memberaction"> <strong><?php echo ucfirst($username);?></strong>
                        
                      </div>
                    </div>
                    <div style="float:left;margin-left:10px; margin-top:6px;"> <?php if(!empty($getAllPostSubCatById[0]['post_date'])){ echo date("d-m-Y H:i",strtotime($getAllPostSubCatById[0]['post_date']));}?>  </div>
                  </div>
                  <div id="archives_374" style="clear:all;float:left;width:100%;margin-bottom:10px;margin-top:-10px;display:none;"> </div>
                </div>
              </li>
			  
			  <?php } }?>
              
            </ol>
          </div>
          <hr>
          <div class="noinlinemod forumfoot">
           <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){ ?> <div id="below_threadlist" style="float:left;clear:right;" class="noinlinemod below_threadlist"> <a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=newthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>" rel="nofollow" class="newcontent_textcontrol" id="newthreadlink_bottom"><span>+</span> Post New Thread</a>
              <div class="threadpagenav" style="clear:both;float:right;margin-left:10px">
                <table cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td><?php print $DataSet['nav'];?></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> <?php }?>
          </div>
      </div>
      
    </div>
  </div>
  
  <!-- Start worldsextraveler Programming -->
  <div class="isg_background_border_banner" style="margin-left: 10px; margin-bottom:10px; margin-top:0px; height:830px; border:1px solid #222; width: 180px; float: right;" align="center"> 
    <!--<font color=red><b>[Add Invocation Code<br>for Banner #8 Here]</b></font>--> 
  </div>
  <!-- End worldsextraveler Programming --> 
  
  <!-- Start worldsextraveler Programming -->
  <div class="isg_background_border_banner" style="float:left;width:100%;margin-bottom:10px;" align="center"> 
    <!--<font color=red><b>[Add Invocation Code for Banner #6 Here]</b></font>--> 
    
  </div>
  <!-- End worldsextraveler Programming --> 
  
</div>
<div class="clr"></div>
</div>
