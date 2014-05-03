$(document).ready(function() {
	var timer;
	$('#delete').click(function()
	{
		$('.dissmiss').show();
		timer = window.setTimeout( submit_form,  3000);
		show_countdown();
	});

	$('#cancel').click(function()
	{
		$('.dissmiss').hide();
		clearTimeout(timer);
	});
});

function submit_form() {
	$('#deleteform').submit();
}


function show_countdown()
{
	var timer2 = setInterval(function() {
		$("#count_num").html(function(i,html) {
			if(parseInt(html)>0)
			{
				return parseInt(html)-1;
			}
			else
			{
				clearTimeout(timer2);
			}
		});
	},1000);
}

