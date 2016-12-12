
$(document).ready(function(){

	$('header h1').hover(
		function(){ $('header h1').animate({ top: 5 }, 'fast'); },
		function(){ $('header h1').animate({ top: 0 }, 'fast'); }
	);

	/* ---- Countdown timer ---- */
	$('#counter').countdown({
		timestamp : (new Date()).getTime() + 20*24*60*60*1000
	});


	$('.email').focus(function() {
		if($(this).val() == 'enter your email...') {
			$(this).val('');
		}
	});

	$('.email').blur(function() {
		if($(this).val() == '') {
			$(this).val('enter your email...');
		}
	});



	$('#follow_us a').hover(
		function(){ $(this).animate({ top: 5 }, 'fast'); },
		function(){ $(this).animate({ top: 0 }, 'fast'); }
	);

	$('.footer-orange').hover(
		function(){ $('.footer-orange').animate({ top: 5 }, 'fast'); },
		function(){ $('.footer-orange').animate({ top: 0 }, 'fast'); }
	);


});

