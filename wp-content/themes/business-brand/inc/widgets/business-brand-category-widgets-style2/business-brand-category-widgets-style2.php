<?php 
function business_brand_category_register_custom_widgets_template2() {
    register_widget( 'business_brand_category_widget_recent_posts_template2' );
}
add_action( 'widgets_init', 'business_brand_category_register_custom_widgets_template2' );
class business_brand_category_widget_recent_posts_template2 extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'business_brand_category_widget_recent_posts_template2', 'description' => esc_html__( "The most recent posts on your site", 'business-brand') );
        parent::__construct('category-posts-template1', esc_html__('BX : Recent Category Post(Style 2)', 'business-brand'), $widget_ops);
        $this->alt_option_name = 'widget_recent_post_template1';
        add_action( 'save_post', array($this, 'business_brand_category_flush_widget_cache_temlate3') );
        add_action( 'deleted_post', array($this, 'business_brand_category_flush_widget_cache_temlate3') );
        add_action( 'switch_theme', array($this, 'business_brand_category_flush_widget_cache_temlate3') );
    }
    function widget($args, $instance) {
        wp_enqueue_style( 'business-brand-template2', get_template_directory_uri().'/inc/widgets/business-brand-category-widgets-style2/style2.css',array(),null, false);

        $business_brand_category_cache = wp_cache_get('business_brand_category_widget_recent_posts_template2', 'widget');
        if ( !is_array($business_brand_category_cache) )
            $business_brand_category_cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $business_brand_category_cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($business_brand_category_cache[ $args['widget_id'] ]);
            return;
        }
        ob_start();
        extract($args);
        $title = ( ! empty( $instance['title'] ) ) ? sanitize_text_field($instance['title']) : esc_html__( 'Recent Posts', 'business-brand' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
        $category_list = isset($instance['category']) ? absint($instance['category']) : '';
        if ( ! $number )
        $number = 3;
        ?>
    <?php    $business_brand_category_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($business_brand_category_r->have_posts()) :
        echo $args['before_widget']; 
        if ( $title ) echo $args['before_title'] . esc_html($title) . $args['after_title']; ?>

        
        <div class="peopel_right">
                <div class="right_post">   
                    <?php $count = 0;
                    while ( $business_brand_category_r->have_posts() ) : $business_brand_category_r->the_post();
                    $post_id = get_the_ID();
                    $category = get_the_category($post_id);
                    if (has_post_thumbnail()){
                            $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
                            $image = $image_array[0];
                    }else{  $image = get_template_directory_uri() .'/assets/images/no-image.png';  }
                    if($count < $number   ): ?>
                    <div class="img_main-wrapper">
                    <div class="row">
                        <div class="img_main">
		                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <a class="main_leftdiv" href="<?php the_permalink(); ?>">
			                         <div class="img_left">
                                        <img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="">
                                    </div>
		                        </a>
                                <div class="thumb_btn">
                                    <div class="img_btn">
                                        <?php foreach($category as $key=> $cat){$class = ($key % 2 == 0)?"gaming":"business"; ?>
                                          <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
			                 </div>
		                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                      <div class="img_content">
			                         <div class="imgdisc">
				                        <div class="everydisc">
				                            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
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
					                           <div class="every_text"><?php the_excerpt(); ?></div>
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
        
        <?php echo $args['after_widget'];
        endif; ?>
      <?php  $business_brand_category_cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('business_brand_category_widget_recent_posts_template2', $business_brand_category_cache, 'widget');
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['category'] =  ( !empty( $new_instance['category']) && $new_instance['category']!='' ) ? absint($new_instance['category']):'';
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->business_brand_category_flush_widget_cache_temlate3();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['business_brand_category_widget_recent_posts_template2']) )
            delete_option('business_brand_category_widget_recent_posts_template2');
        return $instance;
    }
    function business_brand_category_flush_widget_cache_temlate3() {
        wp_cache_delete('business_brand_category_widget_recent_posts_template2', 'widget');
    }
    function form( $instance ) {
        $category_list  = isset($instance['category']) ? esc_attr($instance['category']) : '';
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3; ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','business-brand' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'business-brand' ); ?></label>
        <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" value="<?php echo esc_attr($number); ?>" size="3" /></p>
         <p>
            <label for=<?php echo esc_attr($this->get_field_id('category'));?>><?php esc_html_e('Select Post Category','business-brand'); ?></label>
            <?php wp_dropdown_categories(array('show_option_none'=>' Select', 'name'=> $this->get_field_name('category'),'selected'=> $category_list)); ?>
        </p>
        
<?php }
}