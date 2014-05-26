<?php

class LCA_Facebook_Widget extends WP_Widget {
	function LCA_Facebook_Widget() {
		$widget_opts = array( 'classname' => 'lca_facebook', 'description' => 'LCA Facebook Link');
		$this->WP_Widget( 'lca-facebook', 'LCA Facebook Link', $widget_opts);
		$this->alt_option_name = 'widget_lca_facebook';
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		?>
		<p class="ir">Find us on Facebook for updates and info!</p>
			<a href="http://www.facebook.com/pages/Lazy-Crazy-Acres/127652313955969" target="_blank"
				title="Facebook page">
			<img src="<?php echo get_template_directory_uri() . '/images'; ?>/facebook-callout.png"
				width="220" height="88" alt="Facebook icon" />
		</a>
		<?php
		echo '</li>';
	}
}

function lca_custom_image_url($attr) {
	$parts = parse_url(site_url());
	$hostname_regex = '/^https?:\/\/((www|test).lazycrazyacres.com|localhost)\//i';
	$rv = preg_replace($hostname_regex, '', $attr);
	if ($rv[0] !== '/') {
		$rv = '/' . $rv;
	}
	return $rv;
}

function lca_page_title_frame() {
	$custom_fields = get_post_custom();
	$page_title = $custom_fields['page_title'][0];
	if ($custom_fields['title_image'][0]) {
		$title_image = lca_custom_image_url($custom_fields['title_image'][0]);
		echo '<h4 class="page-title ir" style="background-image: url(' . $title_image . ');">';
	} else {
		echo '<h4 class="page-title">';
	}
	echo $page_title . '</h4>';
}

function lca_get_title() {
	if ( isset( $custom_fields['page_title'] ) ) {
		$page_title = $custom_fields['page_title'][0];
	} else {
		$post = get_post(get_the_ID());
		$page_title = $post->post_title;
	}
	return $page_title;
}

function lca_title_by_path($path) {
	$page = get_page_by_path($path);
	echo $page->post_title;
}

function lca_header_frame() {
	$custom_fields = get_post_custom();
	if ( is_page() && array_key_exists('header_image', $custom_fields) ) {
		$header_field = $custom_fields['header_image'][0];
	} else {
		// Dirty ugly hack. WordPress sucks.
		$header_field = "/wp-content/uploads/2012/05/header5.png";
	}

	$bg_image = lca_custom_image_url($header_field);
	$is_homepage = is_page( 'welcome-to-lazy-crazy-acres' );
	if ( $is_homepage ) {
		echo '<header class="page-header homepage">';
	} else {
		echo '<header class="page-header" style="background-image: url(' . $bg_image . ');">';
	} ?>
	<a class="logo-block" href="<?php echo get_bloginfo( 'wpurl' ) ?>" title="Lazy Crazy Acres" rel="home">
	<div class="logo-block">
	<h1 class="ir"><?php echo lca_get_title(); ?></h1>
	<h2 class="ir">Lazy Crazy Acres is a Catskill Mountain grazing farm and creamery.</h2>
	<?php
	if ( $is_homepage ) { ?>
		</div></a>
		<div id="proposition" class="ir">
			<p>Ice creams and fresh dairy;</p>
			<p>Farmstead ice creams and bottled creamline milk.</p>
		</div>
		<div id="slideshow">
		<img src="<?php echo get_template_directory_uri(); ?>/images/slide0.png"
			width="421" height="328" alt="slideshow image" />
		</div>
		</header>
	<?php
	} else {
		echo '</div></a></header>';
	}
}

if ( ! function_exists( 'lca_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function lca_posted_on() {
	printf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( 'View all posts by %s', get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 */
function lca_widgets_init() {

	register_widget( 'LCA_Facebook_Widget' );

	register_sidebar( array(
		'name' => 'Main Sidebar',
		'id' => 'main-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</div></li>",
		'before_title' => '<div class="widget-top"></div><div class="widget-content"><h3 class="widget-title">',
		'after_title' => '</h3>'
	) );

	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</div></li>",
		'before_title' => '<div class="widget-top"></div><div class="widget-content"><h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
}
add_action( 'widgets_init', 'lca_widgets_init' );

/**
 * Filter the built in Wordpress gallery
 */
function lca_post_gallery($output, $attr) {
	global $post;

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
	), $attr));

	$id = intval($id);
	if ('RAND' == $order) $orderby = 'none';

	if (!empty($include)) {
		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if (empty($attachments)) return '';

	$output = "<div class=\"lca-gallery\">\n";

	$idx = 0;
	foreach ($attachments as $id => $attachment) {
		$img = wp_prepare_attachment_for_js($id);
		$url = $img['sizes']['medium']['url'];
		$height = $img['sizes']['medium']['height'];
		$width = $img['sizes']['medium']['width'];
		$alt = $img['alt'];
		$caption = $img['caption'];
		if ( $idx++ % 2 == 0 ) {
			$classname = 'left';
		} else {
			$classname = 'right';
		}

		$output .= "<div class=\"lca-gallery__item lca-gallery__item--{$classname}\">";
		$output .= "<figure class=\"lca-gallery-figure\">";
		$output .= '<div class="lca-gallery-thumb"><div class="lca-gallery-thumb__inner">';
		$output .= "<div class=\"lca-gallery-thumb__center\">\n";
		$output .= "<img src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\" />\n";
		$output .= "</div></div></div>\n";
		$output .= "<figcaption class=\"wp-caption-text\">{$caption}</figcaption>\n";
		$output .= "</figure>\n";
		$output .= "</div>\n";
	}

	$output .= "</div>\n";

	return $output;
}
add_filter('post_gallery', 'lca_post_gallery', 10, 2);

?>
