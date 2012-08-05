function makepopup (id, width, message)
{
	var htmltext = '<STYLE	TYPE="text/css">#'+id+' {width:'+width+';}</STYLE>';
	htmltext +='<DIV CLASS="popup" id="'+id+'">'+message+'</DIV>';
	document.write(htmltext);
}

function show(id)
{
	document.all[id].style.pixelLeft = document.body.scrollLeft+ 100;
	document.all[id].style.pixelTop = document.body.scrollTop + 5;
	document.all[id].style.visibility="visible";
}

function hide(id)
{
document.all[id].style.visibility="hidden";
}

<script>
var valid=false;

function setUp()
{
	makepopup ("Item1" ,200, "You cannot enter sumit");
	makepopup ("Not_empty",200, "You can not leave this empty")
	makepopup ("Item3",200, "correct");
}

function validate_email(value,message_id)
{
	if(value=="sumit")
	{
		hide('Not_empty');
		show(message_id);
		valid=false;
		return;
	}
	else if(value=="")
	{
		hide(message_id);
		show('Not_empty');
		valid=false;
		return;
	}
		hide(message_id);
		hide('Not_empty');
		valid=true;
		show(Item3);
}
function isValid()
{
	return valid;
}
</script>

<script language="Javascript" src="popup.js"></script>