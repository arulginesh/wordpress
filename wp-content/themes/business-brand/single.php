<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business Brand
 */
get_header();
?>
<div class="featured_wrap">
    <div class="container">
        <?php
        $blog_layout_class = (get_theme_mod('single_sidebar_style', 'right_sidebar') == 'left_sidebar') ? "9" : ((get_theme_mod('single_sidebar_style', 'right_sidebar') == 'right_sidebar') ? "9" : "12");
        if (get_theme_mod('single_sidebar_style', 'right_sidebar') == 'left_sidebar') {
            ?>
            <!-- Left sidebar -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="text-center post-side-bar-init">
                    <?php get_sidebar(); ?>		
                </div>
            </div> <!-- and Left sidebar -->
        <?php } ?>
        <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-<?php echo esc_attr($blog_layout_class); ?> col-xs-12">
           <div class="featured_title"><h2></h2></div>
            <?php while (have_posts()) : the_post(); ?>
                <div class="every_people">
                    <div class="every_sec">	
                        <?php
                        get_template_part('template-parts/content', get_post_type());
                        the_post_navigation(array(
                            'screen_reader_text' => ' ', 
                            'prev_text' => __('<i class="fa fa-arrow-left" aria-hidden="true"></i>', 'business-brand'),
                            'next_text' => __('<i class="fa fa-arrow-right" aria-hidden="true"></i>', 'business-brand')
                        ));
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>	
            <?php endwhile; // End of the loop.?>
        </div>
        <?php if (get_theme_mod('single_sidebar_style', 'right_sidebar') == 'right_sidebar') { ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="right_sider post-side-bar-init">
                    <?php get_sidebar(); ?>		
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php
get_footer();
