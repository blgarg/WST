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
if(isset($_REQUEST['book_id']) && $_REQUEST['book_id']!='')
{
$booksStore_addNewBook=new model_booksStore_editpurchaseBooks();
$books_particular_data=$booksStore_addNewBook->get_data_withid($_REQUEST);
/*echo "<pre>";
print_r($books_particular_data);
echo "</pre>";*/
}
?>
<script type="text/javascript">
$(document).ready(function(){ 
if ($('#royality').attr('checked')){

  $('#hide-unhide').show();
  }
  else
  {
  $('#hide-unhide').hide();
  }
if ($('#books-category').attr('checked')){

  $('#hide-unhide2').show();
  }
  else
  {
  $('#hide-unhide2').hide();
  }
  
});


function hide_unhide(checkbox_id,divhide)
{ 
$(divhide).toggle();
}
function changeparties(value)
{
var url="mod/mod_booksStore/model/codes.php?party_id="+value;
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
function get_edit_value()
{
var values=document.getElementById("business_type").value;
changepartiesedit(values);
}
function changepartiesedit(value)
{
var url="mod/mod_booksStore/model/codes.php?party_editid="+value+"&dbid="+<?php echo $books_particular_data[0]['party_id'];?>;
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
window.onload=get_edit_value; 
function divhide(value)
{
//
	if(value==1)
	{
	document.getElementById("minus quantity").style.display="none";
	document.getElementById("add_quantity").style.display="block";
	}
	else if(value==2)
	{
	document.getElementById("add_quantity").style.display="none";
	document.getElementById("minus quantity").style.display="block";
	}
}
</script>
<?php



?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_booksStore&view=editpurchaseBooks&m=6&book_id=<?php echo $_REQUEST['book_id'];?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddbook();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              <tr>
                <th valign="top"> Academies type<span class="red">* </span>:</th>
                <td><select name="business_type" id="business_type" class="selectbox" style="padding:4px 0 0 6px;" onchange="changeparties(this.value)">
                  <option value="">Select Academies type</option>
                  <?php
                   $businesss=$booksStore_addNewBook->get_all_businesstype();
				   for($i=0;$i<count($businesss);$i++)
				   {
				   ?>
                  <option value="<?php echo $businesss[$i]['buiness_cat_id'];?>"<?php if($books_particular_data[0]['business_id']==$businesss[$i]['buiness_cat_id']) echo 'selected';?>><?php echo $businesss[$i]['business_cat_title'];?></option>
                  <?php
				   }
				   ?>
                </select><br /><a style="color:blue;padding-left:4px;" href="./?mod=mod_businessCategory&view=addNewCategory&m=4">Click here to add new business type</a></td>
              </tr>
              <tr>
                <th valign="top">Select Academies<span class="red">* </span>:</th>
                <td><span id="second"><select name="party" id="party" class="selectbox" style="padding:4px 0 0 6px;">
                  <option value="">Select Party</option>
                  <option value="">No record found</option>
                 </select></span><br /><a style="color:blue;padding-left:4px;" href="./?mod=mod_businessType&view=addNewbusinessType&m=2">Click here to add new business party</a></td>
              </tr>
              <tr>
              <th valign="top">Want Royality:</th>
              <td><label>
                <input name="royality" <?php if($books_particular_data[0]['royality_writer_id']!=0) echo "checked";?> type="checkbox" id="royality" value="1" onclick="hide_unhide('royality','#hide-unhide')" />
              </label></td>
            </tr>
               <tr id="hide-unhide">
                 <th valign="top">&nbsp;</th>
                 <td><label>
                   <select name="writer" id="writer" class="selectbox" style="padding:4px 0 0 6px;">
                   <option value="">Select Royality Writer</option>
                   <?php
                   $writers=$booksStore_addNewBook->get_all_writers();
				   for($i=0;$i<count($writers);$i++)
				   {
				   ?>
				   <option value="<?php echo $writers[$i]['writer_id'];?>"<?php if($books_particular_data[0]['royality_writer_id']==$writers[$i]['writer_id']) echo "selected";?>><?php echo $writers[$i]['writer_name'];?></option>
                   <?php
				   }
				   ?>
                 </select>
                 </label><br /><a style="color:blue;padding-left:4px;" href="./?mod=mod_writers&view=addNewWriter&m=4">Click here to add new royality writer</a></td>
               </tr>
                <!--<tr>
              <th valign="top">Put Under Category:</th>
              <td><label>
                <input name="books-category" <?php //if($books_particular_data[0]['book_cat_id']!=0) echo "checked";?> type="checkbox" id="books-category" value="1" onclick="hide_unhide('books-category','#hide-unhide2')" />
              </label></td>
            </tr>-->
               <!--<tr id="hide-unhide2">
                 <th valign="top">&nbsp;</th>
                 <td><label>
                   <select name="category" id="category" class="selectbox" style="padding:4px 0 0 6px;">
                   <option value="">Select Category</option>-->
                   <?php
                   /*$categories=$booksStore_addNewBook->get_all_categories();
				   for($i=0;$i<count($categories);$i++)
				   {*/
				   ?>
				   <!--<option value="<?php //echo $categories[$i]['cat_id'];?>"<?php //if($books_particular_data[0]['book_cat_id']==$categories[$i]['cat_id']) echo "selected";?>><?php //echo $categories[$i]['cat_title'];?></option>-->
                   <?php
				/*   }*/
				   ?>
                 <!--</select>
                 </label><br />
                 <a style="color:blue;padding-left:4px;" href="./?mod=mod_booksCategory&view=addNewCategory&m=2">Click here to add new book category</a></td>
               </tr>-->
                <tr>
              <th valign="top">Book Name<span class="red">* </span>:</th>
              <td><input type="text"  name="book_name" value="<?php echo $books_particular_data[0]['book_name']; ?>"  id="book_name" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Book Author<span class="red">* </span>:</th>
              <td><input type="text"  name="book_author" value="<?php echo $books_particular_data[0]['book_author']; ?>"  id="book_author" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top"> Purchase Price<span class="red">*</span> :</th>
              <td><input type="text"  name="book_price" value="<?php echo $books_particular_data[0]['party_price']; ?>"  id="book_price" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Selling Price<span class="red">*</span> :</th>
              <td><input type="text"  name="sell_price" value="<?php echo $books_particular_data[0]['book_price']; ?>"  id="sell_price" maxlength="50" class="textbox"/></td>
            </tr>
               <tr>
                 <th valign="top">Description<span class="red">*</span> :</th>
                 <td><label>
                   <textarea name="desc" id="desc" cols="45" rows="5"><?php echo $books_particular_data[0]['description']; ?></textarea>
                 </label></td>
               </tr>
            <tr>
              <th valign="top">Upload Image<span class="red">* </span>:</th>
              <td><label>
                <input type="file" name="file1" id="file1" />
              </label></td>
            </tr>
               <tr>
              <th valign="top">Current Quantity<span class="red">*</span> :</th>
              <td><input type="text" disabled="disabled" name="quantity" value="<?php echo $books_particular_data[0]['quantities']; ?>"  id="quantity" maxlength="50" class="textbox" style="width:25%;"/>&nbsp;
                <label><select name="action_type" id="action_type" class="selectbox" style="padding:4px 0 0 6px;width:27%;" onchange="divhide(this.value)">
                  <option value="">Select Action</option>
                  <option value="1">Increase quantity</option>
                  <option value="2">Decrease quantity</option>
                </select></label></td>
            </tr>
               <tr>
                 <th valign="top">&nbsp;</th>
                 <td><span id="add_quantity" style="display:none;"><b>Add values for increase quantity:</b> <input type="text" name="quantity_add" value=""  id="quantity_add" maxlength="50" class="textbox" style="width:25%;"/></span><span id="minus quantity" style="display:none;"><b>Add values for decrease quantity:</b> <input type="text" name="quantity_decrease" value=""  id="quantity_decrease" maxlength="50" class="textbox" style="width:25%;"/></span></td>
               </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="edit_purchase_book"  />
                <input type="hidden" name="mod" value="mod_booksStore"  />
                <input type="hidden" name="check_quantity" value="<?php echo $books_particular_data[0]['quantities']; ?>" />
                <input type="button" value="" class="form-submit"  name="button" onclick="checkPurchasebook();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_booksStore&view=default&m=1'"  style="cursor:pointer;"/>            </td>
            </tr>
        </table>
  	<!-- end id-form  -->
</td>
	<td align="left"><?php
				 if($books_particular_data[0]['upload_image']!='')
				 {
				 $imgsrc=$config_var->UPLOAD_URL.'books/medium/'.$books_particular_data[0]['upload_image'];
				 ?>
                 <img src="<?php echo $imgsrc;?>" />
                 <?php
					echo "<br>";			 }
				 ?>
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
		