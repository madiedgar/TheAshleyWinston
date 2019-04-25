<?php
/**
 * @package WordPress
 * @subpackage Hazel
 */
?>

	<div id="big_footer" <?php if (get_option("hazel_footer_full_width") == "on") echo " class='footer-full-width'"; ?>>

		<?php
		if (get_option("hazel_show_primary_footer") == "on"){
			?>
			<div id="primary_footer">
			    	<div class="<?php if (get_option("hazel_footer_full_width") == "off") echo "container"; ?> no-fcontainer">

	    		<?php

					if(get_option("hazel_footer_number_cols") == "one"){ ?>
						<div class="footer_sidebar col-xs-12 col-md-12"><?php hazel_print_sidebar('footer-one-column'); ?></div>
					<?php }
					if(get_option("hazel_footer_number_cols") == "two"){ ?>
						<div class="footer_sidebar col-xs-12 col-md-6"><?php hazel_print_sidebar('footer-two-column-left'); ?></div>
						<div class="footer_sidebar col-xs-12 col-md-6"><?php hazel_print_sidebar('footer-two-column-right'); ?></div>
					<?php }
					if(get_option("hazel_footer_number_cols") == "three"){
						if(get_option("hazel_footer_columns_order") == "one_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-three-column-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-three-column-center'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-three-column-right'); ?></div>
						<?php }
						if(get_option("hazel_footer_columns_order") == "one_two_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-three-column-left-1_3'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php hazel_print_sidebar('footer-three-column-right-2_3'); ?></div>
						<?php }
						if(get_option("hazel_footer_columns_order") == "two_one_three"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php hazel_print_sidebar('footer-three-column-left-2_3'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-three-column-right-1_3'); ?></div>
						<?php }
					}
					if(get_option("hazel_footer_number_cols") == "four"){
						if(get_option("hazel_footer_columns_order_four") == "one_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-center-left'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-center-right'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-right'); ?></div>
						<?php }
						if(get_option("hazel_footer_columns_order_four") == "two_one_two_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-left-1_2_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-6"><?php hazel_print_sidebar('footer-four-column-center-2_2_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-3"><?php hazel_print_sidebar('footer-four-column-right-1_2_4'); ?></div>
						<?php }
						if(get_option("hazel_footer_columns_order_four") == "three_one_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php hazel_print_sidebar('footer-four-column-left-3_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-four-column-right-1_4'); ?></div>
						<?php }
						if(get_option("hazel_footer_columns_order_four") == "one_three_four"){ ?>
							<div class="footer_sidebar col-xs-12 col-md-4"><?php hazel_print_sidebar('footer-four-column-left-1_4'); ?></div>
							<div class="footer_sidebar col-xs-12 col-md-8"><?php hazel_print_sidebar('footer-four-column-right-3_4'); ?></div>
						<?php }
					}
				?>
				</div>
		    </div>
			<?php
		}
	?>

    <?php

			if (get_option('hazel_display_instagram_footer') == 'on'){
			?>
			<div id="footer-instagram">
				<?php
				if (get_option('hazel_instagram_title') != "" || get_option('hazel_instagram_title')!=" ") echo "<h4>" . wp_kses_post( get_option('hazel_instagram_title') ) . "</h4>";

				if (get_option('hazel_instagram_username') != '') {

					$media_array = treethemesscrape_instagram( get_option('hazel_instagram_username') );

					if ( is_wp_error( $media_array ) ) {
						echo wp_kses_post( $media_array->get_error_message() );
					} else {

						// filter for images only?
						if ( $images_only = apply_filters( 'treethemesinsta_images_only', FALSE ) ) {
							$media_array = array_filter( $media_array, array( $this, 'treethemesimages_only' ) );
						}

						// slice list down to required limit
						$media_array = array_slice( $media_array, 0, intval(get_option('hazel_instagram_limit')) );

						// filters for custom classes
						$ulclass = apply_filters( 'treethemesinsta_list_class', 'instagram-pics' );
						$liclass = apply_filters( 'treethemesinsta_item_class', '' );
						$aclass = apply_filters( 'treethemesinsta_a_class', '' );
						$imgclass = apply_filters( 'treethemesinsta_img_class', '' );

						?><ul class="<?php echo esc_attr( $ulclass ); ?>"><?php
						foreach ( $media_array as $item ) {
							echo '<li style="width:'. (100/intval(get_option('hazel_instagram_limit'))) .'%;" class="'. esc_attr( $liclass ) .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( get_option('hazel_instagram_target') ) .'"  class="'. esc_attr( $aclass ) .'"><img src="'. esc_url( $item['large'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. esc_attr( $imgclass ) .'"/></a></li>';
						}
						?></ul><?php
					}
				}
				$linkclass = apply_filters( 'treethemesinsta_link_class', 'clear' );
				if ( get_option('hazel_instagram_link') != '' ) {
					?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="<?php echo trailingslashit( '//instagram.com/' . esc_attr( trim( get_option('hazel_instagram_username') ) ) ); ?>" rel="me" target="<?php echo esc_attr( get_option('hazel_instagram_target') ); ?>"><?php echo esc_html( get_option('hazel_instagram_link') ); ?></a></p><?php
				}
				?>
			</div>
			<?php
	    }
	    ?>


    <?php
	    if (get_option("hazel_show_sec_footer") == "on"){
		    ?>
		    <div id="secondary_footer">
				<div class="container">

					<?php
						/* FOOTER LOGOTYPE */
						if (get_option("hazel_footer_display_logo") == 'on'){
						?>
						<a class="footer_logo align-<?php echo esc_attr(get_option("hazel_footer_logo_alignment")); ?>" href="<?php echo esc_url(home_url("/")); ?>" tabindex="-1">
				        	<?php
				    			$alone = true;
			    				if (get_option("hazel_footer_logo_retina_image_url") != ""){
				    				$alone = false;
			    				}
		    					?>
		    					<img class="footer_logo_normal <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" src="<?php echo esc_url(get_option("hazel_footer_logo_image_url")); ?>" alt="<?php esc_attr_e("", "hazel"); ?>" title="<?php esc_attr_e("", "hazel"); ?>">

			    				<?php
			    				if (get_option("hazel_footer_logo_retina_image_url") != ""){
			    				?>
				    				<img class="footer_logo_retina" style="display:none; position: relative;" src="<?php echo esc_url(get_option("hazel_footer_logo_retina_image_url")); ?>" alt="<?php esc_attr_e("", "hazel"); ?>" title="<?php esc_attr_e("", "hazel"); ?>">
			    				<?php
		    					}
			    			?>
				        </a>
						<?php
						}

						/* FOOTER SOCIAL ICONS */
						if (get_option("hazel_footer_display_social_icons") == "on"){
						?>
						<div class="social-icons-fa align-<?php echo esc_attr(get_option("hazel_footer_social_icons_alignment")); ?>">
					        <ul>
							<?php
								$icons = array(array("houzz","Houzz"),array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"));
								foreach ($icons as $i){
									if (is_string(get_option("hazel_icon-".$i[0])) && get_option("hazel_icon-".$i[0]) != ""){
									?>
									<li>
										<a href="<?php echo esc_url(get_option("hazel_icon-".$i[0])); ?>" target="_blank" class="<?php echo esc_attr(strtolower($i[0])); ?>" title="<?php echo esc_attr($i[1]); ?>"><i class="fa fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i></a>
									</li>
									<?php
									}
								}
							?>
						    </ul>
						</div>

						<?php
						}
						/* FOOTER CUSTOM TEXT */
						if (get_option("hazel_footer_display_custom_text") == "on"){
						?>
						<div class="footer_custom_text <?php echo esc_attr(get_option("hazel_footer_custom_text_alignment")); ?>"><?php echo do_shortcode(stripslashes(get_option("hazel_footer_custom_text"))); ?></div>

						<?php
						}


					?>
				</div>
			</div>
		    <?php
	    }
    ?>
	</div>

<?php

/* sets the type of pagination [scroll, autoscroll, paged, default] */
wp_reset_query();
$hazel_reading_option = get_option('hazel_blog_reading_type');
if (is_archive() || is_single() || is_search() || is_page_template('blog-template.php') || is_page_template('blog-masonry-template.php')) {

	$nposts = get_option('posts_per_page');

	$hazel_more = 0;
	$hazel_pag = 0;

	$orderby="";
	$category="";
	$nposts = "";
	$order = "";

	$hazel_pag = $wp_query->query_vars['paged'];
	if (!is_numeric($hazel_pag)) $hazel_pag = 1;
	$max = 0;

	switch ($hazel_reading_option){
		case "scrollauto":

				// Add code to index pages.
				if( !is_singular() ) {

					if (is_search()){

						$hazel_reading_option = get_option('hazel_blog_reading_type');
						$se = get_option("hazel_enable_search_everything");

						$nposts = get_option('posts_per_page');

						$hazel_pag = $wp_query->query_vars['paged'];
						if (!is_numeric($hazel_pag)) $hazel_pag = 1;

						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								's' => esc_html($_GET['s'])
							);

						    $hazel_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);

						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

						    $hazel_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);
						}

						$max = ceil($counter->post_count / $nposts);
						$hazel_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

					} else {

						$max = $wp_query->max_num_pages;
						$hazel_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

					}

					$hazel_inline_script = '
						jQuery(document).ready(function($){
							"use strict";
							if (jQuery("#reading_option").html() === "scrollauto" && !jQuery("body").hasClass("single")){
								window.hazel_loadingPoint = 0;
								//monitor page scroll to fire up more posts loader
								window.clearInterval(window.hazel_interval);
								window.hazel_interval = setInterval("hazel_monitorScrollTop()", 1000 );
							}
						});
					';
					wp_add_inline_script('hazel', $hazel_inline_script, 'after');

				} else {

				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'paged' => $hazel_pag,
	    				'post_status' => 'publish'
	    			);

	    		    $hazel_the_query = new WP_Query( $args );

		    		$max = $hazel_the_query->max_num_pages;
		    		$hazel_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

		    		$hazel_inline_script = '
						jQuery(document).ready(function($){
							"use strict";
							if (jQuery("#reading_option").html() === "scrollauto" && !jQuery("body").hasClass("single")){
								window.hazel_loadingPoint = 0;
								//monitor page scroll to fire up more posts loader
								window.clearInterval(window.hazel_interval);
								window.hazel_interval = setInterval("hazel_monitorScrollTop()", 1000 );
							}
						});
					';
					wp_add_inline_script('hazel', $hazel_inline_script, 'after');

	    		}
			break;
		case "scroll":

				// Add code to index pages.
				if( !is_singular() ) {

					if (is_search()){

						$nposts = get_option('posts_per_page');

						$se = get_option("hazel_enable_search_everything");

						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								's' => esc_html($_GET['s'])
							);

						    $hazel_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);

						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

						    $hazel_the_query = new WP_Query( $args );

						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $hazel_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);

							$counter = new WP_Query($args2);
						}

						$max = ceil($counter->post_count / $nposts);
						$hazel_pag = 1;

						$hazel_pag = $wp_query->query_vars['paged'];
						if (!is_numeric($hazel_pag)) $hazel_pag = 1;

					} else {
						$max = $wp_query->max_num_pages;
						$hazel_paged = $hazel_pag;

					}


				} else {

					$orderby = "";
					$category = "";

				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'post_status' => 'publish'
	    			);

	    		    $hazel_the_query = new WP_Query( $args );


		    		$max = $hazel_the_query->max_num_pages;
		    		$hazel_pag = 1;

					$hazel_pag = $wp_query->query_vars['paged'];
					if (!is_numeric($hazel_pag)) $hazel_pag = 1;
	    		}

			break;
	}
	?>
	<div class="hazel_helper_div" id="loader-startPage"><?php echo esc_html($hazel_pag); ?></div>
	<div class="hazel_helper_div" id="loader-maxPages"><?php echo esc_html($max); ?></div>
	<div class="hazel_helper_div" id="loader-nextLink"><?php echo next_posts($max, false); ?></div>
	<div class="hazel_helper_div" id="loader-prevLink"><?php echo previous_posts($max, false); ?></div>
	<?php
}

$hazel_styleColor = "#".esc_html(get_option("hazel_style_color"));
$hazel_bodyLayoutType = get_option("hazel_body_layout_type");
$hazel_headerType = get_option("hazel_header_type");
?>
</div> <!-- END OF MAIN -->
<div id="bodyLayoutType" class="hazel_helper_div"><?php echo esc_html($hazel_bodyLayoutType); ?></div>
<div id="headerType" class="hazel_helper_div"><?php echo esc_html($hazel_headerType); ?></div>
<?php
	if (get_option("hazel_body_shadow") == "on"){
		?>
			<div id="bodyShadowColor" class="hazel_helper_div"><?php echo "#".esc_html(get_option("hazel_body_shadow_color")); ?></div>
		<?php
	}
	$hazel_headerStyleType = get_option("hazel_header_style_type");
?>
<div id="templatepath" class="hazel_helper_div"><?php echo esc_url(get_template_directory_uri())."/"; ?></div>
<div id="homeURL" class="hazel_helper_div"><?php echo esc_url(home_url("/")); ?></div>
<div id="styleColor" class="hazel_helper_div"><?php echo "#".esc_html(get_option("hazel_style_color")); ?></div>
<div id="headerStyleType" class="hazel_helper_div"><?php echo esc_html($hazel_headerStyleType); ?></div>
<div class="hazel_helper_div" id="reading_option"><?php
	if ($hazel_reading_option == "scrollauto"){
		if (wp_is_mobile())
			$hazel_reading_option = "scroll";
	}
	echo esc_html($hazel_reading_option);
?></div>
<?php
	$hazel_color_code = get_option("hazel_style_color");
?>
<div class="hazel_helper_div" id="hazel_no_more_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'No more posts to load.', get_option('hazel_no_more_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_no_more_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_load_more_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Load More Posts', get_option('hazel_load_more_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_load_more_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_loading_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Loading posts.', get_option('hazel_loading_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_loading_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_links_color_hover"><?php echo esc_html(str_replace("__USE_THEME_MAIN_COLOR__", $hazel_color_code, get_option("hazel_links_color_hover"))); ?></div>
<div class="hazel_helper_div" id="hazel_enable_images_magnifier"><?php echo esc_html(get_option('hazel_enable_images_magnifier')); ?></div>
<div class="hazel_helper_div" id="hazel_thumbnails_hover_option"><?php echo esc_html(get_option('hazel_thumbnails_hover_option')); ?></div>
<div id="homePATH" class="hazel_helper_div"><?php echo ABSPATH; ?></div>
<div class="hazel_helper_div" id="hazel_menu_color">#<?php echo esc_html(get_option("hazel_menu_color")); ?></div>
<div class="hazel_helper_div" id="hazel_fixed_menu"><?php echo esc_html(get_option("hazel_fixed_menu")); ?></div>
<div class="hazel_helper_div" id="hazel_thumbnails_effect"><?php if (get_option("hazel_animate_thumbnails") == "on") echo esc_html(get_option("hazel_thumbnails_effect")); else echo "none"; ?></div>
<div class="hazel_helper_div loadinger">
	<img alt="<?php esc_attr_e("loading", "hazel"); ?>" src="<?php echo esc_url(get_template_directory_uri()). '/images/ajx_loading.gif' ?>">
</div>
<div class="hazel_helper_div" id="permalink_structure"><?php echo esc_html(get_option('permalink_structure')); ?></div>
<div class="hazel_helper_div" id="headerstyle3_menucolor">#<?php echo esc_html(get_option("hazel_menu_color")); ?></div>
<div class="hazel_helper_div" id="disable_responsive_layout"><?php echo esc_html(get_option('hazel_disable_responsive')); ?></div>
<div class="hazel_helper_div" id="filters-dropdown-sort"><?php esc_html_e('Sort Gallery','hazel'); ?></div>
<div class="hazel_helper_div" id="searcheverything"><?php echo esc_html(get_option("hazel_enable_search_everything")); ?></div>
<div class="hazel_helper_div" id="hazel_header_shrink"><?php if (get_option('hazel_fixed_menu') == 'on'){if (get_option('hazel_header_after_scroll') == 'on'){if (get_option('hazel_header_shrink_effect') == 'on'){echo "yes";} else echo "no";}} ?></div>
<div class="hazel_helper_div" id="hazel_header_after_scroll"><?php if (get_option('hazel_fixed_menu') == 'on'){if (get_option('hazel_header_after_scroll') == 'on'){echo "yes";} else echo "no";} ?></div>
<div class="hazel_helper_div" id="hazel_grayscale_effect"><?php echo esc_html(get_option("hazel_enable_grayscale")); ?></div>
<div class="hazel_helper_div" id="hazel_enable_ajax_search"><?php echo esc_html(get_option("hazel_enable_ajax_search")); ?></div>
<div class="hazel_helper_div" id="hazel_menu_add_border"><?php echo esc_html(get_option("hazel_menu_add_border")); ?></div>
<div class="hazel_helper_div" id="hazel_content_to_the_top">
	<?php
		if (is_singular() && get_post_meta(get_the_ID(), 'hazel_enable_custom_header_options_value', true)=='yes') echo esc_html(get_post_meta(get_the_ID(), 'hazel_content_to_the_top_value', true));
		else echo esc_html(get_option('hazel_content_to_the_top'));
	?>
</div>
<div class="hazel_helper_div" id="hazel_update_section_titles"><?php echo esc_html(get_option('hazel_update_section_titles')); ?></div>
<?php
	if (function_exists('icl_t')){
		?>
		<div class="hazel_helper_div" id="hazel_wpml_current_lang"><?php echo ICL_LANGUAGE_CODE; ?></div>
		<?php
	}
?>
<?php
	$standardfonts = array('Arial','Arial Black','Helvetica','Helvetica Neue','Courier New','Georgia','Impact','Lucida Sans Unicode','Times New Roman', 'Trebuchet MS','Verdana','');
	$importfonts = "";
	$hazel_import_fonts = hazel_get_import_fonts();

	if (is_string($hazel_import_fonts)) $hazel_import_fonts = explode( "|", $hazel_import_fonts);
	foreach ($hazel_import_fonts as $font){
		if (!in_array($font,$standardfonts)){
			$font = str_replace(" ","+",str_replace("|",":",$font));
			if ($importfonts=="") $importfonts .= $font;
			else {
				if (strpos($importfonts, $font) === false)
					$importfonts .= "|{$font}";
			}
		}
	}

	if ($importfonts!="") {
		$hazel_import_fonts = $importfonts;
		hazel_set_import_fonts($hazel_import_fonts);
		hazel_google_fonts_scripts();
	}

	if (get_option("hazel_enable_gotop") == "on"){
		?>
		<p id="back-top"><a href="#home"><i class="fa fa-angle-up"></i></a></p>
		<?php
	}

	hazel_get_team_profiles_content();
	hazel_get_custom_inline_css();

	if (get_option("hazel_body_type") == "body_boxed"){
		?>
		</div>
		<?php
	}

	wp_footer();
?>

</body>
</html>
