<?php 
global $config_var;  
global $model;
global $DataSet;
//echo "<pre>"; print_r($DataSet); die;
 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form name="searchForm" id="searchForm" method="post" >
            		<input type="hidden" name="hdnSearch" value="hdnsearch" />
                    <input type="hidden" name="mod" value="mod_gallery"  />
                    <input type="hidden" name="view" value="default"  />
                    <input type="hidden" name="m" value="4"  />
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top" style="padding-right:15px;">
                    <select  style="background-color: #403E3F; 
											border-top-width: 2px; 
											color: white; 
											height: 30px; 
											width: 107px;
											" name="cmbStatus" >
                    <option value="" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> ><?php echo STATUS ?></option>
                    <option value="1" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='1') echo 'selected'; else ''; ?> ><?php echo ACTIVE ?></option>
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='0') echo 'selected'; else ''; ?> ><?php echo DEACTIVE ?></option>
                    </select> 
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top"><input type="text" maxlength="60" name="creteria" id="creteria" value="<?php if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <input type="submit"  class="button_r"   value="<?php echo Search ?>" onclick="this.form.submit();" />
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"> <?php print $DataSet['nav'];?></td>
                    </tr>
                    </table>
			</form>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_travel&view=default&m=4" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <div style="width:3%;min-height:28px;border-left:#CCCCCC 1px solid;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('cat_id[]'),document.mainform.CheckAll)" >
                        </div>
						<div style="float:left;width:8%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Image</a>
                        </div>
                        <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Place Name</a>
                        </div>
						<div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Type</a>
                        </div>
						<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">City</a>
                        </div>
                        
					<div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Status</a>
					</div>
                      
                        
                       <div style="float:left;width:14%;min-height:40px; text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$tguideList  =  $DataSet['result'];
				//echo "<pre>"; print_r($tguideList); die;
				for($i = 0;$i<count($tguideList);$i++){	
				$thumbnail = $config_var->UPLOAD_URL."travel/thumbs/".$tguideList[$i]['thumb_image']; 
				//$cat_name=model_gallery_default::get_category_name($tguideList[$i]['category_id']); 
				$type_name=model_travel_default::get_type_name($tguideList["$i"]['type']);
				
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;border-right:#CCCCCC 1px solid;">
                    	
                        <div style="width:3%;min-height:40px;border-left:#CCCCCC 1px solid;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="cat_id[]" id="cat_id" value="<?php echo $tguideList["$i"]['id'];?>" />
                        </div>
						<div style="float:left;width:7%;min-height:40px;text-align:left;padding-left:1%;padding-top:6px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:100%;min-height:29px;text-align:center;padding-left:0%;">
							<img src="<?php  echo $thumbnail;?>" alt="Smiley face" height="42" width="42">    </div>		
                       </div>
						<div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php  echo $tguideList["$i"]['place_name'];?>   </div>		
                       </div> 
						<div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php  echo $type_name[0]['type_name'];?>   </div>		
                       </div> 
						<div style="float:left;width:14%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php  echo $tguideList["$i"]['city'];?>   </div>		
                       </div> 					   
                        <div style="float:left;width:10%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                            <?php if($tguideList["$i"]['status']=='1') echo "ACTIVE"; else echo "DEACTIVE";?>
                        </div>   
						
                        <div style="float:left;width:14%;solid;min-height:40px;text-align:center;padding-top:12px;">
                           <a href="?mod=mod_travel&view=edittravel&m=4&t_id=<?php echo $tguideList["$i"]['id'];?>" title="Edit" style="color:#595959;"><strong>EDIT</strong>
						   
						   <a title="Gallery" href="?mod=mod_travel&view=gallery&m=4&id=<?php echo $tguideList["$i"]['id'];?>"><img src="<?php echo $config_var->ADMIN_TPL_URL?>images/dashboard/imagegallery.png" height="35" width="45"></a>
						    &nbsp;
						   <a title="Travel Guide Map" href="?mod=mod_travel&view=addMap&id=<?php echo $tguideList["$i"]['id'];?>"><strong>Add Map</strong></a>
						   </a>
						   </div></td>
                </tr>
                
  				<?php  } if(count($tguideList) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;"> No Record Found </p>
                        </div>
                       </div></td>
                </tr>
                <?php } ?>
				</table>
				<!--  end product-table................................... -->
                 <input type="hidden" name="controller" value="" id="controller"  /> 
             </form>
			</div>
			<!--  end content-table  -->
		    <?php print $DataSet['nav'];?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		