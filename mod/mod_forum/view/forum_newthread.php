<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;
//config URL 
//$config_var->ADMIN_TPL_URL
include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
// Create class instance.
/*$CKEditor = new CKEditor();
$CKEditor->returnOutput = true;
$CKEditor->basePath = './ckeditor/';
$CKEditor->config['width'] =700;
$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 10);
$initialValue = '<p>This is some <strong>sample text</strong>. You are using <a href="http://ckeditor.com/">CKEditor</a>.</p>';*/
$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';

$getCatById=$model->getCatById($_REQUEST['id']);
if(isset($_REQUEST['sub_cat']) && !empty($_REQUEST['sub_cat']))
{
$getSubCatById=$model->getSubCatById($_REQUEST['sub_cat']);
$getForumSubCatById=$model->getForumSubCatById($_REQUEST['sub_cat']);
$getMainForumById = $model->getMainForumById($_REQUEST['sub_cat']);
}
?>
<style type="text/css">
td,th{ margin: 5x;;
    padding: 5px;
	font-size:12px;
	font-weight:bold;
	}
.textbox {
    border: 1px solid #D7D7D7;
    border-radius: 8px;
    font-size: 14px;
    height: 25px;
    line-height: 24px;
    padding: 0 0 0 6px;
    width: 90%;
}
</style>
<div class="MainWraper">
<div class="body_wrapper">
  <div id="breadcrumb" class="breadcrumb">
    <ul class="floatcontainer">
        <li class="navbithome"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default" accesskey="1"><img title="Home" src="<?php echo $config_var->WEB_TPL_URL;?>images/forum/navbit-home.png" alt="Home"></a></li>
      <li class="navbit"><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=default">Forum</a></li>
      <li class="navbit" <?php if(!isset($_REQUEST['sub_cat']) && empty($_REQUEST['sub_cat'])){?>style="background-image:none;" <?php }?>><a href="<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=display&id=<?php echo $_REQUEST['id'];?>"><?php echo ucfirst($getCatById[0]['cat_name']);?></a></li>
    <?php if(isset($_REQUEST['sub_cat']) && !empty($_REQUEST['sub_cat'])){?>  <li class="navbit lastnavbit"><span><?php echo ucfirst($getSubCatById[0]['sub_cat_name']);?></span></li> <?php }?>
    </ul>
    <hr>
  </div>
  
  <!-- Start worldsextraveler Programming -->
  <div class="isg_background_border_banner" align="center" style="margin-bottom: 10px;margin-top: 10px;"> 
    <!--<font color=red><b>[Add Invocation Code for Banner #2 Here]</b></font>--> 
    
  </div>
  <!-- End worldsextraveler Programming -->
  <div class="bar-guide-con">
            	<div class="b-guide-hdr" style="float:left; ">
                	 Forum: <span class="forumtitle"><?php echo ucfirst($getSubCatById[0]['sub_cat_name']);?></span>
                   
                </div>
                <div class="bar-guide-txt">
                
                	<form action="./?mod=mod_forum&view=newthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>" onsubmit=" return checkAddCategory();" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  style="float:right;"  >
    <table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Forum Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="title" value="<?php //echo $modelName; ?>"  id="category_title" maxlength="50" class="textbox"/><br/><div id="category_msg" style="color:#FF0000"></div></td>
            </tr>
		
            <tr>
              <th valign="top"><?php echo DESCRIPTION;?>:</th>
                <td><?php
	  include("$config_var->ADMIN_ROOT"."FCKeditor/fckeditor.php");
	  $obj=new FCKEditor("categoryText");
	  $obj->BasePath="FCKeditor/";
	  $obj->Height=400;
	  $obj->Width=800;
	  $obj->Value= @$Category['cat_content'];
	  $obj->Create();
	  ?><?php //echo $code = $CKEditor->editor("categoryText", @$page_content,$config);?></td>
            </tr> 
			
			<tr>
              <th valign="top">Aditional Attachments</th>
			  <td><table width="100%">
					<tr>
					<td><input type="file" name="image_load[]"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]"> </td>
				  </tr>
				  <tr>
					<td><input type="file" name="image_load[]"> </td>
				  </tr>
			</table>
			</td>
            </tr>
            <th>&nbsp;</th>
            <td valign="top">
				<input type="hidden" name="forum_thread" value="forum_thread"  />
                <input type="hidden" name="cat_id" value="<?php echo $_REQUEST['id'];?>"  />
                <input type="hidden" name="sub_cat" value="<?php echo $_REQUEST['sub_cat'];?>"  />
             <input type="button" value="<?php echo SAVE;?>" title="Save" name="button" onclick="checkAddCategory();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel"  onclick="window.location.href='./?mod=mod_forum&view=newthread&id=<?php echo $_REQUEST['id'];?>&sub_cat=<?php echo $_REQUEST['sub_cat'];?>'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
								
					</div>
                <div class="clr"></div>
				
</div>
 <div class="clr"></div>
  <div class="clr"></div>
<script language="javascript">
function who(A,topic)
{
return window.open("<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=whoposted&t="+A,''+topic+'','left=20,top=20,width=600,height=300,toolbar=0,resizable=0');
}
function attachments(A,topic)
{
return window.open("<?php echo $config_var->WEB_URL?>?mod=mod_forum&view=showattachments&t="+A,''+topic+'','left=20,top=20,width=480,height=300,toolbar=0,resizable=0');
}</script>