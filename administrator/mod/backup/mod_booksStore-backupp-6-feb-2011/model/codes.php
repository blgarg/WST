<?php
mysql_connect("localhost","root","");
mysql_select_db("hatron_db");
if(isset($_REQUEST['party_id']))
{
require('../../../../settings.php');
	
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and business_typeid="'.$_REQUEST['party_id'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox">
    
       <option value=""> Select Academies </option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo $result_value['parties_id'];?>" ><?php echo $result_value['business_title'];?></option>
            <?php
			}
			?>
        </select>
        <?php
}

if(isset($_REQUEST['party_editid']))
{
require('../../../../settings.php');
	$back_id=$_REQUEST['dbid'];
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and business_typeid="'.$_REQUEST['party_editid'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox">
    
       <option value=""> Select Academies </option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo $result_value['parties_id'];?>" <?php if(@$back_id==@$result_value['parties_id']) {echo 'selected';}?>><?php echo $result_value['business_title'];?></option>
            <?php
			}
			?>
        </select>
        <?php
}
if(isset($_REQUEST['emp_id']))
{
require('../../../../settings.php');
	$emp_id=$_REQUEST['emp_id'];
	$str='SELECT * FROM mgl_employee_users WHERE emp_id="'.$emp_id.'"';
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	echo "<img src='".$config_var->UPLOAD_URL."employee_users/thumb/".$row['img_title']."'><br>";
	echo "First Name:".$row['emp_fname'];
	echo "<br>Last Name:".$row['emp_lname'];
	echo "<br>DOB:".$row['emp_dob'];
	echo "<br>Mobile:".$row['emp_mobile'];
	echo "<br>Phone no.:".$row['emp_phone'];
	
	;
	
}
if(isset($_REQUEST['partyid_info']))
{
require('../../../../settings.php');
	$partyid_info=$_REQUEST['partyid_info'];
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and parties_id="'.$partyid_info.'"';
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	echo "<b>Owner name:</b>".$row['owner_name'];
	echo "<br><b>Address:</b>".$row['address'];
	echo "<br><b>State:</b>".$row['state'];
	echo "<br><b>City:</b>".$row['city'];
	echo "<br><b>Contact 1:</b>".$row['contact1'];
	echo "<br><b>Contact 2:</b>".$row['contact2'];
	echo "<br><b>Description:</b>".$row['partie_contents'];
}
if(isset($_REQUEST['bill_partyid']))
{

require('../../../../settings.php');
	
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and business_typeid="'.$_REQUEST['bill_partyid'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox" style="width:40%;padding:4px 0 0 3px;" onchange="get_partyinfo(this.value)">
    
       <option value="0"> Select Academies </option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo $result_value['parties_id'];?>" ><?php echo $result_value['business_title'];?></option>
            <?php
			}
			?>
        </select>
        <?php

}
if(isset($_REQUEST['party']))
{
require('../../../../settings.php');
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and business_typeid="'.$_REQUEST['party'].'"';
	$rs=mysql_query($str);
	?>
    <select  class="selectbox" name="partyid"  style="width:100%;padding:3px 0 0 6px;"  >
    <option value="<?php base64_encode(0);?>">Select Academies</option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo base64_encode($result_value['parties_id']);?>" ><?php echo $result_value['business_title'];?></option>
            <?php
			}
			?>
            </select>
        <?php
}
if(isset($_REQUEST['businesstypeid']) && isset($_REQUEST['partid']))
{
require('../../../../settings.php');
	$str='SELECT * FROM mgl_business_parties WHERE Actions=1 and business_typeid="'.$_REQUEST['businesstypeid'].'"';
	$rs=mysql_query($str);
	?>
    <select  class="selectbox" name="partyid"  style="width:100%;padding:3px 0 0 6px;"  >
    <option value="<?php base64_encode(0);?>">Select Academies</option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo base64_encode($result_value['parties_id']);?>" <?php if(isset($_REQUEST['businesstypeid']) && $_REQUEST['businesstypeid']!='' && $_REQUEST['partid']==base64_encode($result_value['parties_id'])) echo 'selected'; ?>><?php echo $result_value['business_title'];?></option>
            <?php
			}
			?>
            </select>
        <?php
}
?>