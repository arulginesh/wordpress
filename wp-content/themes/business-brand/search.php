<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Business Brand
 */

get_header(); ?>
<div class="featured_wrap">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">	
        	<div class="memory_block">
			<?php
			if ( have_posts() ) : ?>
				<header class="page-header">
					<?php get_search_form(); ?>
					<h4>
					 	<?php esc_html_e('Search results for :', 'business-brand'); echo get_search_query();  ?>
					</h4>
				</header><!-- .page-header -->
				<div class="row">						
					<div class="memory_block_search">					
					<?php $icounter=1;	 global $wp_query;					 
					while ( have_posts() ) : the_post(); 					 
						$icounter=($icounter>2)?1:$icounter;  ?>
						<div class="every_people">  
	                        <div class="every_sec">  
					            <div class="post_box">
		                            <ul> 
									<?php  get_template_part( 'template-parts/content', 'search' ); ?>
									</ul>
					            </div>
				            </div>
				        </div>
		            	<?php if($icounter==2 || $wp_query->current_post+1 == $wp_query->post_count):?>
							<div class="clearfix">	</div>
						<?php endif; 
					 	$icounter++; endwhile; ?>
					</div>
	            </div>
				<?php	the_posts_pagination( array(
						'screen_reader_text' => ' ', 
					    'prev_text' => __( '<i class="fa fa-arrow-left" aria-hidden="true"></i>', 'business-brand' ),
				    	'next_text' => __( '<i class="fa fa-arrow-right" aria-hidden="true"></i>', 'business-brand' ),
					) ); 
			 else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
			</div>
		</div><!-- #main -->
		</div>
	</div><!-- #primary -->
<?php  get_footer();