<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-08-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('../../../../pdf/config/lang/eng.php');
require_once('../../../../pdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
//$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetFont('freeserif', '', 12);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
/*$str= "select * from mgl_books_info where  created_year='2012'   order by book_id desc";
$user_query = mysql_query("$str");
while($row = mysql_fetch_array($user_query))
{
 $contents=$row['total_amt'];
}*/
$string='<html lang="hi">
<head>
<meta http-equiv="Content-Language" content="hi">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Haryana Granth Academy</title>
<link href="'.$config_var->Manege_Bill_css.'style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--Container-->
<div id="container">
	<!--Header-->
    <div id="header">
    	<!--Header Top-->
      
        	
            
           
            	<h1 style="text-align:center;">Haryana Granth Academy</h1>
<h3 style="text-align:center">Publish book report</h3>
          
       
        <!-- //Header Top-->
        
        <div class="header-btm">
        	
            
            <div class="header-btm-rt">
           	  <form name="form1" method="post" action="">
           	    <table width="100%" border="1">
                  <tr>
				  <th><div align="center">Srno</div></th>
                    <th><div align="center">'.WRITERNAME.'</div></th>
                    <th><div align="center">Cost Price</div></th>
                    <th><div align="center">Sell Price</div></th>
                    <th><div align="center">Entered Date</div></th>
                    <th><div align="center">Party Title</div></th>
                    <th><div align="center">Writer</div></th>
                    
                </tr>';
				
$st="select * from mgl_books_info";				 
$a=1;
$user_query = mysql_query($st);
$str=array();
while($row = mysql_fetch_array($user_query))
{

				$str[$a-1]='<tr>
				  <td>'.$a++.'</td>
                    <td>'.$row['book_name'].'</td>
                    <td>'.$row['book_name'].'</td>
                    <td>'.$row['book_name'].'</td>
                    <td>'.$row['book_name'].'</td>
                    <td>'.$row['book_name'].'</td>
                    <td>'.$row['book_name'].'</td>
                  </tr>';

}

$strp="";
			for($i=0;$i<count($str);$i++)
			{
			$strp=$strp.$str[$i];
			}

            
            
							  
                  
                 $string=$string.$strp.'</table>
              </form>
            </div>
        </div>
        
        
    </div>
    <!-- //Header-->
   
    <!--Content-->
    <div id="content">
    	
    </div>
    <!-- //Content-->
   
</div>
<!-- //Container--> 
	    	
</body>
</html>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $string, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
