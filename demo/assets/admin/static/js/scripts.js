// end order bar
jQuery(function($){
	$('.order-bar').delay(2000).slideDown(300);
});
// end order bar

// cvv image
jQuery(function($){
	$('.cvv-link').click(function(){
		$('.cvv-image').slideToggle();
	});
});
// end cvv image

// anchor
jQuery(function($){
	$('a[href^="#"]').click(function(){
		var target = $(this).attr('href');
		$('html, body').animate({scrollTop: $(target).offset().top}, 1000);
		return false;
	});
});
// end anchor

// popup
jQuery(function($){
	var OpenPopupLink = $('a.open-popup-link');
	var ClosePopupLink = $('a.close-popup-link');
	var PopupWrapper = $('.popup-wrapper');
	OpenPopupLink.click(function() {
		var clickId = this.id;
		$('#popup-' + clickId).fadeIn(300);
		PopupWrapper.fadeIn(300);
		$('body').css('overflow','hidden').css('height','100%');
	});
	ClosePopupLink.click(function() {
		$(this).parents('.popup').fadeOut(300);
		PopupWrapper.fadeOut(300);
		$('body').css('overflow','auto').css('height','auto');
	});
	$(document).keydown(function(eventObject) {
		if ($('[id^="popup-"]').is(":visible")){
			if (eventObject.which == '27') {
				$('[id^="popup-"]').fadeOut(300);
				PopupWrapper.fadeOut(300);
				$('body').css('overflow','auto').css('height','auto');
			}
		}
	});
	$(document).mouseup(function (e) {
		var container = $('[id^="popup-"]');
		if (container.has(e.target).length === 0){
			container.fadeOut(300);
			PopupWrapper.fadeOut(300);
			$('body').css('overflow','auto').css('height','auto');
		}
	});
});
// end popup