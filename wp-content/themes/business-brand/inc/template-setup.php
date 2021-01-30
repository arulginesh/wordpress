<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business Brand
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_brand_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'business-brand'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'business-brand'),
        'before_widget' => '<section id="%1$s" class="widget secondary-widget-area %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Home Page Slider Section', 'business-brand'),
        'id' => 'home-top-slider-post',
        'description' => esc_html__('Add VN : Slider Widgets here.', 'business-brand'),
        'before_widget' => '<section id="%1$s" class="widget top-slider-post %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="top-slider-post-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Top Middle Section', 'business-brand'),
        'id' => 'home-top-middle-slider-post',
        'description' => esc_html__('Add VN : Top Middle Slider Widgets here.', 'business-brand'),
        'before_widget' => '<section id="%1$s" class="widget top-slider-post %2$s">',
        'after_widget' => '</section>',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Third Section', 'business-brand'),
        'id' => 'home-post-list',
        'description' => esc_html__('Add VN : Post Listing Widgets here.', 'business-brand'),
        'before_widget' => '<section id="%1$s" class="widget top-slider-post %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Section 1', 'business-brand'),
        'id' => 'footer-section-1',
        'description' => esc_html__('Set Footer Section 1 Business Brand.', 'business-brand'),
        'before_widget' => '<div id="%1$s" class="widget col-xs-12 col-sm-6 col-md-3 col-lg-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer_title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Section 2', 'business-brand'),
        'id' => 'footer-section-2',
        'description' => esc_html__('Set Footer Section 2 Business Brand.', 'business-brand'),
        'before_widget' => '<div id="%1$s" class="widget col-xs-12 col-sm-6 col-md-3 col-lg-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer_title"><h3>',
        'after_title' => '</h3></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Section 3', 'business-brand'),
        'id' => 'footer-section-3',
        'description' => esc_html__('Set Footer Section 3 Business Brand.', 'business-brand'),
        'before_widget' => '<div id="%1$s" class="widget col-xs-12 col-sm-6 col-md-3 col-lg-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer_title"><h3>',
        'after_title' => '</h3></div>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Section 4', 'business-brand'),
        'id' => 'footer-section-4',
        'description' => esc_html__('Set Footer Section 4 Business Brand.', 'business-brand'),
        'before_widget' => '<div id="%1$s" class="widget col-xs-12 col-sm-6 col-md-3 col-lg-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer_title"><h3>',
        'after_title' => '</h3></div>',
    ));
}

add_action('widgets_init', 'business_brand_widgets_init');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_brand_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'business_brand_body_classes');

// Menu default 

function business_brand_default_menu() {
    $html = '<ul id="menu-main-menu" class="offside nav navbar-nav">';
    $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
    $html .= '<a href="' . esc_url(home_url()) . '" title="' . esc_attr('Home', 'business-brand') . '">';
    $html .= esc_html('Home', 'business-brand');
    $html .= '</a>';
    $html .= '</li>';
    $html .= '</ul>';
    echo $html;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function business_brand_pingback_header() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'business_brand_pingback_header');

if (!function_exists('business_brand_post_thumbnail')) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function business_brand_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        if (is_singular()) :
            ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('full', array('alt' => the_title_attribute(array('echo' => false)), 'class' => 'img-responsive',)); ?>
            </div><!-- .post-thumbnail -->
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute(array('echo' => false,)), 'class' => 'img-responsive',)); ?>
            </a>
        <?php
        endif; // End is_singular().
    }

endif;

function business_brand_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return esc_html($excerpt);
}

/**
 * Set up post entry meta.    
 * Meta information for current post: categories, tags, permalink, author, and date.    
 * */
function business_brand_entry_meta() {
    $tags_list = get_the_tag_list('<li>', '</li><li>','</li>'); ?>
    <div class="user_time">
        <div class="icon_div"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"> <i class="fa fa-user"></i><p><?php the_author(); ?></p></a></div>
        <div class="icon_div"><i class="fa fa-clock"></i><p><?php echo esc_html(get_the_date()); ?></p></div>
        <div class="icon_div"><i class="fa fa-comment"></i><p><?php comments_number(); ?></p></div>
        <?php if(is_singular() && !empty($tags_list)) : ?>
        <div class="icon_div"><i class="fa fa-link"></i><ul><?php echo wp_kses_post($tags_list); ?></ul></div>
        <?php endif; ?>
    </div>
    <?php

}

add_action('tgmpa_register', 'business_brand_required_plugins');

function business_brand_required_plugins() {
    if (class_exists('TGM_Plugin_Activation')) {
        $plugins = array(
            array(
                'name' => __('Page Builder by SiteOrigin', 'business-brand'),
                'slug' => 'siteorigin-panels',
                'required' => false,
            ),
            array(
                'name' => __('SiteOrigin Widgets Bundle', 'business-brand'),
                'slug' => 'so-widgets-bundle',
                'required' => false,
            ),
            array(
                'name' => __('Contact Form 7', 'business-brand'),
                'slug' => 'contact-form-7',
                'required' => false,
            ),
        );
        $config = array(
            'default_path' => '',
            'menu' => 'business-brand-install-plugins',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false,
            'message' => '',
            'strings' => array(
                'page_title' => __('Install Recommended Plugins', 'business-brand'),
                'menu_title' => __('Install Plugins', 'business-brand'),
                'nag_type' => 'updated'
            )
        );
        tgmpa($plugins, $config);
    }
}
