<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;
$getCatById=$model->getCatById($_REQUEST['id']);
$getSubCatById=$model->getSubCatById($_REQUEST['id']);

?>
<div class="MainWraper">
<div class="body_wrapper">
  <div id="breadcrumb" class="breadcrumb">
    <ul class="floatcontainer">
      <li class="navbithome"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default" accesskey="1"><img title="Home" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/navbit-home.png" alt="Home"></a></li>
      <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default">Forum</a></li>
      <li class="navbit" <?php if(!isset($_REQUEST['sub_cat']) && empty($_REQUEST['sub_cat'])){?>style="background-image:none;" <?php }?>><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $_REQUEST['id'];?>"><?php echo ucfirst($getCatById[0]['cat_name']);?></a></li>
    <?php if(isset($_REQUEST['sub_cat']) && !empty($_REQUEST['sub_cat'])){?>  <li class="navbit lastnavbit"><span>Alberta</span></li> <?php }?>
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
        <h1>Forum: <span class="forumtitle"><?php echo ucfirst($getCatById[0]['cat_name']);?></span></h1>
        <p class="description"><?php for($j=0; $j<count($getSubCatById); $j++){ $sub_category[] = ucfirst($getSubCatById[$j]['sub_cat_name']); } echo implode(", ",$sub_category);?></p>
        <div id="above_threadlist" style="float:right;vertical-align:top; width:100%;">
          <div class="threadpagenav" style="float:right;margin-left:10px">
            <table style="margin-top:20px;" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td><?php print $DataSet['nav'];?></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
     <div id="threadlist" class="threadlist">
          <div> 
            <div class="worldsextraveler_wideheader" style="width:100%;text-align:center;font-size:medium;">
               <div class="threadlisthead table">
              <div> <span class="threadinfo" style="width:12%"> <span class="threadtitle" style="margin-left:0px;"> 
                <!-- Begin worldsextraveler Changes --> 
               	<span style="color:#FFFFFF">Sub-Forums</span>
                <!-- End worldsextraveler Changes --> 
                </span> </span> 
                 <!-- Begin worldsextraveler Changes --> 
               </div>
            </div>
            <!-- worldsextraveler Programming end -->
			
            <ol id="threads" class="threads">
              <?php if(count($DataSet['result'])>0){?>
                    	<?php for($j=0; $j<count($DataSet['result']); $j++){	
							
							$getForumSubCatById=$model->getForumSubCatById($DataSet['result'][$j]['sub_cat_id']);
							$getAllForumSubCatById = $model->getAllForumSubCatById($DataSet['result'][$j]['sub_cat_id']);
							$getAllPostSubCatById = $model->getAllPostSubCatById($DataSet['result'][$j]['sub_cat_id']);
							if($getAllForumSubCatById[0]['topic_by']==0)
							{
								$username="Admin";
							}
							else
							{
								$getUserName=$model->getUserName($getAllForumSubCatById[0]['topic_by']);
								$username=$getUserName[0]['first_name']." ".$getUserName[0]['last_name'];
							}
						?>
			  					<li class="threadbit  attachments" id="thread_374">
                <div class="rating0 nonsticky">
                  <div class="threadinfo" title="" style="width:58%"> 
                    <!--  status icon block --> 
                    <a class="threadstatus" rel="vB::AJAX"></a> 
                    
                    <!-- title / author block -->
                    <div class="inner">
                      <div>
                        <h3 class="threadtitle" align="left" > <a class="title" href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=detail&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $DataSet['result'][$j]['sub_cat_id'];?>#<?php echo $getAllForumSubCatById[0]['topic_id'];?>" id="thread_title_374" style="font-weight:bold;"><strong><?php echo $DataSet['result'][$j]['sub_cat_name'];?></strong></a> </h3>
                      </div>
                      <div class="threadmeta">
                        <p class="threaddesc" style="overflow:visible; text-indent:1px;"><?php echo @implode(",",$getForumSubCatById);?></p>
                        <div class="author"> </div>
                      </div>
                    </div>
                    
                  </div>
                  <!-- threadstats -->
                  
                  <ul class="threadstats td alt" title="" style="width:18%; text-align:center">
                    <li>Threads: <?php echo count($getAllForumSubCatById);?></li>
                    <li>Reports: <?php echo count($getAllPostSubCatById);?></li>
                  </ul>
                  
                  <!-- lastpost -->
                  <div class="threadlastpost td">
                    <div style="float:left; margin-top:5px !important;">
                      <div id="yui-gen18" align="left" ><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=showthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $DataSet['result'][$j]['sub_cat_id'];?>&topic_id=<?php echo $getAllForumSubCatById[0]['topic_id'];?>#post1" class="title" id="thread_title_374"><?php echo ucfirst($getAllForumSubCatById[0]['topic_title']);?></a> post by <?php echo ucfirst($username);?></div>
                    </div>
                    <div style="float:left;margin-top:1px;"> <?php if(!empty($getAllForumSubCatById[0]['topic_date'])){ echo date("d-m-Y, H:i",strtotime($getAllForumSubCatById[0]['topic_date'])); } ?> </div>
                  </div>
                  <div id="archives_374" style="clear:all;float:left;width:100%;margin-bottom:10px;margin-top:-10px;display:none;"> </div>
                </div>
              </li>
             	<?php } }?>
		
            </ol>
          </div>
          <hr>
          <div class="noinlinemod forumfoot">
            <div id="below_threadlist" style="float:left;clear:right;" class="noinlinemod below_threadlist"> 
              <div class="threadpagenav" style="clear:both;float:right;margin-left:10px">
                <table cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td> <?php print $DataSet['nav'];?></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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