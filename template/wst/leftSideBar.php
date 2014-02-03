<div id="Leftcolumn">
<?php global $config_var; ?>
<?php if(isset($_REQUEST['pageid']) && @$_REQUEST['pageid'] != ''){ 

 $theme = new theme(); $Title = $theme->getcatID($_REQUEST['pageid']);
  ?>
                        
                        
                        <div class="columnhead" style="background-color:#FFFFFF;color:#333333;font-family:Tahoma;font-size:16px;font-weight:normal;font-style:normal;font-variant:small-caps;border-bottom:solid 1px #CECECE;">This Month In <?php echo ucfirst($Title['cat_name']); ?></div>
                        <ul class="detaillist">
                         <?php  $catid = $Title['cat_id']; $theme = new theme(); $pageDetails = $theme->pagedetails($catid); 
						     for($d=0;$d<count($pageDetails);$d++){ ?>
                            <li><a style="color:#375779;" href="<?php echo $config_var->WEB_URL.'?userblog='.$_REQUEST['userblog'].'&pageid='.$pageDetails[$d]['page_id']; ?>" title="<?php echo ucfirst($pageDetails[$d]['page_title']); ?>"><?php echo ucfirst($pageDetails[$d]['page_title']);  ?></a></li>
                            <div class="description">
                            
                            <?php if($pageDetails[$d]['page_image'] != ''){ ?><img src="<?php echo $config_var->UPLOAD_URL.'user/thumb/'.$pageDetails[$d]['page_image']; ?>" /><?php } ?>
                            <?php 
							$desc = addslashes($pageDetails[$d]['page_content']);
							if(strlen($desc) >200){ echo substr(strip_tags($desc),0,200)."[...]"; } else { echo $desc; } ?>
                             </div><a href="<?php echo $config_var->WEB_URL.'?userblog='.$_REQUEST['userblog'].'&pageid='.$pageDetails[$d]['page_id']; ?>" title="<?php echo ucfirst($pageDetails[$d]['page_title']); ?>">Read &gt;&gt;</a>
    						<?php } ?>
 						</ul>
<?php } else { ?>
						<?php $theme = new theme(); $leftbarTitle = $theme->leftsideBar();
                        for($l=0;$l<count($leftbarTitle);$l++){ ?>
                        
                                      <div  class="columnhead">Your <?php echo ucfirst($leftbarTitle[$l]['cat_name']); ?></div>
                                      <ul class="indexlist">
                                                    <?php  $cat_id = $leftbarTitle[$l]['cat_id']; $theme = new theme(); $leftbarLinks = $theme->leftsideLinks($cat_id); 
                                                    for($s=0;$s<count($leftbarLinks);$s++){
                                                    //echo "<pre>"; print_r($leftbarLinks);
                                                     ?>
                                                    <li><a href="<?php echo $config_var->WEB_URL.'?userblog='.$_REQUEST['userblog'].'&pageid='.$leftbarLinks[$s]['page_id']; ?>" title="<?php echo ucfirst($leftbarLinks[$s]['page_title']); ?>"><?php echo ucfirst($leftbarLinks[$s]['page_title']); ?></a></li>
                                                    <?php  } ?>
                                          </ul>
<?php       }                } ?>
                      

                          <div style="">
                          <div class="columnhead">Health and Fitness News</div>
                          <ul class="indexlist">
                            <li><a href="javascript:;">Hormones &amp; Weight Loss</a></li>
                            <li><a href="javascript:;">Mediterranean Diet and Fertility</a></li>
                            <li><a href="javascript:;">Liposuction Helps Hearts</a></li>
                            <li><a  href="javascript:;">Is the Flu Shot Effective?</a></li>
                          </ul>
                          </div>
</div>