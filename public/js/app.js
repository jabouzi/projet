$(document).ready(function() {
	var timer;
	$('#delete').click(function()
	{
		//console.log('SET TIMEOUT');
		timer = window.setTimeout( submit_form,  5000);
		//$('#delete_message').show();
		//$.wait( function(){ submit_form($(this).closest("form").id()) }, 5);
	});
	
	$('#cancel').click(function()
	{
		//console.log('CLEAR TIMEOUT');
		clearTimeout(timer);
		//$('#delete_message').show();
		//$.wait( function(){ submit_form($(this).closest("form").id()) }, 5);
	});
	
	//$('#deleteform').submit(function() {
		//var data = $("#login_form :input").serializeArray();
		//alert('Handler for .submit() called.');
		//return false;  // <- cancel event
	//});
});

$.wait = function( callback, seconds){
   return window.setTimeout( callback, seconds * 1000 );
}

function submit_form() {
	console.log('submit');
	//$('#'+id).submit();
}


