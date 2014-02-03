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
  
  if((isset($_REQUEST['agent_id']))&&(@$_REQUEST['agent_id'] != '')){ 
                 				 $agent_id = (int)@$_REQUEST['agent_id']; 
								 $CatDb_OB = new JDatabaseMySQL();
						 		 $CatDb_OB->sql = "SELECT * FROM mgl_agents WHERE agent_id = '$agent_id'";
						 		 $CatDb_OB->query();
								 $PAGE_SEC_SET = $CatDb_OB->getArray();
	$model_agents_editagent = new model_agents_editagent();
	$agents = $model_agents_editagent->getPageData($_REQUEST);
/*	echo "<pre>";							
	print_r($agents);
	die;*/
}          
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_agents&view=editagent&d=5&agent_id=<?php echo $agent_id;?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkAddagents();">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top">Agent Name<span class="red">* </span>:</th>
              <td><input type="text"  name="agent_name" value="<?php echo $agents['agent_name'];?>"  id="agent_name" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Date Of Birth<span class="red">*</span> :</th>
              <td><input type="text"  name="dob" value="<?php echo $agents['agent_dob'];?>"  id="dob" maxlength="50" class="textbox"/></td>
            </tr>
               <tr>
                 <th valign="top">Address<span class="red">*</span> :</th>
                 <td><label>
                   <textarea name="addr1" id="addr1" cols="45" rows="5"><?php echo $agents['agent_address'];?></textarea>
                 </label></td>
               </tr>
            <tr>
              <th valign="top">Country<span class="red">* </span>:</th>
              <td><input type="text"  name="country" value="<?php echo $agents['agent_country'];?>"  id="country" maxlength="50" class="textbox"/></td>
            </tr>
               <tr>
              <th valign="top">State<span class="red">*</span> :</th>
              <td><input type="text"  name="state" value="<?php echo $agents['agent_state'];?>"  id="state" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">City<span class="red">*</span> :</th>
              <td><input type="text"  name="city" value="<?php echo $agents['agent_city'];?>"  id="city" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Phone no.<span class="red">*</span> :</th>
              <td><input type="text"  name="phone" value="<?php echo $agents['agent_phno'];?>"  id="phone" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
              <th valign="top">Mobile no.<span class="red">*</span> :</th>
              <td><input type="text"  name="mobile" value="<?php echo $agents['agent_mobno'];?>"  id="mobile" maxlength="50" class="textbox"/></td>
            </tr>
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="edit_agent"  />
                <input type="hidden" name="mod" value="mod_agents"  />
                <input type="button" value="" class="form-submit"  name="button" onclick="checkAddagent();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_agents&view=default&m=5'"  style="cursor:pointer;"/>            </td>
            </tr>
        </table><!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	
		
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
		