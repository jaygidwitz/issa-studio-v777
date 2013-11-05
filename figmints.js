
  ///////////////////////////////
  // Work-Inner Info Accordion
  /////////////////////////////// 

  var tab = jQuery('.tab');

  tab.on("click", function(e){
    e.preventDefault();
    var $this = $(this);
    $this.toggleClass('active');
    $this.next('.panel').toggleClass('active');
  });
 
  ///////////////////////////////
  // Process Page Sort
  /////////////////////////////// 

  // $("#sort li a").hover(function(){
  //   if ( $(window).width() < 701) {
  //     $('#sort li ul').animate({height: "auto"}, {duration:600, queue:false})
  //   }
  // });

  jQuery('.processSort .processType > span').click(function() {
    jQuery(this).siblings('h3').click();
  });

  jQuery('.processSort h3').click(function() {
    var index = jQuery('.processSort h3').index(this);
    
    jQuery('.processSort h3').removeClass('active');
      jQuery(this).addClass('active');
    if(index > 1){
      index -= 4;
    }
    
      var element = jQuery('.processInfo');
      element.find('.processDetail').removeClass('active').eq(index).addClass('active'); 
    return false;
  });

 