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
//edit image video
function editshowUpload()
{
	
	if(document.getElementById("editUploadImage").checked)
	{
		document.getElementById("editImage1").style.display="block";
	}
	else
	{
		document.getElementById("editImage1").style.display="none";
	}
}
function pageAction(controller)
{
	
	 $("#content-table-inner-susecc").hide(); 
	var checkFound = false;
	var chkboxlen = document.getElementsByName('video_id[]').length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('video_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = "Please select at least one writer.";

	}else {
   
		 document.getElementById("controller").value = controller;
		 if(confirm('Do you really want to '+controller+' the selected record(s)?'))
		 { 
			document.mainform.submit();
		 }
		 else{
			
			 return false;
		 }
	}
}

<!-- Begin
function checkUncheckAll(field,status)
{

	if(field) {
		if(status.checked){
			if( field.length >0 ){
				for (i = 0; i < field.length; i++){
					field[i].checked = true ;
				}
			}
		}else{
			if( field.length >0 ){
				for (i = 0; i < field.length; i++)
				field[i].checked = false ;
			}
		}
	}
}

//  End -->
// Edit Video
function checkEditVideo()
{
	var error = "";
	imagefile_value = $("input[name=video_name]").val();
	var checkimg = imagefile_value.toLowerCase();
	if($("input[name=video_name]").val()=="")
	{
		error = "please enter the video title";
	}
	else if(!isNaN($("input[name=video_name]").val()))
	{
		error = "Please enter only text in video title"
	}
	else if (checkimg.match(/([\<])([^\>]{1,})|([<])|([\>])/i)!=null)
	{			
			error = "Special characters are not allowed in video title.";
	}	
	else if($("input[name=country]").val()=="")
	{
		error ="Please select the country";
	}
	else if($("input[name=category]").val()=="")
	{
		error = "Please select the category";
	}
	else if(document.getElementById("editUploadImage").checked)
	{
		if($("input[name=upload_image]").val()=="")
		{
			error = "Please upload the image";
		}else if($("input[name=upload_image]").val()!=""){
				var checking = document.getElementById("upload_image").value.toLowerCase();
				if(!checking.match(/(\.jpg|\.JPEG|\.gif|\.GIF|\.png|\.PNG)$/)){
				//alert("if");
				error = "Please upload only jpg,gif and png image";
				}else if($("input[name=loadimagesize]").val() > 1){
				error = "Maximum image size should be 1 Mb";
				}
		}
		
	}
	else if(document.getElementById("editVideo").checked)
	{
		if($("input[name=upload_video]").val()=="")
		{
			error = "Please upload the video";
		}
		else if(isValidVideosWMV($("input[name=upload_video]").val()))
		{
			error = "Please upload video type WMV only.";
		}
		else if($("input[name=loadfilesize]").val() >500){
				error = "Video size should be less then 500 MB";
		}
	}
	
	if(error == "")
	{
	           $('#f1_upload_process').css('display','block');
		document.getElementById("editVideoFrm").submit();
	}
	else
	{
		document.getElementById("err_mess").innerHTML = error;
		document.getElementById("content-table-inner").style.display="block";
		
		return false;
	}
}

// CHECK ADD PAGES 
function checkAddVideo()
{
	var error = "";
	imagefile_value = $("input[name=video_name]").val();
	var imageext = $("input[name=upload_image]").val();
	var checkimg = imagefile_value.toLowerCase();
	var checkimg1 = imageext.toLowerCase();
	if($("input[name=video_name]").val()=="")
	{
		error = "please enter the video title";
	}
	
	else if(!isNaN($("input[name=video_name]").val()))
	{
		error = "Please enter only text in video title"
	}
	else if (checkimg.match(/([\<])([^\>]{1,})|([<])|([\>])/i)!=null)
	{			
			error = "Special characters are not allowed in video title.";
	}
	else if($("select[name=country]").val()=="")
	{
		error ="Please select the country";
	}
	else if($("select[name=category]").val()=="")
	{
		error = "Please select the category";
	}
	else if($("input[name=upload_image]").val()=="")
	{
		error = "Please upload the image";
	}
	else if(validImage($("input[name=upload_image]").val()))
	{
		error = "Please upload image type only jpg, gif or png"
	}
	else if($("input[name=loadimagesize]").val() > 1)
	{
		error = "Maximum image size should be 1 Mb";
	}
	else if($("input[name=upload_video]").val()=="")
	{
		error = "Please upload the video";
	}
	
	else if(isValidVideosWMV($("input[name=upload_video]").val()))
	{
		error = "Please upload video type WMV only";
	}
	
	else if($("input[name=loadfilesize]").val() >500){
				error = "Video size should be less then 500 MB";
	}
	
	if(error == "")
	{
		$('#f1_upload_process').show().css({'display' : 'block'});	
              document.getElementById("addVideoFrm").submit();
	}
	else
	{
		document.getElementById("err_mess").innerHTML = error;
		document.getElementById("content-table-inner").style.display="block";
		
		return false;
	}
}



function checkEditBanner()
{
		
	with (window.document.editmodelFrm) { 
	
	var apeared_m =  appear_month.value;
	var apeared_y = appear_year.value;
	var apeared = apeared_m+'-'+apeared_y;

	    if (isEmpty(modelName, 'Please enter first name')) {
			return false;
		}else if(isEmpty(model_lname, 'Please enter last name')) {
			return false;
		}else if(isEmpty(DOB_datepicker, 'Please select date of birth')) {
			return false;
		}else if(compareToDayDate(DOB_datepicker, 'Future date is not allowed')) {
			return false;
		}/*else if(isEmpty(Birthplace, 'Please enter Birthplace')) {
			return false;
		}*/else if(isEmpty(Stats_height, 'Please enter height')) {
			return false;
		}else if(isEmpty(Stats_weight, 'Please enter weight')) {
			return false;
		}else if(isEmpty(Stats_measurement, 'Please enter measurement')) {
			return false;
		}else if(isEmptySelect(Country, 'Please select country')) {
			return false;
		}else if(isEmpty(appear_month, 'Please enter month')) {
			return false;
		}else if(isEmpty(appear_year, 'Please enter year')) {
			return false;
		}else if(isnumeric(appear_year, 'Please enter only numeric')) {
			return false;
		}else if(compareAppearDate(DOB_datepicker,apeared, 'Appeared date must be greater than Birth Date')) {
			return false;
		}else if(compareDate(DOB_datepicker,Deceased_datepicker, 'Deceased date must be greater than Birth Date')) {
			return false;
		}else if(compareDeceasedDate(Deceased_datepicker,apeared, 'Deceased date must be greater than Appeared Date')) {
			return false;
		}else if(ValidImage(imagehdpi_800, 'Invaild image')) {
			return false;
		}else if(ValidImage(imagehdpi_854, 'Invaild image')) {
			return false;
		}else if(ValidImage(imageldpi, 'Invaild image')) {
			return false;
		}else if(ValidImage(imagemdpi, 'Invaild image')) {
			return false;
		}else if(ValidImage(imagetab, 'Invaild image')) {
			return false;
		}
		else {
			submit();
		}
	}
}


function compareToDayDate(formElement,message)
{ 
	
	var DateC ;
	DateC = formElement.value;
	//2011-06-07
	DateC=DateC.split('-');
   
	 
	 x=new Date();

	var  toyear=x.getFullYear();
	 var today= x.getDate();
	 var tomonth=parseInt(x.getMonth());
	
	
	var selectedmonth = parseInt(DateC[0]-1);
	//var selectedmonth = ltrim(selectedmonth); 
	var selectedday =  DateC[1];
	 selectedday = ltrim(selectedday);
	var stmillsec=Date.UTC(parseInt(DateC[2]),selectedmonth,selectedday);
	
	
	var currentmillsec=Date.UTC(toyear, tomonth,today);
	if(parseInt(stmillsec) >= parseInt(currentmillsec))
	{
	 
	    document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('DOB_datepicker').focus();
		
	    return true;
	}
}



	function compareDate(formElementStart,formElementEnd,message)
	{
		var DateC ;
		var DateD ;
		DateC = formElementStart.value;
		DateD = formElementEnd.value;
		//2011-06-07
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		var myDatestarte =new Date();
		 myDatestarte.setFullYear(DateC[2],DateC[0]-1,DateC[1]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[2],DateD[0]-1,DateD[1]);
		 
		if(myDatestarte > myDateEnd)
		{
		 document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('DOB_datepicker').focus();
		
	    return true;
			}
		 
	}

function compareAppearDate(formElementStart,formElementEnd,message)
	{
		var DateC;
		var DateD;
		
		DateC = formElementStart.value;
		DateD = formElementEnd;
		
		//2011-06-07
		x=new Date();
		var today= x.getDate();
				
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		
		var myDatestarte =new Date();
		
		 myDatestarte.setFullYear(DateC[2],DateC[0]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[1],DateD[0]);
		 
		if(myDatestarte > myDateEnd)
		{
		 
		
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('appear_year').focus();	
		
	    return true;
			}
		 
	}
	
function compareDeceasedDate(formElementStart,formElementEnd,message)
	{
		var DateC;
		var DateD;
		
		DateC = formElementStart.value;
		DateD = formElementEnd;
		
		//2011-06-07
		x=new Date();
		var today= x.getDate();
				
		DateC=DateC.split('-');
		DateD=DateD.split('-');
		
		var myDatestarte =new Date();
		
		 myDatestarte.setFullYear(DateC[2],DateC[0]);
		 
		 var myDateEnd =new Date();
		 myDateEnd.setFullYear(DateD[1],DateD[0]);
		 
		
		 
		if(myDatestarte < myDateEnd)
		{
		  document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
		document.getElementById('Deceased_datepicker').focus();
		
	    return true;
			}
		 
	}	
	
	


function ltrim(s)
{
	var l=0;
	while(l < s.length && s[l] == '0')
	{	l++; }
	return s.substring(l, s.length);
}



function  checkModelAppeard(appyear){
	if(parseInt(appyear.length)<4){
	  document.getElementById('content-table-inner').style.display = ''; 
	  //document.getElementById('err_mess').innerHTML = 'Please enter valid year.';
	 document.getElementById('appear_year').value = '';
	 $('#appear_year').focus();
	 //document.getElementById('appear_year').focus();
	 return false;
	}else{
	  document.getElementById('content-table-inner').style.display = 'none'; 
	 document.getElementById('err_mess').innerHTML = '';
	}
	message = 'Model has been already appeared in this month with '+appyear+'';
	month = $('#appear_month').val();
	if(appyear != ''){
	$.ajax({ type: "POST",
			   url: "mod/mod_manageModel/checkappearedModel.php",
			   dataType: 'json',
          	   cache: true,
			   data: "appearedyear="+appyear+"&appearedmonth="+month+"&randval="+Math.random(),
				   success: function(dataSet)
				   { 
				      if(dataSet.isAction == '1'){ 
					  document.getElementById('content-table-inner').style.display = ''; 
						document.getElementById('err_mess').innerHTML = message;
						document.getElementById("appear_year").focus();
						document.getElementById("appear_year").value ='';
						
						return false;
					   }
				  
					  if(dataSet.isAction == '2'){  return true; }
				   }	
			});		
			
	}else{
		return true;
		
		}
  
	}



function  isnumeric(formElement,message){
	var numerixReg  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
    if(!numerixReg.test(formElement.value)){ 
       document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	    formElement.focus();
	   return true;
    }else{return false;}
   
	}


function ValidImage(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();
if(checkimg ==''){
 return false;
}
 
if (!checkimg.match(/(\.PNG|\.png|\.JPG|\.jpg|\.gif|\.GIF|\.jpeg|\.JPEG)$/))
{
       
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = message;
	   return true;
}
else
{
return false;
}
}

	$(function() {
		$( "#dob" ).datepicker();
	});

