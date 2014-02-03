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
$model_booksStore_sell_books = new model_booksStore_sell_books();
$particular_book = $model_booksStore_sell_books->getBookData($_REQUEST);
/*echo "<pre>";
print_r($particular_book);*/
?>
<script type="text/javascript">
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
</script>
<div id="content-table-inner" class="Add_New_Web_Page">
	
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
   <form id="billform" action="./?mod=mod_booksStore&view=sell_books&m=2" name="billform" method="post" >
   <input type="hidden" name="controller" value="generate_bill"  />
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              <tr>
              <th width="69" valign="top">Business Type:</th>
            <td width="354"><label>
                <select name="select" id="select" class="selectbox" style="padding:4px 0 0 3px;width:40%;" onchange="get_parties(this.value)">
                <option value="0">Select Business type</option>
                <?php
				$business=new model_booksStore_sell_books();
				$businesslist=$business->get_all_business_type();
				for($i=0;$i<count($businesslist);$i++)
				{
				?>
                <option value="<?php echo $businesslist[$i]['buiness_cat_id']; ?>"><?php echo $businesslist[$i]['business_cat_title']; ?></option>
                <?php
				}
				?>
                </select>
              </label></td>
            </tr>
            <tr>
              <th width="69" valign="top">Select Party:</th>
              <td width="354" id="second">
                <select name="party" id="party" class="selectbox" style="padding:4px 0 0 3px;width:40%;" >
                <option value="0">Select Party</option>
                <option value="0">No record found</option>
                </select>             </td>
            </tr>
            <tr>
              <th valign="top">&nbsp;</th>
              <td id="second2" style="display:none">&nbsp;</td>
            </tr>
            <tr>
              <th width="69" valign="top">&nbsp;</th>
              <td width="354"><label> <input type="button" value="Generate Bill" name="button" onclick="check_sellcart();" style="cursor:pointer;width:88px;height:30px;float:left;"/></label></td>
            </tr>
                <tr>
              <th colspan="2" valign="top">
              
                            </th>
            </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">                           </td>
            </tr>
        </table></form>
  	<!-- end id-form  -->
</td>
	<td align="left"> <table width="100%" border="0">
      <tr>
        <th width="56%" scope="col" align="center">Book </th>
        <th width="16%" scope="col" align="center">Qty(Avail)</th>
        <th width="28%" scope="col" align="center">Price*Qty</th>
      </tr>
    <?php 
					if(count($_SESSION['cart'])>0)
					{
					$your_cart=new model_booksStore_sell_books();
					$max=count($_SESSION['cart']);
					$a=1;
					for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$Books=$your_cart->get_product_name($pid);
					//extract($row);
					if($q==0) continue;
					?>  <tr>
        <td><?php echo "<b>".$a++.")</b>&nbsp;".$Books['book_name'];?></td>
        <td align="center"><?php echo $q."<b>(".$Books['quantities'].")</b>";?></td>
        <td align="right"><?php echo number_format($your_cart->get_price($pid)*$q,2,".",",");?></td>
      </tr>
      <?php
	  }
	  }
	  
	  ?>
       <tr>
        <th colspan="3" scope="col" align="right"><?php //echo $check=$your_cart->check_is_quantity_available();?>Total:<?php echo "Rs".number_format($your_cart->get_order_total(),2,".",",");?></th>
        </tr>
    </table></td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>

<div class="clear"></div>
 

</div>
		