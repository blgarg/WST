<?php 
global $config_var;  
global $model;
global $DataSet;
$writerslist=model_reports_writers::writer_list();

?>

        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
				<table width="100%" border="0">
						<tr>
						  <td style="width:140px;"> 
							<form method="get" id="filterwnameForm">	
								<select  class="selectbox" name="filterwname" id="filterwname" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="filterwnameForm.submit();" >
									<option value="">select writer Name</option>	
									<?php foreach($writerslist as $list){?>
										<option value="<?php echo $list[writer_id]?>"><?php echo $list[writer_name];?></option>
									<?php }?>
								</select>
								<input type="hidden" name="mod" value="mod_reports"  />
								<input type="hidden" name="view" value="writers"  />
							<input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
								
							</form>	
						</td>
						  <td id="second" style="width:480px;"></td>
						  <td id="" style="width:140px;">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
			  </table>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_writers&view=default&m=1" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo WRITERNAME;?></a>                        </div>
                      <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo EMPNAME;?></a>                        </div>
					  <div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo NUMBEROFBOOKSSOLD;?></a>                        </div>
                      <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo ROYALITY."&nbsp;".PRICE."&nbsp;(".RS.")";?></a>                        </div>
                        <div style="float:left;width:11%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo COUNTRY;?></a>                        </div>
                        <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo BIRTHDATE;?></a>                        </div>
                        
                   <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:22%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo ENTEREDDATE;?></a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Employees  =  $DataSet['result'];
					
				for($i = 0;$i<count($Employees);$i++){	
				$empname=model_reports_writers::get_employee_name($Employees[$i]['employee_id']);
				$fullname=$empname[0]['user_firstname']." ".$empname[0]['user_lastname'];
					
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        
						<div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"   class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Employees["$i"]['cat_title']) >=100){echo ucfirst(substr($Employees["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Employees["$i"]['cat_title']);}*/ echo $Employees["$i"]['writer_name'];?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>">
</div>
                        
                        
                        </div>  
                           <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $fullname ; ?>
                           </div>
						   <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php $total_books=model_reports_writers::get_royality_prices($Employees[$i]['writer_id']); 
			  if($total_books[0]['quantities']!=''){echo $total_books[0]['quantities']; } else{echo "0";}?>
                           </div>
                           <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php $total_books=model_reports_writers::get_royality_prices($Employees[$i]['writer_id']); 
			  if($total_books[0]['totals']!=''){echo "Rs&nbsp;".number_format($total_books[0]['totals'],2,".",","); } else{echo "Rs&nbsp;0.00";}?></div>
                           <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Employees["$i"]['writer_country'];?></div>
                           <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Employees["$i"]['writer_dob'];?></div>
                           <!--<div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Employees["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Employees["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Employees["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:21%;min-height:40px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date(x"Y/m/d",strtotime($Employees["$i"]['createdDate']));?>
                        <?php $data=explode(" ",$Employees["$i"]['created_Date']); echo $data[0];?>
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
                <tr>
                 <td colspan="6" align="right">
                    <div style="width:100%;height:auto;float:right;">
                    	<div style="width:100%;height:29px;border-right:#CCCCCC 1px solid;float:right;padding-left:2%;padding-top:12px;">
                         <p align="right" style="color:#000;font-size:22px;font-weight:bold;">
                         <a target="_blank" href="./mod/mod_reports/view/writers_report.php?wid=<?php echo @$_REQUEST['filterwname'];?>" style="padding-right:5px;"><?php echo Download_Report ?></a></p>
                        </div>
                       </div></td>
                </tr>
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
		