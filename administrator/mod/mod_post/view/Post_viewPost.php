<?php 
global $config_var;  
global $DataSet;
$CatDb_OB = new JDatabaseMySQL();
$CatDb_OB->sql = "SELECT * FROM posts where post_id='".$_REQUEST['post_id']."'";	
$CatDb_OB->query();
$CatDb_OB->getNumRows();
$post_data = $CatDb_OB->loadAssoc();

$CatDb_OB3 = new JDatabaseMySQL();
$CatDb_OB3->sql = "SELECT * FROM posts_image where post_id='".$_REQUEST['post_id']."'";	
$CatDb_OB3->query();
$CatDb_OB3->getNumRows();
$getAllPostImagesId = $CatDb_OB3->loadAssoc();
?>
<div id="content-table-inner" class="Add_New_Web_Page">
  <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:100%"><h3><?php echo $post_data[0]['post_title'];?></h3></td>
	
</tr>
<tr>
<td><p><?php echo nl2br($post_data[0]['post_content']);?></p></td>
</tr>

<tr>
<td><?php for($i=0;$i<count($getAllPostImagesId);$i++)
					{
					?>
							<a href="#" onclick="attachments('<?php echo $config_var->WEB_URL?>/showimage.php?image=<?php echo $config_var->UPLOAD_URL."forum/";?><?php echo $getAllPostImagesId[$i]['image_name'];?>','<?php echo $post_data[0]['post_title'];?>')" ><img src="<?php echo $config_var->UPLOAD_URL."forum/thumbnail/";?><?php echo $getAllPostImagesId[$i]['image_name'];?>" width="100" height="100" style="border: 2px solid #666666" /></a>
					<?php }?></td>
</tr>
</table>
 
 
<div class="clear"></div>
 

</div>

<script language="javascript">
var win;
function attachments(url,topic)
{
	win = window.open(url,''+topic+'','left=20,top=20,width=700,height=550,toolbar=0');
	window.top.close();
}

</script>
