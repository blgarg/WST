
<?php
	global $config_var;
	global $model;
	global $DataSet;
	
	$countries = $model->getCountryList();
	$cities = $model->getCities();
	//print_r($DataSet['result'][0]['bar_country']); die;
	
?>
<div class="inner-hdr">
  	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/bar-guide-txt.png" alt="" />
</div>
<div class="inner-txt">
			<div class="b-guide-search">
			<form action="<?php echo $config_var->WEB_URL?>?mod=mod_barguide&view=default" method="get">
				<input type="hidden" name="mod" value="mod_barguide" />
				<input type="hidden" name="view" value="default" />	
				
            	<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="262">Search Bar Name:</td>
                    <td width="262">Select Country:</td>
                    <td width="262">Select City</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="text" value="<?php echo @$_REQUEST['place_name'];?>" maxlength="50" name="place_name" /></td>
                    <td>
                    	<select name="country">
                        	<option value="">Select country</option>
							<?php foreach($countries as $country){?>
							<option value="<?php echo $country['id'];?>" <?php if(@$_REQUEST['country']==$country['id']){?> selected="selected" <?php }?>><?php echo $country['country_name'];?></option>
							<?php }?>
                        </select>
                    </td>
                     <td>
                    	<select name="city">
                        	<option value="">Select city</option>
							<?php foreach($cities as $list){?>
							<option  value="<?php echo $list['bar_city'];?>" <?php if($list['bar_city']==@$_REQUEST['city']){?> selected="selected" <?php }?>><?php echo $list['bar_city'];?></option>
							<?php }?>
						</select>
                    </td>
                    <td>
						<input type="hidden" value="search" name="search" />
						<input type="image" src="<?php echo $config_var->WEB_TPL_URL;?>images/search-btn.png">
						
					</td>
                  </tr>
                </table>
				
			</form>	
            </div>
           
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
            	<div class="b-guide-hdr">Bar Guide<?php if(@$_REQUEST['search']){?>&nbsp;|&nbsp;<?php echo count($DataSet['result']);?> Record found <?php } ?></div>
                <div class="bar-guide-txt">
                	<!--Image Row-->
					<?php if(count($DataSet['result'])>0){?>
                    <div class="b-guide-img-row" style="height:236px !important;">
					
                    	<?php 
						//echo "<pre>"; print_r($DataSet['result']); die;
							$i=1;foreach($DataSet['result'] as $barlist){ ?>
						<div class="img-outer">
                        	<div class="guide-img">
								<a href="<?php echo $config_var->WEB_URL?>?mod=mod_barguide&view=detail&id=<?php echo $barlist['id'];?><?php if($_REQUEST['p'] != ""){ echo '&p='.$_REQUEST['p'];} ;?>">
									<img src="<?php if($barlist['image_name']!=''){ echo $config_var->UPLOAD_URL."bar_images/".$barlist['image_name'];}else{ echo $config_var->UPLOAD_URL."NotAvailable.gif";}?>" alt=""  />
								</a>	
							</div>
							<?php
								$countryName = $model->getCountryName($barlist[bar_country]);
								
							?>
                           <?php 
						   $length = strlen($barlist['bar_name']);
						   if($length >= 25){
						 echo  $barname=substr($barlist['bar_name'],0,25).'....';
						 echo $countryName[0]['country_name'].'br/>';
						 echo $barlist['bar_city'];
						   }else{
						   echo $barlist['bar_name'].'<br/>';
						   echo $countryName[0]['country_name'].'<br/>';
						   echo $barlist['bar_city'];
						   }
						   ?>
                        </div>
                        
                        <?php 
							if($i%4==0 && count($DataSet['result'])>4)
							{
								echo '</div><div class="b-guide-img-row" style="height:236px !important;">';
							}
						$i++;}
							?>
                        
                    </div>
                 <?php 
				 // end if
						}?> 
<?php //print $DataSet['nav']; ?>						
				   <!--//Image Row-->
                    
                    
                
                </div>
            </div>
			 <!--//Bar Guide Container--> 

            
          <div class="clr"></div>
        </div>