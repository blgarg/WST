<?php
@header('Cache-Control: max-age=900');
global $config_var;  
global $DataSet;
global $model;

$getAllPostImagesId = $model->getAllPostImagesId($_REQUEST['image_id']);
?>
<img src="<?php echo $config_var->UPLOAD_URL."forum/";?><?php echo $getAllPostImagesId[0]['image_name'];?>" style="border: 2px solid #666666" />
<?php die();?>