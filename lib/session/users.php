<?php
class userInfo extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	
	function getUserInfo()
	{	
		            $this->qry = "SELECT * FROM mgl_users WHERE user_id in(".$this->userId.") ";
					$this->sql = $this->qry;
					$this->query();
					//$Rcdrs =  $this->getNumRows();
					$UserData = $this->getArray();
					//$arrResult =  $this->loadAssoc();
					return (object)$UserData;
	}
	
	
	
}

?>