<?php 
global $config_var;  
global $DataSet;
//config URL 
//$config_var->ADMIN_TPL_URL
//include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
// Create class instance.

$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';
?>
<style type="text/css">
.DOBclass
{
    border: 1px solid #D7D7D7;
    border-radius: 8px 8px 8px 8px;
    font-size: 14px;
    height: 25px;
    line-height: 24px;
    padding: 0 0 0 6px;
}
</style>
<script type="text/javascript">
function isPrice(elem, helperMsg){
	var numericExpression = /^[-]?([1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|\.[0-9]{1,2})$/;
	if(elem.value.match(numericExpression)){
	    return true;
	}else{
		elem.focus();
		elem.value="";
		//document.getElementById('sunny').innerHTML = "";
		return false;
	}
}

function isNumeric(elem, helperMsg){
	var numericExpression = /^[-]?([1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|\.[0-9]{1,2})$/;
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
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_payments&view=recivepaymt&m=11" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddpmt();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top"><?php echo "Pending Payment";?> :</th>
              <td> &nbsp;&nbsp;<?php echo @$_REQUEST['pendpmt'];?></td>
            </tr>
           
              <th valign="top"><?php echo PMT;?><span class="red">* </span>:</th>
              <td><input type="text"  name="recv_pmt" value=""   id="recv_pmt" maxlength="20" class="textbox" onkeyup="isPrice(document.getElementById('recv_pmt'), 'Numbers Only Please');" /></td>
            </tr>
       
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
            <input type="hidden" name="biztype" value="<?php echo $_REQUEST['type']; ?>"  />
            <input type="hidden" name="party_id" value="<?php echo $_REQUEST['partiesId']; ?>"  />
             <input type="hidden" name="paymt_id" value="<?php echo $_REQUEST['paymt_id']; ?>"  />
             <input type="hidden" name="curtpmt" value="<?php echo $_REQUEST['curtpmt']; ?>"  />
                <input type="hidden" name="controller" value="add_receive_pmt"  />
                <input type="hidden" name="mod" value="mod_payments"  />
                <input type="button" value="<?php echo SAVE;?>"  name="button" onclick="checkAddpmt();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>"  onclick="window.location.href='./?mod=mod_payments&view=default&m=11'"  style="cursor:pointer;width:70px;height:30px;"/>            </td>
            </tr>
        </table>
  	<!-- end id-form  -->
</td>
	<td align="left">
</td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 </form> 
 
<div class="clear"></div>
 

</div>
		<script type="text/javascript">
        function areaOnBlur(element, inputText)
{

     if(element.value=='')
     {

          element.value = '';

     }

}
function areaOnFocus(element, inputText)
{

     if(element.value == inputText)
     {

          element.value='';

     }

}
        </script>