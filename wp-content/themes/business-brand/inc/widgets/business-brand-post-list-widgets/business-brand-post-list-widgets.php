<?php 
function business_brand_post_list_custom_widgets() {
    register_widget( 'business_brand_post_list_custom_template' );
}
add_action( 'widgets_init', 'business_brand_post_list_custom_widgets' );
class business_brand_post_list_custom_template extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'business_brand_post_list_custom_template', 'description' => esc_html__( "The most recent posts on your site", 'business-brand') );
        parent::__construct('categories-posts-post_template_1', esc_html__('BX : Post List View', 'business-brand'), $widget_ops);
        $this->alt_option_name = 'widget_recent_post_post_template_1';
        add_action( 'save_post', array($this, 'business_brand_post_flush_widget_cache_temlate3') );
        add_action( 'deleted_post', array($this, 'business_brand_post_flush_widget_cache_temlate3') );
        add_action( 'switch_theme', array($this, 'business_brand_post_flush_widget_cache_temlate3') );
    }
    function widget($args, $instance) {
        $business_brand_post_cache = wp_cache_get('business_brand_post_list_custom_template', 'widget');
        if ( !is_array($business_brand_post_cache) )
            $business_brand_post_cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $business_brand_post_cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($business_brand_post_cache[ $args['widget_id'] ]);
            return;
        }
        ob_start();
        extract($args);
        $title = ( ! empty( $instance['title'] ) ) ? sanitize_text_field($instance['title']) : esc_html__( 'Recent Posts', 'business-brand' );
        $post_view = ( ! empty( $instance['post-view'] ) ) ? sanitize_text_field($instance['post-view']) : 'box-view';
        $number = ( ! empty( $instance['number'] ) ) ? absint($instance['number']) : 4;        
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        ?>
    <?php    $business_brand_post_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($business_brand_post_r->have_posts()) :
        echo $args['before_widget']; 
        if ( $title ) echo $args['before_title'] . esc_html($title) . $args['after_title']; 
       if($post_view == 'list-view'){ ?>
       <div class="every_people"> 
	   <div class="every_sec">  
          <div class="post_box">
            <ul>
                 <?php $count = 0;
                    while ( $business_brand_post_r->have_posts() ) : $business_brand_post_r->the_post();
                    $post_id = get_the_ID();
                    $categories = get_the_category($post_id);
                    if (has_post_thumbnail()){
                            $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                            $image = $image_array[0];
                    }else{  $image = get_template_directory_uri() .'/assets/images/no-image.png';  }
                    ?>
              <li class="left_list-with-sidebar">
              <div class="img_list-with_left" href=""><a href=""><img src="<?php echo esc_url($image); ?>" class="img-responsive" alt=""></a></div>
              <div class="list-with_left">
                <div class="img_btn">
                    <?php foreach($categories as $key=> $cat){$class = ($key % 2 == 0)?"gaming":"business"; ?>
                    <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>              
                    <?php } ?>
                </div>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                 <?php business_brand_entry_meta(); ?>
                  <div class="with-sidebar_containt"><?php the_excerpt(); ?></p>
              </div>
              </li>
              
               <?php endwhile;  ?>
            </ul>
         </div>
         </div>
         </div>
    <?php }else if($post_view == 'box-view'){ ?>
           <div class="every_people">     
               <div class="row"> 
                   <?php $count = 1;
                   while ($business_brand_post_r->have_posts()) : $business_brand_post_r->the_post();
                       $post_id = get_the_ID();
                       $categories = get_the_category($post_id);
                       if (has_post_thumbnail()) {
                           $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                           $image = $image_array[0];
                       } else {
                           $image = get_template_directory_uri() . '/assets/images/no-image.png';
                       }
                    ?>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                       <div class="img_main">
                           <a class="main_leftdiv" href="">
                               <div class="img_left"><img style="width: 350px;" src="<?php echo esc_url($image); ?>" class="img-responsive" alt=""></div>
                               <div class="thumb_btn">
                                   <div class="img_btn">
                                   <?php
                                      foreach ($categories as $key => $cat) {  $class = ($key % 2 == 0)?"gaming":"business";  ?>
                                      <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                                  <?php } ?>
                                   </div>
                               </div>
                           </a>
                           <div class="img_content">
                               <div class="imgdisc">
                                   <div class="everydisc">
                                       <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                       <?php business_brand_entry_meta(); ?>
                                       <div class="every_text"><?php the_excerpt(); ?></div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <?php if($count % 2 == 0):?>
                    <div class="clearfix"></div>
                  <?php endif; $count++; endwhile; ?>
           </div>
        </div>
    <?php } 
    the_posts_pagination( array(
        'screen_reader_text' => ' ', 
        'prev_text' => __( '<i class="fa fa-arrow-left" aria-hidden="true"></i>', 'business-brand' ),
       'next_text' => __( '<i class="fa fa-arrow-right" aria-hidden="true"></i>', 'business-brand' )));
        wp_reset_postdata(); ?>
        <?php echo $args['after_widget'];
        endif; ?>
      <?php  $business_brand_post_cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('business_brand_post_list_custom_template', $business_brand_post_cache, 'widget');
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ( !empty( $new_instance['title']) && $new_instance['title']!='' ) ? sanitize_text_field($new_instance['title']):'';
        $instance['number'] = ( !empty( $new_instance['number']) && $new_instance['number'] > 0 ) ? absint($new_instance['number']):''; 
        $instance['post-view'] = ( !empty( $new_instance['post-view']) && $new_instance['post-view']!='' ) ? sanitize_text_field($new_instance['post-view']):'';
        $this->business_brand_post_flush_widget_cache_temlate3();
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['business_brand_post_list_custom_template']) )
            delete_option('business_brand_post_list_custom_template');
        return $instance;
    }
    function business_brand_post_flush_widget_cache_temlate3() {
        wp_cache_delete('business_brand_post_list_custom_template', 'widget');
    }
    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : ''; 
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
        $post_view = isset( $instance['post-view'] ) ? sanitize_text_field( $instance['post-view'] ) : ''; ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','business-brand' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
       <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'business-brand' ); ?></label>
        <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" value="<?php echo esc_attr($number); ?>" size="3" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'post-view' )); ?>"><?php esc_html_e( 'Post View:','business-brand' ); ?></label>
       
        <select id="<?php echo esc_attr($this->get_field_id( 'post-view' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post-view' )); ?>">
            <option value="box-view" <?php if($post_view == 'box-view'){ echo 'selected="selected"'; } ?>><?php esc_html_e( 'Box View','business-brand' ); ?></option>
            <option value="list-view" <?php if($post_view == 'list-view'){ echo 'selected="selected"'; } ?>><?php esc_html_e( 'List View','business-brand' ); ?></option>
        </select>
<?php }
}