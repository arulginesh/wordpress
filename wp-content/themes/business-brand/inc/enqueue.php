<?php 
/**
 * Enqueue scripts and styles.
 */
function business_brand_scripts() {    

	wp_enqueue_style( 'business-brand-fonts-lora', '//fonts.googleapis.com/css?family=Lora:400,400i,700,700i');
	wp_enqueue_style( 'business-brand-fonts-source-sans-pro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i');

    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css',array(),null, false);
	wp_enqueue_style( 'font-awesome',  get_template_directory_uri().'/assets/css/fontawesome.css',array(),null, false);
	
	wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/css/animate.css', array(),null, false);	
	wp_enqueue_style( 'business-brand-menu', get_template_directory_uri().'/assets/css/menu.css',array(),null, false);
	wp_enqueue_style( 'business-brand-default', get_template_directory_uri().'/assets/css/default.css',array(),null, false);

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), null, true);
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), null, true);
	wp_enqueue_script( 'business-brand-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), null, true);	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	business_brand_customs_css();
}
add_action( 'wp_enqueue_scripts', 'business_brand_scripts' );