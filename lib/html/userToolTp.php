<?php  
include '../../settings.php';
require_once('../../inc/load.php');
require_once('../users/artist_db.php');	
$idUser = @$_REQUEST['userId'];
$model_artist_default = new model_artist_default();
$JDatabaseMySQL = new JDatabaseMySQL();
$JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_id ='$idUser'";
$JDatabaseMySQL->query();
$dataA = $JDatabaseMySQL->getArray();
$userVal = @unserialize($dataA['youTubeProfilepic']); 
$randF = rand();
if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'].'?fk='.$randF;}
else{$IMG_PATH = @$dataA['youTubeProfilepic'];}
$IMAGE = '<img src="'.$IMG_PATH.'"  border="0" alt="" title=""  width="90" height="90"/>'; ?>
<table>
<tr>
<td align="left" valign="top"><div style="width:94px;height:94px;"><a href="javascript:;" onclick="getPublicProfile('<?php echo $idUser ;?>','<?php echo $dataA['type'];?>')" style="font:18px Arial, Helvetica, sans-serif;color:#000000;text-decoration:none;"><?php echo $IMAGE;?></a></div></td>
<td valign="top" style="padding-left:10px;"><table>
<tr><td><a href="javascript:;" onclick="getPublicProfile('<?php echo $idUser ;?>','<?php echo $dataA['type'];?>')" style="font:18px Arial, Helvetica, sans-serif;color:#000000;text-decoration:none;"><?php echo ucfirst($dataA['user_firstname']);?></a></td></tr>
<tr><td><b>Born:</td><td align="left"><?php echo $model_artist_default->format_date($dataA['dateofbirth']); ?></td></tr>
<tr><td><b>From:</td><td align="left"><?php echo $dataA['stateText'] .','.$model_artist_default->getCountryName($dataA['country']); ?></td></tr>
<tr><td valign="top"><b>Bio:</td><td align="left" valign="top"><div style="width:130px;"><?php if(strlen($dataA['bio']) >50){echo substr($dataA['bio'],0,50)."...";}else{ echo $dataA['bio'];} ?></div> </td></tr>
</table></td></tr>
</table>