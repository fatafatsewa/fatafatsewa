jQuery(document).ready(function(){
/*==========================*/	
/* Animation on Scroll */	
/*==========================*/
	
function onScrollInit( items, trigger ) {
  items.each( function() {
    var osElement = jQuery(this),
        osAnimationClass = osElement.attr('data-os-animation'),
        osAnimationDelay = osElement.attr('data-os-animation-delay');
      
        osElement.css({
          '-webkit-animation-delay':  osAnimationDelay,
          '-moz-animation-delay':     osAnimationDelay,
          'animation-delay':          osAnimationDelay
        });

        var osTrigger = ( trigger ) ? trigger : osElement;
        
        osTrigger.waypoint(function() {
          osElement.addClass('animated').addClass(osAnimationClass);
          },{
              triggerOnce: true,
              offset: '95%'
        });
  });
}

 onScrollInit( jQuery('.os-animation') );
 onScrollInit( jQuery('.staggered-animation'), jQuery('.staggered-animation-container') );

/*==========================*/	
/* Countdown */	
/*==========================*/

 $(".clock").countdown('2020/08/11', function(event) {
    $(this).html(event.strftime('<span>%D <b>days</b></span> <span>%H<b>hours</b></span> <span>%M<b>minutes</b></span> <span>%S<b>seconds</b></span>'));
  });
	 	
 


});
 
 