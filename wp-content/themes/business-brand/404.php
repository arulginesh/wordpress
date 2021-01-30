<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business Brand
 */

get_header(); ?>
	<div class="featured_wrap">
<!-- Main -->
	<div class="container">
		<div class="row">
		<div class="every_people">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'business-brand' ); ?></h1>
				</header>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'business-brand' ); ?></p>
					<?php	get_search_form();	?>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
<?php get_footer();