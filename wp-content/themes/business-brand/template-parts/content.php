<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Brand
 */
$categories = get_the_category(get_the_ID());
if (has_post_thumbnail()) {
    $image_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
    $image = $image_array[0];
} else {
    $image = get_template_directory_uri() . '/assets/images/no-image.png';
}
?>
<div id="post-<?php  the_ID(); ?>" <?php post_class(); ?>>
    <div class="main_leftdiv full-single-post-init" href="">
        <div class="img_left">
            <img src="<?php echo esc_url($image); ?>" class="img-responsive" >
        </div>
        <div class="left_full_content">       
            <div class="img_btn">
                <?php foreach($categories as $key=> $cat){
                    if ( 'post' === get_post_type() && get_theme_mod('category_link',0) != 1) :
                    $class =($key % 2 == 0)?"gaming":"sport"; ?>
                 <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>              
                 <?php endif; } ?>
            </div>  
            <div class="imgdisc">               
                <?php
                if (!is_front_page()):
                    if (is_singular()) :
                        the_title('<h2 class="entry-title">', '</h2>');
                    else :
                        the_title('<h2 class="entry-post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif;
                endif;
                if ( 'post' === get_post_type() && get_theme_mod('singal_blog_meta_tag',0) != 1) :  
                    business_brand_entry_meta();
                 endif; ?>
            </div>							
        </div>
    </div>
    <div class="every_content">
        <div class="everydisc">  
            <?php if ( 'post' === get_post_type() && get_theme_mod('singal_blog_meta_tag',0) != 1) : 
                business_brand_entry_meta();
             endif; ?>
            <div class="every_text">
                <?php
                the_content(sprintf(
                      wp_kses(
                          /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'business-brand'), array(
                    'span' => array('class' => array(), ), ) ), get_the_title() ));
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'business-brand'),
                    'after' => '</div>',
                ));
                ?>
            </div>
        </div>
    </div>	
</div>
