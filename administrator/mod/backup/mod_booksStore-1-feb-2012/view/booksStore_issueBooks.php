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
			 <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"> <?php print $DataSet['nav'];?></td>
                    </tr>
                    </table>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_agents&view=default&m=1" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        <div style="width:3%;min-height:28px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
		                        <input type="checkbox" name="CheckAll"   value="Check All" onClick="checkUncheckAll(document.getElementsByName('agent_id[]'),document.mainform.CheckAll)" >
                        </div>
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Book Title</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Category</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Author</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Available Quantities</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Unit Price</a>                        </div>
                        
                  <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:15%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$BooksIssue  =  $DataSet['result'];
				for($i = 0;$i<count($BooksIssue);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        <div style="width:3%;min-height:65px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                        <input  type="checkbox" name="agent_id[]" id="agent_id" value="<?php echo $BooksIssue["$i"]['agent_id'];?>" />
                        </div>
						<div style="float:left;width:19%;min-height:65px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:41px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($BooksIssue["$i"]['cat_title']) >=100){echo ucfirst(substr($BooksIssue["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($BooksIssue["$i"]['cat_title']);}*/ echo $BooksIssue["$i"]['book_name'];?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>"><a href="?mod=mod_agents&view=editAgent&m=6&agent_id=<?php echo $BooksIssue["$i"]['agent_id'];?>" style="color:#595959;"><strong>Edit</strong></a><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&agent_id=<?php //echo $BooksIssue[$i]['agent_id']; ?>" style="color:#474747;"><strong>View</strong></a>--></div>
                        
                        
                        </div>  
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $BooksIssue["$i"]['book_cat_id'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $BooksIssue["$i"]['book_author'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $BooksIssue["$i"]['quantities'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $BooksIssue["$i"]['book_price'];?></div>
                           <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($BooksIssue["$i"]['Birthplace']) >=20){ echo ucfirst(substr($BooksIssue["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($BooksIssue["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:15%;min-height:66px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($BooksIssue["$i"]['createdDate']));?>
                        <?php //if($BooksIssue["$i"]['Actions']=='1') echo 'Active'; else echo "Deactive";?>
                        <a href="./?mod=mod_booksStore&view=bookissue_detail&book_id=<?php echo base64_encode($BooksIssue["$i"]['book_id']); ?>&m=4"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/add_book.png" /></a>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  } if(count($BooksIssue) <=0){	?>
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
		