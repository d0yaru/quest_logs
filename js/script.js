jQuery(document).ready(function($){
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
        $('.palka').hide();
    }
    setTimeout(function() {check();},1500);
  $preloader = $('.loaderArea'),
    $loader = $preloader.find('.loader');
  $loader.fadeOut();
  $preloader.delay(350).fadeOut('slow');
  
});

$(window).scroll(function (event) {
		var y = $(this).scrollTop();
		if ($(this).scrollTop() > 57 ) {
		        $('body').addClass('fixed-body');
			    $('.navbar').addClass('stuck');
		} else {
			
			$('.navbar').removeClass('stuck');
			$('body').removeClass('fixed-body');
		}
});
