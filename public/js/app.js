$(document).ready(function() {
	$('#delete').click(function()
	{
		$('#delete_message').show();
		$.wait( function(){ submit_form($(this).closest("form").id()) }, 5);
	});
	
	$('#deleteform').submit(function() {
		var data = $("#login_form :input").serializeArray();
		alert('Handler for .submit() called.');
		return false;  // <- cancel event
	});
});

$.wait = function( callback, seconds){
   return window.setTimeout( callback, seconds * 1000 );
}

function submit_form(id) {
	console.log(id);
	//$('#'+id).submit();
}


