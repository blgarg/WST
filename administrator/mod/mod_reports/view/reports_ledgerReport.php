<?php 
global $config_var;  
global $model;
global $DataSet;
//echo "<pre>"; print_r($model); die;

			// Geanrate ledger report pdf code               

              if((isset($_REQUEST['report_datewise']) && $_REQUEST['report_datewise']=='report_datewise') || (isset($_REQUEST['report_sixmonthwise']) && $_REQUEST['report_sixmonthwise']=='report_sixmonthwise')){
				if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && $_REQUEST["filtertype"]!=3){
					
						$this->searchCondition .= " amt_date>='".$_REQUEST['sdate']."' and amt_date<='".$_REQUEST['edate']."' ";
					}
					else if(isset($_REQUEST["filtertype"]) && $_REQUEST["filtertype"]==3){
					$tdate=date("Y-m-d");
					$stdate=date("Y-m-d", strtotime("-6 months"));
					$this->searchCondition .= " amt_date>='".$stdate."' and amt_date<='".$tdate."' ";
					}
				}
				else if(isset($_REQUEST['report_yearwise']) && @$_REQUEST['report_yearwise']=='report_yearwise'){
				$year1=$_REQUEST['yearselection'];
				$quater_first=$year1."-01-01";
				$endquater_first=$year1."-03-31";
				$quater_second=$year1."-04-01";
				$endquater_second=$year1."-06-30";
				$quater_third=$year1."-07-01";
				$endquater_third=$year1."-09-30";
				$quater_fourth=$year1."-10-01";
				$endquater_fourth=$year1."-12-31";
				
				$firsthalf_start=$year1."-01-01";
				$firsthalf_end=$year1."-06-30";
				$secondhalf_start=$year1."-07-01";
				$secondhalf_end=$year1."-12-31";
					if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==3){
						$this->searchCondition .= " a.amt_year='".@$_REQUEST['yearselection']."' ";
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->searchCondition .= " a.amt_date>='".$quater_first."' and a.amt_date<='".$endquater_first."' ";
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->searchCondition .= " a.amt_date>='".$quater_second."' and a.amt_date<='".$endquater_second."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
								$this->searchCondition .= " a.amt_date>='".$quater_third."' and a.amt_date<='".$endquater_third."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->searchCondition .= " a.amt_date>='".$quater_fourth."' and a.amt_date<='".$endquater_fourth."' ";
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->searchCondition .= " a.amt_date>='".$firsthalf_start."' and a.amt_date<='".$firsthalf_end."' ";
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->searchCondition .= " a.amt_date>='".$secondhalf_start."' and a.amt_date<='".$secondhalf_end."' ";
						 }
						  
				 }	
				}
				
				if(@$_REQUEST['acapar'] ==1){
					$biztype = @$_REQUEST['biztype'];
					$party_type = " and a.`academy_id` ='".$biztype."' ";
				}else if(@$_REQUEST['acapar'] ==2){
					$biztype = @$_REQUEST['biztype'];
					$party_type = " and a.`party_id`= '".$biztype."' ";
				}
				
			$str = ' select * from mgl_amt_sell_books a,mgl_sell_books b where a.amt_book_id=b.sell_amt_id and a.pending_payment!=0 and '.$this->searchCondition.' '.$party_type.' group by b.sell_amt_id order by amt_book_id DESC';

				
?>
 
 <style type="text/css">
.DOBclass
{
    border: 1px solid #D7D7D7;
    border-radius: 8px 8px 8px 8px;
    font-size: 14px;
    height: 25px;
    line-height: 24px;
    padding: 0 0 0 6px;
}
</style>
      <script type="text/javascript">
	   function second_functionstest(value)
	 {
	// alert(value);
	 if(value==1)
	 {
	 var type="quaterly_wise";
	 }
	 if(value==2)
	 {
	 var type="halfyearly_wise";
	 }
	 var url="mod/mod_reports/ajax/_call_ajax.php?ajax_call_method="+type;
	var obj
	 try
		{
	   obj=new XMLHttpRequest();    
		 }
	  catch(e)
		{
				   try
				  {
				obj=new ActiveXObject("Microsoft.XMLHTTP");
					}
			catch(e)
				{
			   alert("Your Browser not supported Ajax");
				  }
		}
	obj.open("GET",url,true);
	obj.send(null);
	obj.onreadystatechange=function()
	  {
	  if(obj.readyState==4)
		 {
		   var res=obj.responseText;
		   //alert(res);
		   document.getElementById('getcontens').innerHTML = res;
		  }
	  }
	 }	
      function get_busingesss(value)
	 {
	// alert(value);
	 if(value==1)
	 {
	 var type="date_wise_ledger";
	 }
	 if(value==2)
	 {
	 var type="year_wise_ledger";
	 }
	 if(value==3)
	 {
	 var type="last_six_month_wise_ledger";
	 }
	 var url="mod/mod_reports/ajax/_call_ajax.php?ajax_call_method="+type;
	var obj
	 try
		{
	   obj=new XMLHttpRequest();    
		 }
	  catch(e)
		{
				   try
				  {
				obj=new ActiveXObject("Microsoft.XMLHTTP");
					}
			catch(e)
				{
			   alert("Your Browser not supported Ajax");
				  }
		}
	obj.open("GET",url,true);
	obj.send(null);
	obj.onreadystatechange=function()
	  {
	  if(obj.readyState==4)
		 {
		   var res=obj.responseText;
		   //alert(res);
		   document.getElementById('second').innerHTML = res;
		   $( "#sdate" ).datepicker();
		   $( "#edate" ).datepicker();
		  }
	  }
	 }	

      function party_type(value)
	  {
var url="mod/mod_reports/ajax/_call_ajax.php?ajax_call_data="+value;
var obj
 try
    {
   obj=new XMLHttpRequest();    
     }
  catch(e)
    {
               try
              {
            obj=new ActiveXObject("Microsoft.XMLHTTP");
                }
        catch(e)
            {
           alert("Your Browser not supported Ajax");
              }
    }
obj.open("GET",url,true);
obj.send(null);
obj.onreadystatechange=function()
  {
  if(obj.readyState==4)
     {
       var res=obj.responseText;
     
	   document.getElementById('third').innerHTML = res;

	   document.getElementById('second').innerHTML = "";
	   document.getElementById('second2').innerHTML = "";
	
      }
  }

}
	 
  	 
     </script>
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			
            
            <div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form name="searchForm" id="searchForm" method="get" >
            		
                  <table border="0" cellpadding="0" cellspacing="0" align="left" style="margin-right:10px;">
                    <tr>
                    <td valign="top">
                   
                    </td>
                    </tr>
                    </table>
                     
                    
                   <table width="100%" border="0">
    <tr>
     <td style="width:160px;"> 
     		<select name="acapar" id="acapar" onchange="party_type(this.value)" class="selectbox" style="padding:4px 0 0 3px;">
                    <option value="0"><?php echo SELECTACADEMYORPARTY;?></option>
                    <option value="1"><?php echo ACADEMY;?></option>
                    <option value="2"><?php echo PARTY;?></option>
            </select>
     </td>
  
     <td  style="width:160px;" > 
     <select name="biztype" id="third" class="selectbox" style="padding:4px 0 0 3px;" >
      <option><?php echo SELECT; ?></option>
     </select>     
    </td>
    
      <td style="width:180px;"> <select  class="selectbox" name="filtertype" id="filtertype" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="get_busingesss(this.value)" >
                    <option value="0"  ><?php echo Generate_Report ?></option>
                    <option value="1"  ><?php echo Date_Wise ?></option>
                    <option value="2"  ><?php echo Year_Wise ?></option>
					<option value="3"  ><?php echo Last_Six_Month_Wise ?></option>
                    </select> </td> 
      <td id="second" style="width:480px;"></td>
      <td id="" style="width:140px;">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>  
                    
                  
                    
                    
                    
                    
                    
                    
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"><!--<input type="text" name="creteria" id="creteria" value="<?php //if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  />--></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <!--<input type="submit"  class="button_r"   value="Search" onclick="this.form.submit();" />-->
                    </td>
                    </tr>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"> <?php //print $DataSet['nav'];?></td>
                    </tr>
                    </table>
			</form>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="#" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo BOOKORDERNUMBER;?></a>                        </div>
						<div style="float:left;width:11%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo EMPNAME;?></a>                        </div>
                        <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo TRANSACTIONTYPE;?></a>                        </div>
                      <div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo DATE;?></a>                        </div>
                      <div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo Quantity;?></a>                        </div>
                      <div style="float:left;width:24%;min-height:40px;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo TOTALAMOUNT;?></a></div>
                      <!-- <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Pending Amount<?php //echo DISCOUNT;?>&nbsp;(Rs)</a>                        </div> 
                      
                       <div style="float:left;width:22%;min-height:40px;text-align:center">
                        	<a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">View detail</a>              </div>-->
                  </div></td>
                </tr>
				<?php 
				
				$Books  =  $DataSet['result']; 
				
				if(count($Books)>0)
				{
				for($i = 0;$i<count($Books);$i++){	
				$empname=model_reports_ledgerReport::get_employee_name($Books[$i]['employee_id']);
				$fullname=$empname[0]['user_firstname']." ".$empname[0]['user_lastname'];
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        
						<div style="float:left;width:10%;min-height:40px;text-align:left;padding-left:10%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:29px;text-align:left;padding-left:1%;">
							<?php  
									if($Books["$i"]['book_report_order_number']!='' && $Books["$i"]['book_report_order_number']!=0){echo $Books["$i"]['book_report_order_number'];} else { echo "N.A";}
							?>   
							</div>		
                                                
                        </div>  
                       <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php echo $fullname ; ?>
						   </div>
					   <div style="float:left;width:8%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php  
									if(!isset($Books["$i"]['receivepmt']) && $Books["$i"]['receivepmt'] ==''){
											echo sellbook;
									} else {
											echo recivepmt;
									}
							?>
						   </div>
                           <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php
	                            if(!isset($Books["$i"]['receivepmt']) && $Books["$i"]['receivepmt'] ==''){
	                            	echo $Books["$i"]['amt_date'];
	                            } else {
	                            	echo date("Y-m-d", strtotime($Books["$i"]['createDate']));
	                            }
                            ?>
						   </div>
                           <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php if($Books["$i"]['book_qty'] != ''){ echo $Books["$i"]['book_qty']; } else { echo "-"; }?></div>
                           <div style="float:left;width:21%;min-height:40px;text-align:center;padding-left:1%;padding-top:12px;">
                           	<?php 								
								if(!isset($Books["$i"]['receivepmt']) && $Books["$i"]['receivepmt'] ==''){
									echo $Books["$i"]['total_amt_withanothercost'];
								} else {	
									echo $Books["$i"]['receivepmt'];
								}
								?>
							</div>
                           
                        
                       	</div>
                       </td>
                </tr>
                
  				<?php  }
				?>
                <tr>
                 <td colspan="6" align="right">
                    <div style="width:100%;height:auto;float:right;">
                    	<div style="width:100%;height:29px;border-right:#CCCCCC 1px solid;float:right;padding-left:2%;padding-top:12px;">
                         <p align="right" style="color:#000;font-size:22px;font-weight:bold;">
                
                         <a target="_blank" href="./mod/mod_reports/view/ledger_report.php?str=<?php echo $str;?>&acapar=<?php echo @$_REQUEST['acapar']; ?>&biztype=<?php echo @$_REQUEST['biztype']; ?>" style="padding-right:5px;"><?php echo Download_Report ?></a></p>
                        </div>
                       </div></td>
                </tr>
                <?php
				}
				else
				{
				 if(count($Books) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;"><?php echo No_Record_Found ?></p>
                        </div>
                       </div></td>
                </tr>
                <?php } 
				}
				?>
				</table>
				<!--  end product-table................................... -->
                 <input type="hidden" name="controller" value="" id="controller"  /> 
             </form>
			</div>
			<!--  end content-table  -->
		    <?php print $DataSet['nav'];?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
        
        <?php
		function get_date_wise(){
?>
					<input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="ledgerReport"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="12"  />
                    <tr>
                    <td valign="top" style="padding-right:10px;"><input type="text" class="DOBclass" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td valign="top"> <input type="text" class="DOBclass" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr>
<?php
}
		?>
		<!--  end content-table-inner ............................................END  -->
		