<?php
/**
 * Template Name: Full Width
 * @package Business Brand
 */
get_header();
?>
<div class="featured_wrap">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php while (have_posts()) : the_post(); ?>
                <div class="every_people">
                    <div class="every_sec">	
                        <?php
	                        get_template_part('template-parts/content', get_post_type());
                        ?>
                    </div>
                </div>	
            <?php endwhile; // End of the loop.?>
    </div>
</div>
</div>
<?php
get_footer();