<?php
class Helper{ // start class

	static function createPassword($length) {
	$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i = 0;
	$password = "";
	while ($i < $length) {
		$password .= mt_rand(0,strlen($chars));
		$i++;
	}
	return $password;
     }
 
	static function resizeImage($originalImage,$toWidth,$toHeight,$path,$arr)
	{ 
		ini_set("memory_limit", "256M"); 
		$imgType = $arr['type'];
		// Get the original geometry and calculate scales
		list($width, $height) = getimagesize($originalImage);
		if($width < $toWidth){
			$toWidth = $width;
		}
		if($height < $toHeight){
			$toHeight = $height;
		}
		if($toWidth != 0){
		$xscale=$width/$toWidth;}
		if($toHeight != 0){
		$yscale=$height/$toHeight;}
		// Recalculate new size with default ratio
		if ($yscale>$xscale){
			$new_width = round($width * (1/$yscale));
			$new_height = round($height * (1/$yscale));
		}
		else 
		{
			$new_width = round($width * (1/$xscale));
			$new_height = round($height * (1/$xscale));
		}
		
		$new_width =$toWidth;
		$new_height =$new_height;
			
		// Resize the original image
		$imageResized = imagecreatetruecolor($new_width, $new_height);
		if ($imgType =="image/gif"){
			$imageTmp = imagecreatefromgif($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif($imageResized, $path);
		}
		elseif($imgType =="image/png")
		{
			$imageTmp = imagecreatefrompng($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif( $imageResized,$path);
		} 
		else {
			//$imageTmp  = imagecreatefromjpeg(TEMP_PATH.$originalImage);
			$imageTmp  = imagecreatefromjpeg($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagejpeg($imageResized,$path);
		}
		
		return $imageResized;
	
	}
	
	
		static function resizeImage_android($originalImage,$toWidth,$toHeight,$path,$arr)
	{ 
		ini_set("memory_limit", "256M"); 
		$imgType = $arr['type'];
		// Get the original geometry and calculate scales
		list($width, $height) = getimagesize($originalImage);
		if($width < $toWidth){
			$toWidth = $width;
		}
		if($height < $toHeight){
			$toHeight = $height;
		}
		if($toWidth != 0){
		$xscale=$width/$toWidth;}
		if($toHeight != 0){
		$yscale=$height/$toHeight;}
		// Recalculate new size with default ratio
		if ($yscale>$xscale){
			$new_width = round($width * (1/$yscale));
			$new_height = round($height * (1/$yscale));
		}
		else 
		{
			$new_width = round($width * (1/$xscale));
			$new_height = round($height * (1/$xscale));
		}
		
		$new_width =$toWidth;
		$new_height =$toHeight;
			
		// Resize the original image
		$imageResized = imagecreatetruecolor($new_width, $new_height);
		if ($imgType =="image/gif"){
			$imageTmp = imagecreatefromgif($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif($imageResized, $path);
		}
		elseif($imgType =="image/png")
		{
			$imageTmp = imagecreatefrompng($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagegif( $imageResized,$path);
		} 
		else {
			//$imageTmp  = imagecreatefromjpeg(TEMP_PATH.$originalImage);
			$imageTmp  = imagecreatefromjpeg($originalImage);
			imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			imagejpeg($imageResized,$path);
		}
		
		return $imageResized;
	
	}
	
	
	function redirectPath($pathToRedirect){
		header("Location: $pathToRedirect");	
	}


	public static function generateRefCode($num) {

		$charsAlpha = "abcdefghijklmnopqrstuvwxyz";
		srand((double)microtime()*1000000);
		$i = 0;
		$passAlpha = '' ;
	
		while ($i < $num/4) {
			$num = rand() % 33;
			$tmp = substr($charsAlpha, $num, 1);
			$passAlpha = $passAlpha . $tmp;
			$i++;
		}
		
		$charsNum = "0123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$passNum = '' ;
	
		while ($i < $num) {
			$num = rand() % 33;
			$tmp = substr($charsNum, $num, 1);
			$passNum = $passNum . $tmp;
			$i++;
		}
		$strReturn = $passAlpha."-".$passNum; 
		return $strReturn;
	
	}  // create random string  ends	



	public static function getScreenNameByAccId($uid){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT screenName FROM cc_account WHERE accountId = '".$uid."' ";
		$result = $dbConnect->executeQuery($stQuery);
		return $result[0]['screenName'];
	}
	
	
	public static function getProfilePicByUserId($uid){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT * FROM cc_upload WHERE userId = '".$uid."' AND typeId = '4' ";
		$result = $dbConnect->executeQuery($stQuery);
		return $result;
	}



		/*
	function getYears 
	@param $startingYear First option value to be displayed in select box
	@param $totalOptions Total number of records to be shown
	@param $order='ASC' order in which years should be displayed ASC or DESC
	@param $selected any selected value
	@return string representation of option value pair
	*/
	
	public static function getYears($startingYear, $totalOptions, $order='ASC', $selected=''){
		if($order == 'ASC'){
			$slot = 1;
		}else {
			$slot = -1;
		}
		$str = "";
		for($i=0; $i <= $totalOptions; $i++){
			$str .= "<option value='" . $startingYear . "'";
			if($selected == $startingYear){
				$str .= " selected='selected' ";
			}
			$str .=">" .$startingYear . "</option>";
			$startingYear += $slot;
		}
		return $str;
		
	}
	
	
	
	
		/*
	function getMonths 
	@param $selected option value to be selected
	@returns list of options values for select box for month drop down
	*/
	

	
	
	public static function getMonths($selected=''){
		$montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$str = "";
		for($i=1; $i<=12; $i++){
			$str .= "<option value='".$i."' ";
			if($selected == $i){
				$str .=" selected ";
			}
			$str .=">". $montharray[$i-1] ."</option> ";
		} 
		return $str;
	}
	
	
		/*
	function getDays 
	@param $selected option value to be selected
	@returns list of options values for select box for days drop down
	*/
	
		
	public static function getDays($selected=''){
		$str = "";
		for($i=1; $i<=31; $i++){
			$str .= "<option value='".$i."' ";
			if($selected == $i){
				$str .=" selected='selected' ";
			}
			$str .=">". $i ."</option> ";
		} 
		return $str;
	}

	// fetch countries
	public static function fetchCountry($default=''){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT * FROM cc_country ";
		$resCountry = $dbConnect->executeQuery($stQuery);
		$HTML = '';
		foreach($resCountry as $cont){
			$selected = ($cont['countryId']==$default)?" selected = 'selected'":"";
			if(strlen($cont['name'])>25)
				$lin['name'] = substr($cont['name'],0,25)."...";
			$HTML .= '<option value="'.$cont['countryId'].'"  '.$selected.'>'.$cont['name'].'</option><br />';
		}
		return $HTML;
	}
	
	
	// fetch states
	public static function fetchStates($id='',$default=''){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		if($id!=''){
			$str = " WHERE countryId = '".$id."' ";
		} else {
			$str = '';
		}
		$stQuery = "SELECT * FROM cc_province ".$str;
		$resCountry = $dbConnect->executeQuery($stQuery);
		$HTML = '';
		foreach($resCountry as $cont){
			$selected = ($cont['provinceId']==$default)?" selected = 'selected'":"";
			if(strlen($cont['name'])>25)
				$lin['name'] = substr($cont['name'],0,25)."...";
			$HTML .= '<option value="'.$cont['provinceId'].'"  '.$selected.'>'.$cont['name'].'</option><br />';
		}
		return $HTML;
	}
	// fetch cities
	public static function fetchCities($id='',$default=''){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		if($id!=''){
			$str = " WHERE provinceId = '".$id."' ";
		} else {
			$str = '';
		}
		$stQuery = "SELECT * FROM cc_city ".$str;
		$resCountry = $dbConnect->executeQuery($stQuery);
		$HTML = '';
		foreach($resCountry as $cont){
			$selected = ($cont['cityId']==$default)?" selected = 'selected'":"";
			if(strlen($cont['name'])>25)
				$lin['name'] = substr($cont['name'],0,25)."...";
			$HTML .= '<option value="'.$cont['cityId'].'"  '.$selected.'>'.$cont['name'].'</option><br />';
		}
		return $HTML;
	}

	// fetch universites
	public static function fetchUniversties($id='',$default=''){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		if($id!=''){
			$str = " WHERE cityId = '".$id."' ";
		} else {
			$str = '';
		}
		$stQuery = "SELECT * FROM cc_university ".$str;
		$resCountry = $dbConnect->executeQuery($stQuery);
		$HTML = '';
		foreach($resCountry as $cont){
			$selected = ($cont['universityId']==$default)?" selected = 'selected'":"";
			if(strlen($cont['name'])>25)
				$lin['name'] = substr($cont['name'],0,25)."...";
			$HTML .= '<option value="'.$cont['universityId'].'"  '.$selected.'>'.$cont['name'].'</option><br />';
		}
		return $HTML;
	}

	// fetch facilities
	public static function fetchFaculty($id='',$default=''){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		if($id!=''){
			$str = " WHERE universityId = '".$id."' ";
		} else {
			$str = '';
		}
		$stQuery = "SELECT * FROM cc_faculty ".$str;
		$resCountry = $dbConnect->executeQuery($stQuery);
		$HTML = '';
		foreach($resCountry as $cont){
			$selected = ($cont['facultyId']==$default)?" selected = 'selected'":"";
			if(strlen($cont['name'])>25)
				$lin['name'] = substr($cont['name'],0,25)."...";
			$HTML .= '<option value="'.$cont['facultyId'].'"  '.$selected.'>'.$cont['name'].'</option><br />';
		}
		return $HTML;
	}


	public static function getTypeNameFromId($tblname,$tpid){
		$resSettings ='';
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT type FROM ".$tblname." where typeId= '".$tpid."' ";
		$resSettings = $dbConnect->executeQuery($stQuery);
		return $resSettings[0]['type'];
	}


	public static function getCountryNameFromId($tpid){
		$resSettings ='';
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT name FROM cc_country where countryId= '".$tpid."' ";
		$resSettings = $dbConnect->executeQuery($stQuery);
		return $resSettings[0]['name'];
	}

	public static function getCityNameFromId($cId){
		$resSettings ='';
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT name FROM  cc_city where cityId= '".$cId."' ";
		$resSettings = $dbConnect->executeQuery($stQuery);
		return $resSettings[0]['name'];
	}
    
	
	public function getUserSettings($uid,$tabid){
		$resSettings ='';
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$stQuery = "SELECT * FROM cc_usersettings where userId= '".$uid."' and tabId = '".$tabid."' ";
		$resSettings = $dbConnect->executeQuery($stQuery);
		return $resSettings;
	}
	
 /* date functions */
	public function dateFormat($date){
		$getDate = date('m-d-Y',strtotime($date));
		return $getDate;
	}
	
	public function dateLongFormat($date){
		$getDate = date('m-d-y H:i',strtotime($date));
		return $getDate;
	}

       function getcitywiseRecord($id){
        require_once(COMM_PATH."DatabaseManager.php");
        $dbConnect = new DatabaseManager();
       $sql=" SELECT cc_faculty . * , cc_university.name AS university, cc_city.name AS city, cc_province.name AS province,             cc_country.name AS country
            FROM cc_faculty, cc_university, cc_city, cc_province, cc_country
            WHERE cc_faculty.universityId = cc_university.universityId
            AND cc_university.cityId = cc_city.cityId
            AND cc_city.provinceId = cc_province.provinceId
            AND cc_province.countryId = cc_country.countryId
           AND cc_city.cityId
           IN ( ".$id." )  ";
        $result=$dbConnect->executeQuery($sql); 
        return $result;
     }	
    
	
	function getuserDetail($id){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$sql="SELECT * FROM cc_user WHERE facultyId=".$id;
		$result=$dbConnect->executeQuery($sql); 
		return $result;
	}
    
	
	public static function getuserType($id){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$sql="SELECT cc_program.name As name FROM cc_user,cc_program,cc_application WHERE cc_user.userId=cc_application.userId AND                cc_application.programId=cc_program.programId AND cc_user.userId=".$id;
		$result=$dbConnect->executeQuery($sql);  
		return $result[0]['name'];
	   
	}
	
	public static function getProgramNameById($pid){
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$sql="SELECT name FROM cc_program WHERE programId=".$pid;
		$result=$dbConnect->executeQuery($sql);  
		return $result[0]['name'];	
	}
	
	public static function getDeadlineFromProgId($uid,$pid){
		
		require_once(COMM_PATH."DatabaseManager.php");
		$dbConnect = new DatabaseManager();
		$sql="SELECT facultyId FROM cc_user WHERE userId=".$uid." ";
		$result=$dbConnect->executeQuery($sql);  
		$fId =  $result[0]['facultyId'];	
		$resAdd = Helper::getUserCityByFaculty($fId);
		$cId = $resAdd[0]['cityId'];
		$sql="SELECT participationDeadline FROM cc_cityparticipant WHERE cityId=".$cId." ";
		$resDeadline=$dbConnect->executeQuery($sql);  
		
		/*$sqlProg="SELECT * FROM cc_program WHERE programId=".$pid." ";
		$resProg=$dbConnect->executeQuery($sqlProg);  
		if(strtolower($resProg[0]['name'])=='ambassador'){
			$str = $resProg[0]['generalPaperTopic'];
		}*/
		return $resDeadline[0]['participationDeadline'];
	}
	
	public static function getUserCityByFaculty($facId){
	     require_once(COMM_PATH."DatabaseManager.php");
         $db=new DatabaseManager();
		 $sql = 'SELECT cc_faculty.name AS faculty, cc_university.name AS university, cc_city.name AS city, cc_city.cityId AS cityId, cc_province.name AS province, cc_country.name AS country FROM cc_faculty, cc_university, cc_city, cc_province, cc_country WHERE cc_faculty.universityId = cc_university.universityId AND cc_university.cityId = cc_city.cityId AND cc_city.provinceId = cc_province.provinceId AND cc_province.countryId = cc_country.countryId AND cc_faculty.facultyId = '.$facId.' ';
	     $result =$db->executeQuery($sql);
	     return $result;	 
	 }
	
	public static function getProvinceNameByFaculty($fId){
		$uniArr = Helper::getUserCityByFaculty($fId);
		return $uniArr[0]['province'];
	} // ends 
	
	public static function getUniversityNameByFaculty($fId){
		$uniArr = Helper::getUserCityByFaculty($fId);
		return $uniArr[0]['university'];
	} // ends 
	
	
	public static function getUserAddFromId($addId){
		 require_once(COMM_PATH."DatabaseManager.php");
         $db=new DatabaseManager();
		 $sql = "SELECT * FROM cc_address WHERE addressId = '".$addId."' ";
	     $result =$db->executeQuery($sql);
	     $str = $result[0]['street'].", ".$result[0]['postcode'].", ".$result[0]['city'];
		 return  $str;
	}
	public static function getScore($uId)
	{
	   require_once(COMM_PATH."DatabaseManager.php");
         $db=new DatabaseManager();
		 $sql = "SELECT SUM(score) AS Score FROM cc_taskprogress WHERE userId = '".$uId."' ";
	     $result =$db->executeQuery($sql);
	     return $result[0]['Score'];
	}

	function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
		/*
		$interval can be:
		yyyy - Number of full years
		q - Number of full quarters
		m - Number of full months
		y - Difference between day numbers
		(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
		d - Number of full days
		w - Number of full weekdays
		ww - Number of full weeks
		h - Number of full hours
		n - Number of full minutes
		s - Number of full seconds (default)
		*/
		if (!$using_timestamps) {
		$datefrom = strtotime($datefrom, 0);
		$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; // Difference in seconds
		
		switch($interval) {
		
		case 'yyyy': // Number of full years
		
		$years_difference = floor($difference / 31536000);
		if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
		$years_difference--;
		}
		if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
		$years_difference++;
		}
		//$years_difference++;
		$datediff = $years_difference;
		break;
		
		case "q": // Number of full quarters
		
		$quarters_difference = floor($difference / 8035200);
		while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
		$months_difference++;
		}
		$quarters_difference--;
		$datediff = $quarters_difference;
		break;
		
		case "m": // Number of full months
		
		$months_difference = floor($difference / 2678400);
		while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
		$months_difference++;
		}
		$months_difference--;
		$datediff = $months_difference;
		break;
		
		case 'y': // Difference between day numbers
		
		$datediff = date("z", $dateto) - date("z", $datefrom);
		break;
		
		case "d": // Number of full days
		
		$datediff = floor($difference / 86400);
		break;
		
		case "w": // Number of full weekdays
		
		$days_difference = floor($difference / 86400);
		$weeks_difference = floor($days_difference / 7); // Complete weeks
		$first_day = date("w", $datefrom);
		$days_remainder = floor($days_difference % 7);
		$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
		if ($odd_days > 7) { // Sunday
		$days_remainder--;
		}
		if ($odd_days > 6) { // Saturday
		$days_remainder--;
		}
		$datediff = ($weeks_difference * 5) + $days_remainder;
		break;
		
		case "ww": // Number of full weeks
		
		$datediff = floor($difference / 604800);
		break;
		
		case "h": // Number of full hours
		
		$datediff = floor($difference / 3600);
		break;
		
		case "n": // Number of full minutes
		
		$datediff = floor($difference / 60);
		break;
		
		default: // Number of full seconds (default)
		
		$datediff = $difference;
		break;
		}
		
		return $datediff;
		
	}
	/* date functions */	
	
	
	function getUploadFileExtension($filename)
	{
		$pos = strrpos($filename,".");
		$ext = substr($filename,$pos+1);
		return $ext;
	}
} // end class




?>