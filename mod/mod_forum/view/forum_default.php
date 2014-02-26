<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;

?>

<div class="MainWraper">
<div class="body_wrapper">
  <div id="breadcrumb" class="breadcrumb">
    <ul class="floatcontainer">
      <li class="navbithome"><a href="../index.php" accesskey="1"><img title="Home" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/navbit-home.png" alt="Home"></a></li>
      <li class="navbit lastnavbit"><span>Forum</span></li>
    </ul>
    <hr>
  </div>
  

  <div class="isg_background_border_banner" style="margin-bottom: 10px;margin-top: 10px;" align="center"> 

    
  </div>

  
  <div id="content_container">
    <div id="pagetitle">
      <h1>WorldSexTraveler</h1>
      <p id="welcomemessage" class="description">Welcome to the WorldSexTraveler.</p>
    </div>
    <div id="content"> 
		<?php print $DataSet['nav'];?>
	<ol id="forums" class="floatcontainer">
	  <?php if(count($DataSet['result'])>0){?>
                    	<?php for($j=0; $j<count($DataSet['result']); $j++){	
							
							$getSubCatById=$model->getSubCatById($DataSet['result'][$j]['cat_id']);
						?>
        <li class="forumbit_nopost L1" id="cat102">
          <div class="forumhead foruminfo L1 collapse">
            <h2> <span class="forumtitle"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $DataSet['result'][$j]['cat_id'];?>"><?php echo $DataSet['result'][$j]['cat_name'];?></a></span> <span class="forumlastpost">Last Report</span> <a style="display: none;" class="collapse" id="collapse_c_cat102" href="../forum.php#top"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/collapse_40b.png" alt="" title="Collapse this Category"></a> </h2>
            <div class="forumrowdata">
              <p class="subforumdescription"><?php  for($i=0; $i<count($getSubCatById); $i++){ ?><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $DataSet['result'][$j]['cat_id'];?>&sub_cat=<?php echo $getSubCatById[$i]['sub_cat_id'];?>"><u><?php echo $getSubCatById[$i]['sub_cat_name'];?></u></a><?php }?> </p>
            </div>
          </div>
        </li>
		<?php } 
		}?>
		
      </ol>
       <?php print $DataSet['nav'];?>
      
       
      

      

      
    </div>
  </div>
  

  <div class="isg_background_border_banner" style="margin-left: 10px; margin-bottom:10px; margin-top:0px; width: 180px; float: right;min-height:1230px" align="center"> 

    
  </div>
 
  

  <div class="isg_background_border_banner" style="float:left;width:100%;margin-bottom:10px;" align="center"> 

    
  </div>

  
  
</div>
<div class="clr"></div>
</div>