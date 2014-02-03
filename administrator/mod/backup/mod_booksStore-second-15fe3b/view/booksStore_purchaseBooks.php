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
<?php
$booksStore_addNewBook=new model_booksStore_purchaseBooks();

?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_booksStore&view=purchaseBooks&m=5" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddbook();" >
     <input type="hidden" name="business_type" value="0" />
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
              <tr>
                <th valign="top">Select Academies<span class="red">* </span>:</th>
                <td><span id="second"><select name="party" id="party" class="selectbox" style="padding:4px 0 0 6px;">
                  <option value="">Select Academy</option>
                  <?php
                   $businesss=$booksStore_addNewBook->get_all_businesstype();
				   for($i=0;$i<count($businesss);$i++)
				   {
				   ?>
                  <option value="<?php echo $businesss[$i]['parties_id'];?>"><?php echo $businesss[$i]['business_title'];?></option>
                  <?php
				   }
				   ?>
                 </select></span><br />
                 <a style="color:blue;padding-left:4px;" href="./?mod=mod_businessType&view=addNewbusinessType&m=2">Click here to add new academy</a></td>
              </tr>
              <tr>
              <th valign="top">Want Royality:</th>
              <td><label>
                <input name="royality" type="checkbox" id="royality" value="1" onclick="hide_unhide('royality','#hide-unhide')" />
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
				   <option value="<?php echo $writers[$i]['writer_id'];?>"><?php echo $writers[$i]['writer_name'];?></option>
                   <?php
				   }
				   ?>
                 </select>
                 </label><br /><a style="color:blue;padding-left:4px;" href="./?mod=mod_writers&view=addNewWriter&m=4">Click here to add new royality writer</a></td>
               </tr>
                <!--<tr>
              <th valign="top">Put Under Category:</th>
              <td><label>
                <input name="books-category" type="checkbox" id="books-category" value="1" onclick="hide_unhide('books-category','#hide-unhide2')" />
              </label></td>
            </tr>-->
               <!--<tr id="hide-unhide2">
                 <th valign="top">&nbsp;</th>
                 <td><label>
                   <select name="category" id="category" class="selectbox" style="padding:4px 0 0 6px;">
                   <option value="">Select Category</option>-->
                   <?php
                  /* $categories=$booksStore_addNewBook->get_all_categories();
				   for($i=0;$i<count($categories);$i++)
				   {*/
				   ?>
				   <!--<option value="<?php //echo $categories[$i]['cat_id'];?>"><?php //echo $categories[$i]['cat_title'];?></option>-->
                   <?php
				  /* }*/
				   ?>
                <!-- </select>
                 </label><br />
                 <a style="color:blue;padding-left:4px;" href="./?mod=mod_booksCategory&view=addNewCategory&m=2">Click here to add new book category</a></td>
               </tr>-->
                <tr>
              <th valign="top">Book Name<span class="red">* </span>:</th>
              <td><input type="text"  name="book_name" value="<?php echo $modelName; ?>"  id="book_name" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Book Author<span class="red">* </span>:</th>
              <td><input type="text"  name="book_author" value="<?php echo $modelName; ?>"  id="book_author" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top"> Purchase Price<span class="red">*</span> :</th>
              <td><input type="text"  name="book_price" value="<?php echo $modelName; ?>"  id="book_price" maxlength="50" class="textbox" onkeyup="isPrice(document.getElementById('book_price'), 'Numbers Only Please');" /></td>
            </tr>
            <tr>
              <th valign="top"> Selling Price<span class="red">*</span> :</th>
              <td><input type="text"  name="sell" value="<?php echo $modelName; ?>"  id="sell" maxlength="50" class="textbox" onkeyup="isPrice(document.getElementById('sell'), 'Numbers Only Please');" /></td>
            </tr>
               <tr>
                 <th valign="top">Description<span class="red">*</span> :</th>
                 <td><label>
                   <textarea name="desc" id="desc" cols="45" rows="5"></textarea>
                 </label></td>
               </tr>
            <tr>
              <th valign="top">Upload Image<span class="red">* </span>:</th>
              <td><label>
                <input type="file" name="file1" id="file1" />
              </label></td>
            </tr>
               <tr>
              <th valign="top">Quantities<span class="red">*</span> :</th>
              <td><input type="text"  name="quantity" value="<?php echo $modelName; ?>"  id="quantity" maxlength="50" class="textbox" onkeyup="isNumeric(document.getElementById('quantity'), 'Numbers Only Please');" /></td>
            </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="purchase_new_book"  />
                <input type="hidden" name="mod" value="mod_booksStore"  />
                <input type="button" value="" class="form-submit"  name="button" onclick="checkPurchasebook();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_booksStore&view=default&m=1'"  style="cursor:pointer;"/>            </td>
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
		