<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );
require_once(CHILD_DIR.'/theme-js.php');



//Add Localization Support
load_child_theme_textdomain( 'mp', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'mp' ) );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Modern Portfolio Theme', 'mp' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/modern-portfolio/' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'mp_viewport_meta_tag' );
function mp_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add new image sizes
add_image_size( 'blog', 320, 120, TRUE );
add_image_size( 'portfolio', 320, 210, TRUE );

// Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 1152,
	'height' => 120
) );

// Modify the size of the Gravatar in author box
add_filter( 'genesis_author_box_gravatar_size', 'mp_author_box_gravatar_size' );
function mp_author_box_gravatar_size( $size ) {
	return 80;
}

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );



/**
 * Genesis Next/Previous Post Navigation (after post, before comments)
 * 
 */
add_action( 'genesis_after_post_content', 'ac_next_prev_post_nav' );
 
function ac_next_prev_post_nav() {
	
	if ( is_single() ) {
 
		echo '<div class="loop-nav">';
		previous_post_link( '<div class="previous">Previous: %link</div>', '%title' );
		next_post_link( '<div class="next">Next: %link</div>', '%title' );
		echo '</div><!-- .loop-nav -->';
 
	}
 
}


// Hooks after-post widget area to single posts
add_action( 'genesis_after_post_content', 'metro_after_post'  ); 
function metro_after_post() {
	if ( is_single() && is_active_sidebar( 'after-post' ) ) {
		echo '<div class="after-post"><div class="wrap">';
		dynamic_sidebar( 'after-post' );
		echo '</div></div>';
	}
}



// Hooks after-post widget area to single posts
add_action( 'genesis_after_footer', 'timemachine_after_footer'  ); 
function timemachine_after_footer() {
	if ( is_page( 'about' )  ) {
		echo '<div id="timemachine"></div>';
	}
}





/** Register widget areas */

genesis_register_sidebar( array(
	'id'				=> 'top',
	'name'			=> __( 'Top', 'mp' ),
	'description'	=> __( 'This is the top section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'about',
	'name'			=> __( 'About', 'mp' ),
	'description'	=> __( 'This is the about section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'portfolio',
	'name'			=> __( 'Portfolio', 'mp' ),
	'description'	=> __( 'This is the portfolio section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'services',
	'name'			=> __( 'Services', 'mp' ),
	'description'	=> __( 'This is the Services section.', 'mp' ),
) );

genesis_register_sidebar( array(
	'id'				=> 'clients',
	'name'			=> __( 'Clients', 'mp' ),
	'description'	=> __( 'This is the Ideal Clients section.', 'mp' ),
) );

genesis_register_sidebar( array(
	'id'				=> 'blog',
	'name'			=> __( 'Blog', 'mp' ),
	'description'	=> __( 'This is the Blog section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'contact',
	'name'			=> __( 'Contact', 'mp' ),
	'description'	=> __( 'This is the Contact section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'after-post',
	'name'			=> __( 'After Post', 'mp' ),
	'description'	=> __( 'This is the after post section.', 'mp' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'after-portfolio-widget',
	'name'			=> __( 'After Post', 'mp' ),
	'description'	=> __( 'This is the after post section.', 'mp' ),
) );


add_filter('widget_text', 'do_shortcode');

if ( ! isset( $content_width ) )
    $content_width = 1080;





/** Customize Read More Text */
add_filter( 'excerpt_more', 'child_read_more_link' );
add_filter( 'get_the_content_more_link', 'child_read_more_link' );
add_filter( 'the_content_more_link', 'child_read_more_link' );
function child_read_more_link() {
 
return '<br></br><a href="' . get_permalink() . '" rel="nofollow" class="more-link" > Keep Reading...</a>';
}


remove_action( 'genesis_after_post_content', 'genesis_post_meta' );


//* Add Jetpack share buttons above post
remove_filter( 'the_content', 'sharing_display', 19 );
remove_filter( 'the_excerpt', 'sharing_display', 19 );
 
add_filter( 'the_content', 'share_buttons_above_post', 19 );
add_filter( 'the_excerpt', 'share_buttons_above_post', 19 );
 
function share_buttons_above_post( $content = '' ) {
	if ( function_exists( 'sharing_display' ) && is_single() ) {
		return sharing_display() . $content;
	}
	else {
		return $content;
	}
}



add_filter( 'genesis_pre_get_option_site_layout', 'change_layout_blog_genesis');
function change_layout_blog_genesis( $opt ) {
if (is_single() || is_page_template( 'page_blog.php' ) ) {
    $opt = 'content-sidebar'; 
    return $opt;
 
	}
	
}






add_action( 'wp_enqueue_scripts', 'smoothscroll_scripts' );
/**
 * Enqueue Scripts
 */
function smoothscroll_scripts() {

	if ( is_page()  || is_single( ) ||  is_home() || is_front_page() ) {
		wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
		wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
		wp_enqueue_script( 'scroll', get_stylesheet_directory_uri() . '/js/scroll.js', array( 'localScroll' ), '', true );
	}
}

/*
//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'scripts_footer_services_page' );
function scripts_footer_services_page() {

	if ( is_single('482') ) {
		wp_enqueue_script( 'services-1', get_stylesheet_directory_uri() . '/js/services-1.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'services-2', get_stylesheet_directory_uri() . '/js/services-2.js', array( 'jquery' ), '', true );
	}
}
*/


/**add_action( 'genesis_after_footer', 'scripts_footer_services_page' );
/**
 * Enqueue Scripts
 */
/**
function scripts_footer_services_page() {

	if ( is_single('482') ) {
      	wp_enqueue_script( 'services-1', get_stylesheet_directory_uri() . '/js/services-1.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'services-2', get_stylesheet_directory_uri() . '/js/services-2.js', array( 'jquery' ), '', true );
	}
}
*/

/** Add mobile menu toggle */
add_action( 'genesis_header_right', 'mycustom_mobile_menu_toggle', 5 );
 
function mycustom_mobile_menu_toggle() {
echo '<div class="menu-toggle">';
echo '<span><a href="#">Menu</a></span>';
echo '<i class="icon-reorder"></i>';
echo '</div>';
}



/**
* Registers and loads font awesome
* CSS files using a CDN.
*Read more at http://youneedfat.com/font-awesome-wordpress-cdn/#MIIsB8FzXehhUups.99 
* @link http://www.bootstrapcdn.com/#tab_fontawesome
* @author FAT Media
*/
/**add_action( 'wp_enqueue_scripts', 'mytheme_add_the_awesome' );
function mytheme_add_the_awesome() {
// Register the awesomeness.
wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css', null, '3.2.0' );
do_action( 'mytheme_add_the_awesome' );
}
 
// Load the awesomeness
add_action( 'mytheme_add_the_awesome' , 'mytheme_load_the_awesome' );
function mytheme_load_the_awesome() {
wp_enqueue_style( 'font-awesome' );
}
*/

// fix the content with for embeds
if ( ! isset( $content_width ) )
$content_width = 708;

function custom_content_width() {
global $content_width;

$layout = genesis_site_layout();

if( in_array( $layout, array( 'content-sidebar-sidebar', 'sidebar-content-sidebar', 'sidebar-sidebar-content' ) ) )
    $content_width = 676;
elseif( 'full-width-content' == $layout )
    $content_width = 1080;

}
add_action( 'template_redirect', 'custom_content_width' );






// Add support for Genesis layouts to listings post type
add_post_type_support( 'portfolio', 'genesis-layouts' );

// Force layout on custom post type
add_filter('genesis_site_layout', 'ts_portfolio_layout');
function ts_portfolio_layout($opt) {
if ( 'portfolio' == get_post_type() )
$opt = 'full-width-content';
return $opt;
}







add_action('genesis_before_loop','sfws_tax_single');
/**
 * Remove post meta and post info on single post type.
 * 
 * @author Sure Fire Web Services
 * @link http://surefirewebservices.com/?p=1563
 *
 */
function sfws_tax_single() {
    if (is_singular('portfolio')) { //Replace post_type with your post type slug
        remove_action( 'genesis_before_post_content', 'genesis_post_info' );
        remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
        remove_action( 'genesis_after_post_content', 'metro_after_post'  ); 

    }   
}




// Hooks after-post widget area to single posts
add_action( 'genesis_after_post_content', 'after_portfolio_post'  );
/**
 * Add After Portfolio Widget to Custom Post Type Portfolio
 * 
 * @author Jay Gidwitz
 * @link http://studioissa.com/
 *
 */
function after_portfolio_post() {
	if ( is_single('portfolio') && is_active_sidebar( 'after-portfolio-widget' ) ) {
		echo '<div class="after-post"><div class="wrap">';
		dynamic_sidebar( 'after-post' );
		echo '</div></div>';
	}
}
