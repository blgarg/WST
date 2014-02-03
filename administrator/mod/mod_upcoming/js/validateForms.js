// JavaScript Document
function showUpload()
{
	if(document.getElementById("editVideo").checked)
	{
		document.getElementById("activate_upload").style.display="block";
	}
	else
	{
		document.getElementById("activate_upload").style.display="none";
	}
}

//Check edit page
function checkEditbar()
{ 
with (window.document.adddPageFrm) { 
		if(isEmpSelect(country_name, 'Please select country name.')) {
			return false;
		}else if(document.getElementById("editVideo").checked)
		{
			if($("input[name=upload_video]").val()=="")
			{
				document.getElementById("err_mess").innerHTML = "Please upload the Image";
				document.getElementById("content-table-inner").style.display="block";
				return false;	
			}
			else if(isValidImage(image_load, 'Please select the valid image jpg, gif, png and jpeg.')) {
				return false;
			}else if(loadfilesize.value>1){
				document.getElementById("err_mess").innerHTML = "Image size should be less then 1 MB";
				document.getElementById("content-table-inner").style.display="block";
				return false;	
		}else {
			submit();
		}	
		}else{
			submit();
		}
 }
}

