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
$model_booksStore_generateOrders = new model_booksStore_generateOrders();
$particular_book = $model_booksStore_generateOrders->getBookData($_REQUEST);
$your_cart=new model_booksStore_generateOrders();
$price=number_format($your_cart->get_order_total(),2,".",",");
/*echo "<pre>";
print_r($particular_book);*/
?>
<script type="text/javascript">
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function CurrencyFormatted(amount)
{
	var i = parseFloat(amount);
	if(isNaN(i)) { i = 0.00; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	i = parseInt((i + .005) * 100);
	i = i / 100;
	s = new String(i);
	if(s.indexOf('.') < 0) { s += '.00'; }
	if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
	s = minus + s;
	return s;
}
function get_totalprice()
{
var transport_cost=document.billform.transport_cost.value;
var postage_cost=document.billform.postage_cost.value;
var current_cart_price=document.billform.current_cart_price.value;
var discount=document.billform.discount.value;
		if(transport_cost!='' && postage_cost!='' && discount=='' && current_cart_price!='')
					{
						var totalprice=parseFloat(transport_cost)+parseFloat(postage_cost)+parseFloat(current_cart_price.replace(",",""));
						var percentage_amt=totalprice;
						var show_price=percentage_amt;
					}
		else
					{
						if(transport_cost!='')
						{
							var transport=parseFloat(transport_cost);
						}
						else
						{
							var transport=parseInt(0);
						}
						if(postage_cost!='')
						{
							var postage=parseFloat(postage_cost);
						}
						else
						{
							var postage=parseInt(0);
						}
						if(current_cart_price!='')
						{
						var current_cart=parseFloat(current_cart_price.replace(",",""));
						}
						else
						{
						var current_cart=parseInt(0);
						}
						var totalprice=transport+postage+current_cart;
						if(discount=="")
						{
						//var percentage_amt=(totalprice*parseFloat(discount))/100;
						var show_price=parseFloat(totalprice);
						}
						else
						{
						var percentage_amt=(totalprice*parseFloat(discount))/100;
						var show_price=parseFloat(totalprice-percentage_amt);
						}
					}
document.getElementById('price').innerHTML ="<b>Rs:&nbsp;"+addCommas(show_price)+"</b>";
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
function get_parties(value)
{

var url="mod/mod_booksStore/model/codes.php?bill_partyid="+value;
var obj
 try
    {
   obj=new XMLHttpRequest();    
     }
  catch(e)
    {
               try
              {
            obj=new ActiveXObject("Microsoft.XMLHTTP");
                }
        catch(e)
            {
           alert("Your Browser not supported Ajax");
              }
    }
obj.open("GET",url,true);
obj.send(null);
obj.onreadystatechange=function()
  {
  if(obj.readyState==4)
     {
       var res=obj.responseText;
    // alert(res); 
	   document.getElementById('second').innerHTML = res;
	   //alert("Record is Entered");
      }
  }

}
function get_partyinfo(value)
{


var url="mod/mod_booksStore/model/codes.php?partyid_info="+value;
var obj
 try
    {
   obj=new XMLHttpRequest();    
     }
  catch(e)
    {
               try
              {
            obj=new ActiveXObject("Microsoft.XMLHTTP");
                }
        catch(e)
            {
           alert("Your Browser not supported Ajax");
              }
    }
obj.open("GET",url,true);
obj.send(null);
obj.onreadystatechange=function()
  {
  if(obj.readyState==4)
     {
       var res=obj.responseText;
    // alert(res); 
	document.getElementById('second2').style.display="block";
	   document.getElementById('second2').innerHTML = res;
	   if(value==0)
		{
		document.getElementById('second2').style.display="none";
		}
	   //alert("Record is Entered");
      }
  }


}
/*function get_with_transport(value)
{
value=parseInt(value)+parseInt(<?php //echo $price;?>);
document.getElementById('price').innerHTML = value;
}*/
</script>

<div id="content-table-inner" class="Add_New_Web_Page">
	
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
   <form id="billform" action="./?mod=mod_booksStore&view=generateOrders&m=7" name="billform" method="post" >
<input type="hidden" name="current_cart_price" id="current_cart_price" value="<?php echo $price;?>" />
   <input type="hidden" name="controller" value="generate_order"  />
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              <tr>
              <th width="69" valign="top">Select Academy:</th>
            <td width="354"><label>
                <select name="select" id="select" class="selectbox" style="padding:4px 0 0 3px;width:40%;" onchange="get_parties(this.value)">
                <option value="0">Select Academy</option>
                <?php
				$business=new model_booksStore_generateOrders();
				$businesslist=$business->get_all_business_type();
				for($i=0;$i<count($businesslist);$i++)
				{
				?>
                <option value="<?php echo $businesslist[$i]['parties_id']; ?>"><?php echo $businesslist[$i]['business_title']; ?></option>
                <?php
				}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <th valign="top">&nbsp;</th>
              <td><table width="100%" border="0">
      <tr>
        <th width="56%" scope="col" align="center">Book </th>
        <th width="16%" scope="col" style="text-align:center">Qty(Avail)</th>
        <th width="28%" scope="col" style="text-align:center">Price*Qty</th>
      </tr>
    <?php 
					if(count($_SESSION['order'])>0)
					{
					$your_cart=new model_booksStore_generateOrders();
					$max=count($_SESSION['order']);
					$a=1;
					for($i=0;$i<$max;$i++){
					$pid=$_SESSION['order'][$i]['productid'];
					$q=$_SESSION['order'][$i]['qty'];
					$Books=$your_cart->get_product_name($pid);
					//extract($row);
					if($q==0) continue;
					?>  <tr>
        <td><?php echo "<b>".$a++.")</b>&nbsp;".$Books['book_name'];?></td>
        <td align="center"><?php echo $q."<b>(".$Books['quantities'].")</b>";?></td>
        <td align="right"><?php echo "<b>Rs</b>&nbsp;".number_format($your_cart->get_price($pid)*$q,2,".",",");?></td>
      </tr>
      <?php
	  }
	  }
	  
	  ?>
       <tr>
        <th colspan="3" scope="col" style="text-align:right"><?php //echo $check=$your_cart->check_is_quantity_available();?>Total:<?php echo "Rs".number_format($your_cart->get_order_total(),2,".",",");?></th>
        </tr>
      
    </table></td>
            </tr>
            <tr>
              <th width="69" valign="top">&nbsp;</th>
              <td width="354" style="text-align:right;"><label> <input type="button" value="Generate Order" name="button" onclick="check_ordercart();" style="cursor:pointer;width:103px;height:30px;float:right;"/></label></td>
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
		