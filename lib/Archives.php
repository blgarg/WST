<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var; 
 $Months = array('1'=>"January", '2'=>"February",'3'=>"March",'4'=>"April",'5'=>"May",'6'=>"June",'7'=>"July",'8'=>"August",'9'=>"September",'10'=>"October",'11'=>"November",'12'=>"December");
 
 $JDatabaseMySQL_OBJ = new JDatabaseMySQL();
 
 if(isset($_REQUEST['action']) && $_REQUEST['action'] =='contestArchivesPage'){
 //$JDatabaseMySQL_OBJ->sql= "SELECT YEAR(createdDate) AS `year`, MONTH(createdDate) AS `month`, DAYOFMONTH(createdDate) AS `dayofmonth`, count(contestId) as contests FROM mgl_contest  GROUP BY YEAR(createdDate), MONTH(createdDate), DAYOFMONTH(createdDate) ORDER BY createdDate DESC";
 $JDatabaseMySQL_OBJ->sql= "SELECT YEAR(createdDate) AS `year`, MONTH(createdDate) AS `month`, DAYOFMONTH(createdDate) AS `dayofmonth`, count(contestId) as contests FROM mgl_contest  GROUP BY YEAR(createdDate) ORDER BY createdDate DESC";
 $JDatabaseMySQL_OBJ->query();
 $loadData = $JDatabaseMySQL_OBJ->loadAssoc();
 $data = '<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
    	  <div class="content-lt-hdr" style="width:100%;background:#555555">Contest Archives</div>
		  <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">';
 for($y=0;$y<count($loadData);$y++){
  $Months_query = "SELECT YEAR(createdDate) AS `year`, MONTH(createdDate) AS `month`, DAYOFMONTH(createdDate) AS `dayofmonth`, count(contestId) as contests FROM mgl_contest  WHERE YEAR(createdDate) = '".$loadData [$y]['year']."' GROUP BY MONTH(createdDate) ORDER BY createdDate DESC";
  	 //echo "Years:&nbsp;&nbsp;:".$loadData [$y]['year'];
	 
	 $JDatabaseMySQL_OBJ->sql= $Months_query ;
	 $JDatabaseMySQL_OBJ->query();
 	 $loadDataForMonths = $JDatabaseMySQL_OBJ->loadAssoc();
	 $data  .= '<ul><h1>'.$loadData [$y]['year'].'</h1>';
	 for($m=0;$m<count($loadDataForMonths);$m++){               
     $data  .="<li style='margin-left:30px;margin-bottom:11px;'><a href='#' onclick=contestArchivesPage_Content('".$loadData [$y]['year']."_".$loadDataForMonths[$m]['month']."')>".$Months[$loadDataForMonths[$m]['month']]."(&nbsp;".$loadDataForMonths[$m]['contests']."&nbsp;)</a></li>";
	}
	 $data  .= '</ul>';
	 
 }
 $data  .= '<div class="clr"></div>
               </div>
               </div>';
echo $data ;			   
 }
 
 if(isset($_REQUEST['action']) && $_REQUEST['action'] =='getArchiveContestPage'){
	$year_month = explode("_",$_REQUEST['archive_year_month']);
	$year =$year_month[0];
	$month =$year_month[1]; 

 $JDatabaseMySQL_OBJ->sql= "SELECT * FROM mgl_contest  WHERE  YEAR(createdDate) = '".$year."' AND MONTH(createdDate) = '".$month."' ORDER BY createdDate DESC";
 $JDatabaseMySQL_OBJ->query();
 $loadData = $JDatabaseMySQL_OBJ->loadAssoc();
 $data = '<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
    	  <div class="content-lt-hdr" style="width:100%;background:#555555">'.$year."/".$Months[$month].'</div>
		  <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">';
 for($m=0;$m<count($loadData);$m++){
	 $data  .= "<ul>";
	 for($m=0;$m<count($loadData);$m++){
	 		$data  .="<li style='margin-left:30px;margin-bottom:11px;'><a href='#' onclick=getContestDetail('".$loadData [$m]['contestId']."')>".$loadData[$m]['contestTitle']."</a></li>";
	 }
	 $data  .= "</ul>";
	 
 }
  $data  .= '<div class="clr"></div>
               </div>
               </div>';
echo $data ;	
 }
?>
