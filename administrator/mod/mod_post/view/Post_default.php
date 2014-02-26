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
                    <input type="hidden" name="mod" value="mod_Post"  />
                    <input type="hidden" name="view" value="default"  />
                    <input type="hidden" name="d" value="1"  />
					<input type="hidden" name="type" value="forum"  />
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
                    <td valign="top"><input type="text" name="creteria" id="creteria" value="<?php if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /></td>
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
				<form id="mainform" action="./index.php?mod=mod_Post&view=default&d=1&type=forum" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <div style="width:3%;min-height:28px;border-left:#CCCCCC 1px solid;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('cat_id[]'),document.mainform.CheckAll)" >
                        </div>
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Title</a>
                        </div>
						<div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Topic</a>
                        </div>
                        <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Category</a>
                        </div>
						 <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Sub Category</a>
                        </div>
						  <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Reports</a>
                        </div>
					<div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Status</a>
					</div>
                      <div style="float:left;width:10%;min-height:40px; text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Categories  =  $DataSet['result'];
				for($i = 0;$i<count($Categories);$i++){	
				$getCatName=$model->getCatName($Categories["$i"]['cat_id']);
				$getSubCatName=$model->getSubCatName($Categories["$i"]['sub_cat_id']);
				$gettopic_image=$model->gettopic_image($Categories["$i"]['post_id']);
				$gettopic=$model->gettopic($Categories["$i"]['topic_id']);
				
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;border-right:#CCCCCC 1px solid;">
                    	
                        <div style="width:3%;min-height:40px;border-left:#CCCCCC 1px solid;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="cat_id[]" id="cat_id" value="<?php echo $Categories["$i"]['post_id'];?>" />
                        </div>
						<div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:auto;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:40px; padding-top:12px;text-align:center;">
							<?php  echo $Categories["$i"]['post_title'];?></div>
							</div>  
						<div style="float:left;width:13%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                           <?php  echo $gettopic[0]['topic_title'];?> 
                        </div>
					    <div style="float:left;width:13%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                           <?php  echo $getCatName[0]['cat_name'];?> 
                        </div>  
						 <div style="float:left;width:12%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                           <?php  echo $getSubCatName[0]['sub_cat_name'];?> 
                        </div>    
						 <div style="float:left;width:14%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                            <table width="100%" border="0" style="border:none;">
								  <tr>
									<td style="border:none;"><strong><?php echo count($gettopic_image);?></strong> Photos</td>
								</tr>
								  
							</table>
                        </div>   
						
                        <div style="float:left;width:10%;min-height:40px; padding-top:12px;text-align:center; border-right:#CCCCCC 1px solid;">
                            <?php if($Categories["$i"]['status']=='1') echo ACTIVE; else echo DEACTIVE;?>
                        </div>   
						
                        <div style="float:left;width:10%;solid;min-height:40px;text-align:center;padding-top:12px;">
                           <a href="?mod=mod_Post&view=viewPost&post_id=<?php echo $Categories["$i"]['post_id'];?>&type=forum" title="<?php echo $Categories["$i"]['post_title'];?>" style="color:#595959;"><strong>Show Comments</strong></a></div>
                                                    
                     </div></td>
                </tr>
                
  				<?php  } if(count($Categories) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;">No Record Found</p>
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
		