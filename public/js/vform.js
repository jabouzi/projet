function validate_from(form_id)
{
	var required = 0;
	$('input').removeClass('error_input');
	$('select').removeClass('error_input');
	$("#" + form_id).find('[data-validate]').each(function() {
		required += validate_element($(this));
	});

	process_validated_form(required, form_id);
}

function process_validated_form(required, form_id)
{
	if (required)
	{
		$('.error_form_msg').show();
		blinkit('error_form_msg');
	}
	else
	{   $('.error_form_msg').hide();
		$("#" + form_id).submit();
	}
}

function validate_element(element)
{
	var required = 0;
	if (element.attr('data-type') == 'email')
	{
		if (!isValidEmailAddress(element)) {  element.addClass('error_input'); required++; }
	}
	else if (element.attr('data-validate') == 'required')
	{
		if (element.val() == '' || element.val() == null) { element.addClass('error_input'); required++; }
	}

	return required;
}

function isValidEmailAddress(element)
{
	var isValid = false;
	var emailAddress = element.val();
	if (element.attr('data-validate') == 'validate' && emailAddress == '') isValid = true;
	else { var regex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		isValid = regex.test(emailAddress.toLowerCase()) ? true : false; }
	return isValid;
}

function blinkit(classname)
{
	var speed = 200;
	effectFadeIn(classname, speed);
	effectFadeOut(classname, speed);
}

function effectFadeIn(classname, speed) {
	$("." + classname).fadeOut(speed);
}

function effectFadeOut(classname, speed) {
	$("." + classname).fadeIn(speed);
}
