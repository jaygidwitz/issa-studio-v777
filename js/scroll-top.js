

    
/*-----------------------------------------------------------------------------------

 	AJAX Page Loading
 
-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
		
    // If the link is on site, load it via AJAX
    $('#portfolio-container .portfolio-link').live('click', function(e) {
        e.preventDefault();
		var dataSlide = $(this).attr('data-slide');
		var targetDiv;
		var header = $('header[role="banner"]');
		var offsetHeight = -50;
		if (header.css('position') == 'absolute' || header.css('display') == 'none') { offsetHeight = 0; };
		if($(this).hasClass('portfolio-link')) {
                        var portfolio = true;
			targetDiv = $('#portfolio-loader'); 
                        targetDiv.slideToggle(300);
			jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
			jQuery(window).scrollTo(targetDiv, {duration:1600, easing:'swing', offset:(offsetHeight - 50), axis:'y'}, {queue:false});
		}
		
        var path = $(this).attr('href');
        var title = $(this).text();
		targetDiv.find('.content').load(path + ' #content', {limit: 25}, function(responseText, textStatus, req) {
			
			if (textStatus == "error") {
			  return "It seems we've encountered an error...";
			}
		
			/*-----------------------------------------------------------------------------------

				Toggles & Accordions (AJAX)
			 
			-----------------------------------------------------------------------------------*/
			
			$(function(){ // run after page loads
					$(".toggle_container").hide(); 
					//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			});
		
			jQuery(".accordion").accordion()
			
			
			/*-----------------------------------------------------------------------------------

				Tabs (AJAX)
			 
			-----------------------------------------------------------------------------------*/
		
                        $('ul.tabs').each(function(i) {
                                //Get all tabs
                                var tab = $(this).find('> li > a');
                                $("ul.tabs li:first").addClass("active").fadeIn('fast'); //Activate first tab
                                $("ul.tabs li:first a").addClass("active").fadeIn('fast'); //Activate first tab
                                $("ul.tabs-content li:first").addClass("active").fadeIn('fast'); //Activate first tab

                                tab.click(function(e) {

                                        //Get Location of tab's content
                                        var contentLocation = $(this).attr('href') + "Tab";

                                        //Let go if not a hashed one
                                        if(contentLocation.charAt(0)=="#") {

                                                e.preventDefault();

                                                //Make Tab Active
                                                tab.parent().removeClass('active');
                                                $(this).parent().addClass('active');

                                                //Show Tab Content & add active class
                                                $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

                                        } 
                                });
                        }); 
			
			

                    /*-----------------------------------------------------------------------------------

                            Sliders (AJAX)

                    -----------------------------------------------------------------------------------*/


                    
                                           
                                              jQuery('.slider-1188').flexslider({
                                                    animation: "fade",
                                                    easing: "swing",
                                                    direction: "horizontal",
                                                    slideshowSpeed: "7000",
                                                    animationSpeed: "600",
                                                    controlNav: false,               
                                                    directionNav: true,  
                                                    pauseOnAction: false,
                                                    pauseOnHover: false,
                                                    useCSS: false
                                              });
                                           

                            
                                           
                                              jQuery('.slider-745').flexslider({
                                                    animation: "slide",
                                                    easing: "swing",
                                                    direction: "horizontal",
                                                    slideshowSpeed: "7000",
                                                    animationSpeed: "600",
                                                    controlNav: true,               
                                                    directionNav: false,  
                                                    pauseOnAction: true,
                                                    pauseOnHover: false,
                                                    useCSS: false
                                              });
                                           

                            
                                           
                                              jQuery('.slider-440').flexslider({
                                                    animation: "fade",
                                                    easing: "swing",
                                                    direction: "horizontal",
                                                    slideshowSpeed: "7000",
                                                    animationSpeed: "600",
                                                    controlNav: false,               
                                                    directionNav: false,  
                                                    pauseOnAction: true,
                                                    pauseOnHover: false,
                                                    useCSS: false
                                              });
                                           

                                                        

			/*-----------------------------------------------------------------------------------

				hide scroll to top
			 
			-----------------------------------------------------------------------------------*/
	
	jQuery(document).ready(function($){
	
		// hide #back-top first
		$("#scroll-top").hide();

		
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#scroll-top').fadeIn();
				} else {
					$('#scroll-top').fadeOut();
				}
			});
	
			// scroll body to 0px on click
			$('#scroll-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 1800);
				return false;
			});
		});
		


