<?php
global $config_var;  
global $DataSet;
global $model;
$countries = $model->getCountry();
$city = $model->getCity();
?>

   		<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/travel-guide-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
			<div class="b-guide-search">
			<form action="<?php echo $config_var->WEB_URL?>?mod=mod_travel&view=default" method="get">
				<input type="hidden" name="mod" value="mod_travel" />
				<input type="hidden" name="view" value="default" />	
            	<table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="262">Search Place:</td>
                    <td width="262">Select Country:</td>
                    <td width="262">Select City</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
				    <td><input type="text" id="search_place" name="search_place" maxlength="50" value="<?php echo @$_REQUEST['search_place'];?>" /></td>
                    <td>
                    	<select name="country">
                        	<option value="">---- Select ----</option>
							<?php foreach($countries as $list){?>
							<option value="<?php echo $list['id']?>" <?php if(@$_REQUEST['country']==$list['id']){?>selected="selected" <?php }?>><?php echo $list['country_name']?></option>
							<?php }?>
							</select>
                    </td>
                     <td>
                    	<select name="bar_city">
                        	<option value="">---- Select ----</option>
							<?php foreach($city as $cityname){?>
							
							<option value="<?php echo $cityname['city']; ?>" <?php if(@$_REQUEST['bar_city']==$cityname['city']){?>selected="selected" <?php }?>><?php echo $cityname['city']; ?></option>
							<?php }?>
                        </select>
                    </td>
                    <td>
					<input type="image" name="searchVideo" src="<?php echo $config_var->WEB_TPL_URL;?>images/search-btn.png" alt="" />
					<input type="hidden" name="search" value="1">
					</td>
                  </tr>
                </table>
			</form>	
            </div>
          
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
            	<div class="b-guide-hdr">Travel Guide<?php if(@$_REQUEST['search']){?>&nbsp;|&nbsp;<?php echo count($DataSet['result']);?> Record found<?php } ?></div>
                <div class="bar-guide-txt">
                	<!--Image Row-->
					<?php if(count($DataSet['result'])>0){?>
                    <div class="b-guide-img-row" style="height:236px !important;">
						<?php 
							$i=1;foreach($DataSet['result'] as $barlist){ ?>
							<div class="img-outer">
                        	<div class="guide-img">
								<a href="<?php echo $config_var->WEB_URL?>?mod=mod_travel&view=detail&id=<?php echo $barlist['id'];?><?php if($_REQUEST['p'] != ""){ echo '&p='.$_REQUEST['p'];} ;?>">
									<img src="<?php if($barlist['thumb_image']!=''){ echo $config_var->UPLOAD_URL."travel/".$barlist['thumb_image'];}else{ echo $config_var->UPLOAD_URL."NotAvailable.gif";}?>" alt=""  />
								</a>	
							</div>
							<?php
								$countryName = $model->getCountryName($barlist[country]);
								
							?>
						   <?php 
						   $length = strlen($barlist['place_name']);
						   if($length >= 25){
						 echo  $barname=substr($barlist['place_name'],0,25).'....'.'<br/>';
						 echo $countryName[0]['country_name'].'<br/>';
						 echo $barlist['city'];
						   }else{
						   echo $barlist['place_name'].'<br/>';
						   echo $countryName[0]['country_name'].'<br/>';
						 echo $barlist['city'];
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
<?php print $DataSet['nav']; ?>						
				   <!--//Image Row-->
                    
                    
                
                </div>
            </div>
			 <!--//Bar Guide Container--> 

            
          <div class="clr"></div>
        </div>