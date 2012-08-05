<form name="myform">
<textarea name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,100);" 
onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,100);">
</textarea><br>
<font size="1">(Maximum characters: 100)<br>
You have <input readonly type="text" name="countdown" size="3" value="100"> characters left.</font>
</form>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
