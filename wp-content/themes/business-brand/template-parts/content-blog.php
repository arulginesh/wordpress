<?php
/**
 * Template part for displaying page content in page.php
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
<li class="left_list-with-sidebar">
<div class="img_list-with_left" href=""><a href=""><img src="<?php echo esc_url($image); ?>" class="img-responsive" alt=""></a></div>
<div class="list-with_left">
  <div class="img_btn">
      <?php foreach($categories as $key=> $cat){ $class = ($key % 2 == 0)?"gaming":"business";  ?>
      <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>              
      <?php } ?>
  </div>
  <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
  <?php if ( 'post' === get_post_type() && get_theme_mod('blog_meta_tag',0) != 1) : 
      business_brand_entry_meta();
     endif;?>
    <div class="with-sidebar_containt"><?php the_excerpt(); ?></div>
</li>