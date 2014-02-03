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
                    <input type="hidden" name="mod" value="mod_booksStore"  />
                    <input type="hidden" name="view" value="default"  />
                    <input type="hidden" name="m" value="1"  />
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top">
                    <select  class="styledselect" name="cmbStatus" >
                    <option value="" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Status</option>
                    <option value="1" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='1') echo 'selected'; else ''; ?> >Active</option>
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='0') echo 'selected'; else ''; ?> >Deactive</option>
                    </select> 
                    </td>
                    </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="left">
                    <tr>
                    <td valign="top"><input type="text" name="creteria" id="creteria" value="<?php if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /></td>
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
				<form id="mainform" action="./index.php?mod=mod_booksStore&view=default&m=1" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('book_id[]'),document.mainform.CheckAll)" >
                        </div>
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Book Name</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Created date</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Author</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Unit Price</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Quantities</a>                        </div>
                        
                   <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:15%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
/*				echo "<pre>";
				print_r($DataSet);*/
				$Books  =  $DataSet['result'];
				for($i = 0;$i<count($Books);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        <div style="width:3%;min-height:65px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="book_id[]" id="book_id" value="<?php echo $Books["$i"]['book_id'];?>" />
                        </div>
						<div style="float:left;width:19%;min-height:65px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:41px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Books["$i"]['cat_title']) >=100){echo ucfirst(substr($Books["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Books["$i"]['cat_title']);}*/ echo $Books["$i"]['book_name'];?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><a href="?mod=mod_booksStore&view=<?php if($Books["$i"]['purchase_type']==1){ echo "editpurchaseBooks";} else {echo "editBook";}?>&m=6&book_id=<?php echo base64_encode($Books["$i"]['book_id']);?>" style="color:#595959;"><strong>Edit</strong></a><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&book_id=<?php //echo $Books[$i]['book_id']; ?>" style="color:#474747;"><strong>View</strong></a>--></div>
                        
                        
                        </div>  
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['created_Date'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['book_author'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['book_price'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['quantities'];?></div>
                           <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Books["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Books["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Books["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:15%;min-height:66px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($Books["$i"]['createdDate']));?>
                        <?php if($Books["$i"]['Actions']=='1') echo 'Active'; else echo "Deactive";?>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  } if(count($Books) <=0){	?>
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
		