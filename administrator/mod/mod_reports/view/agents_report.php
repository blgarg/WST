<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2010-08-08
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */
require_once('../../../../pdf/config/lang/eng.php');
require_once('../../../../pdf/tcpdf.php');

include '../../../../settings.php';
// create new PDF document
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo.jpg';
        $this->Image($image_file, 0, 4, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('freeserif', '', 14);
        // Title
		$title=HARYANAGRANTHACADEMY."(".AGENTSREPORT.")";
        $this->Cell(0, 10, $title, 0, false, 'C', 0, '', 7, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
$pdf->setFontSubsetting(true);
// set font
$pdf->SetFont('freeserif', '', 16);

// add a page
$pdf->AddPage();

$pdf->setFontSubsetting(true);
$pdf->SetFont('freeserif', '', 6);

// -----------------------------------------------------------------------------



ob_start();

global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
/*$str= "select * from mgl_books_info where  created_year='2012'   order by book_id desc";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{
 $contents=$row['total_amt'];
}*/
$string='<table border="1" cellpadding="2" cellspacing="2" >
 <tr nobr="true" style="background-color:#E8E8E4;" align="center">
  <th width="130px;">'.PARTYNAME.'/'.ACADEMY.'/'.THIRDPERSON.'</th>
  <th width="80px;">'.AGENTNAME.'</th>
  <th width="80px;">'.EMPNAME.'</th>
  <th width="80px;">'.TOTALPRICEOFBOOKS.'</th>
  <th width="70px;">'.AGENTSCOMMISION.'</th>
  <th width="60px;">'.QUANTITY.'</th>
  <th  width="80px;">'.AGENTCOMMISTION.'</th>
  <th  width="70px;">'.DATE.'</th>
  </tr>';
 
 $st="select * from mgl_amt_sell_books a,mgl_sell_books b where a.amt_book_id=b.sell_amt_id group by b.sell_amt_id ORDER BY a.amt_book_id desc";			 
$a=1;
$user_query = mysql_query($st);
$str=array();
while($row = mysql_fetch_array($user_query))
{

$query = "SELECT user_firstname,user_lastname FROM mgl_users where user_id=" . $row['employee_id'];	
$execute = mysql_query($query);
$data = mysql_fetch_array($execute);
$fullname=$data['user_firstname']." ".$data['user_lastname'];

$comm_query = "SELECT agent_amt FROM mgl_amt_sell_books where amt_book_id =" . $row['amt_book_id'];	
$comm_execute = mysql_query($comm_query);
$comm_data = mysql_fetch_array($comm_execute);
if($comm_data['agent_amt']!=""){
$commission = $comm_data['agent_amt'];
}else{
$commission = "0.00";
}
$commission = $comm_data['agent_amt'];


 /*if(strlen($Agents["$i"]['cat_title']) >=100){echo ucfirst(substr($Agents["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Agents["$i"]['cat_title']);}*/ //echo ucwords($Agents["$i"]['party_title']);
							if($row['academy_id']!=0)
							{
							$business_title=get_academytitle($row['academy_id']);
							$businesstitle=$business_title."&nbsp;<b>(".ACADEMY.")</b>";
							}
							else if($row['party_id']!=0)
							{
							$business_title=get_partytitle($row['party_id']);
							$businesstitle=$business_title."&nbsp;<b>(".PARTYNAME.")</b>";
							}else
							{
							$business_title=get_personname($row['amt_book_id']);
							$businesstitle=$business_title."&nbsp;<b>(".THIRDPERSON.")</b>";
							}
$agenttitle=get_agent_title($row['agent_id']);

$datewise=explode(" ",$row['created_Date']);
//$partytitle=get_aell_party($row['party_id']);
				$str[$a-1]='<tr nobr="true">
				    <td>'.$businesstitle.'</td>
                    <td align="center">'.$agenttitle.'</td>
					<td align="center">'.$fullname.'</td>
                    <td align="center">'.$row['total_amt_withanothercost'].'</td>
                    <td align="center">'.$commission.'%</td>
					<td align="center">'.get_total_books($row['amt_book_id']).'</td>
                    <td align="center">'.$row['end_amt'].'</td>
					<td align="center">'.$row['amt_date'].'</td>
                 </tr>';
$a++;
}

$strp="";
			for($i=0;$i<count($str);$i++)
			{
			$strp=$strp.$str[$i];
			}
 
 $string=$string.$strp.'</table>';
 
 


// Print text using writeHTMLCell()
//$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $string, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $string, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('agentsreport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
function get_royality_prices($id)
	{
	$str = "SELECT sum(`book_qty`) as quantities,sum(`writer_amt`) as totals FROM mgl_sell_books WHERE `writer_id`= '$id' and `writer_amt`!='0.00'"; 
    $rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
					return $row['quantities'].",".$row['totals'];
	}				
 
 
 function get_academytitle($id)
				{
				$str = "SELECT business_title FROM mgl_business_parties where parties_id=$id";	
				$rs=mysql_query($str);
				$row=mysql_fetch_array($rs);
				return $row['business_title'];
				}
				function get_partytitle($id)
				{
				$str = "SELECT party_title FROM mgl_party where party_id=$id";	
				$rs=mysql_query($str);
				$row=mysql_fetch_array($rs);
				return $row['party_title'];
				}
				function get_personname($id)
				{
				$str = "SELECT name FROM mgl_fair_person_detail where transaction_id=$id";	
				$rs=mysql_query($str);
				$row=mysql_fetch_array($rs);
				return $row['name'];
				}
 function get_total_books($id)
				{
				$str = "SELECT SUM(book_qty) as booksum FROM mgl_sell_books where sell_amt_id=$id";	
				$rs=mysql_query($str);
				$row=mysql_fetch_array($rs);
				return $row['booksum'];
				}
 function get_agent_title($id)
				{
				$str = "SELECT agent_name FROM mgl_agents where agent_id=$id";	
				$rs=mysql_query($str);
				$row=mysql_fetch_array($rs);
				return $row['agent_name'];
				}	
 
 
 
/* ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$str=$_REQUEST['str'];
$contents="<span style='font-weight:bold'>Book Name</span>,<span style='font-weight:bold'>Reprinted Quantity</span>,<span style='font-weight:bold'>Publish Date</span>,<span style='font-weight:bold'>Reprinted Date</span>,<span style='font-weight:bold'>Sell Price</span>,<span style='font-weight:bold'>Academy</span>,<span style='font-weight:bold'>Writer</span>\n\n";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{
$writertitle=get_all_writers($row['royality_writer_id']);
$partytitle=get_all_party($row['party_id']);
$contents.=$row['book_name'].",";
$contents.=$row['book_quantity'].",";
$contents.=$row['created_Date'].",";
$contents.=$row['date_entered'].",";
$contents.=$row['book_price'].",";
$contents.=$partytitle.",";
$contents.=$writertitle."\n";;
}
$contents2=strip_tags($contents); // remove html and php tags etc.
//echo $contents2; die;
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=export.csv");
//Header("Content-Disposition: attachment; filename=export2.csv");
print $contents2;
function get_all_writers($id)
{
$str="select * from mgl_writers where writer_id=$id";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
return $row['writer_name'];
}
function get_all_party($id)
{
$str="select * from mgl_business_parties where parties_id=$id";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
return $row['business_title'];
}*/
?> 