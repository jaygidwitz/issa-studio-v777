 //animate pane up
            jQuery('.reveal').hover(function() {
                jQuery(this).animate({
                    opacity: 1.0,
                    marginTop: '-447px'
                }, 200);
            }, function() {
                jQuery(this).animate({
                    opacity: 1.0,
                    marginRight: '0px'
                }, 200);
            });