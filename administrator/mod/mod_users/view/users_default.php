<?php 
global $config_var;  
global $DataSet;
global $model;

 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form name="searchForm" id="searchForm" method="get" >
            		<input type="hidden" name="hdnSearch" value="hdnsearch" />
                    <input type="hidden" name="mod" value="mod_users"  />
                    <input type="hidden" name="view" value="default"  />
                    <input type="hidden" name="m" value="1"  />
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top" style="padding-right:15px;">
                    <select  style="background-color: #403E3F; 
											border-top-width: 2px; 
											color: white; 
											height: 30px; 
											width: 107px;
											" name="cmbStatus" >
                    <option value="" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Status</option>
                    <option value="1" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='1') echo 'selected'; else ''; ?> >Activate</option>
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='0') echo 'selected'; else ''; ?> >Deactivate</option>
                    </select> 
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top"><input maxlength="60" type="text" name="creteria" id="creteria" value="<?php if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <input type="submit"  class="button_r"   value="Search" onclick="this.form.submit();" />
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
				<form id="mainform" action="./index.php?mod=mod_users&view=default&d=2" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                  <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('user_id[]'),document.mainform.CheckAll)" />
                        </div>
                        <div style="float:left;width:20%;min-height:30px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">First Name</a>
                        </div>
						
						<div style="float:left;width:20%;min-height:30px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Last Name</a>
                        </div>
                        <div style="float:left;width:20%;min-height:30px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Email</a>
                        </div>
                        
                        <div style="float:left;width:20%;min-height:30px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Updated Date</a>
                        </div>
                        <div style="float:left;width:10%;min-height:30px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Status</a>
                        </div>
                        
                       </div>
                 </td>
                </tr>
				<?php 
				 $users  =  $DataSet['result'];
				 for($i = 0;$i<count($users);$i++){	
				 //$name=$users[$i]['user_firstname'].' '.$users[$i]['user_lastname'];
				 $first_name=$users[$i]['first_name'];
				 $last_name = $users[$i]['last_name'];
				 if(strlen($first_name) >=100){
				   $first_name = substr($name,0,100)."...";
				  }
				  if(strlen($last_name)>=100 )
				  {
					$last_name = substr($last_name,0,100)."...";
				  }
				 ?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        <div style="width:3%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                       <input  type="checkbox" name="user_id[]" id="user_id" value="<?php echo $users["$i"]['id'];?>" />
                        </div>

                        <div style="float:left;width:19%;height:66px;border-right:#CCCCCC 1px solid;text-align:left;padding-left:1%;padding-top:5px;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;height:41px;text-align:left;padding-left:1%;">
						<?php  echo $first_name; ?>
                        </div>		
                                                
                        <div style="width:98%;height:13px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><a href="./?mod=mod_users&view=editUser&m=1&user_id=<?php echo $users["$i"]['id'];?><?php if(isset($_GET['p']) && $_GET['p']!=''){  echo "&p=".$_GET['p'];} ?>" style="color:#595959;"><strong>Edit</strong></a></div>
                        
                        
                        </div>
						<div style="float:left;width:19%;height:66px;border-right:#CCCCCC 1px solid;text-align:left;padding-left:1%;padding-top:5px;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;height:41px;text-align:left;padding-left:1%;">
						<?php  echo $last_name; ?>
                        </div>		
                                                
                        <div style="width:98%;height:13px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><a href="./?mod=mod_users&view=editUser&d=2&user_id=<?php echo $users["$i"]['id'];?>" style="color:#595959;"><strong>Edit</strong></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_users&view=detailUser&user_id=<?php echo $users["$i"]['id'];?>&d=2" style="color:#474747;"><strong>View</strong></a></div>
                        
                        
                        </div>
						
                        <div class="breakword" style="float:left;width:19%;height:66px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:5px;">
                       <?php echo $users["$i"]['email'];?> 
                        </div>

                        <div class="breakword" style="float:left;width:19%;height:66px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:5px;">
                       <?php echo date("Y-m-d",strtotime($users["$i"]['modified_on']));?> 
                        </div>
                        
                        <div style="float:left;width:9%;height:66px;text-align:center;padding-left:1%;padding-top:5px;">
                         <?php if($users["$i"]['status']=='1'){echo 'Activate';}else{ echo "Deactivate";}?>
                        </div>
                        </div></td>
                </tr>
                
  				<?php  } if(count($users) <=0){	?>
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
		