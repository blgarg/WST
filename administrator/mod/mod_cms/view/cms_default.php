<?php 
global $config_var;  
global $model;
global $DataSet;
 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">	
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_cms&view=default&d=3" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <!--<div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('model_id[]'),document.mainform.CheckAll)" >
                        </div>-->
                           <div style="float:left;width:30%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Page Title</a>
                        </div>
                         <div style="float:left;width:48%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Meta Title</a>
                        </div>
                        
                        <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:21%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:29px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo "Action";?></a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Pages  =  $DataSet['result'];
				for($i = 0;$i<count($Pages);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:40px;float:left;">
                    	
						<div style="float:left;width:29%;min-height:29px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php 
							if(isset($_SESSION['en']))
{
	
	if(strlen($Pages["$i"]['page_title']) >=100){echo substr($Pages["$i"]['page_title'],0,100)."...";}else{echo $Pages["$i"]['page_title'];}
	}
	else {
		if(strlen($Pages["$i"]['page_title']) >=100){echo substr($Pages["$i"]['page_title'],0,100)."...";}else{echo $Pages["$i"]['page_title'];}
		
		}
							
							?>   </div>		
                        
                        
                        <!--<div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php //echo $i;?>"><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&model_id=<?php //echo $Pages[$i]['model_id']; ?>" style="color:#474747;"><strong>View</strong></a>--><!--</div>-->
                        
                        
                        </div>  
                           <div style="float:left;width:47%;min-height:29px;border-right:#CCCCCC 1px solid;text-align:left;padding-left:1%;padding-top:12px;" >
                           <?php
						   if(strlen($Pages["$i"]['page_meta_tags'])>50)
						   {
								echo substr($Pages["$i"]['page_meta_tags'],0,50)."...";
							}
							else
							{
								echo ucfirst($Pages["$i"]['page_meta_tags']);
							}?></div>
                           <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Pages["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Pages["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Pages["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:19%;min-height:29px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($Pages["$i"]['createdDate']));?>
                        <?php //if($Pages["$i"]['Actions']=='1') echo ACTIVE; else echo DEACTIVE;?>
                        <a href="?mod=mod_cms&view=editPage&d=2&page_id=<?php echo $Pages["$i"]['page_id'];?>" style="color:#595959;" title="Edit" ><strong><?php echo EDIT;?></strong></a>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  } if(count($Pages) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;">No Record Found </p>
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
		