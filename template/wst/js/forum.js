function checkAddCategory()
{
	var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
	var category_title = document.getElementById("category_title").value;
	if(category_title=="")
	{
		document.getElementById("category_msg").innerHTML =  'Please enter category title.';
	}
	else
	{
		document.getElementById("adddPageFrm").submit();
	}
	
	/*else if(!category_title.match(/^\w+( \w+)*$/))
	{
		document.getElementById("category_msg").innerHTML = 'Please enter only text.';
	}*/
	
}
var win='';
function who(url,topic)
{
	return window.open(url,''+topic+'','left=20,top=20,width=600,height=300,toolbar=0,resizable=0');
}

function attachments(url,topic)
{
	win = window.open(url,''+topic+'','left=20,top=20,width=700,height=550,toolbar=0');
	window.top.close();
}

