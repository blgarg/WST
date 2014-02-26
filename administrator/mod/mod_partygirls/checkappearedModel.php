<?php 
include_once '../../../settings.php';
require_once('../../../inc/load.php');
$config_var = new config();  

$JDatabaseMySQL2 = new JDatabaseMySQL();
			
			
			
			$appearedyear = @$_REQUEST['appearedyear'];
			$appearedmonth = @$_REQUEST['appearedmonth'];
			
			$JDatabaseMySQL2->sql = "SELECT * FROM  mgl_models WHERE appear_month = '$appearedmonth' and appear_year= '$appearedyear'";
			$JDatabaseMySQL2->query();
			$ischeckModel =  $JDatabaseMySQL2->getNumRows();
				if($ischeckModel > 0){
				$ischeck = 1;
				}else{
				$ischeck = 2;
				}
				$result = array("isAction"=>$ischeck);
				$result = json_encode($result);
				echo $result;

?>