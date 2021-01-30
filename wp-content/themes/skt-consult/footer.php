<?php 
/**
 * The Footer for SKT Consulting
 *
 * Displays the footer area of the template.
 *
 * @package SKT Consulting
 * 
 * @since SKT Consulting 1.0
 */
global $complete;?>
<?php /*To Top Button */?>

<a class="to_top <?php if (empty ($complete['totop_id'])) { ?>hide_totop<?php } ?>"><i class="fa-angle-up fa-2x"></i></a> 
<!--Footer Start-->
<div class="footer_wrap layer_wrapper <?php if(!empty($complete['hide_mob_footwdgt'])){ echo 'mobile_hide_footer';} ?>">
  <?php
  global $complete;
  $footertype = $complete['foot_layout_id']; 
?>
  <div id="footer" class="footer-type<?php echo $footertype; ?><?php if ($footertype == 5) {?> footernone<?php } ?>">
  <div class="skt-footer-wave">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="1450.000000pt" height="240.000000pt" viewBox="0 0 1450.000000 240.000000" preserveAspectRatio="xMidYMid meet">
			<g transform="translate(0.000000,240.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
				<path class="skt-footer-wave-color" d="M13770 2394 c-19 -2 -80 -9 -135 -15 -369 -40 -805 -146 -1205 -295 -80 -29 -274 -108 -430 -175 -1099 -468 -1950 -757 -2665 -903 -388 -79 -626 -106 -976 -113 -508 -10 -694 21 -1294 212 -525 167 -780 215 -1151 215 -457 0 -920 -92 -1554 -308 -168 -57 -388 -131 -490 -163 -749 -241 -1538 -385 -2355 -430 -274 -15 -851 -6 -1050 16 -77 9 -213 19 -302 22 l-163 6 0 -232 0 -231 7250 0 7250 0 0 1189 0 1189 -32 6 c-37 8 -644 16 -698 10z"/>
			</g>
		</svg>
	</div>
    <div class="center">
      <?php if($complete['hide_foot_infobox'] == '0') { ?>
      <div class="row">
        <div class="contact-info">
          <div class="col-4">
            <div class="box">
              <?php 
							if (!empty ($complete['foot_infobox1_icon'])) { $ft1icon = html_entity_decode($complete['foot_infobox1_icon']); $ft1icon = stripslashes($ft1icon);
							?>
              <?php echo do_shortcode($ft1icon);  ?>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox1_heading'])) { $ft1heading = html_entity_decode($complete['foot_infobox1_heading']); $ft1heading = stripslashes($ft1heading);
							?>
              <h5><?php echo do_shortcode($ft1heading);  ?></h5>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox1_description'])) { $ft1description = html_entity_decode($complete['foot_infobox1_description']); $ft1description = stripslashes($ft1description);
							?>
              <p><?php echo do_shortcode($ft1description);  ?></p>
              <?php } ?>
            </div>
          </div>
          <div class="col-4">
            <div class="box">
              <?php 
							if (!empty ($complete['foot_infobox2_icon'])) { $ft2icon = html_entity_decode($complete['foot_infobox2_icon']); $ft2icon = stripslashes($ft2icon);
							?>
              <?php echo do_shortcode($ft2icon);  ?>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox2_heading'])) { $ft2heading = html_entity_decode($complete['foot_infobox2_heading']); $ft2heading = stripslashes($ft2heading);
							?>
              <h5><?php echo do_shortcode($ft2heading);  ?></h5>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox2_description'])) { $ft2description = html_entity_decode($complete['foot_infobox2_description']); $ft2description = stripslashes($ft2description);
							?>
              <p><?php echo do_shortcode($ft2description);  ?></p>
              <?php } ?>
            </div>
          </div>
          <div class="col-4">
            <div class="box">
              <?php 
							if (!empty ($complete['foot_infobox3_icon'])) { $ft3icon = html_entity_decode($complete['foot_infobox3_icon']); $ft3icon = stripslashes($ft3icon);
							?>
              <?php echo do_shortcode($ft3icon);  ?>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox3_heading'])) { $ft3heading = html_entity_decode($complete['foot_infobox3_heading']); $ft3heading = stripslashes($ft3heading);
							?>
              <h5><?php echo do_shortcode($ft3heading);  ?></h5>
              <?php } ?>
              <?php 
							if (!empty ($complete['foot_infobox3_description'])) { $ft3description = html_entity_decode($complete['foot_infobox3_description']); $ft3description = stripslashes($ft3description);
							?>
              <p><?php echo do_shortcode($ft3description);  ?></p>
              <?php } ?>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <?php } ?>
      <div class="rowfooter">
        <div class="clear"></div>
        <?php if ($footertype == 4) {?>
        <div class="footercols4">
          <?php if (dynamic_sidebar('footer-1')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols1_title'])) { $ftcols1 = html_entity_decode($complete['foot_cols1_title']); $ftcols1 = stripslashes($ftcols1); echo do_shortcode($ftcols1); } ?></h3>
          <?php $ftcols1cntnt = $complete['foot_cols1_content']; echo do_shortcode($ftcols1cntnt); endif;?>
        </div>
        <div class="footercols4">
          <?php if (dynamic_sidebar('footer-2')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols2_title'])) { $ftcols2 = html_entity_decode($complete['foot_cols2_title']); $ftcols2 = stripslashes($ftcols2); echo do_shortcode($ftcols2); } ?></h3>
          <?php $ftcols2cntnt = $complete['foot_cols2_content']; echo do_shortcode($ftcols2cntnt); endif;?>
        </div>
        <div class="footercols4">
          <?php if (dynamic_sidebar('footer-3')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols3_title'])) { $ftcols3 = html_entity_decode($complete['foot_cols3_title']); $ftcols3 = stripslashes($ftcols3); echo do_shortcode($ftcols3); } ?></h3>
          <?php $ftcols3cntnt = $complete['foot_cols3_content']; echo do_shortcode($ftcols3cntnt); endif;?>
        </div>
        <div class="footercols4">
          <?php if (dynamic_sidebar('footer-4')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols4_title'])) { $ftcols4 = html_entity_decode($complete['foot_cols4_title']); $ftcols4 = stripslashes($ftcols4); echo do_shortcode($ftcols4); } ?></h3>
          <?php $ftcols4cntnt = $complete['foot_cols4_content']; echo do_shortcode($ftcols4cntnt); endif;?>
        </div>
        <?php } if ($footertype == 3) {?>
        <div class="footercols3">
          <?php if (dynamic_sidebar('footer-1')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols1_title'])) { $ftcols1 = html_entity_decode($complete['foot_cols1_title']); $ftcols1 = stripslashes($ftcols1); echo do_shortcode($ftcols1); } ?></h3>
          <?php $ftcols1cntnt = $complete['foot_cols1_content']; echo do_shortcode($ftcols1cntnt); endif;?>
        </div>
        <div class="footercols3">
          <?php if (dynamic_sidebar('footer-2')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols2_title'])) { $ftcols2 = html_entity_decode($complete['foot_cols2_title']); $ftcols2 = stripslashes($ftcols2); echo do_shortcode($ftcols2); } ?></h3>
          <?php $ftcols2cntnt = $complete['foot_cols2_content']; echo do_shortcode($ftcols2cntnt); endif;?>
        </div>
        <div class="footercols3">
          <?php if (dynamic_sidebar('footer-3')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols3_title'])) { $ftcols3 = html_entity_decode($complete['foot_cols3_title']); $ftcols3 = stripslashes($ftcols3); echo do_shortcode($ftcols3); } ?></h3>
          <?php $ftcols3cntnt = $complete['foot_cols3_content']; echo do_shortcode($ftcols3cntnt); endif;?>
        </div>
        <?php } ?>
        <?php if ($footertype == 2) {?>
        <div class="footercols2">
          <?php if (dynamic_sidebar('footer-1')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols1_title'])) { $ftcols1 = html_entity_decode($complete['foot_cols1_title']); $ftcols1 = stripslashes($ftcols1); echo do_shortcode($ftcols1); } ?></h3>
          <?php $ftcols1cntnt = $complete['foot_cols1_content']; echo do_shortcode($ftcols1cntnt); endif;?>
        </div>
        <div class="footercols2">
          <?php if (dynamic_sidebar('footer-2')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols2_title'])) { $ftcols2 = html_entity_decode($complete['foot_cols2_title']); $ftcols2 = stripslashes($ftcols2); echo do_shortcode($ftcols2); } ?></h3>
          <?php $ftcols2cntnt = $complete['foot_cols2_content']; echo do_shortcode($ftcols2cntnt); endif;?>
        </div>
        <?php } if ($footertype == 1) { if(!dynamic_sidebar('footer-1')) : ?>
        <div class="footercols1">
          <?php if (dynamic_sidebar('footer-1')) : else : ?>
          <h3><?php if (!empty ($complete['foot_cols1_title'])) { $ftcols1 = html_entity_decode($complete['foot_cols1_title']); $ftcols1 = stripslashes($ftcols1); echo do_shortcode($ftcols1); } ?></h3>
          <?php $ftcols1cntnt = $complete['foot_cols1_content']; echo do_shortcode($ftcols1cntnt); endif;?>
        </div>
        <?php  endif; ?>
        <?php } ?>
      </div>
      <div class="clear"></div>
    </div>
    <div class="center">
      <div id="copyright">
        <div class="copytext">
          <?php $copyrightcntnt = $complete['footer_text_id']; echo do_shortcode($copyrightcntnt); ?>
        </div>
      </div>
    </div>
  </div>
  
  <!--Footer END--> 
</div>
<!--layer_wrapper class END-->
<?php wp_footer(); ?>
</body></html>