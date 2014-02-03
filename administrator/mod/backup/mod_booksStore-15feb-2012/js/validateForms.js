// JavaScript Document

function pageAction(controller)
{
	
	 $("#content-table-inner-susecc").hide(); 
	var checkFound = false;
	var chkboxlen = document.getElementsByName('book_id[]').length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('book_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = "Please select at least one checkbox.";

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
function check_sellcart()
{

	var sun=document.billform.select.value;
		var sun2=document.billform.party.value;
	with (window.document.billform) { 
	    if (sun==0) {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select business type.";
			document.billform.select.focus();
			return false;
		} else if (sun2==0) {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select party.";
			document.billform.party.focus();
			return false;
		}
		else {
			submit();
		}
	}
		
	}
	function check_ordercart()
{

	var sun=document.billform.select.value;
	with (window.document.billform) { 
	    if (sun==0) {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select academy.";
			document.billform.select.focus();
			return false;
		}
		else {
			submit();
		}
	}
		
	}
	 function decode_base64(s) {
    var e={},i,k,v=[],r='',w=String.fromCharCode;
    var n=[[65,91],[97,123],[48,58],[47,48],[43,44]];

    for(z in n){for(i=n[z][0];i<n[z][1];i++){v.push(w(i));}}
    for(i=0;i<64;i++){e[v[i]]=i;}

    for(i=0;i<s.length;i+=72){
    var b=0,c,x,l=0,o=s.substring(i,i+72);
         for(x=0;x<o.length;x++){
                c=e[o.charAt(x)];b=(b<<6)+c;l+=6;
                while(l>=8){r+=w((b>>>(l-=8))%256);}
         }
    }
    return r;
    }
function check_business()
{
	var sun=document.getElementById("businessid").value;
	if(sun=="")
	{
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select academies type.";
			document.searchForm1.businessid.focus();
			return false;
	}
	else
	{
		document.searchForm.submit();
		document.searchForm1.submit();
		//document.forms["searchForm1"].submit();
		}

	}
function check_category()
{
	var sun=document.getElementById("bookcategory").value;
	if(sun==0)
	{
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select book category.";
			document.searchForm2.bookcategory.focus();
			return false;
	}
	else
	{
		document.searchForm.submit();
		document.searchForm2.submit();
		//document.forms["searchForm1"].submit();
		}

	}
function check_writer()
{
	var sun=document.getElementById("royalitywriter").value;
	if(sun==0)
	{
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select books writer.";
			document.searchForm3.royalitywriter.focus();
			return false;
	}
	else
	{
		document.searchForm.submit();
		document.searchForm3.submit();
		//document.forms["searchForm1"].submit();
		}

	}	
	
function checkbookcart()
{
	
with (window.document.form1) { 
	    if (isEmpty(person_name, 'Please enter person name')) {
			return false;
		}
		else if(isEmpty(detail, 'Please enter person detail')) {
			return false;
		}
		else {
			submit();
			document.form1.command.value='issue_gift_books';
		}
	}
	}
function check_emp_cart()
{
	var sun=document.form2.select2.value;
	with (window.document.form2) { 
	    if (sun==0) {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select any employee.";
			document.form2.select2.focus();
			return false;
		}
		else {
			submit();
		}
	}
	}
function checkeditbook()
{
	
	
	with (window.document.adddPageFrm) { 
	    if (isEmpty(book_name, 'Please enter book name')) {
			return false;
		}
		else if(isEmpty(book_author, 'Please enter book author')) {
			return false;
		}
		else if(isEmpty(sell_price, 'Please enter book price')) {
			return false;
		}
		else if(isEmpty(desc, 'Please enter description')) {
			return false;
		}
		else if(isEmpty(quantity, 'Please enter quantity')) {
			return false;
		}
		else {
			submit();
		}
	}

	
	}
function checkadd_book_cart()
{
	
	with (window.document.adddPageFrm) { 
	    if (isEmpty(quantity, 'Please enter quantity')) {
			return false;
		}
		else if(window.document.adddPageFrm.quantity.value==0)
		{
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please enter minimum 1 quantity";
			document.adddPageFrm.quantity.focus();
			return false;
			}
		else if(integer(quantity,'Please enter only integer values')){
			return false;
		}
		else {
			submit();
		}
	}

	}
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

function checkPurchasebook()
{
	var sun=document.adddPageFrm.business_type.value;
	var sun1=document.adddPageFrm.party.value;
	with (window.document.adddPageFrm) { 
	    if (sun=="") {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select academies type.";
			document.adddPageFrm.business_type.focus();
			return false;
		}
		else if (sun1=="") {
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select any academies.";
			document.adddPageFrm.party.focus();
			return false;
		}
		else if (isEmpty(book_name, 'Please enter book name')) {
			return false;
		}
		else if(isEmpty(book_author, 'Please enter book author')) {
			return false;
		}
		else if(isEmpty(book_price, 'Please enter book purchase price')) {
			return false;
		}
		else if(isEmpty(sell, 'Please enter book sell price')) {
			return false;
		}
		else if(isEmpty(desc, 'Please enter description')) {
			return false;
		}
		else if(isEmpty(quantity, 'Please enter quantity')) {
			return false;
		}
		else {
			submit();
		}
	}

	}
// CHECK ADD PAGES 
function checkAddbook()
{
	with (window.document.adddPageFrm) { 
	    if (isEmpty(book_name, 'Please enter book name')) {
			return false;
		}
		else if(isEmpty(book_author, 'Please enter book author')) {
			return false;
		}
		else if(isEmpty(book_price, 'Please enter book price')) {
			return false;
		}
		else if(isEmpty(desc, 'Please enter description')) {
			return false;
		}
		else if(isEmpty(quantity, 'Please enter quantity')) {
			return false;
		}
		else {
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

function del(pid){
		if(confirm('Do you really mean to delete this book')){
			document.mainform.pid.value=pid;
			document.mainform.controller.value='delete_books_cart';
			document.mainform.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your book cart, continue?')){
			document.mainform.command.value='clear';
			document.mainform.submit();
		}
	}
	function update_cart(){
		document.mainform.controller.value='update_books_quantity';
		document.mainform.submit();
	}
	function clear_issue_cart(){
		if(confirm('This will empty your book cart, continue?')){
			document.mainform.command.value='clear_issue_cart';
			document.mainform.submit();
		}
	}
	function update_issue_cart(){
		document.mainform.controller.value='update_issue_cart';
		document.mainform.submit();
	}
	function delissue(pid){
		if(confirm('Do you really mean to delete this book from issue cart')){
			document.mainform.pid.value=pid;
			document.mainform.controller.value='delete_issue_cart';
			document.mainform.submit();
		}
	}
	function delorder(pid)
	{
		if(confirm('Do you really mean to delete this book from order cart')){
			document.mainform.pid.value=pid;
			document.mainform.controller.value='delete_order_cart';
			document.mainform.submit();
		}
	}
	function clear_order_cart(){
		if(confirm('This will empty your book cart, continue?')){
			document.mainform.controller.value='clear_order_cart';
			document.mainform.submit();
		}
	}
	function update_order_cart(){
		document.mainform.controller.value='update_order_cart';
		document.mainform.submit();
	}
	
function ValidImage(imagename,message)
{
imagefile_value = imagename;
var checkimg = imagefile_value.value.toLowerCase();
if(checkimg ==''){
 return false;
}
 function isPrice(elem, helperMsg){
	var numericExpression = /^[-]?([1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|\.[0-9]{1,2})$/;
	if(elem.value.match(numericExpression)){
	    return true;
	}else{
		elem.focus();
		elem.value="";
		//document.getElementById('sunny').innerHTML = "";
		return false;
	}
}
function isNumeric(elem, helperMsg){
	var numericExpression = /^ *[0-9]+ *$/;
	if(elem.value.match(numericExpression)){
	    return true;
	}else{
		elem.focus();
		elem.value="";
		//document.getElementById('sunny').innerHTML = "";
		return false;
	}
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

