// JavaScript Document

/*function pageAction(controller)
{
	
	 $("#content-table-inner-susecc").hide(); 
	var checkFound = false;
	var chkboxlen = document.getElementsByName('mag_id[]').length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('mag_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = '<?php echo Magazine_Select ?>';

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
}*/

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


// CHECK ADD Receive payments 
/*function checkAddpmt()
{
	with (window.document.adddPageFrm) { 
	    if(isEmpty(recv_pmt, 'Please enter payment')) {
			return false;
		}
		else {
			submit();
		}
	}
}

*/

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

