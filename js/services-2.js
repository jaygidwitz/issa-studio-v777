
  jQuery(document).ready(function($){
    //function to correctly provide height for panes
    function fixrevealHeight () {
            var pictureframeWidth = $('.pictureframe').width();
            $('a.reveal').height(pictureframeWidth/2.42);

    }
    // Call it on DOM ready
    fixrevealHeight();

    //And call it when browser resizes
    $(window).resize(function() {
      fixrevealHeight();
    });

    // On the blog page, make the read more tags have title information
    // and below each post also have the correct meta data
    if (document.URL==="http://studioissa.com/blog/") {
      var postAmount = jQuery('.post').length;
      for (var i = 0; i < postAmount; i++) {
        var postObject = jQuery('.post').eq(i);
        var postinfoHTML = postObject.find('.post-info').html();
        postObject.find('.more-link').html('Read more...');
        postObject.find('.entry-content').append(postinfoHTML)
      };
    // Also place the blog title in the top, as pulled from the widget area
    var titleHTML = jQuery('#text-24').html();
    jQuery('#text-24').remove();
    jQuery('#inner').prepend(titleHTML);
    jQuery('#inner > .widget-wrap').eq(0).wrap('<div id="blogTitle">');

    }

    // Change section header colors when you click on their corresponding
    // text values on the services page
      var colorValues = ['#757f8c', '#5b544e', '#3a4341'];
      $('.goToSlide').click(function(){
          indexOf = $(this).parent().parent().index();
          $('.clipboard h3, .clipboard-first h3').css('color', colorValues[indexOf])
      })      

    // Turn opacity to zero on load
    $('#scroll-top span').css('opacity', 0)





    // For the about page this function rearranges html so that layout
    // is consistent for yearbook on ipad/iphone  
    if (document.URL === 'http://studioissa.com/about/' && $(window).width() <= 786) {
      var jayHTMLobject = $('.post-170 .entry-content section').eq(1).find('.one-third')
      var jayHTML = jayHTMLobject.html();
      jayHTMLobject.remove();
      jQuery('.post-170 .entry-content section').eq(1).find('h2').after('<div class="one-third"'+jayHTML+'</div>')
    }

  
 
  

  });
