<?php
/**
 * Business Brand Theme Customizer
 *
 * @package Business Brand
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'business_brand_field_sanitize_checkbox' ) ) :
  function business_brand_field_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
endif;

if ( ! function_exists( 'business_brand_field_sanitize_input_choice' ) ) :
function business_brand_field_sanitize_input_choice( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

function business_brand_customize_register( $wp_customize ) {

	$wp_customize->add_panel(
   'business_brand_general',
   array(
     'title' => esc_html__( 'General Settings', 'business-brand' ),
     'description' => esc_html__('General options','business-brand'),
     'priority' => 20, 
     )
   ); 

  $wp_customize->get_section('title_tagline')->panel = 'business_brand_general';

  $wp_customize->get_section('header_image')->panel = 'business_brand_general';
  $wp_customize->get_section('static_front_page')->panel = 'business_brand_general';
  $wp_customize->get_section('title_tagline')->title = __('Header Logo','business-brand');

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
      'selector'        => '.site-title a',
      'render_callback' => 'business_brand_customize_partial_blogname',
    ) );
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
      'selector'        => '.site-description',
      'render_callback' => 'business_brand_customize_partial_blogdescription',
    ) );
  }

//social icons
$wp_customize->add_section(
    'business_brand_social_links',
    array(
      'title' => __('Header Social icons', 'business-brand'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find <a target="_blank" href="https://fortawesome.github.io/Font-Awesome/icons/">here</a> and in second input box, you need to add your social media profile URL.<br /> Enter the URL of your social accounts. Leave it empty to hide the icon.' , 'business-brand'),
      'panel' => 'business_brand_general'
    )
  );

$business_brand_social_icon = array();
for($i=1;$i <= 5;$i++):  
    $business_brand_social_icon[] =  array( 'slug'=>sprintf('business_brand_social_icon%d',$i),   
      'default' => '',   
      'label' => esc_html__( 'Social icons ', 'business-brand' ). $i,   
      'priority' => sprintf('%d',$i) );  
  endfor;
foreach($business_brand_social_icon as $business_brand_social_icons){
    $wp_customize->add_setting(
        $business_brand_social_icons['slug'],
        array(
          'default' => '',
          'capability'     => 'edit_theme_options',
          'type' => 'theme_mod',
          'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        $business_brand_social_icons['slug'],
        array(
            'type'  => 'text',
            'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','business-brand') ),
            'section' => 'business_brand_social_links',
            'label'      =>   $business_brand_social_icons['label'],
            'priority' => $business_brand_social_icons['priority']
        )
    );
}
$business_brand_social_icon_links = array();
for($i=1;$i <= 5;$i++):  
    $business_brand_social_icon_links[] =  array( 'slug'=>sprintf('business_brand_social_icon_links%d',$i),   
      'default' => '',   
      'label' => esc_html__( 'Social Link ', 'business-brand' ) . $i,   
      'priority' => sprintf('%d',$i) );  
endfor;

foreach($business_brand_social_icon_links as $business_brand_social_icons){
    $wp_customize->add_setting(
        $business_brand_social_icons['slug'],
        array(
            'default' => '',
            'capability'     => 'edit_theme_options',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        $business_brand_social_icons['slug'],
        array(
            'type'  => 'text',
            'input_attrs' => array( 'placeholder' => esc_attr__('Enter Url','business-brand') ),
            'section' => 'business_brand_social_links',
            'priority' => $business_brand_social_icons['priority']
        )
    );
}

/* Site  logo*/

	$wp_customize->add_setting(
  'business_brand_dark_logo',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'business_brand_dark_logo', array(
  'section'     => 'title_tagline',
  'label'       => __( 'Upload Dark Logo (300 x 70)' ,'business-brand'),
  'flex_width'  => true,
  'flex_height' => true,
  'width'       => 120,
  'height'      => 50,
  'priority'    => 49,
  'default-image' => '',
  ) ) );
$wp_customize->add_setting(
  'logo_height',
  array(
    'default' => '55',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'logo_height',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'business-brand'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 20 (default: 10px)",'business-brand'),
    'type'       => 'text',
    'priority'    => 49,
    )
  );
  $wp_customize->add_setting(
  'display_fixed_header',
  array(
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'business_brand_field_sanitize_checkbox',
    'priority' => 49, 
    )
  );
$wp_customize->add_control(
  'display_fixed_header',
  array(
    'section' => 'title_tagline',                
    'label'   => __('Fixed Header','business-brand'),
    'type'    => 'checkbox',
    )
  );
//
$wp_customize->add_setting(
    'theme_color',
    array(
        'default' => '#F54307',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'theme_color',
    array(
        'label'      => __('Theme Color ', 'business-brand'),
        'section' => 'colors',
        'priority' => 10
    )
  )
);
$wp_customize->add_setting(
  'secondary_color',
  array(
      'default' => '#022658',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'secondary_color',
    array(
        'label'      => __('Secondary Color', 'business-brand'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Add Blog Settings
$wp_customize->add_section( 'blog_settings' , array(
  'title'       => __( 'Blog (Archive) Settings', 'business-brand' ),
  'description' => __( 'These settings work for default blog.','business-brand' ),
  'priority'    => 32,
  'capability'     => 'edit_theme_options',
  'panel' => 'business_brand_general'
  ) );
$wp_customize->add_setting(
  'blog_sidebar_style',
  array(
    'default' => 'right_sidebar',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'business_brand_field_sanitize_input_choice',
    )
  );
$wp_customize->add_control(
  'blog_sidebar_style',
  array(
    'section' => 'blog_settings',
    'label'      => __('Blog Sidebar Style', 'business-brand'),
    'type'       => 'select',
    'choices' => array(
      'no_sidebar'  => __('No Sidebar','business-brand'),
      'right_sidebar'  => __('Right Sidebar','business-brand'),
      'left_sidebar'  => __('Left Sidebar','business-brand'),
      ),
    )
  );
//blog meta tag
 $wp_customize->add_setting(
  'blog_meta_tag',
  array(
  'default' => '0',
  'capability'     => 'edit_theme_options',
  'sanitize_callback' => 'business_brand_field_sanitize_input_choice',
    )
  );
$wp_customize->add_control(
  'blog_meta_tag',
  array(
  'section' => 'blog_settings',
    'label'      => __('Blog Meta Tag', 'business-brand'),
    'type'       => 'select',
    'choices' => array(
      '0'  => __('Show','business-brand'),
      '1'  => __('Hide','business-brand'),
      )
    )
  );

//Add single Blog Settings
$wp_customize->add_section( 'single_blog_settings' , array(
  'title'       => __( 'Single Blog Settings', 'business-brand' ),
  'priority'    => 32,
  'capability'     => 'edit_theme_options',
  'panel' => 'business_brand_general'
) );
$wp_customize->add_setting(
  'single_sidebar_style',
  array(
    'default' => 'right_sidebar',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'business_brand_field_sanitize_input_choice',
    )
  );
$wp_customize->add_control(
  'single_sidebar_style',
  array(
    'section' => 'single_blog_settings',
    'label'      => __('Singal Blog Sidebar Style', 'business-brand'),
    'type'       => 'select',
    'choices' => array(
      'no_sidebar'  => __('No Sidebar','business-brand'),
      'right_sidebar'  => __('Right Sidebar','business-brand'),
      'left_sidebar'  => __('Left Sidebar','business-brand'),
      ),
    )
  );
//singal blog meta tag
$wp_customize->add_setting(
  'singal_blog_meta_tag',
  array(
  'default' => '0',
  'capability'     => 'edit_theme_options',
  'sanitize_callback' => 'business_brand_field_sanitize_input_choice',
    )
  );
$wp_customize->add_control(
'singal_blog_meta_tag',
array(
'section' => 'single_blog_settings',
  'label'      => __('Singal Blog Meta Tag', 'business-brand'),
  'type'       => 'select',
  'choices' => array(
    '0'  => __('Show','business-brand'),
    '1'  => __('Hide','business-brand'),
    )
  )
);
//category hide and show 
$wp_customize->add_setting(
'category_link',
array(
'default' => '0',
'capability'     => 'edit_theme_options',
'sanitize_callback' => 'business_brand_field_sanitize_input_choice',
  )
);
$wp_customize->add_control(
  'category_link',
  array(
  'section' => 'single_blog_settings',
  'label'      => __('Single Blog Category List ', 'business-brand'),
  'type'       => 'select',
    'choices' => array(
      '0'  => __('Show','business-brand'),
      '1'  => __('Hide','business-brand'),
      )
    )
  );
//Footer Section
$wp_customize->add_panel(
    'footer',
    array(
        'title' => __( 'Footer', 'business-brand' ),
        'description' => __('Footer options','business-brand'),
        'priority' => 150, 
    )
);
$wp_customize->add_section( 'footer_copyright_area' , array(
    'title'       => __( 'Footer Copyright Area', 'business-brand' ),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );
$wp_customize->add_setting(
    'Copyright_area_text',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'Copyright_area_text',
    array(
        'section' => 'footer_copyright_area',                
        'label'   => __('Enter Copyright Text','business-brand'),
        'type'    => 'textarea',
    )
);
}
add_action( 'customize_register', 'business_brand_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function business_brand_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function business_brand_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function business_brand_customs_css()
{
  wp_enqueue_style('business-brand-style', get_stylesheet_uri(), array()); 
  
  $custom_css = 'header li a i {
    color:#000;
  }
  h2.entry-title {
      margin: 0 0 10px;
  }
  h2.entry-title a {
    color: #000;
  }
  a:hover, a:focus {
    color: #000;
    text-decoration: underline;
  }

  .img_btn a{
    background:'.esc_attr(get_theme_mod('theme_color','#F54307')).';
  }
  .read-more-init{
    background:'.esc_attr(get_theme_mod('secondary_color','#022658')).';
  }
  aside section h3,.tagcloud a.tag-cloud-link, aside section ul li a:hover, aside section ul li a:focus{
    color:'.esc_attr(get_theme_mod('secondary_color','#022658')).';
  }
  .tagcloud a.tag-cloud-link{
    border-color:'.esc_attr(get_theme_mod('secondary_color','#022658')).';
  }
  .nav-links span.page-numbers, #return-to-top{
        background:'.esc_attr(get_theme_mod('theme_color','#F54307')).';
  }
  .nav-links a.page-numbers{
    background:'.esc_attr(get_theme_mod('secondary_color','#022658')).';
  }
  .featured_title h2 span, .everydisc a:hover{
    color:'.esc_attr(get_theme_mod('theme_color','#F54307')).';
  }

  ';

  $logo_height = (get_theme_mod('logo_height'))?(get_theme_mod('logo_height')):55;
  $custom_css .=".navbar-header .logo-fixed img, .navbar-header .custom-logo-link .logo-dark {
         max-height: ".esc_attr($logo_height)."px;
      }";

  wp_add_inline_style( 'business-brand-style', $custom_css ); 

  $custom_js='';

  $display_fixed_header = get_theme_mod('display_fixed_header',true);
  if($display_fixed_header)
  {
    $custom_js = "jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 150) {
            jQuery('.navbar-wrapper').addClass('fixed-header');
        } else {
            jQuery('.navbar-wrapper').removeClass('fixed-header');           
            
        }
    });";  
  }

  wp_add_inline_script( 'business-brand-menu', $custom_js ); 
}