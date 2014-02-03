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

//Check edit page
function checkEditbar()
{ 
with (window.document.adddPageFrm) { 
		if (isEmpty(bar_name, 'Please enter bar name')) {
			return false;
		}else if(onlytext(bar_name, 'Please enter text only.')) {
			return false;
		}else if(validateHtml(bar_name,'Special characters are not allowed in bar name')){
			return false;
		}else if (isValidUrl(site_name, ' Enter valid web site')) {
			return false;
		}else if(isEmptySelect(bar_type, 'Please select bar type.')) {
			return false;
		}else if(isEmpty(bar_address, 'Please enter the bar address.')) {
			return false;
		}else if(validateHtml(bar_address,'Special characters are not allowed in bar address')){
			return false;
		}else if(isEmptySelect(country_name, 'Please select country name.')) {
			return false;
		}else if(isEmpty(bar_city, 'Please enter the city name.')) {
			return false;
		}else if(onlytext(bar_city, 'Please enter text only for city name.')) {
			return false;
		}else if(validateHtml(bar_city,'Special characters are not allowed in city name')){
			return false;
		}else if(validateHtml(facilities,'Special characters are not allowed in facilities')){
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
// CHECK ADD PAGES 
function checkAddbar()
{
	with (window.document.adddPageFrm) { 
	    if (isEmpty(bar_name, 'Please enter bar name')) {
			return false;
		}else if(onlytext(bar_name, 'Please enter text only.')) {
			return false;
		}else if(validateHtml(bar_name,'Special characters are not allowed in bar name')){
			return false;
		}else if (isValidUrl(site_name, ' Enter valid web site')) {
			return false;
		}else if(isEmptySelect(bar_type, 'Please select bar type.')) {
			return false;
		}else if(isEmpty(bar_address, 'Please enter the bar address.')) {
			return false;
		}else if(validateHtml(bar_address,'Special characters are not allowed in bar address')){
			return false;
		}else if(isEmptySelect(country_name, 'Please select country name.')) {
			return false;
		}else if(isEmpty(bar_city, 'Please enter the city name.')) {
			return false;
		}else if(onlytext(bar_city, 'Please enter text only for city name.')) {
			return false;
		}else if(validateHtml(bar_city,'Special characters are not allowed in bar city')){
			return false;
		}else if(validateHtml(facilities,'Special characters are not allowed in facilities')){
			return false;
		}else if(insertValidImage(image_load, 'Please select only jpg,gif,png and jpeg image.')) {
			return false;
		}else if(loadfilesize.value>1){
				document.getElementById("err_mess").innerHTML = "Image size should be less then 1 MB";
				document.getElementById("content-table-inner").style.display="block";
				return false;	
		}else{
			submit();
		}
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
		$( "#DOB_datepicker" ).datepicker();
		$( "#Deceased_datepicker" ).datepicker();
	});

