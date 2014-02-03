<?php
mysql_connect("localhost","root","root");
mysql_select_db("hga");
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
	$str='SELECT * FROM mgl_users WHERE user_id="'.$emp_id.'"';
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	echo "<img src='".$config_var->UPLOAD_URL."employee_users/thumb/".$row['user_image']."'><br>";
	echo "First Name:".$row['user_firstname'];
	echo "<br>Last Name:".$row['user_lastname'];
	echo "<br>DOB:".$row['dateofbirth'];
	echo "<br>Mobile:".$row['user_mobile'];
	echo "<br>Phone no.:".$row['user_phone'];
	
	;
	
}
if(isset($_REQUEST['partyid_info']))
{
require('../../../../settings.php');
	$partyid_info=$_REQUEST['partyid_info'];
	$str='SELECT * FROM mgl_party WHERE Actions=1 and party_id="'.$partyid_info.'"';
	$rs=mysql_query($str);
	$row=mysql_fetch_array($rs);
	echo '<table width="100%" border="0">
                <tr>
                  <td width="16%" valign="top" scope="col">Owner name:</th>
                  <td width="84%" valign="top" scope="col">'.$row['owner_name'].'</th>                
                </tr>
                <tr>
                  <td valign="top">Address:</td>
                  <td valign="top">'.$row['address'].'</td>
                </tr>
                <tr>
                  <td valign="top">State:</td>
                  <td valign="top">'.$row['state'].'</td>
                </tr>
                <tr>
                  <td valign="top">City:</td>
                  <td valign="top">'.$row['city'].'</td>
                </tr>
                <tr>
                  <td valign="top">Contact 1:</td>
                  <td valign="top">'.$row['contact1'].'</td>
                </tr>
                <tr>
                  <td valign="top">Contact 2:</td>
                  <td valign="top">'.$row['contact2'].'</td>
                </tr>
                <tr>
                  <td valign="top">Description:</td>
                  <td valign="top">'.$row['partie_contents'].'</td>
                </tr>
              </table>';
}
if(isset($_REQUEST['bill_partyid']))
{

require('../../../../settings.php');
	
	$str='SELECT * FROM mgl_party WHERE Actions=1 and party_type_id="'.$_REQUEST['bill_partyid'].'"';
	$rs=mysql_query($str);

	?>
	
	 <select  name="party"  id="party" class="selectbox" style="width:40%;padding:4px 0 0 3px;" onchange="get_partyinfo(this.value)">
    
       <option value="0"> Select Party </option>
	 <?php while($result_value=mysql_fetch_array($rs))
	{?>
            <option value="<?php echo $result_value['party_id'];?>" ><?php echo $result_value['party_title'];?></option>
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