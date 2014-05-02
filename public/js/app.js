$(document).ready(function() {
	$('#delete').click(function()
	{
		$('#delete_message').show();
		$.wait( function(){ submit_form($(this).closest("form").id()) }, 5);
	});
});

$.wait = function( callback, seconds){
   return window.setTimeout( callback, seconds * 1000 );
}

function submit_form(id) {
	console.log(id);
	//$('#'+id).submit();
}


