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
		$title=HARYANAGRANTHACADEMY."(".GIFTBOOKSREPORT.")";
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
  <th width="150px;">'.PERSONNAME.'</th>
  <th width="80px;">'.GIFTORDERNUMBER.'</th>
  <th width="40px;">'.QUANTITY.'</th>
  <th width="50px;">'.DATE.'</th>
  <th  width="50px;">Year</th>
  <th  width="140px;">'.EMPLOYEENAME.'</th>

 </tr>';
 
 $st=$_REQUEST['str'];				 
$a=1;
$user_query = mysql_query($st);
$str=array();
while($row = mysql_fetch_array($user_query))
{
$get_all_emp=get_all_name($row['issue_userid']);
$totalbooks=get_totalbooks($row['gift_id']);
//$partytitle=get_all_party($row['party_id']);
				$str[$a-1]='<tr nobr="true">
				    <td>'.$row['person_name'].'</td>
                    <td>'.$row['gift_id'].'</td>
                    <td>'.$totalbooks.'</td>
                    <td>'.$row['gift_date'].'</td>
                    <td>'.$row['gift_year'].'</td>
                    <td>'.$get_all_emp.'</td>
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
$pdf->Output('giftbookreport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
function get_all_writers($id)
{
$str="select * from mgl_writers where writer_id=$id";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
return $row['writer_name'];
}
function get_all_name($id)
{
$str="select * from mgl_users where user_id=$id";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
return $row['user_display_name'];
}
 
 function get_totalbooks($id)
		{
		$str="SELECT sum(book_qty) as totalbooks FROM mgl_issue_book where issue_type=2 and issue_foregin_id='$id'";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
			
			return $row['totalbooks'];
		}
 
 
 
 
 
 /*
ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$str=$_REQUEST['str'];
$contents="<span style='font-weight:bold'>Gifted Person</span>,<span style='font-weight:bold'>Gift Order number</span>,<span style='font-weight:bold'>Total Books</span>,<span style='font-weight:bold'>Gifted Date</span>,<span style='font-weight:bold'>Gifted Year</span>,<span style='font-weight:bold'>Enter Employee</span>\n\n";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{
$contents.=$row['person_name'].",";
$contents.=$row['gift_id'].",";
$contents.=$row['amt_id'].",";
$contents.=$row['gift_date'].",";
$contents.=$row['gift_year'].",";
$contents.=$row['issue_userid']."\n";;
}
$contents2=strip_tags($contents); // remove html and php tags etc.
//echo $contents2; die;
header("Content-Type: application/csv");
header("Content-Disposition: attachment; filename=export.csv");
//Header("Content-Disposition: attachment; filename=export2.csv");
print $contents2;*/

?> 