<?php 
ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$str=$_REQUEST['str'];
$contents="<span style='font-weight:bold'>Grant Received</span>,<span style='font-weight:bold'>Grant Title</span>,<span style='font-weight:bold'>Grant Description</span>,<span style='font-weight:bold'>Grant Price</span>,<span style='font-weight:bold'>Starting Date</span>,<span style='font-weight:bold'>End Date</span>,<span style='font-weight:bold'>Entry Date</span>,<span style='font-weight:bold'>Year</span>,<span style='font-weight:bold'>Phone</span>,<span style='font-weight:bold'>Mobile</span>,<span style='font-weight:bold'>Entered User</span>\n\n";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{
if($row['grant_recieved']==1)
{
$recievedgrant="State";
}
else if($row['grant_recieved']==2)
{
$recievedgrant="Center";
}
$contents.=$recievedgrant.",";
$contents.=$row['grant_title'].",";
$contents.=str_replace(',', ';', $row['grant_desc']).",";
$contents.=$row['grant_price'].",";
$contents.=$row['starting_date'].",";
$contents.=$row['ending_date'].",";
$contents.=$row['created_date'].",";
$contents.=$row['amt_year'].",";
$contents.=$row['phone'].",";
$contents.=$row['mobile'].",";
$contents.=$row['user_display_name']."\n";
}
$contents2=strip_tags($contents); // remove html and php tags etc.
//echo $contents2; die;
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=export.csv");
//Header("Content-Disposition: attachment; filename=export2.csv");
print $contents2;

?> 