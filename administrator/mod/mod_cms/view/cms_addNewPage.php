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
  
/*  if((isset($_REQUEST['page_id']))&&(@$_REQUEST['page_id'] != '')){ 
                  				 echo $page_id = (int)@$_REQUEST['page_id']; 
								 
								 $CatDb_OB = new JDatabaseMySQL();
						 		 $CatDb_OB->sql = "SELECT * FROM mgl_pages WHERE page_id = '$page_id'";
						 		 $CatDb_OB->query();
								 $PAGE_SEC_SET = $CatDb_OB->getArray();
								
				  				} */     
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_cms&view=addNewPage&m=1" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddmodel();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Page Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="page_title" value="<?php echo $modelName; ?>"  id="page_title" maxlength="50" class="textbox" style="width:74%;"/></td>
            </tr>
            
            
          
           <tr>
            <th valign="top">Meta Title <span class="red">*</span>:</th>
            <td><textarea name="page_meta_tags" id="page_meta_tags"  style="width:74%;"></textarea></td>
           </tr>
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
             
              <th valign="top">Meta Description<span class="red">*</span>:</th>
              <td><textarea name="meta_desc"  id="meta_desc"  style="width:74%;"></textarea></td>
            </tr>
            <tr>
              <th valign="top">Description:</th>
              <td><?php echo $code = $CKEditor->editor("pageText", @$page_content,$config);?></td>
            </tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_page"  />
                <input type="hidden" name="mod" value="mod_cms"  />
             <input type="button" value="" class="form-submit"  name="button" onclick="checkAddPage();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_cms&view=default&d=3'"  style="cursor:pointer;"/>          </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	<?php /*<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<a href="#"  id="Categories_top"  style="cursor:text">Latest Model</a>
        </div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner" style="float:left">
			 		<?php 
						  $JDatabaseMySQL = new JDatabaseMySQL();
						  $JDatabaseMySQL->sql = "SELECT * FROM mgl_models order by model_id DESC limit 10";
						  $JDatabaseMySQL->query();
						  $latestModel = $JDatabaseMySQL->loadAssoc();
						  ?>
					<ul>
                    <?php   $j = 0;
					        for($i=0;$i<count($latestModel);$i++): $j++;?>
							<li><div id="checkbox"><?php echo @$j;?></div>
                            <div id="cat_name" class="breakword">
							<!--<a href="./?mod=mod_cms&view=ViewBanner&m=1&bannerId=<?php //echo $latestBanners[$i]['model_id'];?>">-->
							<?php if(strlen(@$latestModel[$i]['model_name']) >50){ echo ucfirst(substr(@$latestModel[$i]['model_name'],0,50))."...";}else{ echo @ucfirst($latestModel[$i]['model_name']);}?>
                            <!--</a>-->
                            </div>
                            </li> 
                        
                                           
					<?php endfor; ?>						                      
					</ul>
				</div>
				
			</div>
			<!-- end related-act-inner by Rohit kundal -->
			<div class="clear"></div>
		
		</div> */?>
		
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
		