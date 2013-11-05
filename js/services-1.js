
var myDeck = jQuery('#slidedeck').slidedeck();

jQuery('a.goToSlide').click(function(event){
event.preventDefault();
var slideNumber = parseInt(jQuery(this).attr('href').replace(/.+#/, ''));
jQuery('dl.slidedeck-491').slidedeck().goTo(slideNumber);
});

jQuery('.processSort .processType > a').click(function() {
    jQuery(this).siblings('span').click();
  });

  jQuery('.processSort a').click(function() {
    var index = jQuery('.processSort span').index(this);
    
    jQuery('.processSort a').removeClass('active');
      jQuery(this).addClass('active');
    if(index > 1){
      index -= 4;
    }
    
      var element = jQuery('.processInfo');
      element.find('.processDetail').removeClass('active').eq(index).addClass('active'); 
    return false;
  });
