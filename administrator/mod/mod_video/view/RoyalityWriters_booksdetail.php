<?php 
global $config_var;  
global $DataSet;
//config URL 
//$config_var->ADMIN_TPL_URL
include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
// Create class instance.
$CKEditor = new CKEditor();
$CKEditor->returnOutput = true;
$CKEditor->basePath = './ckeditor/';
$CKEditor->config['width'] =700;
$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 10);
$initialValue = '<p>This is some <strong>sample text</strong>. You are using <a href="http://ckeditor.com/">CKEditor</a>.</p>';
$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';
$model_RoyalityWriters_booksdetail = new model_RoyalityWriters_booksdetail();
$taxes_detail=$model_RoyalityWriters_booksdetail->get_all_taxes_detail($_REQUEST);

?>


<div id="content-table-inner" class="Add_New_Web_Page" style="float:left;">
	
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
   <form id="billform" action="./?mod=mod_booksStore&view=generateOrders&m=7" name="billform" method="post" >
<input type="hidden" name="current_cart_price" id="current_cart_price" value="<?php echo $price;?>" />
   <input type="hidden" name="controller" value="generate_order"  />
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top">&nbsp;</th>
              <td><table width="100%" border="0">
      <tr  style="font-size:13px;">
        <th width="56%" scope="col" align="center">Book Name</th>
        <th width="16%" scope="col" style="text-align:center">Quantity</th>
        <th width="28%" scope="col" style="text-align:center"><div align="right">Price*Qty</div></th>
      </tr>
    <?php 
					$orderbooks=model_RoyalityWriters_booksdetail::get_all_books_withorder($_REQUEST);$a=1;
					for($i=0;$i<count($orderbooks);$i++)
					{
					/*echo "<pre>";
					print_r($orderbooks);*/
					?>  <tr>
        <td><?php echo "<b>".$a++.")</b>&nbsp;".$orderbooks[$i]['book_name'];?></td>
        <td align="center"><?php echo $orderbooks[$i]['book_qty'];?></td>
        <td align="right"><?php echo "Rs".number_format($orderbooks[$i]['book_qty']*$orderbooks[$i]['book_price'],2,".",",");?></td>
      </tr>
      <?php
	  }

	  ?>
       <tr>
       <th colspan="2" scope="col" style="text-align:right">Total:</th>
        <th colspan="1" scope="col" style="text-align:right"><?php echo "Rs".number_format($taxes_detail[0]['total_amt'],2,".",",");?></th>
        </tr>
    </table></td>
            </tr>
            <tr>
              <th width="71" valign="top">&nbsp;</th>
              <td width="351" style="text-align:right;"><label> <input type="button" value="Print" name="button" onClick="ctest();" style="cursor:pointer;width:80px;height:30px;float:right;"/></label></td>
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
		