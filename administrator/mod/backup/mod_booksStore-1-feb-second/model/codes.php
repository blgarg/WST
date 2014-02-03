<?php
mysql_connect("localhost","root","root");
mysql_select_db("hga");
if(isset($_REQUEST['party_id']))
{
require('../../../../settings.php');
	
	$str='SELECT * FROM mgl_business_parties WHERE business_typeid="'.$_REQUEST['party_id'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox">
    
       <option value=""> Select Party </option>
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
	$str='SELECT * FROM mgl_business_parties WHERE business_typeid="'.$_REQUEST['party_editid'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox">
    
       <option value=""> Select Party </option>
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
?>