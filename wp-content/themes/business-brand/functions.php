<?php
/**
 * Business Brand functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business Brand
 */
if ( ! function_exists( 'business_brand_setup' ) ) :
		function business_brand_setup() {		
		load_theme_textdomain( 'business-brand', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );		
		add_theme_support( 'title-tag' );		
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-top-menu' => esc_html__( 'Top Header', 'business-brand' ),
			'header-menu' => esc_html__( 'Header', 'business-brand' ),
			'footer-menu' => esc_html__( 'Footer', 'business-brand' ),
		) );

		add_theme_support( 'html5', array(			
			'comment-form','comment-list','caption',
		) );
        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'business_brand_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
            'priority' => 11,
            'header-text' => array('img-responsive', 'site-description'),
		) );

		$user = wp_get_current_user();
        update_user_option($user->ID, 'managenav-menuscolumnshidden',
            array( 0 => 'link-target',  1 => 'xfn', 2 => 'description', 3 => 'title-attribute', ),
            true);
	}
endif;
add_action( 'after_setup_theme', 'business_brand_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_brand_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_brand_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_brand_content_width', 0 );


add_filter( 'nav_menu_css_class', 'business_brand_nav_menu_css_class' );
add_filter( 'walker_nav_menu_start_el', 'business_brand_walker_nav_menu_start_el', 10, 4 );

function business_brand_nav_menu_css_class( $classes ){
        if( is_array( $classes ) ){
            $tmp_classes = preg_grep( '/^(fa)(-\S+)?$/i', $classes );
            if( !empty( $tmp_classes ) ){
                $classes = array_values( array_diff( $classes, $tmp_classes ) );
            }
        }
        return $classes;
}
function business_brand_walker_nav_menu_start_el( $item_output, $item, $depth, $args ){
        if( is_array( $item->classes ) ){
            $classes = preg_grep( '/^(fa)(-\S+)?$/i', $item->classes );
            if( !empty( $classes ) ){
                $item_output = business_brand_replace_item( $item_output, $classes );
            }
        }
        return $item_output;
}
function business_brand_replace_item( $item_output, $classes ){       
       $spacer = ' ';
        if( !in_array( 'fa', $classes ) ){
            array_unshift( $classes, 'fa' );
        }

        $before = true;
        if( in_array( 'fa-after', $classes ) ){
            $classes = array_values( array_diff( $classes, array( 'fa-after' ) ) );
            $before = false;
        }

        $icon = '<i class="' . implode( ' ', $classes ) . '"></i>';

        preg_match( '/(<a.+>)(.+)(<\/a>)/i', $item_output, $matches );
        if( 4 === count( $matches ) ){
            $item_output = $matches[1];
            if( $before ){
                $item_output .= $icon . '<span class="fontawesome-text">' . $spacer . $matches[2] . '</span>';
            } else {
                $item_output .= '<span class="fontawesome-text">' . $matches[2] . $spacer . '</span>' . $icon;
            }
            $item_output .= $matches[3];
        }
        return $item_output;
    }

add_filter('get_custom_logo','business_brand_change_logo_class');
function business_brand_change_logo_class($html)
{
	$html = str_replace('class="custom-logo"', 'class="img-responsive logo-fixed"', $html);
	$html = str_replace('width=', 'original-width=', $html);
	$html = str_replace('height=', 'original-height=', $html);
	$html = str_replace('class="custom-logo-link"', 'class="img-responsive logo-fixed"', $html);
	return $html;
}

function business_brand_custom_excerpt_length( $length ) {
    if ( is_admin() ) { return $length;  }
    return 15;
}
add_filter( 'excerpt_length', 'business_brand_custom_excerpt_length', 999 );


function business_brand_excerpt_more($more) {
    if ( is_admin() ) { return $more;  }
    return '...';
}
add_filter('excerpt_more', 'business_brand_excerpt_more', 21 );

function business_brand_excerpt_more_link( $excerpt ){
    if ( is_admin() ) { return $excerpt;  }
    $post = get_post();
    $excerpt .= '<a class="read-more-init sport" href="'. esc_url(get_permalink($post->ID)) . '">'.esc_html__("Read more",'business-brand').'</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'business_brand_excerpt_more_link', 21 );

add_action( 'admin_menu', 'business_brand_admin_menu');
function business_brand_admin_menu( ) {
    add_theme_page( __('Pro Feature','business-brand'), __('Business Brand Pro','business-brand'), 'manage_options', 'business-brand-pro-buynow', 'business_brand_pro_buy_now', 300 ); 
  
}
function business_brand_pro_buy_now(){ ?>  
  <div class="business_brand_pro_version">
  <a href="<?php echo esc_url('https://sigmathemes.com/wordpress-themes/business-brand-pro/'); ?>" target="_blank">
    <img src ="<?php echo esc_url(get_template_directory_uri().'/assets/images/business-brand-pro-feature.png') ?>" width="70%" height="auto" />
  </a>
</div>
<?php }

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/template-setup.php';
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/widgets/business-brand-slider-top-middle/business-brand-slider-top-middle.php';
require get_template_directory() . '/inc/widgets/business-brand-latest-post-slider1/template-style1.php';
require get_template_directory() . '/inc/widgets/business-brand-latest-post-slider2/template-style2.php';
require get_template_directory() . '/inc/widgets/business-brand-post-list-widgets/business-brand-post-list-widgets.php';
require get_template_directory() . '/inc/widgets/business-brand-category-widgets-style1/business-brand-category-widgets-style1.php';
require get_template_directory() . '/inc/widgets/business-brand-category-widgets-style2/business-brand-category-widgets-style2.php';