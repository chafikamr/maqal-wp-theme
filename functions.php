<?php

/*
** Function to add custom styles 
** Chafik Amraoui
*/

require('wp-navwalker.php');
function maqal_add_styles (){

    wp_enqueue_style('bootstrap-css' , get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fontAwsome-css' , get_template_directory_uri() . '/css/all.min.css');
    wp_enqueue_style('main-css' , get_template_directory_uri() . '/css/main.css');
    
}

/*
** Function to add custom scripts 
** Chafik Amraoui
*/

function maqal_add_scripts (){

    // remove registration of j query 
    wp_deregister_script('jquery');
    
    // re-register script again 
    wp_register_script('jquery' , includes_url('/js/jquery/jquery.min.js') , false , '' , true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js' , get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
    // wp_enqueue_script('jquey-3.6.0' , get_template_directory_uri() . '/js/jquery.3.6.0.js' , array() , false, true);
    wp_enqueue_script('main-js' , get_template_directory_uri() . '/js/main.js', array(), false, true);

}

/*
** add_action(tag , )
** Chafik Amraoui
*/
add_action('wp_enqueue_scripts' , 'maqal_add_styles' );
add_action('wp_enqueue_scripts' , 'maqal_add_scripts' );

/*
** Add Custom Menu Support
** Added by chafik amraoui
*/


 function register_menu(){
     register_nav_menus( array (
         'main-menu'=> 'Main Navigation Bar',
         'footer-menu' => 'footer Menu'
        ));
 }

 add_action('init', 'register_menu');


/*
** Dipslay Nav Menu
*/

function bootstrap_menu(){
    wp_nav_menu(array(
        'theme_location' => 'menu1',
        'menu_class' => 'navbar-nav nav ',
        'container' => false,
        'depth'=> 2,
        'walker' => new wp_bootstrap_navwalker()

    ));
}
function bootstrap_menu_two(){
    wp_nav_menu(array(
        'theme_location' => 'footer-menu'
    ));
}
add_filter( 'nav_menu_link_attributes', 'bootstrap5_dropdown_fix' );
function bootstrap5_dropdown_fix( $atts ) {
     if ( array_key_exists( 'data-toggle', $atts ) ) {
         unset( $atts['data-toggle'] );
         $atts['data-bs-toggle'] = 'dropdown';
     }
     return $atts;
}