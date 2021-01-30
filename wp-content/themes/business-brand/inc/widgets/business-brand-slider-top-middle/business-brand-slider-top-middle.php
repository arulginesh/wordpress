<?php 
function business_brand_slider_top_middle_custom_widgets() {
    register_widget( 'business_brand_slider_top_middle' );
}
add_action( 'widgets_init', 'business_brand_slider_top_middle_custom_widgets' );
class business_brand_slider_top_middle extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'business_brand_slider_top_middle', 'description' => esc_html__( "The most recent posts on your site", 'business-brand') );
        parent::__construct('recent-posts-middle1', esc_html__('BX : Top Middle Slider', 'business-brand'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries_middle1';
        add_action( 'save_post', array($this, 'business_brand_slider_top_middle_flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'business_brand_slider_top_middle_flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'business_brand_slider_top_middle_flush_widget_cache') );
    }
    function widget($args, $instance) {
        
        wp_enqueue_script( 'business-brand-slider-top-middle', get_template_directory_uri().'/inc/widgets/business-brand-slider-top-middle/top_middle.js',array('jquery'),null, false);
        $business_brand_slider_top_middle_flush_widget_cache = wp_cache_get('business_brand_slider_top_middle', 'widget');
        if ( !is_array($business_brand_slider_top_middle_flush_widget_cache) )
            $business_brand_slider_top_middle_flush_widget_cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $business_brand_slider_top_middle_flush_widget_cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($business_brand_slider_top_middle_flush_widget_cache[ $args['widget_id'] ]);
            return;
        }
        ob_start();
        extract($args);       
        $category_list = isset($instance['category']) ? absint($instance['category']) : '';   
        $title = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
        $number = isset( $instance['number'] ) ? absint($instance['number']) : '';
        ?>
    <?php    $business_brand_slider_top_middle_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($business_brand_slider_top_middle_r->have_posts()) :
        echo $args['before_widget'];  ?>
       <?php if(!empty($title)){ 
           $arr = explode(' ',trim($title));
           if(!empty($arr)){ ?>
        <div class="featured_title"><h2><?php foreach($arr as $key=> $arr_value){ if($key ==0){ echo esc_html($arr_value); } } ?> <span><?php foreach($arr as $key=> $arr_value){ if($key !=0){ echo esc_html($arr_value).' '; } } ?></span> </h2></div>
           <?php }else{ ?>
            <div class="featured_title"><h2><?php echo esc_html($title); ?></h2></div>    
          <?php } ?>
       <?php }else{ ?>
         <div class="featured_title"><h2></h2></div>  
      <?php } ?>
        <div class="featured_post top_middle_slider">            
            <?php $count = 0;
            while ( $business_brand_slider_top_middle_r->have_posts() ) : $business_brand_slider_top_middle_r->the_post();
            $post_id = get_the_ID();
            $category = get_the_category($post_id);
            if (has_post_thumbnail()){
                    $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                    $image = $image_array[0];
            }else{  $image = get_template_directory_uri() .'/assets/images/no-image.png';  }          
            if($count < $number   ): ?>
            <div class="col-md-3">
                <a href="<?php the_permalink(); ?>">
				    <div class="banner_box">
					   <div class="img_main">
						  <div class="img_slider"><img src="<?php echo esc_url($image); ?>" class="img-responsive" alt=""></div>
					      <div class="img_content">
							<div class="imgdisc">
                                <div class="img_btn">
                                <?php foreach($category as $key=> $cat){
                                    $class=($key % 2 == 0)?"gaming" :"business"; ?>
                                <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a> 
                                <?php } ?>
                                </div>
                                <a href="<?php the_permalink(); ?>"><h2><?php the_title();?></h2></a>
								<div class="user_time">
									<div class="icon_div">
										<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><i class="fas fa-user"></i>
										<p><?php the_author(); ?></p></a>
									</div>
									<div class="icon_div">
										<i class="far fa-clock"></i>
										<p><?php echo esc_html(get_the_date()); ?></p>
									</div>
								</div>
							</div>
						  </div>
					    </div>
				    </div>
                </a>
			</div>                       
            <?php endif; $count++; endwhile; wp_reset_postdata(); ?>
        </div>                    
        <?php echo $args['after_widget'];
        endif; ?>
      <?php  $business_brand_slider_top_middle_flush_widget_cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('business_brand_slider_top_middle_flush_widget_cache', $business_brand_slider_top_middle_flush_widget_cache, 'widget');
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['category'] = ( !empty( $new_instance['category']) && $new_instance['category'] > 0 ) ? absint($new_instance['category']):'';
        $instance['title'] = (!empty( $new_instance['title']) && $new_instance['title'] !='' ) ? sanitize_text_field($new_instance['title']):'';        
        $instance['number'] = isset( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 10;
        $this->business_brand_slider_top_middle_flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['business_brand_slider_top_middle_flush_widget_cache']) )
            delete_option('business_brand_slider_top_middle_flush_widget_cache');
        return $instance;
    }
    function business_brand_slider_top_middle_flush_widget_cache() {
        wp_cache_delete('business_brand_slider_top_middle_flush_widget_cache', 'widget');
    }
    function form( $instance ) {
        $category_list  = isset($instance['category']) ? absint($instance['category']) : ''; 
        $title     = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10; ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','business-brand' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:','business-brand' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" value="<?php echo esc_attr($number); ?>" /></p>
        
            <label for=<?php echo esc_attr($this->get_field_id('category'));?>><?php esc_html_e('Select Post Category','business-brand'); ?></label>
            <?php wp_dropdown_categories(array('show_option_none'=>' Select', 'name'=> $this->get_field_name('category'),'selected'=> $category_list)); ?>
        </p>
       
<?php }
}