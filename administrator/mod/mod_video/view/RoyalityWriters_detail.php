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
                    	
                        
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Order number</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Quantity</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Books total price</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Writer balance</a></div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Date</a>                        </div>
                        
                 <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:15%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Writers  =  $DataSet['result'];
				for($i = 0;$i<count($Writers);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        
						<div style="float:left;width:19%;min-height:65px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:41px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Writers["$i"]['cat_title']) >=100){echo ucfirst(substr($Writers["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Writers["$i"]['cat_title']);}*/ echo $Writers["$i"]['sell_amt_id'];?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><!--<a href="?mod=mod_agents&view=editAgent&m=6&agent_id=<?php //echo $Writers["$i"]['agent_id'];?>" style="color:#595959;"><strong>Edit</strong></a>--><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&agent_id=<?php //echo $Writers[$i]['agent_id']; ?>" style="color:#474747;"><strong>View</strong></a>--></div>
                        
                        
                        </div>  
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <a href="?mod=mod_writers&view=booksdetail&m=3&transaction_id=<?php echo base64_encode($Writers["$i"]['amt_book_id']);?>" style="color:#595959;"><strong><?php $totalbooks=model_RoyalityWriters_detail::get_total_books($Writers["$i"]['amt_book_id']);echo $totalbooks[0]['booksum'];?></strong></a></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php $totalpwrice=model_RoyalityWriters_detail::get_price_books($Writers["$i"]['amt_book_id']);echo $totalpwrice[0]['totalsum'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php $totalbalance=model_RoyalityWriters_detail::get_price_balance($Writers["$i"]['amt_book_id']);echo $totalbalance[0]['balance'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Writers["$i"]['amt_date'];?></div>
                           <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Writers["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Writers["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Writers["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:15%;min-height:66px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($Writers["$i"]['createdDate']));?>
                        <?php if($Writers["$i"]['amt_paid']=='1') echo 'Paid'; else echo "UnPaid";?>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  } if(count($Writers) <=0){	?>
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
		