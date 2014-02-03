<?php
ob_start();
include '../../../settings.php';
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$JDatabaseMySQL = new JDatabaseMySQL();
$qry = "SELECT * FROM mgl_ranking_module";
	$JDatabaseMySQL->sql = $qry;
	$JDatabaseMySQL->query();
	$Rcdrs =  $JDatabaseMySQL->getNumRows();
	$Rows = $JDatabaseMySQL->getArray();
	
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'changeModule'){
	$model_id = (int)$_REQUEST['idIs'];
	$qry = "SELECT * FROM mgl_ranking_module WHERE module_id = $model_id";
	$JDatabaseMySQL->sql = $qry;
	$JDatabaseMySQL->query();
	$Data = $JDatabaseMySQL->getArray();
	
	$data = '<span id="msgbox" style="display:none"></span>
	<table align="center" cellpadding="0" cellspacing="5" border="0"  class="singInClass" >
	<tr><th>Model Name<span class="red">*</span>:</th><td class="colunClas"></td><td>&nbsp;</td></tr>
	<tr><td colspan="3"><input type="text" name="module_name" value="'.ucfirst($Data['module_name']).'" id="module_name"   /></td></tr>
	<tr><th>Model Description:</th><td class="colunClas"></td><td>&nbsp;</td></tr>
	<tr><td colspan="3"><textarea name="modelDesc" id="modelDesc" style="width:300px;height:80px;">'.ucfirst($Data['model_desc']).'</textarea></td></tr>
    <tr><td colspan="3"><input type="submit" name="button" value="Save"   class="button"  onclick="update_rank_model('.$Data['module_id'].');"/></td></tr>
    </table>';
	$result = array('isAction'=>1,'no'=>$Rcdrs,'data'=>$data);
	
}  

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_rank_model'){
	$model_name = $_REQUEST['model_name'];
	$model_des = $_REQUEST['model_desc'];
	$model_id = $_REQUEST['model_id'];
	$qry = "UPDATE mgl_ranking_module SET module_name = '$model_name', model_desc = '$model_des' WHERE module_id = $model_id";
	$JDatabaseMySQL->sql = $qry;
	$data = "<p id='msgbox_correct'>Data has been saved.</p>";
	if($JDatabaseMySQL->query()){ $result = array('isAction'=>1,'data'=>$data); }
	}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'changeModuleAttribute'){
	$model_id = (int)$_REQUEST['idIs'];
	$qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_attr_id = $model_id";
	$JDatabaseMySQL->sql = $qry;
	$JDatabaseMySQL->query();
	$Data = $JDatabaseMySQL->getArray();
	$att_val = trim($Data['rank_attr_name']);
	
		$flag = false;
		if($att_val=='Subscribers'){
		$flag = false;
		}
		if($att_val=='Views'){
		$flag = false;
		}
		if($att_val=='weighted_rating'){
		$flag = false;
		}
		if($att_val=='Favourites'){
		$flag = false;
		}
		if($att_val=='Facebook'){
		$flag = false;
		}
		if($att_val=='Last_views'){
		$flag = true;
		}
		if($att_val=='Avg_of_days'){
		$flag = true;
		}
		if($att_val=='Age_for'){
		$flag = true;
		}
		if($att_val=='Youtube_num_comments'){
		$flag = true;
		}
		if($att_val=='Facebook_num_comments'){
		$flag = true;
		}
		if($att_val=='Videos_posted_in_last_week'){
		$flag = true;
		}
		if($att_val=='channel_views_differece'){
		$flag = false;
		}
		
	$isValue  = '';
	if($flag){
	$isValue = '<tr><th>Attribute Value:</th><td class="colunClas"></td><td>&nbsp;</td></tr>
	<tr><td colspan="3"><input type="text" name="attribute_value" value="'.ucfirst($Data['rank_attr_value']).'" id="attribute_value"  /></td></tr>';
	}
	$data ='<span id="msgbox" style="display:none"></span>
	<table align="center" cellpadding="0" cellspacing="5" border="0"  class="singInClass" >
	<tr><th>Attribute Name<span class="red">*</span>:</th><td class="colunClas"></td><td>&nbsp;</td></tr>
	<tr><td colspan="3"><input type="text" name="attribute_name" value="'.ucfirst($Data['rank_attr_name']).'" id="attribute_name"   readonly="readonly"/></td></tr>'.$isValue.'
	<tr><th>Attribute Description:</th><td class="colunClas"></td><td>&nbsp;</td></tr>
	<tr><td colspan="3"><textarea name="attributeDesc" id="attributeDesc" style="width:300px;height:80px;">'.ucfirst($Data['rank_attr_description']).'</textarea></td></tr>
    <tr><td colspan="3"><input type="submit" name="button" value="Save"   class="button"  onclick="update_rank_model_attribute('.$Data['rank_attr_id'].');"/></td></tr>
    </table>';
	$result = array('isAction'=>1,'no'=>$Rcdrs,'data'=>$data);
	
}   
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_rank_model_attr'){
	$model_name = $_REQUEST['model_name'];
	$model_des = $_REQUEST['model_desc'];
	$attribute_value = $_REQUEST['attribute_value'];
	$model_id = $_REQUEST['model_id'];
	$qry = "UPDATE mgl_ranking_module_attribute SET rank_attr_name = '$model_name', rank_attr_description = '$model_des', rank_attr_value = '$attribute_value' WHERE rank_attr_id  = $model_id";
	$JDatabaseMySQL->sql = $qry;
	$data = "<p id='msgbox_correct'>Data has been saved.</p>";
	if($JDatabaseMySQL->query()){ $result = array('isAction'=>1,'data'=>$data); }
	}
	
	$result = json_encode($result);
	echo $result;

?>
