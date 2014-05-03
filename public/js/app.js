$(document).ready(function() {
	var timer;
	$('#delete').click(function()
	{
		$('.dissmiss').show();
		$("#count_num").html(3);
		timer = window.setTimeout( submit_form,  3000);
		show_countdown();
	});

	$('#cancel').click(function()
	{
		$('.dissmiss').hide();
		clearTimeout(timer);
	});
	
	$("form").submit(function(e){
        e.preventDefault();
        validate_from($(this).attr('id'));
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
