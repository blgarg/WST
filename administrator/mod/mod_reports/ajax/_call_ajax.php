
<?php
ob_start();

include '../../../../settings.php';
global $config_var;

include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
global $model;
$_request_method = @$_REQUEST['ajax_call_method'];
//include $config_var->USER_ROOT.'mod/mod_blogSetting/ajax/_ajax.php';
include $config_var->ADMIN_ROOT.'mod/mod_booksStore/controller/booksStore.php';
include $congig_var->ADMIN_ROOT.'mod/mod_reports/controller/reports.php';

switch($_request_method){
			
			case 'date_wise_publishreprint':
			get_publishreprint_date_wise();
			break;
			case 'year_wise_publishreprint':
			get_publishreprint_year_wise();
			break;
			case 'Academic_wise_publishreprint':
			get_publishreprint_academic_wise();
			break;
			
			case 'cash_date_wise':
			get_cash_date_wise();
			break;
			
			case 'cash_year_wise':
			get_cash_year_wise();
			break;
			
			case 'cash_academic_Wise':
			get_cash_academic_wise();
			break;
			
			case 'loan_date_wise':
			get_loan_date_wise();
			break;
			
			case 'loan_year_wise':
			get_loan_year_wise();
			break;
			
			case 'loan_academic_Wise':
			get_loan_academic_wise();
			break;
			
			case 'Party wise':
			get_party_list();
			break;
			
			case 'cash_party_wise':
			get_cash_report_party_wise();
			break;
			
			case 'Party_wise_issue':
			get_party_issue();
			break;
			
			case 'loan_party_wise':
			loan_report_party_wise();
			break;
			
			case 'date_wise':
			get_date_wise();
			break;
			case 'year_wise':
			get_year_wise();
			break;
			case 'Academic_Wise':
			get_academic_wise();
			break;
			
			case 'date_wise_pending':
			get_date_wise_pending();
			break;
			case 'year_wise_pending':
			get_year_wise_pending();
			break;
			
			case 'date_wise_ledger':
			get_date_wise_ledger();
			break;
			
			case 'year_wise_ledger':
			get_year_wise_ledger();
			break;
			case 'last_six_month_wise_ledger':
			get_last_six_month_wise_ledger();
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
			
			case 'Academic_wise_publication':
			get_publicastion_academicwise();
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
			
			case 'Academic_wise_reprinted':
			get_reprinted_academicwise();
			break;
			
			case 'date_wise_issue':
			get_issue_datewise();
			break;
			case 'year_wise_issue':
			get_issue_yearwise();
			break;
			case 'academic_wise_issue':
			get_issue_academicwise();
			break;
			
			case 'date_wise_gift':
			get_gift_datewise();
			break;
			case 'year_wise_gift':
			get_gift_yearwise();
			break;
			case 'Academic_wise_gift':
			get_gift_academicwise();
			break;

}	
if(isset($_REQUEST['ajax_call_data']))
{
	switch($_REQUEST['ajax_call_data'])
	{
		case '1':
			academise_type();
			break;
		case '2':
			partyies();
			break;
		
	}
}
function get_cash_report_party_wise()
{
	echo '<input type="hidden" name="party_wise" value="cash_party_wise">
	<input type="hidden" name="mod" value="mod_reports" />
	<input type="hidden" name="view" value="cashReport" />
	<input type="hidden" name="m" value="6" />
	<input type="hidden" name="d" value="13" />
	<select class="selectbox" id="party_category" name="party" style="width:30%;">
		<option value="">Select party category</option>';
	$all_party_obj=new booksStore_controller();
		  $all_parties_data=$all_party_obj->get_all_business_type();
			foreach($all_parties_data as $list){
				echo '<option value="'.$list['cat_id'].'">'.$list['cat_title'].'</option>';
			}
	echo '</select><input type="button" class="button_r" value="Generate" onclick="check_party();" style="" />';
}
function loan_report_party_wise()
{
	echo '<input type="hidden" name="party_wise" value="loan_party_wise">
	<input type="hidden" name="mod" value="mod_reports" />
	<input type="hidden" name="view" value="loanReport" />
	<input type="hidden" name="m" value="6" />
	<input type="hidden" name="d" value="13" />
	<select class="selectbox" id="party_category" name="party" style="width:30%;">
		<option value="">Select party category</option>';
	$all_party_obj=new booksStore_controller();
		  $all_parties_data=$all_party_obj->get_all_business_type();
			foreach($all_parties_data as $list){
				echo '<option value="'.$list['cat_id'].'">'.$list['cat_title'].'</option>';
			}
	echo '</select><input type="button" class="button_r" value="Generate" onclick="check_party();" style="" />';		
 }
function loan_party_wise()
{?>
	<input type="hidden" name="party_wise" value="loan_party_wise">
	<input type="hidden" name="mod" value="mod_reports" />
	<input type="hidden" name="view" value="loanReport" />
	<input type="hidden" name="m" value="6" />
	<input type="hidden" name="d" value="13" />
	<select class="selectbox" id="party_category" name="party" style="width:30%;">
		<option value="">Select party category</option>
	
			
		  </select>
	<input type="button" class="button_r" value="Generate" onclick="check_party();" style="" />	  
<? }
function get_party_issue()
{?>	
	<input type="hidden" name="party_wise" value="report_party_wise">
	<input type="hidden" name="mod" value="mod_reports" />
	<input type="hidden" name="view" value="issuebook" />
	<input type="hidden" name="m" value="6" />
	<input type="hidden" name="d" value="13" />
	<select class="selectbox" id="party_category" name="party" style="width:30%;">
		<option value="">Select party category</option>
	<?php 
		  $all_party_obj=new booksStore_controller();
		  $all_parties_data=$all_party_obj->get_all_business_type();
			foreach($all_parties_data as $list){?>
				<option value="<?php echo $list['cat_id']; ?>"><?php echo $list['cat_title']; ?></option>
		<?php	} ?>
			
		  </select>
	<input type="button" class="button_r" value="Generate" onclick="check_party();" style="" />	  
<?php }
function get_party_list()
{?>
	<input type="hidden" name="party_wise" value="report_party_wise">
	<input type="hidden" name="mod" value="mod_reports" />
	<input type="hidden" name="view" value="saleReport" />
	<input type="hidden" name="m" value="6" />
	<input type="hidden" name="d" value="13" />
	<select class="selectbox" id="party_category" name="party" style="width:30%;">
		<option value="">Select party category</option>
	<?php 
		  $all_party_obj=new booksStore_controller();
		  $all_parties_data=$all_party_obj->get_all_business_type();
			foreach($all_parties_data as $list){?>
				<option value="<?php echo $list['cat_id']; ?>"><?php echo $list['cat_title']; ?></option>
		<?php	} ?>
			
		  </select>
	<input type="button" class="button_r" value="Generate" onclick="check_party();" style="" />	  
<?php
	
}
function get_gift_datewise(){
?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="giftbook" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>
<?php
}
function get_gift_yearwise(){


	$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="giftbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>

<?php
}
function get_gift_academicwise(){
?>
		<input type="hidden" name="report_academicwise"
			value="report_academicwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="giftbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> 
		<div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"></td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table> </div>

<?php
}


function get_issue_datewise(){
?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="issuebook" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>
<?php
}
function get_issue_yearwise(){
	$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="issuebook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>
<?php
}
function get_issue_academicwise(){
	?>

					<input type="hidden" name="report_academicwise"
			value="report_academicwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="issuebook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> 
			<div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"></td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table> </div>
<?php
}


function get_reprinted_datewise()
{ ?>

<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="reprintedbook" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>


<?php }
function get_reprinted_yearwise()
{


	$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="reprintedbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>
<?php
}
function get_reprinted_academicwise()
{
?>
		<input type="hidden" name="report_academicwise"
			value="report_academicwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="reprintedbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" />
		<div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
					<option value="hga"  >HGA</option>
				   <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"></td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table> </div>
<?php
}
function get_date_wise_pending(){

?>

<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="pendingReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
<tr>
	<td valign="top" style="padding-right: 10px;"><input type="text"
		class="DOBclass" readonly="readonly" maxlength="50" id="sdate"
		value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
		name="sdate" style="width: 120px;"></td>
	<td valign="top"><input type="text" class="DOBclass"
		readonly="readonly" maxlength="50" id="edate"
		value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
		name="edate" style="width: 120px;"></td>
	<td valign="top"><input type="button" class="button_r" value="Generate"
		onclick="check_datewise();" style="margin-left: 5px;" /></td>
</tr>
<?php

}
function get_year_wise_pending(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="pendingReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="12" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select></td>
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>



<?php
}
function get_date_wise(){
?>

<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="saleReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
<tr>
	<td valign="top" style="padding-right: 10px;">
		<input type="text" class="DOBclass" readonly="readonly" maxlength="50" id="sdate" value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"name="sdate" style="width: 120px;">
	</td>
	<td valign="top">
		<input type="text" class="DOBclass" readonly="readonly" maxlength="50" id="edate" value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>" name="edate" style="width: 120px;">
	</td>
	
	<td valign="top">
		<input type="button" class="button_r" value="Generate" onclick="check_datewise();" style="margin-left: 5px;" />
	</td>
</tr>
<?php
}	
function get_academic_wise(){

?>
<input type="hidden" name="report_academywise" value="report_academywise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="saleReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
   <div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table>   </div> 
<?php
}	

function get_year_wise(){

?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="saleReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="12" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select></td>
		<td id="getcontens"></td>
		
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>



<?php
}		
function get_quaterly()
{
?>
<select class="selectbox" name="quarter" id="quarter" style="width: 100%; padding: 3px 0 0 6px;">
	<option value="0">Select Quarter</option>
	<option value="1">First Quarter</option>
	<option value="2">Second Quarter</option>
	<option value="3">Third Quarter</option>
	<option value="4">Fourth Quarter</option>
</select>
<?php
}
function get_halfyearly()
{
?>
<select class="selectbox" name="selecthalf" id="selecthalf" style="width: 100%; padding: 3px 0 0 6px;">
	<option value="0">Select Half</option>
	<option value="1">First Half</option>
	<option value="2">Second Half</option>
</select>
<?php
}
function get_publication_datewise()
{
?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="publicationbook" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>
<?php
}
function get_publishreprint_date_wise()
{

?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="publishreprintReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>
<?php
}
function get_publicastion_yearwise(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="publicationbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>


<?php
}
function get_publishreprint_year_wise(){
?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="publishreprintReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>


<?php
}
function get_publicastion_academicwise(){
?>

<input type="hidden" name="report_academicwise"
			value="report_academicwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="publicationbook" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" />
			<div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
					<option value="hga"  >HGA</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table> </div>


<?php
}
function get_publishreprint_academic_wise(){
?>

<input type="hidden" name="report_academicwise"
			value="report_academicwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="publishreprintReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" />
			<div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
					<option value="hga"  >HGA</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table> </div>


<?php
}
function get_grant_datewise(){
?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="grantRecieved" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="13" />
<div style="float:right;"><table>
	<tr>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="sdate"
			value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
			name="sdate" style="width: 120px;"></td>
		<td><input type="text" class="DOBclass" readonly="readonly"
			maxlength="50" id="edate"
			value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
			name="edate" style="width: 120px;"></td>
		<td><input type="button" class="button_r" value="Generate"
			onclick="check_datewise();" style="margin-left: 5px;" /></td>
	</tr>
</table></div>
<?php
}

function get_grant_yearwise(){

	$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="grantRecieved" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="13" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select>
		
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>
<?php
}

function academise_type(){

	?>


<option value="0"><?php echo ACADEMYTITLE;?></option>
<?php
 				$all_book_academies=new booksStore_controller();
				$businesslist=$all_book_academies->get_all_academics();
				for($i=0;$i<count($businesslist);$i++)
				{
				?>
<option value="<?php echo $businesslist[$i]['parties_id']; ?>"><?php echo $businesslist[$i]['business_title']; ?></option>
<?php
				}
				?>
                      
<?php
}
function partyies(){
	
	$str='SELECT * FROM mgl_party WHERE Actions=1 ';
	$rs=mysql_query($str);

	?>


<option value="0"><?php echo PARTYNAME;?></option>
<?php
 				 while($result_value=mysql_fetch_array($rs))
				{
				?>
<option value="<?php echo $result_value['party_id'];?>"><?php echo $result_value['party_title'];?></option>
<?php } ?>
                
<?php }
 	
 	function get_date_wise_ledger(){
 		
 	?>
<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="ledgerReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
<tr>
	<td valign="top" style="padding-right: 10px;"><input type="text"
		class="DOBclass" readonly="readonly" maxlength="50" id="sdate"
		value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
		name="sdate" style="width: 120px;"></td>
	<td valign="top"><input type="text" class="DOBclass"
		readonly="readonly" maxlength="50" id="edate"
		value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
		name="edate" style="width: 120px;"></td>
	<td valign="top"><input type="button" class="button_r" value="Generate"
		onclick="check_datewise();" style="margin-left: 5px;" /></td>
</tr>
<?php
 		
 		}
 		function get_year_wise_ledger(){
 		?>
 		
 		                    <?php
 							$yearly=array();
 							$c=0;
 							for($i=2000;$i<=2090;$i++)
 							{
 							$yearly[$c]=$i;
 							$c++;
 							}
 							?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> 
			
			<input type="hidden" name="view"
			value="ledgerReport" /> <input type="hidden" name="m" value="6" /> <input
			type="hidden" name="d" value="12" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
 		                    <?php foreach($yearly as $val)
 							{
 							echo "<option value=".$val.">".$val."</option>";
 							}
 							?>
 		                    
 		                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select></td>
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>



<?php } 
 		function get_last_six_month_wise_ledger(){
			
			
	
		?>
 		 		                    
<div style="float:right;"><table>
	<tr>
		<td>
		
		<input type="hidden" name="report_sixmonthwise"
			value="report_sixmonthwise" /> 
			<input type="hidden" name="controller" value="sixmonthreport" />
			<input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="ledgerReport" /> <input type="hidden"  id="m" name="m" value="6" /> <input
			type="hidden" name="d" value="12" /> </td>
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_lastsixmonth()" style="" /></td>
	</tr>
</table></div>



<?php } 
function get_loan_date_wise(){
?>

<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="loanReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
<tr>
	<td valign="top" style="padding-right: 10px;"><input type="text"
		class="DOBclass" readonly="readonly" maxlength="50" id="sdate"
		value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
		name="sdate" style="width: 120px;"></td>
	<td valign="top"><input type="text" class="DOBclass"
		readonly="readonly" maxlength="50" id="edate"
		value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
		name="edate" style="width: 120px;"></td>
	<td valign="top"><input type="button" class="button_r" value="Generate"
		onclick="check_datewise();" style="margin-left: 5px;" /></td>
</tr>
<?php
}	
function get_loan_year_wise(){

?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="loanReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="12" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select></td>
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>



<?php
}		
function get_loan_academic_wise(){

?>
<input type="hidden" name="report_academywise" value="report_academywise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="loanReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
   <div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table>   </div> 
<?php
}	

function get_cash_date_wise(){
?>

<input type="hidden" name="report_datewise" value="report_datewise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="cashReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
<tr>
	<td valign="top" style="padding-right: 10px;"><input type="text"
		class="DOBclass" readonly="readonly" maxlength="50" id="sdate"
		value="<?php if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='') echo $_REQUEST['sdate'];?>"
		name="sdate" style="width: 120px;"></td>
	<td valign="top"><input type="text" class="DOBclass"
		readonly="readonly" maxlength="50" id="edate"
		value="<?php if(isset($_REQUEST['edate']) && $_REQUEST['edate']!='') echo $_REQUEST['edate'];?>"
		name="edate" style="width: 120px;"></td>
	<td valign="top"><input type="button" class="button_r" value="Generate"
		onclick="check_datewise();" style="margin-left: 5px;" /></td>
</tr>
<?php
}	
function get_cash_year_wise(){

?>

                    <?php
					$yearly=array();
					$c=0;
					for($i=2000;$i<=2090;$i++)
					{
					$yearly[$c]=$i;
					$c++;
					}
					?>
<div style="float:right;"><table>
	<tr>
		<td><input type="hidden" name="report_yearwise"
			value="report_yearwise" /> <input type="hidden" name="mod"
			value="mod_reports" /> <input type="hidden" name="view"
			value="cashReport" /> <input type="hidden" name="m" value="6" /><input
			type="hidden" name="d" value="12" /> <select class="selectbox"
			name="yearselection" id="yearselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					Year</option>
                    <?php foreach($yearly as $val)
					{
					echo "<option value=".$val.">".$val."</option>";
					}
					?>
                    
                    </select></td>
		<td style="width: 140px;"><select class="selectbox"
			name="typeselection" id="typeselection"
			style="padding: 3px 0 0 6px; width: 100%; margin-right: 10px;"
			onchange="second_functionstest(this.value)">
				<option value="0"
					<?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?>>Select
					type</option>
				<option value="1"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Quaterly</option>
				<option value="2"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Half
					yearly</option>
				<option value="3"
					<?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?>>Yearly</option>
		</select></td>
		<td id="getcontens"></td>
		<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_quarterly()" style="" /></td>
	</tr>
</table></div>



<?php
}		
function get_cash_academic_wise(){

?>
<input type="hidden" name="report_academywise" value="report_academywise" />
<input type="hidden" name="mod" value="mod_reports" />
<input type="hidden" name="view" value="cashReport" />
<input type="hidden" name="m" value="6" />
<input type="hidden" name="d" value="12" />
   <div style="float:right;"><table><tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <?php
				    $all_busin_cate=new booksStore_controller();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">                  
                    </td>
					<td style="width: 140px;"><input type="button" class="button_r"
			value="Generate" onclick="check_academics()" style="" /></td>
                    </tr>   </table>   </div> 
<?php
}	


?>
 		 		
 		
