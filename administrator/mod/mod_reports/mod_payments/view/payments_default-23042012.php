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
                    <option value="" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='') echo 'selected'; else ''; ?> ><?php echo BIZTYPE; ?></option>
                    <option value="academy" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='academy') echo 'selected'; else ''; ?> ><?php echo ACADEMIES; ?></option>
                    <option value="party" <?php if(isset($_REQUEST['type']) && $_REQUEST['type']=='party') echo 'selected'; else ''; ?> ><?php echo PARTIES; ?></option>
                    </select>
                    
                    <!-- <select  class="selectbox" style="padding:4px 0 0 6px;width:105%;" name="cmbStatus" >
                    <option value="" <?php //if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Business Type</option>
                    <option value="academy" <?php //if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='academy') echo 'selected'; else ''; ?> >Academies</option>
                    <option value="party" <?php //if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='party') echo 'selected'; else ''; ?> >Parties</option>
                    </select> -->
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top">
                    <!-- <input type="text" name="creteria" id="creteria" value="<?php //if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /> -->
                    </td>
                    <td>&nbsp;</td>
                    <td valign="top"> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
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
				<form id="mainform" action="./index.php?mod=mod_magazines&view=default&m=9" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <!-- <div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('mag_id[]'),document.mainform.CheckAll)" > 
                        </div>-->
                      <div style="float:left;width:25%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo PARTYTITLE.'/'.ACADEMYTITLE;?></a> </div>
                        
                        <div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo OWNERNAME;?></a>  </div>
                        
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo PNDPAYMT.' '.PMT;?></a>  </div>
                      
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo BALC.' '.PMT;?></a>  </div>
                          
                      <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo TOTAL.' '.PMT;?></a> </div>
                        

                  <div style="float:left;width:18%;min-height:40px;text-align:center">
                    <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo RECIVEPMT;  ?></a>
                        </div>      
                       </div></td>
                </tr>
				<?php 
				$Employees = $DataSet['result'];
				
				$recvpmt = $DataSet['recvpmt'];
				//echo "<pre>";
				//print_r($recvpmt);
					$totalsum = 0;			
					for($i=0;$i<count($recvpmt);$i++){
							$totalsum = $totalsum + $recvpmt[$i]['receivepmt'];
					}
					
				for($i = 0;$i<count($Employees);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        <!--  <div style="width:3%;min-height:40px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="mag_id[]" id="mag_id" value="<?php //if(isset($Employees["$i"]['parties_id']) && $Employees["$i"]['parties_id'] != ''){ echo $Employees["$i"]['parties_id']; } if(isset($Employees["$i"]['party_id']) && $Employees["$i"]['party_id'] != ''){ echo $Employees["$i"]['party_id']; } ?>" />
                        </div>-->
						<div style="float:left;width:24%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:40px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Employees["$i"]['cat_title']) >=100){echo ucfirst(substr($Employees["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Employees["$i"]['cat_title']);}*/
							if(isset($Employees["$i"]['parties_id']) && $Employees["$i"]['parties_id'] != ''){
								echo $Employees["$i"]['business_title'];
							} if(isset($Employees["$i"]['party_id']) && $Employees["$i"]['party_id'] != ''){
								echo $Employees["$i"]['party_title'];
							}
							?>   </div>		
                        
                        
                        <!--<div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php //echo $i;?>"><a href="?mod=mod_magazines&view=editMagazines&m=9&mag_id=<?php //echo $Employees["$i"]['mag_id'];?>" style="color:#595959;"><strong>Edit</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="./?mod=mod_agents&view=detail&m=5&mag_id=<?php //echo base64_encode($Employees["$i"]['mag_id']);?>" style="color:#474747;"><strong>View detail</strong></a>--><!--</div>-->
                        </div> 
                         
                           <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Employees["$i"]['owner_name'];?></div>
                         
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:right;padding-left:1%;padding-top:12px;">
                           	<?php 
                           		$currtpmt = $Employees["$i"]['pending_payment']-$totalsum;
                           		
                           		$a = 0;
                           		if($currtpmt<0){
                           			$a = $Employees["$i"]['balance_payment']-$currtpmt;
                           		}
				 				if($currtpmt<0){
									echo "Nill";
								}else{
									if($Employees["$i"]['pending_payment'] != ''){
										echo number_format($currtpmt,2,".",",");
									}else{ echo "Nill";
									}
								}
							?>
                           </div>
                           
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:right;padding-left:1%;padding-top:12px;">
                           		<?php if($Employees["$i"]['balance_payment'] != ''){ 
                           			echo number_format($a,2,".",",");  } else { echo "Nill"; }?>&nbsp;
                           </div>
                           
                           <div style="float:left;width:12%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:right;padding-left:1%;padding-top:12px;">
                           		<?php if($Employees["$i"]['total_amt_withanothercost'] != ''){ 
                           			echo number_format($Employees["$i"]['total_amt_withanothercost'],2,".",",");  } else { echo "Nill"; }?>&nbsp;
                           </div>
              
                        
                         <div style="float:left;width:19%;min-height:40px;margin-top:5px;text-align:center;padding-top:5px;">
                        <a href="?mod=mod_payments&view=recivepaymt&m=11&paymt_id=<?php echo $Employees["$i"]['amt_book_id'];?>&partiesId=<?php if(isset($Employees["$i"]['parties_id']) && $Employees["$i"]['parties_id'] != ''){ echo $Employees["$i"]['parties_id']; } if(isset($Employees["$i"]['party_id']) && $Employees["$i"]['party_id'] != ''){ echo $Employees["$i"]['party_id']; }?>&pendpmt=<?php if($currtpmt<=0){ echo "Nill"; }else{ echo $currtpmt; }?>&type=<?php echo $_REQUEST['type']; ?>" style="color:#595959;" class="info-tooltip" title="<?php echo "Click for Recive payment";?>"><strong><?php echo CLICKRECPMT;?></strong></a>
                        </div>
                        
                       </div></td>
                </tr>
                
  				<?php  } if(count($Employees) <=0){	?>
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
		