<?php 
global $config_var;  
global $model;
global $DataSet;
$your_cart_update=new model_booksStore_seeOrder();
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		$your_cart_update->remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['order']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['order']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['order'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0){
				$_SESSION['order'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
 ?>
      <script type="text/javascript">
      function isNumeric(elem, helperMsg){
	var numericExpression = /^ *[0-9]+ *$/;
	if(elem.value.match(numericExpression)){
	    return true;
	}else{
		elem.focus();
		elem.value="";
		//document.getElementById('sunny').innerHTML = "";
		return false;
	}
}
      </script>
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./?mod=mod_booksStore&view=seeOrder&m=7" name="mainform" method="post" >
				<input type="hidden" name="pid" />
				<input type="hidden" name="command" />
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           <div style="float:left;width:26%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Book Name</a></div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Available Quantity</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Author</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Unit Price</a>                        </div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Quantity</a>                        </div>
                        
                   <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:17%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Unit price * Quantity</a>                        </div>
                       </div></td>
                </tr>
				    <?php 
					if(count($_SESSION['order'])>0)
					{
					$your_cart=new model_booksStore_seeOrder();
					$max=count($_SESSION['order']);
					for($i=0;$i<$max;$i++){
					$pid=$_SESSION['order'][$i]['productid'];
					$q=$_SESSION['order'][$i]['qty'];
					$Books=$your_cart->get_product_name($pid);
					//extract($row);
					if($q==0) continue;
					?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        
					  <div style="float:left;width:25%;min-height:65px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:41px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Books["$i"]['cat_title']) >=100){echo ucfirst(substr($Books["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Books["$i"]['cat_title']);}*/ echo $Books['book_name'];?>   </div>		
                        
                        
                        <div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php echo $i;?>">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:delorder(<?php echo $Books['book_id'];?>)" style="color:#474747;"><strong>Remove</strong></a></div>
                        </div>  
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books['quantities'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books['book_author'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books['book_price'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                             <label>
                             <input type="text" maxlength="5" name="product<?php echo $pid;?>" id="product<?php echo $pid;?>" value="<?php echo $q;?>"  size="3" onkeyup="isNumeric(document.getElementById('product<?php echo $pid;?>'), 'Numbers Only Please');" />							<input type="hidden" name="avai_qty<?php echo $pid;?>" value="<?php echo $Books['quantities'];?>" />
                             </label>
                           </div>
                <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Books["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Books["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Books["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:16%;min-height:66px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($Books["$i"]['createdDate']));?>
                        <?php echo number_format($your_cart->get_price($pid)*$q,2,".",",");?>                        </div>
                       </div></td>
                </tr>
                <?php
				}
				?>
                 <tr>
                   <td colspan="6" style="float:right;border:none;font-size:17px;padding:5px 26px 0px 0px;"><b>Total Amount:<?php echo "Rs".number_format($your_cart->get_order_total(),2,".",",");?></b></td>
                 </tr>
                  <tr>
                   <td colspan="6" style="float:right;border:none;font-size:17px;padding:5px 26px 0px 0px;"><input type="button" value="Order books" onclick="window.location.href='./?mod=mod_booksStore&view=generateOrders&m=7'" style="cursor:pointer;" /></td>
                 </tr>
  				<?php  } if(count($_SESSION['order']) <=0){	?>
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
                 <input type="hidden" name="controller" value="remove_all_books" id="controller"  /> 
             </form>
			</div>
			<!--  end content-table  -->
		    <?php //print $DataSet['nav'];?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		