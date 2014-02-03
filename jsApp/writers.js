function submitform(){
	var writername=document.getElementById('writername').value;
	var writerpwd=document.getElementById('writerpwd').value;
	if(writername=="")
	{
		document.getElementById('errorspan').style.display="block";
		document.getElementById('errorspan').innerHTML="Please enter writer name";
		document.getElementById('writername').focus();
		return false;
		}
	else if(writerpwd=="")
	{
		document.getElementById('errorspan').style.display="block";
		document.getElementById('errorspan').innerHTML="Please enter writer password";
		document.getElementById('writerpwd').focus();
		return false;
		}	
		else {
			document.form1.submit()
			}
	}