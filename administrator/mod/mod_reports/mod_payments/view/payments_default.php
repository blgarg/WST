<?php 
global $config_var;  
global $model;
global $DataSet;

 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form name="searchForm" id="searchForm" method="get" >
            		<input type="hidden" name="hdnSearch" value="hdnsearch" />
                    <input type="hidden" name="mod" value="mod_payments"  />
                    <input type="hidden" name="view" value="default"  />
                    <input type="hidden" name="m" value="11"  />
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top">
                    <select  class="selectbox" style="padding:4px 0 0 6px;width:105%;" name="type" >
                    <option value=""  >Select Condition</option>
                    <option value="txn_id" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='txn_id') echo 'selected'; else ''; ?> >Transaction</option>
                    <option value="amount" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='amount') echo 'selected'; else ''; ?> >Amount</option>
					<option value="membership_plan" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='membership_plan') echo 'selected'; else ''; ?> >Membership Plan</option>
					<option value="payment_status" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='payment_status') echo 'selected'; else ''; ?> >Payment Status</option>
					<option value="payment_type" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='payment_type') echo 'selected'; else ''; ?> >Payment Type</option>
                    </select>
                    
                    </td>
					<td valign="top"><input type="text" name="input_search" class="selectbox" style="margin-left:15px;"> </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top">
                    <!-- <input type="text" name="creteria" id="creteria" value="<?php //if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /> -->
                    </td>
                    <td>&nbsp;</td>
                    <td valign="top"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    <input type="submit"  class="button_r"   value="<?php echo Search; ?>" onclick="this.form.submit();" />
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
				<form id="mainform" action="./index.php?mod=mod_magazines&view=default&m=9" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <!-- <div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('mag_id[]'),document.mainform.CheckAll)" > 
                        </div>-->
                      <div style="float:left;width:25%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Transaction </a> </div>
                        
                        <div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Amount</a>  </div>
                        
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Membership Plan</a>  </div>
                      
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Payment Status</a>  </div>
                          
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Payment Type</a> </div>
                        

                  <div style="float:left;width:18%;min-height:40px;text-align:center">
                    <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Payment Date</a>
                        </div>      
                       </div></td>
                </tr>
				<?php 
				
				foreach($DataSet['result'] as $list){
					 
					?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        <!--  <div style="width:3%;min-height:40px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="mag_id[]" id="mag_id" value="<?php //if(isset($Employees["$i"]['parties_id']) && $Employees["$i"]['parties_id'] != ''){ echo $Employees["$i"]['parties_id']; } if(isset($Employees["$i"]['party_id']) && $Employees["$i"]['party_id'] != ''){ echo $Employees["$i"]['party_id']; } ?>" />
                        </div>-->
						<div style="float:left;width:24%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:40px;text-align:center;padding-left:1%;">
								<?php echo $list['txn_id'];?>	
							</div>		
                        
                        
                        <!--<div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php //echo $i;?>"><a href="?mod=mod_magazines&view=editMagazines&m=9&mag_id=<?php //echo $Employees["$i"]['mag_id'];?>" style="color:#595959;"><strong>Edit</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="./?mod=mod_agents&view=detail&m=5&mag_id=<?php //echo base64_encode($Employees["$i"]['mag_id']);?>" style="color:#474747;"><strong>View detail</strong></a>--><!--</div>-->
                        </div> 
                         
                           <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $list['amount'];?></div>
                         
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           	<?php echo $list['membership_plan'];?>
                           </div>
                           
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           		<?php echo $list['payment_status'];?>
                           </div>
                           
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           		<?php echo $list['payment_type'];?>
                           </div>
              
                        
                         <div style="float:left;width:19%;min-height:40px;margin-top:5px;text-align:center;padding-top:5px;">
							<?php echo date("m-d-Y",strtotime($list['txn_date']));?>
                        </div>
                        
                       </div></td>
                </tr>
                
  				<?php  } if(count($DataSet['result']) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;"><?php echo No_Record_Found ?></p>
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
		