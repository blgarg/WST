<?php 
global $config_var;  
global $model;
global $DataSet;
/*echo "<pre>";
print_r($DataSet);
echo "</pre>";*/
 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_agents&view=default&m=1" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           
                      <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo AGENTNAME;?></a>                        </div>
                      <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo PARTYNAME."/".ACADEMY."/".THIRDPERSON;?></a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo TOTALPRICEOFBOOKS;?></a>                        </div>
                      
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo QUANTITY;?></a>                        </div>
                      <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo AGENTCOMMISTION."&nbsp;(".RS.")";?></a></div>  
                 <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:11%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo DATE;?></a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Agents  =  $DataSet['result'];
				/*echo "<pre>";
				print_r($Agents);*/
				//$ttamount=0;
				$totalamount=array();
				for($i = 0;$i<count($Agents);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        
						  
                           <div style="float:left;width:19%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:left;padding-left:1%;padding-top:12px;">
                          <?php $agentname=model_reports_agents::get_agent_title($Agents["$i"]['agent_id']);
						  echo $agentname[0]['agent_name'];
						  ?></div>
                          <div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Agents["$i"]['cat_title']) >=100){echo ucfirst(substr($Agents["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Agents["$i"]['cat_title']);}*/ //echo ucwords($Agents["$i"]['party_title']);
							if($Agents["$i"]['academy_id']!=0)
							{
							$business_title=model_reports_agents::get_academytitle($Agents["$i"]['academy_id']);
							echo $business_title[0]['business_title']."&nbsp;<b>(".ACADEMY.")</b>";
							}
							else if($Agents["$i"]['party_id']!=0)
							{
							$business_title=model_reports_agents::get_partytitle($Agents["$i"]['party_id']);
							echo $business_title[0]['party_title']."&nbsp;<b>(".PARTYNAME.")</b>";
							}else
							{
							$business_title=model_reports_agents::get_personname($Agents["$i"]['amt_book_id']);
							echo $business_title[0]['name']."&nbsp;<b>(".THIRDPERSON.")</b>";
							}
							?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><!--<a href="?mod=mod_agents&view=editAgent&m=6&agent_id=<?php //echo $Agents["$i"]['agent_id'];?>" style="color:#595959;"><strong>Edit</strong></a>--><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&agent_id=<?php //echo $Agents[$i]['agent_id']; ?>" style="color:#474747;"><strong>View</strong></a>--></div>
                        
                        
                        </div>
                           <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Agents["$i"]['total_amt_withanothercost'];?></div>
                          
                           <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <a href="?mod=mod_agents&view=booksdetail&m=5&transaction_id=<?php echo base64_encode($Agents["$i"]['amt_book_id']);?>" style="color:#595959;"><strong><?php $totalbooks=model_reports_agents::get_total_books($Agents["$i"]['amt_book_id']);echo $totalbooks[0]['booksum'];?></strong></a></div>
                           <div style="float:left;width:19%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Agents["$i"]['end_amt']; ?></div>
                           <!--<div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Agents["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Agents["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Agents["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:9%;min-height:40px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php echo $Agents["$i"]['amt_date'];?>
                        </div>
                       </div></td>
                </tr>
                
  				<?php $totalamount[$i]=$Agents["$i"]['end_amt']; }
				
				?>
                
                <?php
				
				 if(count($Agents) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;">No Record Found</p>
                        </div>
                       </div></td>
                </tr>
                <?php } ?>
                <tr>
                 <td colspan="6" align="right">
                    <div style="width:100%;height:auto;float:right;">
                    	<div style="width:100%;height:29px;border-right:#CCCCCC 1px solid;float:right;padding-left:2%;padding-top:12px;">
                         <p align="right" style="color:#000;font-size:22px;font-weight:bold;">
                         <a target="_blank" href="./mod/mod_reports/view/agents_report.php" style="padding-right:5px;">Click here to download report</a></p>
                        </div>
                       </div></td>
                </tr>
				</table>
				<!--  end product-table................................... -->
                 <input type="hidden" name="controller" value="" id="controller"  /> 
             </form>
			</div>
			<!--  end content-table  -->
		    <?php print $DataSet['nav']; ?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		