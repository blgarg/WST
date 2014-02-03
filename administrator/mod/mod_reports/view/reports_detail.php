<?php 
global $config_var;  
global $DataSet;

//config URL 
//$config_var->ADMIN_TPL_URL
include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
// Create class instance.

$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';
$model_reports_detail = new model_reports_detail();
$order_detail=$model_reports_detail->get_order_detail($_REQUEST);
$order_detail2=$model_reports_detail->get_order_seconddetail($_REQUEST);
$academytitle=model_reports_detail::get_academy_title($order_detail['academy_id']);
$employeename=model_reports_detail::get_employee_name($order_detail['person_emp_id']);
$total_orderamt=$order_detail['total_amt'];
$pricelist=$model_reports_detail->get_price_list($_REQUEST);
$agents_commision=model_reports_detail::get_agents_commision($_REQUEST['agentid']);

?>

<div id="content-table-inner" class="Add_New_Web_Page" style="float:left;">
	
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:100%">
   <form id="billform" action="./?mod=mod_booksStore&view=generateOrders&m=7" name="billform" method="post" >
<input type="hidden" name="current_cart_price" id="current_cart_price" value="<?php echo $price;?>" />
   <input type="hidden" name="controller" value="generate_order"  />
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              
              <?php
             $empname=model_reports_detail::get_employee_name($_REQUEST['employee_id']);
			$fullname=$empname['user_firstname']." ".$empname['user_lastname'];
				
			  if($order_detail2[0]['agent_id']!=0)
			  {
			  ?>
              <tr>
                <th valign="top"  style="font-size:13px;width:180px;"><?php echo AGENTNAME;?>:</th>
                <td><span style="text-align:left"><?php $agenttitle=model_reports_detail::get_particular_agentname($order_detail2[0]['agent_id']);
				echo $agenttitle[0]['agent_name'];
				?></span></td>
              </tr>
			  <tr>
                <th valign="top"  style="font-size:13px;width:180px;"><?php echo EMPNAME;?>:</th>
                <td><span style="text-align:left">
				<?php //echo $_REQUEST['empname'];
				echo $fullname ;
				?></span></td>
              </tr>
              <?php } 
			   if($pricelist['party_title']!='')
			  {
			  ?><tr>
                <th valign="top"  style="font-size:13px;"><?php echo PARTYNAME;?>:</th>
                <td><?php echo $pricelist['party_title']; ?></td>
              </tr>
              <?php
			  }
			  else if($order_detail2[0]['academy_id']!=0)
			  {
			  ?>
              <tr>
                <th valign="top"  style="font-size:13px;"><?php echo ACADEMY;?>:</th>
                <td><span style="text-align:left"><?php $academytitle=model_reports_detail::get_academy_title($order_detail2[0]['academy_id']);
				echo $academytitle['business_title'];
				?></span></td>
              </tr>
              <?php
			  }
			  else
			  {
			  ?>
              <tr>
                <th valign="top"  style="font-size:13px;"><?php echo THIRDPERSON;?>:</th>
                <td><span style="text-align:left"><?php $academytitle=model_reports_detail::get_third_person($order_detail2[0]['amt_book_id']);
				echo $academytitle[0]['name'];
				?></span></td>
              </tr>
              <?php
			  }
			  ?>
              <tr>
                <th valign="top"  style="font-size:13px;"><?php echo DATE;?>:</th>
                <td><span style="text-align:left"><?php echo $order_detail2[0]['amt_date'];?></span></td>
              </tr>
			  <tr>
                <th valign="top"  style="font-size:13px;"><?php echo AGENTSCOMMISION;?>:</th>
                <td><span style="text-align:left"><?php 
				if($agents_commision[0]['agents_commision'] != ""){
				echo $agents_commision[0]['agents_commision'] . "%";
				}
				else{
				echo "0.00%";
				}
				?></span></td>
              </tr>
            <tr>
              <th valign="top">&nbsp;</th>
              <td><table width="100%" border="0">
      <tr  style="font-size:13px;">
        <th scope="col" align="center">&nbsp;</th>
        <th scope="col" align="center" style="text-align:center">&nbsp;</th>
        <th scope="col" style="text-align:center">&nbsp;</th>
        <th scope="col" style="text-align:center">&nbsp;</th>
      </tr>
      <tr  style="font-size:13px;">
        <th width="45%" scope="col" align="center">Book Name</th>
        <th width="20%" scope="col" align="center" style="text-align:center">Price</th>
        <th width="17%" scope="col" style="text-align:center">Quantity</th>
        <th width="18%" scope="col" style="text-align:center"><div align="right">Price*Qty</div></th>
      </tr>
    <?php 
$a=1;
					for($i=0;$i<count($order_detail);$i++)
					{
					/*echo "<pre>";
					print_r($orderbooks);*/
					?>  <tr>
        <td><?php echo "<b>".$a++.")</b>&nbsp;".$order_detail[$i]['book_name'];?></td>
        <td align="center"><?php echo $order_detail[$i]['book_price'];?></td>
        <td align="center"><?php echo $order_detail[$i]['book_qty'];?></td>
        <td align="right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail[$i]['book_qty']*$order_detail[$i]['book_price'],2,".",",");?></td>
      </tr>
      <?php
	  }

	  ?>
      <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:55px;">Total:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['total_amt'],2,".",",");?></td>
        </tr>
       <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:13px;">Discount&nbsp;(%):</th>
       <td scope="col" style="text-align:right"><?php echo number_format($order_detail2[0]['discount']);?></td>
        </tr>
        <tr>
        <th colspan="3" scope="col" style="text-align:right">Transportation:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['transport_cost'],2,".",",");?></td>
        </tr>
        <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Postage:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['postage_cost'],2,".",",");?></td>
        </tr>
        
        <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Net total:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['total_amt_withanothercost'],2,".",",");?></td>
        </tr>
         <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Payment Type:</th>
       <td scope="col" style="text-align:right"><?php if($order_detail2[0]['payment_type']==1){echo "Front Payment";}else{echo "Credit";}?></td>
        </tr>
        <?php
		if($order_detail2[0]['payment_type']==1)
		{
		?>
          <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Front Payment Type:</th>
       <td scope="col" style="text-align:right"><?php if($order_detail2[0]['front_payment_type']==1){echo "Cash";}else if($order_detail2[0]['front_payment_type']==2){echo "Cheque";} else {echo "VPP";}?></td>
        </tr> 
       <?php
	   }
	   ?>
         <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Paid Payment:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['enter_payment'],2,".",",");?></td>
        </tr>
         <?php
        if($order_detail2[0]['pending_payment']!=0.00)
		{
		?>
          <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Pending Payment:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['pending_payment'],2,".",",");?></td>
        </tr>
        <?php
		}
        if($order_detail2[0]['balance_payment']!=0.00)
		{
		?>
          <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Balance:</th>
       <td scope="col" style="text-align:right"><?php echo "<b>Rs</b>&nbsp;".number_format($order_detail2[0]['balance_payment'],2,".",",");?></td>
        </tr>
        <?php
		}
        if($order_detail2[0]['manual_payment']!=0)
		{
		?>
         <tr>
        <th colspan="3" scope="col" style="text-align:right;padding-right:36px;">Manual Order number:</th>
       <td scope="col" style="text-align:right"><?php echo $order_detail2[0]['order_number'];?></td>
        </tr>
        	<?php
			}
			?>
    </table></td>
            </tr>
            <tr>
              <th width="71" valign="top">&nbsp;</th>
              <td width="406" style="text-align:right;"><label> <!--<input type="button" value="Print" name="button" onclick="ctest();" style="cursor:pointer;width:80px;height:30px;float:right;"/>--></label></td>
            </tr>
                <tr>
              <th colspan="2" valign="top">                            </th>
            </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">                           </td>
            </tr>
        </table>
   </form>
  	<!-- end id-form  -->
</td>
	<td align="left"> </td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>

<div class="clear"></div>
 

</div>
		