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
$model_booksStore_issue_type = new model_booksStore_issue_type();
$particular_book = $model_booksStore_issue_type->getBookData($_REQUEST);
/*echo "<pre>";
print_r($particular_book);*/
?>
<script type="text/javascript">
function divhide(value)
{
//
	if(value==0)
	{
	document.getElementById("show_employee").style.display="none";
	document.getElementById("show_gift").style.display="none";
	}else if(value==1)
	{
	document.getElementById("show_employee").style.display="none";
	document.getElementById("show_gift").style.display="block";
	}
	else if(value==2)
	{
	document.getElementById("show_gift").style.display="none";
	document.getElementById("show_employee").style.display="block";
	}
}
function get_information(value)
{

var url="mod/mod_booksStore/model/codes.php?emp_id="+value;
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
</script>
<div id="content-table-inner" class="Add_New_Web_Page">
	
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              <tr>
              <th width="69" valign="top">Issue Book Type:</th>
              <td width="354"><label>
                <select name="select" id="select" class="selectbox" style="padding:4px 0 0 3px;width:40%;" onchange="divhide(this.value)">
                <option value="0">Select Issue book type</option>
                <option value="1">Gift</option>
                <option value="2">Fair</option>
                </select>
              </label></td>
            </tr>
                <tr>
              <th colspan="2" valign="top">
              <div id="show_gift" style="float:left;width:100%;line-height:0px;display:none;">
             <form name="form1" id="form1" action="./index.php?mod=mod_booksStore&view=issue_type&m=4" method="post"> <table width="100%" border="0" id="id-form">
                <tr>
                  <th style="width:27%;" scope="col">Enter person name:</th>
                  <th width="87%" scope="col">
                      <input type="text" name="person_name" id="person_name" class="textbox" />
                    
                 </th>
                </tr>
                <tr>
                  <th scope="col" valign="top">Enter person detail:</th>
                  <th scope="col">
                      <textarea name="detail" id="detail" cols="45" rows="5"></textarea>
                  </th>
                </tr>
                <tr>
                  <th scope="col" valign="top"></th>
                  <th scope="col">
                     <input type="hidden" name="controller" value="issue_gift_books"  />
                <input type="hidden" name="mod" value="mod_booksStore"  />
                <input type="button" value="Gift book" name="button" onclick="checkbookcart();" style="cursor:pointer;width:88px;height:30px;float:left;"/>
                  </th>
                </tr>
              </table></form>
              </div>
              <div id="show_employee" style="display:none;">
              <form name="form2" id="form2" action="./index.php?mod=mod_booksStore&view=issue_type&m=4" method="post">
              <table width="100%" border="0" id="id-form">
                <tr>
                  <th style="width:27%;" scope="col">Select Employee:</th>
                  <th width="87%" scope="col"><?php
					$employees=new model_booksStore_issue_type();
					$employeelist=$employees->employee_list();
					?><select name="select2" id="select2" class="selectbox" style="padding:4px 0 0 3px;width:40%;" onchange="get_information(this.value)">
                    <option value="0">Select employee</option>
                    <?php
					for($i=0;$i<count($employeelist);$i++)
					{
					?>
                    <option value="<?php echo $employeelist[$i]['emp_id']; ?>"><?php echo $employeelist[$i]['emp_fname']." ".$employeelist[$i]['emp_lname']; ?></option>
                    <?php
					}
					?>
                  </select>                 </th>
                </tr>
                <tr>
                  <th scope="col" valign="top">&nbsp;</th>
                  <th scope="col" id="second">&nbsp;</th>
                </tr>
                <tr>
                  <th scope="col" valign="top">&nbsp;</th>
                  <th scope="col" ><input type="hidden" name="controller" value="issue_emp_books"  />
                <input type="hidden" name="mod" value="mod_booksStore"  />
                <input type="button" value="Generate Bill" name="button" onclick="check_emp_cart();" style="cursor:pointer;width:88px;height:30px;float:left;"/></th>
                </tr>
              </table></form>
              </div>
              </th>
            </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                
                           </td>
            </tr>
        </table>
  	<!-- end id-form  -->
</td>
	<td align="left"> <table width="100%" border="0">
      <tr>
        <th width="56%" scope="col" align="center">Book </th>
        <th width="16%" scope="col" align="center">Qty(Avail)</th>
        <th width="28%" scope="col" align="center">Price*Qty</th>
      </tr>
    <?php 
					if(count($_SESSION['issue_cart'])>0)
					{
					$your_cart=new model_booksStore_issue_type();
					$max=count($_SESSION['issue_cart']);
					$a=1;
					for($i=0;$i<$max;$i++){
					$pid=$_SESSION['issue_cart'][$i]['productid'];
					$q=$_SESSION['issue_cart'][$i]['qty'];
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
		