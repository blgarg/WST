<?php 
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;
$countries = $model->getAllCountry();
$country_name=$model->getSelectedCountry();
?>

   		<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/videos-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
			<div class="videos-search">
			<form action="" method="post">
            	<table width="100%" border="0" cellspacing="5" cellpadding="0">
                	<td width="110" valign="middle" align="right">Select Country :</td>
                    <td width="250" valign="middle">
                    	<select name="country">
                        	<option value="">---- Select ----</option>
							<?php foreach($countries as $list){?>
							<option value="<?php echo $list['id']?>" <?php if(@$_REQUEST['country']==$list['id']){?>selected="selected" <?php }?>><?php echo $list['country_name']?></option>
							<?php }?>
                        </select>
                    </td>
                    <td width="172" valign="middle" align="right">Search By Video Name :</td>
                    <td width="250" valign="middle"><input type="text" name="video_name" value="<?php echo @$_REQUEST['video_name'];?>" /></td>
                     
                    <td valign="middle">
						<input type="image" name="searchVideo" src="<?php echo $config_var->WEB_TPL_URL;?>images/search-btn.png" alt="" />
						<input type="hidden" name="search" value="1">
						</td>
                  </tr>
                </table>
			</form>	
            </div>
           
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
			<?php 
			
			if((isset($_REQUEST['country']) && $_REQUEST['country']>0) ||(isset($_REQUEST['video_name']) && $_REQUEST['video_name']!='')){?>
				<div class="b-guide-hdr"><?php if($_REQUEST['country']>0){echo $country_name[0]['country_name'];?>&nbsp;|&nbsp;<?php }echo count($DataSet['result']);?> Record found</div>
			<?php }else{?>	
            	<div class="bg-top"></div>
			<?php }?>
                <div class="bar-guide-txt">
                
                	<!--Videos Row-->
                    <div class="videos-row">
					<?php if(count($DataSet['result'])>0){?>
						<?php $j=1;for($i=0;$i<count($DataSet['result']);$i++){
							
							$data = unserialize($DataSet['result'][$i]['video_data']);
							/*echo "<pre>";
							
							print_r($data);
							echo "</pre>";*/
							
							
						?>
                    	<div class="video-outer">
                        	<div class="video">
							<a href="<?php echo $config_var->WEB_URL?>?mod=mod_video&view=detail&id=<?php echo $DataSet['result'][$i]['id'];?>">
							<img width="220" height="150" src="<?php echo $config_var->UPLOAD_URL."videos/images/".$DataSet['result'][$i]['image'];?>" alt="" /></div>
                            </a>
							<?php echo $DataSet['result'][$i]['video_title'];?>
                            <span></span>
                        </div>
                        <?php 
						
						if($j%4==0 && count($DataSet['result'])>4)
						{
							echo '</div><div class="videos-row">';
						}
						$j++;}
						
						}
						
						?>
                       
                        
                        
                    </div>                  
                 	<?php print $DataSet['nav'];?>
                 </div>
            </div>
			 <!--//Bar Guide Container--> 

            
          <div class="clr"></div>
        </div>
        <!--//Inner Text-->
        

		