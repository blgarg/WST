<?php
//include("dbcon.php");
session_start();
include ("../../settings.php");
require_once('../mysql/mysql.php');



class rating extends JDatabaseMySQL
{
    function initialize(){ 
		
	}
	function getvarp(){return ;}
	function addRating()
	{	
		$rating = $this->chkRating($_GET['user_id'],$_GET['vid']);
		//print_r($rating);
		if($rating['count']==0)
		{
			$this->qry = "insert into video_rating(video_id,rating,user_id) values(".$_GET['vid'].",".$_GET['r'].",".$_GET['user_id'].")";
			$this->sql = $this->qry;
			if($this->query())
			{
				$returnData['msg'] =  "Your rating has been submitted";
				$returnData['rate'] =  $this->calcRating($_GET['vid']);
				$returnData['error']=0;
				echo json_encode($returnData);
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			$returnData['msg'] = "You cannot rate more than once";
			$returnData['rate'] =  $this->calcRating($_GET['vid']);
			$returnData['error']=1;
			echo json_encode($returnData);
		}
	}
	function chkRating($id,$vid)
	{
		 $this->sql = "SELECT count(*) as count FROM video_rating WHERE user_id=".$id." and video_id=".$vid;
		 $this->query();
		 $this->_result = $this->getArray();   				
		 return $this->_result;
	}
	function calcRating($vid)
	{
		$this->sql = "SELECT count(*) as count FROM video_rating WHERE video_id=".$vid;
			$this->query();
			$this->_result = $this->getArray();   				
			
		$this->sql = "select sum(rating) as total from video_rating where video_id=".$vid;		
		$this->query();
		$total_rating = $this->getArray();   				
		
		$rating = ceil($total_rating['total']/$this->_result['count']);
		$this->sql = "update videos set rating=".$rating." where id=".$vid;
		$this->query();
		return $rating;
	}
	 
	 
}

$object = new rating();
$object->addRating();

?>