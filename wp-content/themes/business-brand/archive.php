<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Brand
 */
get_header();
?>
<div class="featured_wrap">
    <div class="container">
        <?php
        $blog_layout_class = (get_theme_mod('blog_sidebar_style', 'right_sidebar') == 'left_sidebar') ? "9" : ((get_theme_mod('blog_sidebar_style', 'right_sidebar') == 'right_sidebar') ? "9" : "12");
        if (get_theme_mod('blog_sidebar_style', 'right_sidebar') == 'left_sidebar') {
            ?>
            <!-- Left sidebar -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="sidebar">
                <div class="<?php echo esc_attr(get_theme_mod('blog_sidebar_style')); ?>">
                    <?php get_sidebar(); ?>		
                </div>
            </div>
            </div> <!-- and Left sidebar -->
        <?php } ?>
        <!-- content -->
        <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-9 col-xs-12">
            <div class="memory_block ">
                 <h3 class="widget-title"><?php esc_html_e("Blog",'business-brand'); ?></h3>
                <?php
                $icounter = 1;
                while (have_posts()) : the_post();
                    $icounter = ($icounter > 2) ? 1 : $icounter;
                    ?>
                    <div class="every_people">  
                           <div class="every_sec">  
                          <div class="post_box">
                            <ul>  
                                    <?php
                                    get_template_part('template-parts/content', 'blog');
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    ?> 
                            </ul>
                            </div>
                        </div>
                    </div>
                    <?php if ($icounter == 2): ?>
                        <div class="clearfix">
                        </div>
                    <?php endif; ?>
                    <?php
                    $icounter++;
                endwhile; // End of the loop.
                 the_posts_pagination( array(
                    'screen_reader_text' => ' ', 
                    'prev_text' => __( '<i class="fa fa-arrow-left" aria-hidden="true"></i>', 'business-brand' ),
                   'next_text' => __( '<i class="fa fa-arrow-right" aria-hidden="true"></i>', 'business-brand' )));
                ?>
            </div>
        </div><!-- and content -->
        <?php if (get_theme_mod('blog_sidebar_style', 'right_sidebar') == 'right_sidebar') { ?>
            <!-- right sidebar -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="sidebar">
                    <?php get_sidebar(); ?>		
                </div>
            </div> <!-- and right sidebar -->
        <?php } ?>
    </div><!-- and Main  -->
</div>
<?php
get_footer();
