<?php 
function business_brand_slider_register_custom_widgets_template2() {
    register_widget( 'business_brand_slider_widget_recent_posts_template2' );
}
add_action( 'widgets_init', 'business_brand_slider_register_custom_widgets_template2' );
class business_brand_slider_widget_recent_posts_template2 extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'business_brand_slider_widget_recent_posts_template2', 'description' => esc_html__( "The most recent posts on your site", 'business-brand') );
        parent::__construct('recent-posts-template2', esc_html__('BX : Post Slider Style 2', 'business-brand'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries_template2';
        add_action( 'save_post', array($this, 'business_brand_slider_flush_widget_cache_temlate2') );
        add_action( 'deleted_post', array($this, 'business_brand_slider_flush_widget_cache_temlate2') );
        add_action( 'switch_theme', array($this, 'business_brand_slider_flush_widget_cache_temlate2') );
    }
    function widget($args, $instance) {
        wp_enqueue_script( 'business-brand-post-slider-style-1', get_template_directory_uri().'/inc/widgets/business-brand-latest-post-slider1/slider1.js',array('jquery'),null, false);

        $business_brand_slider_cache = wp_cache_get('business_brand_slider_widget_recent_posts_template2', 'widget');
        if ( !is_array($business_brand_slider_cache) )
            $business_brand_slider_cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $business_brand_slider_cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($business_brand_slider_cache[ $args['widget_id'] ]);
            return;
        }
        ob_start();
        extract($args);       
        
        $category_list = isset($instance['category']) ? absint($instance['category']) : '';   
         $number = isset( $instance['number'] ) ? absint($instance['number']) : ''; ?>
    <?php    $business_brand_slider_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($business_brand_slider_r->have_posts()) :
        echo $args['before_widget'];     ?>
        
    <div class="banner_wrap fullwidth">
	   <div class="container">
		  <div class="main_slider autoplay template-style-1">
            <?php $count = 0;
            while ( $business_brand_slider_r->have_posts() ) : $business_brand_slider_r->the_post();
            $post_id = get_the_ID();
            $category = get_the_category($post_id);
            if (has_post_thumbnail()){
                    $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                    $image = $image_array[0];
            }else{  $image = get_template_directory_uri() .'/assets/images/no-image.png';  }
            if($count < $number ): ?>
            <div class="col-md-3">
                <div class="banner_box">
                    <div class="img_main">
                       <div class="full6-col_slider" style="background-image: url(<?php echo esc_url($image); ?>);"></div>
                        <div class="img_content">
                            <div class="imgdisc">
                                <div class="img_btn">
                                <?php foreach($category as $key=> $cat){
                                    $class = ($key % 2 == 0)?"gaming":"business"; ?>
                                <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>                                
                                    <?php } ?>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                                <div class="user_time">
                                    <div class="icon_div">
                                        <i class="fas fa-user"></i>
                                        <p><a class="url fn n" href='<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>'><?php the_author(); ?></a></p>
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
            </div>
            <?php endif; $count++; endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
        <?php echo $args['after_widget'];
        endif; ?>
      <?php  $business_brand_slider_cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('business_brand_slider_widget_recent_posts_template2', $business_brand_slider_cache, 'widget');
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['category'] = ( !empty( $new_instance['category']) && $new_instance['category'] > 0 ) ? absint($new_instance['category']):'';      
        $instance['number'] = ( !empty( $new_instance['number']) && $new_instance['number'] > 0 ) ? absint($new_instance['number']):0;
        $this->business_brand_slider_flush_widget_cache_temlate2();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['business_brand_slider_widget_recent_posts_template2']) )
            delete_option('business_brand_slider_widget_recent_posts_template2');
        return $instance;
    }
    function business_brand_slider_flush_widget_cache_temlate2() {
        wp_cache_delete('business_brand_slider_widget_recent_posts_template2', 'widget');
    }
    function form( $instance ) {
        $category_list  = isset($instance['category']) ? absint($instance['category']) : '';       
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
        ?>
        
       <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:','business-brand' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" value="<?php echo esc_attr($number); ?>" /></p>
       <p> <label for=<?php echo esc_attr($this->get_field_id('category'));?>><?php esc_html_e('Select Post Category','business-brand'); ?></label>
            <?php wp_dropdown_categories(array('show_option_none'=>' Select', 'name'=> $this->get_field_name('category'),'selected'=> $category_list)); ?>
        </p>
<?php }
}