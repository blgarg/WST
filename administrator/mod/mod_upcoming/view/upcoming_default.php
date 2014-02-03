<?php 
global $config_var;  
global $model;
global $DataSet;
$model_upcoming_default = new model_upcoming_default();
$getRecord = $model_upcoming_default->getRecord();
//echo "<pre>"; print_r($getRecord[0]['image_name']); die;
$getCountry = $model_upcoming_default->getCountry($getRecord[0]['country_id']);
?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_upcoming&view=default&d=8" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
						<div style="float:left;width:68%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Image</a>
                        </div>
                         <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Country Name</a>
                        </div>
                       <div style="float:left;width:10%;min-height:40px; text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$thumbnail = $config_var->UPLOAD_URL.'upcoming/'.$getRecord[0]['image_name'];
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:100px;float:left;border-right:#CCCCCC 1px solid;">
                        <div style="float:left;width:68%;min-height:100px;text-align:center;padding-left:0%;border-right:#CCCCCC 1px solid;">
							<img src="<?php echo $thumbnail; ?>" > 
						</div>		
					<div style="border-right:#CCCCCC 1px solid;float:left;width:20%;min-height:179px;text-align:center;padding-top:25px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
					<?php echo $getCountry[0]['country_name']; ?>
					</div>
                    
					<div style="float:left;width:10%;solid;min-height:100px;padding-top:25px;text-align:center;">
                           <a href="?mod=mod_upcoming&view=editupcoming&d=8&id=1" title="Edit" style="color:#595959;"><strong><?php echo EDIT;?></strong></a></div>
                     </div>
				</td>
                </tr>
                </table>
	             
             </form>
			</div>
		</div>
	
		