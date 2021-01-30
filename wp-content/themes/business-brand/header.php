<!doctype html>
<html <?php language_attributes(); ?> >
    <head>        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">    
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <meta charset="<?php bloginfo('charset'); ?>" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <!-- header -->
        <div class="top_header">
            <div class="container">
                <?php if (has_nav_menu('header-top-menu')): ?>
                    <div class="top_leftmenu">
                        <?php
                        $top_header_defaults = array(
                            'theme_location' => 'header-top-menu',
                            'container' => false,
                            'menu_id' => 'header-top-menu',
                        );
                        wp_nav_menu($top_header_defaults);
                        ?>
                    </div>
                <?php endif; ?>

                <div class="header_right">
                    <div class="phone">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if (get_theme_mod('business_brand_social_icon' . $i) != '' && get_theme_mod('business_brand_social_icon_links' . $i) != ''): ?>
                                <a href="<?php echo esc_url(get_theme_mod('business_brand_social_icon_links' . $i)); ?>" target="_blank">
                                    <i class="fab <?php echo esc_attr(get_theme_mod('business_brand_social_icon' . $i)); ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>                   
                </div>		
            </div>
        </div>
        <div class="header_menu">
            <div class="navbar-wrapper">
                	<div class="container">
						<div class="row">
                    	<div class="menubar">
                        	<nav class="navbar navbar-inverse" role="navigation">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                             	<div class="navbar-header">
                                	<div class="navbar-header">
                                        <?php
                                        $logo = '';
                                        if (has_custom_logo()) {
                                            the_custom_logo();
                                        }
                                        $scroll_logo = get_theme_mod('business_brand_dark_logo', '');
                                        if ($scroll_logo == ''){  $scroll_logo=get_theme_mod('custom_logo',''); }
                                        if ($scroll_logo != '') { ?>
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand" rel="home" itemprop="url">
                                                <img class="img-responsive logo-dark" src="<?php echo esc_url(wp_get_attachment_url($scroll_logo)); ?>" alt="<?php esc_attr_e('Logo', 'business-brand'); ?>">
                                            </a>
                                            <?php
                                        }                                        
                                        if (get_theme_mod('header_text', true)) {
                                            printf('<a href="%s" rel="home" class="navbar-head-text site-title"><h4 class="custom-logo ">%s</h4></a><h6 class="custom-logo site-description">%s</h6>', esc_url(home_url('/')), esc_html(get_bloginfo('name')), esc_html(get_bloginfo('description')));
                                        }
                                        ?>
                                </div>
                            </div>
								</div>
                            <!-- Brand and toggle get grouped for better mobile display -->
                        
                            <div class="col-md-9 col-sm-12 col-xs-12 mob_nav">
                            <div class="main-menu">  
                                <div id='header-style-menu'>
                                 <?php
                                    if (has_nav_menu('header-menu')) :
                                        $business_brand_defaults = array(
                                            'theme_location' => 'header-menu',
                                            'container'      => 'none', 
                                            'menu_class'    => 'mobilemenu',
                                        );
                                        wp_nav_menu($business_brand_defaults);                                        
                                    else:
                                        wp_nav_menu(
                                            array(
                                              'theme_location' => 'header-menu',
                                              'fallback_cb'    => 'business_brand_default_menu'
                                        )); 
                                    endif; ?>  
                                </div>                            
                            </div>
                        </div>
                        </nav>
                    </div>    
                </div>
			</div>
          </div>
      </div>
     <!-- end header -->