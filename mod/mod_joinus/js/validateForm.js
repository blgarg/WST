  function validation(){
  $("html, body").animate({ scrollTop: 200 }, 600);
  $('#server_mess').hide();
  with (window.document.signup) {
	var pass = document.getElementById('password').value;
	var confirm_pass = document.getElementById('confirm_password').value;
	var chk_box = document.getElementById('agreement').checked;

		if (isEmpty(username, 'Please enter username.')) {
			return false;
		}else if(isMinLen(username,1,'Minimum 2 alphabet is required for unsername')){
			return false;
		}else if(onlytext(username, 'Only numbers are not valid for username.')) {
			return false;
		}else if(isEmpty(lastname,'Please enter last name.')){
			return false;
		}else if(isMinLen(lastname,1,'Minimum 2 alphabet required for lastname')){
			return false;
		}else if(notEmpLen(address,2,'Minimum 3 characters are required for address')){
			return false;
		}else if(isEmpty(phone_no,'Please enter the phone number')){
			return false;
		}else if(validateContact(phone_no,'Only digits are allow for phone number')){
			return false;
		}else if(isMinLen(phone_no,6,'Minimum 7 digits required for phone number')){
			return false;
		}else if(isEmptySelect(country_name,'Please select the country.')){
			return false;
		}else if(isEmpty(emailid,'Please enter the email ID.')){
			return false;
		}else if(email(emailid,'Kindly enter the valid email.')){
			return false;
		}else if(isEmpty(password,'Please enter the password.')){
			return false;
		}else if(isMinLen(password,5,'Minimum 6 characters required for password')){
			return false;
		}else if(isEmpty(confirm_password,'Please enter the confirm password.')){
			return false;
		}else if(pass != confirm_pass ){
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Confirm password does not match.";
			return false;
		}else if(isEmptySelect(payment_type,'Kindly select the payment option')){
			return false;
		}else if(isEmpty(card_number,'Please enter the card number.')){
			return false;
		}else if(validateContact(card_number,'Please enter only digits for card number.')){
			return false;
		}else if(isEmpty(name_on_card,'Kindly enter the name of card.')){
			return false;
		}else if(isEmptySelect(month,'Please select the month.')){
			return false;
		}else if(isEmptySelect(year,'Please select the year.')){
			return false;
		}else if(isEmpty(cvv,'Please enter the CVV')){
			return false;
		}else if( (chk_box == false ) ){
			document.getElementById('content-table-inner').style.display = ''; 
			document.getElementById('err_mess').innerHTML = "Kindly read the agreement ant select the box.";
			return false;
		}else {
			submit();
		//	alert("else");
		}
 }
}