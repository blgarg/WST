<?php 
global $config_var;  
global $model;
global $DataSet;
//echo "<pre>"; print_r($DataSet); die;
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
	  if(value==1)
	 {
	 var type="date_wise_publishreprint";
	 }
	 if(value==2)
	 {
	 var type="year_wise_publishreprint";
	 }
	 if(value==3)
	 {
	 var type="Academic_wise_publishreprint";
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
                    <select  class="selectbox" name="filtertype" id="filtertype" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="get_busingesss(this.value)" >
                    <option value="0"  ><?php echo Generate_Report ?></option>
                    <option value="1"  ><?php echo Date_Wise ?></option>
                    <option value="2"  ><?php echo Year_Wise ?></option>
					<option value="3"  ><?php echo Academic_Wise ?></option>
                    </select> 
                    </td>
                     <td id="second" style="width:580px;"></td>
      <td id="" style="width:140px;">&nbsp;</td>
      <td>&nbsp;</td>
                    </tr>
                    </table>
                     
                    
                     
                    
                    
                    
                    
                    
                    
                    
                    
                 
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                 
                    </td>
                    </tr>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"> </td>
                    </tr>
                    </table>
			</form>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod_reports&view=publicationbook&m=6&d=13" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo BOOKNAME ; ?></a>                        </div>
					  <div style="float:left;width:11%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo EMPNAME;?></a>                        </div>
                      <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo Publication_Date ; ?></a>                        </div>
                      <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo PURCHASEPRICE ; ?></a>                        </div>
                      <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo Sell_Price ; ?></a></div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo ACADEMY ;?></a>                        </div>
                        
<!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:14%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;"><?php echo AUTHOR ;?></a>                        </div>
                  </div></td>
                </tr>
				<?php 
				
				$Books  =  $DataSet['result'];
			echo "<pre>"; print_r($Books); die;
				if(count($Books)>0)
				{
				for($i = 0;$i<count($Books);$i++){	
				$empname=model_reports_publishreprintReport::get_employee_name($Books[$i]['emp_id']);
				$fullname=$empname[0]['user_firstname']." ".$empname[0]['user_lastname'];
				
				?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;min-height:40px;float:left;">
                    	
                        
						<div style="float:left;width:19%;min-height:40px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:26px;text-align:left;padding-left:1%;">
							<?php echo $Books["$i"]['book_name'];?>   </div>		
                        
                        
                        <!--<div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php //echo $i;?>"><a href="?mod=mod_agents&view=editAgent&m=6&agent_id=<?php //echo $Books["$i"]['agent_id'];?>" style="color:#595959;"><strong>Edit</strong></a><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&agent_id=<?php //echo $Books[$i]['agent_id']; ?>" style="color:#474747;"><strong>View</strong></a></div>-->
                        
                        
                        </div>  
                           <div style="float:left;width:10%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php echo $fullname;?>
						   </div>
						   <div style="float:left;width:19%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                            <?php echo $Books["$i"]['created_Date'];?>
						   </div>
                           <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['party_price'];?></div>
                           <div style="float:left;width:9%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['book_price'];?></div>
                           <div style="float:left;width:13%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php $academies=model_reports_publicationbook::get_party_title($Books["$i"]['party_id']);
							if($academies[0]['business_title']!="") {
							 echo $academies[0]['business_title'];
							 }
							 else
							 {
							 echo "HGA Academy";
							 }
						   ?></div>
                           <!--<div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Books["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Books["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Books["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:12%;min-height:40px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php $author=model_reports_publicationbook::get_author($Books["$i"]['royality_writer_id']);
							if($author[0]['writer_name']!="") {
							 echo $author[0]['writer_name'];
							 }
							 else
							 {
							 echo "Not available";
							 }
						   ?>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  }
				?>
                <tr>
                 <td colspan="6" align="right">
                    <div style="width:100%;height:auto;float:right;">
                    	<div style="width:100%;height:29px;border-right:#CCCCCC 1px solid;float:right;padding-left:2%;padding-top:12px;">
                         <p align="right" style="color:#000;font-size:22px;font-weight:bold;">
                         <?php
                   if(isset($_REQUEST['report_datewise']) && $_REQUEST['report_datewise']=='report_datewise'){
				
					if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!=''){
					
						$this->searchCondition .= " created_date>='".$_REQUEST['sdate']."' and created_date<='".$_REQUEST['edate']."' ";
					}
				}
				else if(isset($_REQUEST['report_academicwise']) && $_REQUEST['report_academicwise']=='report_academicwise'){
						$this->searchCondition .= " party_id='".base64_decode($_REQUEST['businessid'])."' ";
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
						$this->searchCondition .= " created_year='".@$_REQUEST['yearselection']."' ";
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->searchCondition .= " created_date>='".$quater_first."' and created_date<='".$endquater_first."' ";
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->searchCondition .= " created_date>='".$quater_second."' and created_date<='".$endquater_second."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
								$this->searchCondition .= " created_date>='".$quater_third."' and created_date<='".$endquater_third."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->searchCondition .= " created_date>='".$quater_fourth."' and created_date<='".$endquater_fourth."' ";
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->searchCondition .= " created_date>='".$firsthalf_start."' and created_date<='".$firsthalf_end."' ";
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->searchCondition .= " created_date>='".$secondhalf_start."' and created_date<='".$secondhalf_end."' ";
						 }
						  
				 }	
				}
				 $str = ' select * from mgl_books_info where '.$this->searchCondition.'  order by book_id desc';
                         ?>
                         <a target="_blank" href="./mod/mod_reports/view/publication_report.php?str=<?php echo $str;?>" style="padding-right:5px;"><?php echo Download_Report ?></a></p>
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
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;"><?php echo No_Report ?></p>
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
		<!--  end content-table-inner ............................................END  -->
		