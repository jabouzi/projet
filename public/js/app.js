$(document).ready(function() {
	var timer;
	$('#delete').click(function()
	{
		$('.dissmiss').show();
		timer = window.setTimeout( submit_form,  5000);
	});
	
	$('#cancel').click(function()
	{
		clearTimeout(timer);
	});
});

function submit_form() {
	$('#deleteform').submit();
}


