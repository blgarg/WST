
<?php

ob_start();
include '../../../../settings.php';
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$_request_method = @$_REQUEST['ajax_call_method'];
include $config_var->USER_ROOT.'mod/mod_blogSetting/ajax/_ajax.php';
switch($_request_method){

case 'date_wise':
get_date_wise();
break;
case 'year_wise':
get_year_wise();
break;

case 'date_wise_pending':
get_date_wise_pending();
break;
case 'year_wise_pending':
get_year_wise_pending();
break;

case 'quaterly_wise':
get_quaterly();
break;
case 'halfyearly_wise':
get_halfyearly();
break;


case 'date_wise_publication':
get_publication_datewise();
break;
case 'year_wise_publication':
get_publicastion_yearwise();
break;

case 'date_wise_grant':
get_grant_datewise();
break;
case 'year_wise_grant':
get_grant_yearwise();
break;

case 'date_wise_reprinted':
get_reprinted_datewise();
break;
case 'year_wise_reprinted':
get_reprinted_yearwise();
break;

case 'date_wise_issue':
get_issue_datewise();
break;
case 'year_wise_issue':
get_issue_yearwise();
break;

case 'date_wise_gift':
get_gift_datewise();
break;
case 'year_wise_gift':
get_gift_yearwise();
break;

}	
function get_gift_datewise(){
?>
 <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="giftbook"  /> <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <table>
                    <tr><td>
                    <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td>
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr></table>
<?php
}
function get_gift_yearwise(){


	$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                     <table> <tr><td>
                     <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="giftbook"  /> <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> </td>
                    <td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                 <td id="getcontens"></td>
                    <td  style="width:140px;">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                    </td></tr></table>

<?php
}

function get_issue_datewise(){
?>
<input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="issuebook"  /> <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <table>
                    <tr><td>
                    <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td>
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr></table>
<?php
}
function get_issue_yearwise(){
	$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                     <table> <tr><td>
                   <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="issuebook"  /> <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> </td>
                    <td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                 <td id="getcontens"></td>
                    <td  style="width:140px;">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                    </td></tr></table>
<?php
}
function get_reprinted_datewise()
{ ?>

  <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="reprintedbook"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <table>
                    <tr><td>
                    <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td>
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr></table>


<?php }
function get_reprinted_yearwise()
{


	$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                     <table> <tr><td>
                    <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="reprintedbook"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> </td>
                    <td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                 <td id="getcontens"></td>
                    <td  style="width:140px;">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                    </td></tr></table>
<?php
}
function get_date_wise_pending(){

?>
              
                   <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="pendingReport"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="12"  />
                    <tr>
                    <td valign="top" style="padding-right:10px;"><input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td valign="top"> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr>
<?php

}
function get_year_wise_pending(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                    <table> <tr><td>
                    <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="pendingReport"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="12"  />
                    
                  
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> 
                   </td><td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                  </td>
                  <td id="getcontens"></td>
                    <td  style="width:140px;">
                
                  
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                     
                 </td></tr></table>
                   
                      
                     
<?php
}
function get_date_wise(){
?>
              
                   <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="saleReport"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="12"  />
                    <tr>
                    <td valign="top" style="padding-right:10px;"><input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td valign="top"> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr>
<?php
}	

function get_year_wise(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                    <table> <tr><td>
                    <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="saleReport"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="12"  />
                    
                  
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> 
                   </td><td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                  </td>
                  <td id="getcontens"></td>
                    <td  style="width:140px;">
                
                  
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                     
                 </td></tr></table>
                   
                      
                     
<?php
}		
function get_quaterly()
{
?>
<select  class="selectbox" name="quarter" id="quarter" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" >Select Quarter</option>
                    <option value="1" >First Quarter</option>
                    <option value="2" >Second Quarter</option>
                    <option value="3" >Third Quarter</option>
                    <option value="4" >Fourth Quarter</option>
                    </select>
<?php
}
function get_halfyearly()
{
?>
<select  class="selectbox" name="selecthalf" id="selecthalf" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" >Select Half</option>
                      <option value="1">First Half</option>
                        <option value="2">Second Half</option>
                    </select>
<?php
}
function get_publication_datewise()
{
?>
                   <input type="hidden" name="report_datewise" value="report_datewise" />
                   <input type="hidden" name="mod" value="mod_reports"  />
                   <input type="hidden" name="view" value="publicationbook"  />
                   <input type="hidden" name="m" value="6"  />
                   <input type="hidden" name="d" value="13"  />
                    <table>
                    <tr><td>
                    <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td>
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr></table>
<?php
}
function get_publicastion_yearwise(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                     <table> <tr><td>
                    <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="publicationbook"  /> <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> </td>
                    <td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                 <td id="getcontens"></td>
                    <td  style="width:140px;">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                    </td></tr></table>
                     
                 
<?php
}
function get_grant_datewise(){
?>
  <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="report_datewise" value="report_datewise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="grantRecieved"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <table>
                    <tr><td>
                    <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>" name="sdate" style="width:120px;"> </td>
                    <td> <input type="text" class="DOBclass"  readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width:120px;"></td>
                    <td>
                    <input type="button"  class="button_r"   value="Generate" onclick="check_datewise();" style="margin-left:5px;" />
                     
                    </td>
                    </tr></table>
<?php
}

function get_grant_yearwise(){

	$yearly=array();
					$c=0;
					for($i=2009;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
                     <table> <tr><td>
                    <input type="hidden" name="report_yearwise" value="report_yearwise" />
                    <input type="hidden" name="mod" value="mod_reports"  />
                    <input type="hidden" name="view" value="grantRecieved"  />
                    <input type="hidden" name="m" value="6"  /><input type="hidden" name="d" value="13"  />
                    <select  class="selectbox" name="yearselection" id="yearselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select> </td>
                    <td style="width:140px;">
                    <select  class="selectbox" name="typeselection" id="typeselection" style="padding:3px 0 0 6px;width:100%;margin-right:10px;" onchange="second_functionstest(this.value)"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select type</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Quaterly</option>
                    <option value="2" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Half yearly</option>
                    <option value="3" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Yearly</option>
                    </select> 
                 <td id="getcontens"></td>
                    <td  style="width:140px;">
                    <input type="button"  class="button_r"   value="Generate" onclick="check_quarterly()" style="" />
                    </td></tr></table>
<?php
}
?>