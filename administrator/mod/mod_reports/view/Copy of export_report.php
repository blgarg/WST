<?php 
ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$str=$_REQUEST['str'];
$contents="<span style='font-weight:bold'>Sell Order</span>,<span style='font-weight:bold'>Selling Date</span>,<span style='font-weight:bold'>Total amt</span>,<span style='font-weight:bold'>Discount(%)</span>,<span style='font-weight:bold'>Agent(%)</span>,<span style='font-weight:bold'>Transport cost</span>,<span style='font-weight:bold'>Postage cost</span>,<span style='font-weight:bold'>Remaining cost</span>,<span style='font-weight:bold'>Party Name</span>,<span style='font-weight:bold'>Party Owner</span>,<span style='font-weight:bold'>Party Address</span>,<span style='font-weight:bold'>State</span>,<span style='font-weight:bold'>City</span>,<span style='font-weight:bold'>Contact 1</span>,<span style='font-weight:bold'>Contact 2</span>\n\n";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{

$contents.=$row['amt_book_id'].",";
$contents.=$row['amt_date'].",";

$contents.=$row['total_amt'].",";
$contents.=$row['discount'].",";
$contents.=$row['agent_amt'].",";
$contents.=$row['transport_cost'].",";
$contents.=$row['postage_cost'].",";
$contents.=$row['total_amt_withanothercost'].",";
$contents.=str_replace(',', ';', $row['party_title']).",";
$contents.=$row['owner_name'].",";
$contents.=str_replace(',', ';', $row['address']).",";
$contents.=$row['state'].",";
$contents.=$row['city'].",";
$contents.=$row['contact1'].",";
$contents.=$row['contact2']."\n";

}
$contents2=strip_tags($contents); // remove html and php tags etc.
//echo $contents2; die;
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=export.csv");
//Header("Content-Disposition: attachment; filename=export2.csv");
print $contents2;

?> 