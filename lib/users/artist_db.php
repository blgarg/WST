<?php
 /*require_once('mysql/mysql.php');*/
 $JDatabaseMySQL  =  new JDatabaseMySQL();
class model_artist_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ 
		              
			}   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){}	
				
				
				
				 function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
				function numRow(){	
									 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}
				
				
			function getArtistData($id)
			{	
			    $this->sql = "SELECT * FROM mgl_users WHERE user_id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}	
			
			
			function getLikeCount($id)
			{	
			   $this->sql ="SELECT * FROM mgl_artist_like WHERE artistId = '".$id."'";
		       $this->query();
		       $like = $this->loadAssoc();
	           return count($like);		
			}	
			
			function getCountryName($id){
			
			   $this->sql = "SELECT name FROM country WHERE id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result['name'];	
			}	
			
			function format_date($original='', $format="%b %d,%Y") {
             $format = ($format=='date' ? "%m-%d-%Y" : $format); 
             $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
             $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
             $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
             return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           } 
		   
		   
		  function getCommentList($uId){
		    
		   $sql = "SELECT * FROM youtubeactivities WHERE uId = '".$uId."' ORDER BY  date_created DESC ";
			 $exec = mysql_query($sql) or mysql_error();
			 while($res = mysql_fetch_assoc($exec)){
		     $comment[] = $res;
			 }
			 
			 return @$comment;
	 } 
	 
	  function getArtistLatestPost($fbUsername,$token){
	     
		  $userPost = json_decode(file_get_contents('https://graph.facebook.com/'.$fbUsername.'/home?'.$token));
		  return $userPost;
	  }	
		   
		   
		   
		function ago($datefrom,$dateto=-1)
        {
        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch
   
        if($datefrom=='0') { return "A long time ago"; }
        if($dateto=='-1') { $dateto = time(); }
       
        // Make the entered date into Unix timestamp from MySQL datetime field

        $datefrom = strtotime($datefrom);
   
        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'
   
        switch(true)
        {
            // If difference is less than 60 seconds,
            // seconds is a good interval of choice
            case(strtotime('-1 min', $dateto) < $datefrom):
                $datediff = $difference;
                $res = ($datediff==1) ? $datediff.' second ago' : $datediff.' seconds ago';
                break;
            // If difference is between 60 seconds and
            // 60 minutes, minutes is a good interval
            case(strtotime('-1 hour', $dateto) < $datefrom):
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? $datediff.' minute ago' : $datediff.' minutes ago';
                break;
            // If difference is between 1 hour and 24 hours
            // hours is a good interval
            case(strtotime('-1 day', $dateto) < $datefrom):
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? $datediff.' hour ago' : $datediff.' hours ago';
                break;
            // If difference is between 1 day and 7 days
            // days is a good interval               
            case(strtotime('-1 week', $dateto) < $datefrom):
                $day_difference = 1;
                while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom)
                {
                    $day_difference++;
                }
               
                $datediff = $day_difference;
                $res = ($datediff==1) ? 'yesterday' : $datediff.' days ago';
                break;
            // If difference is between 1 week and 30 days
            // weeks is a good interval           
            case(strtotime('-1 month', $dateto) < $datefrom):
                $week_difference = 1;
                while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
                {
                    $week_difference++;
                }
               
                $datediff = $week_difference;
                $res = ($datediff==1) ? 'last week' : $datediff.' weeks ago';
                break;           
            // If difference is between 30 days and 365 days
            // months is a good interval, again, the same thing
            // applies, if the 29th February happens to exist
            // between your 2 dates, the function will return
            // the 'incorrect' value for a day
            case(strtotime('-1 year', $dateto) < $datefrom):
                $months_difference = 1;
                while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
                {
                    $months_difference++;
                }
               
                $datediff = $months_difference;
                $res = ($datediff==1) ? $datediff.' month ago' : $datediff.' months ago';

                break;
            // If difference is greater than or equal to 365
            // days, return year. This will be incorrect if
            // for example, you call the function on the 28th April
            // 2008 passing in 29th April 2007. It will return
            // 1 year ago when in actual fact (yawn!) not quite
            // a year has gone by
            case(strtotime('-1 year', $dateto) >= $datefrom):
                $year_difference = 1;
                while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom)
                {
                    $year_difference++;
                }
               
                $datediff = $year_difference;
                $res = ($datediff==1) ? $datediff.' year ago' : $datediff.' years ago';
                break;
               
        }
        return $res;
  }		
  
 function isMyTuneCrew($fanId,$artist_id){
				$this->sql = "SELECT * FROM mgl_tune_crew WHERE fan_id='$fanId' AND artist_id = '$artist_id'";
				$this->query();
				$this->_result = $this->getNumRows();
				return (int)$this->_result;
			}
			
  function isMyFavouritArtist($fanId,$artist_id){
				$this->sql = "SELECT * FROM mgl_fan_favourit_artist WHERE fan_id='$fanId' AND artist_id = '$artist_id'";
				$this->query();
				$this->_result = $this->getNumRows();
				return (int)$this->_result;
			}
			
  function getArtistRank($artist_id){
				$this->sql = "SELECT * FROM rankings As rank WHERE rank.userName = '$artist_id' AND rank.rankingId = '1' AND rank.rank >= 0  ORDER BY rank.rank ASC";
				$this->query();
				$this->_result = $this->getArray();
				return ceil($this->_result['rank']);
			}		
						
			
}
	