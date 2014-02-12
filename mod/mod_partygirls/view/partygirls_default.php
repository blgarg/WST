<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;
$country_list = $model->getCountryList();
$country_name=$model->getCountryName();
$city = $model->getCity();
?>
<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/photos-txt.png" alt="" />
        </div>
		
        <!--Inner Text-->
        <div class="inner-txt">
			<div class="b-guide-search">
            	<form action="?mod=mod_partygirls&view=default&s=3" method="post">
				<table width="100%" border="0" cellspacing="5" cellpadding="0">
				<tr>
                    <td width="262">Select Country:</td>
                    <td width="262">Select City</td>
					<td width="262">Search By Girl Name :</td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr>
                	 <td width="250" valign="middle">
                    	<select name="country">
                        	<option value="">---- Select ----</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['id']; ?>"<?php if(@$_REQUEST['country']==$country_list[$i]['id']){?>selected="selected" <?php }?> ><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
                        </select>
                    </td>
					 <td>
                    	<select name="city">
                        	<option value="">---- Select ----</option>
							<?php foreach($city as $cityname){?>
							
							<option value="<?php echo $cityname['city']; ?>" <?php if(@$_REQUEST['city']==$cityname['city']){?>selected="selected" <?php }?>><?php echo $cityname['city']; ?></option>
							<?php }?>
                        </select>
                    </td>
                    <td width="250" valign="middle"><input type="text" value="<?php echo @$_REQUEST['image_name'];?>" name="image_name"/></td>
                    <td valign="middle">
						<input type="image" src="<?php echo $config_var->WEB_TPL_URL;?>images/search-btn.png" alt="" />
						<input type="hidden" name="search" value="1">
					</td>
                  </tr>
                </table>
				</form>
            </div>
           
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
			<?php if((isset($_REQUEST['country']) && $_REQUEST['country']>0) ||(isset($_REQUEST['image_name']) && $_REQUEST['image_name']!='')){?>
				<div class="b-guide-hdr"><?php if($_REQUEST['country']>0){echo $country_name[0]['country_name'];?>&nbsp;|&nbsp;<?php }echo count($DataSet['result']);?> Record found</div>
			<?php }else{?>	
            	<div class="bg-top"></div>
			<?php }?>	
                <div class="bar-guide-txt">
                
                	<!--Videos Row-->
                    <div class="videos-row">
					<?php if(count($DataSet['result'])>0){?>
                    	<?php for($j=0; $j<count($DataSet['result']); $j++){	
						?>
						<div class="video-outer">
                        	<div class="video">
							
						
							<a href="<?php echo $config_var->WEB_URL?>?mod=mod_partygirls&view=detail&s=3&id=<?php echo$DataSet['result'][$j]['id'];?>">
							
							
								<img src="<?php echo $config_var->UPLOAD_URL;?>partygirls_images/thumbnail/<?php echo $DataSet['result'][$j]['image_thumbnail']; ?>" alt="" height="162px" width="122px" />
							</a>
							</div>
                           <?php //echo $DataSet['result'][$j]['image_title'];?>
						   <?php 
							   $length = strlen($DataSet['result'][$j]['image_title']);
							    $countryNames = $model->getCountryNameById($DataSet['result'][$j]['country_id']);
					if($length >= 20){
							   
							 echo  $barname=substr($DataSet['result'][$j]['image_title'],0,20).'....';
							 echo "<br>".$countryNames[0]['country_name']; 
							 echo "<br>".$DataSet['result'][$j]['city']; 
					}else{
							 echo $DataSet['result'][$j]['image_title'];
							 echo "<br>".$countryNames[0]['country_name'];
							 echo "<br>".$DataSet['result'][$j]['city'];
							  }
							   ?>
                            <span ><?php 
							 	 //echo $config_var->UPLOAD_URL."partygirls_images/".$DataSet['result'][$j]['id'] ;
								 if(is_dir($config_var->UPLOAD_ROOT."partygirls_images/".$DataSet['result'][$j]['id']))
								 {
									$countFiles = scandir($config_var->UPLOAD_ROOT."partygirls_images/".$DataSet['result'][$j]['id']);
									$cnt=0;foreach($countFiles as $img){
										if($img != "." && $img != ".." && $img != "thumbnails" && $img != "thumbs.db")
										{
				
										$ext = explode(".",$img);
										if($ext['1'] == "jpg" ||  $ext['1'] == "png" ||$ext['1'] == "gif" || $ext['1'] == "JPG" ||  $ext['1'] == "PNG" ||$ext['1'] == "GIF")
										$cnt++ ;
										
										}
				
									}
								echo $cnt ;
								}else {echo "0";} echo " images"; ?>
									</span>
                        </div>
                       <?php 
						if(($j+1)%4==0 && count($DataSet['result'])>4)
						{
							echo '</div><div class="videos-row">';
						}
					   }
					   //end if
					   }
					   ?> 
                     </div>
                    <!--//Videos Row-->
                   
				 <?php print $DataSet['nav'];?>
                
                </div>
            </div>
			 <!--//Bar Guide Container--> 

            
          <div class="clr"></div>
        </div>
        <!--//Inner Text-->
        
