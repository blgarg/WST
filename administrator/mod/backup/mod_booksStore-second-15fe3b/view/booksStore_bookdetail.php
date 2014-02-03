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
$model_booksStore_bookdetail = new model_booksStore_bookdetail();
$particular_book = $model_booksStore_bookdetail->getBookData($_REQUEST);
/*echo "<pre>";
print_r($particular_book);*/
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
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_booksStore&view=bookdetail&book_id=<?php echo $_REQUEST['book_id'];?>&m=2" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkadd_book_cart();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            
              <tr>
              <th valign="top">Royality writer:</th>
              <td><?php if($particular_book['royality_writer_id']==0){echo "N.A";} else {$writer_title=$model_booksStore_bookdetail->get_royalitywriter($particular_book['royality_writer_id']); echo $writer_title['writer_name'];}?></td>
            </tr>
                <tr>
              <th valign="top"> Category:</th>
              <td><?php if($particular_book['book_cat_id']==0){echo "N.A";} else {$book_title=$model_booksStore_bookdetail->get_book_category($particular_book['book_cat_id']); echo $book_title['cat_title'];/*$book_title['cat_title'];*/} ?></td>
            </tr>
                <tr>
              <th valign="top">Book Name:</th>
              <td><?php echo $particular_book['book_name'];?></td>
            </tr>
            <tr>
              <th valign="top">Book Author:</th>
              <td><?php echo $particular_book['book_author'];?></td>
            </tr>
            <tr>
              <th valign="top">Book Price:</th>
              <td><?php echo $particular_book['book_price'];?></td>
            </tr>
               <tr>
                 <th valign="top">Description:</th>
                 <td valign="top"><?php echo $particular_book['description'];?></td>
               </tr>
            <tr>
              <th valign="top">Available Quantity:</th>
              <td><?php echo $particular_book['quantities'];?></td>
            </tr>
               <tr>
              <th valign="top">Add your Quantity<span class="red">*</span> :</th>
              <td><input style="width:27%;" type="text"  name="quantity"   id="quantity" maxlength="50" class="textbox" value="<?php if(isset($_COOKIE['cook_quantity'])) echo $_COOKIE['cook_quantity'];?>" onkeyup="isNumeric(document.getElementById('quantity'), 'Numbers Only Please');" /></td>
            </tr>
            
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_book_cart"  />
                <input type="hidden" name="mod" value="mod_booksStore"  />
                <input type="button" value="Add to cart" name="button" onclick="checkadd_book_cart();" style="cursor:pointer;width:80px;height:30px;float:left;"/>
                <input type="button" value="" class="form-reset"  onclick="history.go(-1)"  style="cursor:pointer;"/>            </td>
            </tr>
        </table>
  	<!-- end id-form  -->
</td>
	<td align="left"> <?php
				 if($particular_book['upload_image']!='')
				 {
				 $imgsrc=$config_var->UPLOAD_URL.'books/medium/'.$particular_book['upload_image'];
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
		