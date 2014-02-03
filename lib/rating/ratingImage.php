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
		
		$rating = $this->chkRating($_REQUEST['user_id'],$_REQUEST['gid'],$_REQUEST['image']);
		
		if($rating['count']==0)
		{
			$this->qry = "insert into image_rating(user_id,image_name,rating,gallery_id) values(".$_REQUEST['user_id'].",'".$_REQUEST['image']."',".$_REQUEST['rating'].",".$_REQUEST['gid'].")";
			$this->sql = $this->qry;
			if($this->query())
			{
				$returnData['msg'] =  "Your rating has been submitted";
				$returnData['rate'] =  $this->calcRating($_REQUEST['gid'],$_REQUEST['image']);
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
			$returnData['rate'] =  $this->calcRating($_REQUEST['gid'],$_REQUEST['image']);
			$returnData['error']=1;
			echo json_encode($returnData);
		}
	}
	function chkRating($id,$gid,$img)
	{
		 $this->sql = "SELECT count(*) as count FROM image_rating WHERE user_id=".$id." and gallery_id=".$gid." and image_name='".$img."'";
		 $this->query();
		 $this->_result = $this->getArray();   				
		 return $this->_result;
	}
	function calcRating($gid,$img)
	{
		 $this->sql = "SELECT count(*) as count FROM image_rating WHERE gallery_id=".$gid." and image_name='".$img."'";
			$this->query();
			$this->_result = $this->getArray();   				
			
		$this->sql = "select sum(rating) as total FROM image_rating WHERE gallery_id=".$gid." and image_name='".$img."'";		
		$this->query();
		$total_rating = $this->getArray();   				
		
		$rating = ceil($total_rating['total']/$this->_result['count']);
		return $rating;
	}
	 
	 
}

$object = new rating();
if(isset($_GET['mod']) && $_GET['mod']=='getRating')
{
	if(isset($_REQUEST['gid']) && isset($_REQUEST['image']) && $_REQUEST['image']!='' && $_REQUEST['gid']!=''){
	$rating = $object->calcRating($_REQUEST['gid'],$_REQUEST['image']);
	echo json_encode($rating);die;
	}
	else
	{
		echo json_encode("error");die;
	}
}
else
{
	$object->addRating();
}
?>