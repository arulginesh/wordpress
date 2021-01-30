<?php
/**
 * Child Theme functions and definitions.
 * This theme is a child theme for JetBlack.
 *
 * @package Versatile_Business_Dark
 * @author  FireflyThemes https://fireflythemes.com
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

/**
 * Theme functions and definitions.
 */
function jetblack_education_enqueue_styles() {
	// Parent Theme stylesheet.
	wp_enqueue_style( 'jetblack-style', get_template_directory_uri() . '/style.css', null, jetblack_education_get_file_mod_date( get_template_directory() . '/style.css' ) );

	wp_enqueue_style( 'jetblack-education-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'jetblack-style' ),
        jetblack_education_get_file_mod_date( get_stylesheet_directory() . '/style.css' )
    );
}
add_action(  'wp_enqueue_scripts', 'jetblack_education_enqueue_styles' );

/**
 * Get file modified date
 */
function jetblack_education_get_file_mod_date( $file ) {
	return date( 'Ymd-Gis', filemtime( $file ) );
}

/**
 * Loads the child theme textdomain.
 */
function jetblack_education_setup() {
    load_child_theme_textdomain( 'jetblack-education', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'jetblack_education_setup', 11 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jetblack_education_widgets_init() {
	register_sidebar( array(
			'name'        => esc_html__( 'Footer 4', 'jetblack' ),
			'id'          => 'sidebar-4',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'jetblack' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jetblack_widgets_init', 100 );

/**
 * Load Social Menu Widget
 */
require get_theme_file_path( '/inc/social-menu.php' );
