<?php
/*****************
 * DEPENDENCIES  *
 *****************/
require_once( 'prometheus/prometheus.php' );

/****************
 * OBFUSCATION  *
 ****************/
remove_action('admin_notices', 'woothemes_updater_notice');
remove_action('wp_head', 'wp_generator');

/*****************************
 * GOOGLE TAG MANAGER STUFF  *
 *****************************/
if ( ! is_admin() ) {
  function wordpress_ready_gtm(){
  
    global $post;
  
    $pageType = (is_404() ? "404" : (is_home() ? "Home" : (is_tag() ? "Tag" : (is_category() ? "Category" : ((is_single()||is_page()) ? ucfirst(get_post_type()) : "Other" )))));
    $visitorLoginState = (is_user_logged_in() ? "logged-in" : "logged-out");
    $author =  get_the_author_meta('display_name',(get_post($post)->post_author));
  
    $js = "<script type='text/javascript'>\n
    window.dataLayer = window.dataLayer || [];\n
    dataLayer.push({\n
    \t'visitorLoginState': '" . $visitorLoginState . "',\n
    \t'pageType': '" . $pageType . "',\n
    \t'author': '" . $author . "',\n
    \t'event': 'WordpressReady'\n});
    </script>\n";
    echo $js;
  }
  add_action( 'wp_print_scripts', 'wordpress_ready_gtm' );
}

/*********************************************
 * STUFF FROM PROMETHEUS FOUNDATION ELEMENTS *
 *********************************************/
 
add_action( 'wp_enqueue_scripts', 'prometheus_retina' );

/***************************
 * ENQUEUE CUSTOM SCRIPTS  *
 ***************************/
function eden_styles() {
 
     if ( ! is_admin() ) {
          wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
          wp_enqueue_style( 'eden', get_stylesheet_directory_uri() . '/eden.less' );
          wp_enqueue_style( 'fontsawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
     }
 
}
add_action('wp_enqueue_scripts', 'eden_styles');

function eden_controls() {
 
     if ( ! is_admin() ) {
          wp_enqueue_script( 'wpml-dropdown', get_stylesheet_directory_uri() . '/js/wpml-switcher.js', array('jquery'), '1.0.0', true );
     }
 
}
add_action( 'wp_enqueue_scripts', 'eden_controls' );