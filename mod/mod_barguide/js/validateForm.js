  function validation(){
with (window.document.signup) {
var pass = document.getElementById('password').value;
var confirm_pass = document.getElementById('confirm_password').value;
var chk_box = document.getElementById('agreement').checked;
var payment_type = document.getElementById("payment_type").value;

		if (isEmpty(username, 'Please enter username.')) {
			return false;
		}else if(onlytext(username, 'Only numbers are not valid for username.')) {
			return false;
		}else if(isEmpty(lastname,'Please enter last name.')){
			return false;
		}else if(isEmptySelect(country_name,'Please select the country name.')){
			return false;
		}else if(isEmpty(emailid,'Please enter the email ID.')){
			return false;
		}else if(email(emailid,'Kindly enter the valid email.')){
			return false;
		}else if(isEmpty(password,'Please enter the password.')){
			return false;
		}else if(isEmpty(confirm_password,'Please enter the confirm password.')){
			return false;
		}else if(pass != confirm_pass ){
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Confirm password does not matach.";
			return true;
		}
		else if($("#payment_type").val()=="")
		{
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Please select the payment options.";
			return false;
		}
		else if( (chk_box == false ) ){
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Kindly read the agreement ant select the box.";
			return true;
		}else {
			submit();
		//	alert("else");
		}
 }
}
