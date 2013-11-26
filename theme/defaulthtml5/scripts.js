$(document).ready(function(){
	$('body').append('<a id="top" href="javascript:">Haut de page</a>');
	$('#top').click(function(){
	    $('html,body').animate({scrollTop:0}, 'fast');
	});
});