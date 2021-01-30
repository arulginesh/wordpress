<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Brand
 */
?>
<!-- main content section -->
<!-- footer -->
<div class="footer_wrap">
    <div class="container">
        <div class="row">
            <div class="footer_section">
                <?php
                if (is_active_sidebar('footer-section-1')) {
                    dynamic_sidebar('footer-section-1');
                }
                ?>

                <?php
                if (is_active_sidebar('footer-section-2')) {
                    dynamic_sidebar('footer-section-2');
                }
                ?>
                <?php
                if (is_active_sidebar('footer-section-3')) {
                    dynamic_sidebar('footer-section-3');
                }
                ?>
				<?php
                if (is_active_sidebar('footer-section-4')) {
                    dynamic_sidebar('footer-section-4');
                }
                ?>
            </div>
        </div>
    </div>
    <div class="footer_copyright">
        <div class="container">
            <div class="footer_copy">
                <?php if (get_theme_mod('Copyright_area_text') != '') : ?>
                    <p><?php echo wp_kses_post(get_theme_mod('Copyright_area_text')); ?></p>
                <?php endif; ?>  
                <p><?php esc_html_e('Theme: ', 'business-brand'); ?>
                    <a class="devlope" href="<?php echo esc_url("https://sigmathemes.com/wordpress-themes/business-brand/"); ?>">
                        <?php esc_html_e('Business Brand', 'business-brand'); ?>
                    </a>
                </p>
            </div><!-- and footer text area -->

            <?php if (has_nav_menu('footer-menu')) { ?>
                <div class="right_footer">
                    <?php
                    $footer_defaults = array(
                        'theme_location' => 'footer-menu',
                        'menu_class' => 'footer-socials list-inline text-center',
                    );
                    wp_nav_menu($footer_defaults);
                    ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="fas fa-arrow-up"></i></a>
    <!-- Test the scroll -->
    <?php wp_footer(); ?>
</body>
</html>