<?php 
 global $config_var;  
 global $DataSet;
 global $model;
 include '../settings.php';
 require_once('mysql/mysql.php');
 
 class stateDetail extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	
	function getStateList($cId)
	{	
		          $this->qry = "SELECT * FROM state WHERE cid = '".$cId."'";
					$this->sql = $this->qry;
					$this->query();
					//$Rcdrs =  $this->getNumRows();
					$UserData = $this->loadAssoc();
					//$arrResult =  $this->loadAssoc();
					return $UserData;
	}
	
}

 $stateList = new stateDetail();
  
 $stateList =  $stateList->getStateList($_REQUEST['cId']); ?>
    
    <option value="0">Select State</option>
    <?php
 for($i=0;$i<count($stateList);$i++){  ?>
  <option value="<?php echo $stateList[$i]['id']; ?>"><?php echo $stateList[$i]['name']; ?></option>
<?php  }  ?>
      
       