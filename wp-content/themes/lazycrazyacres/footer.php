<footer id="footer">
    <p class="links">
        <a href="<?php bloginfo( 'wpurl' ); ?>/"
            title="Lazy Crazy Acres Home">home</a>
        |
        <a href="<?php bloginfo( 'wpurl' ); ?>/about-lazy-crazy-acres"
            title="All About Lazy Crazy Acres">about</a>
        |
        <a href="<?php bloginfo( 'wpurl' ); ?>/blog"
            title="The Lazy Crazy Acres Blog">blog</a>
        |
        <a href="<?php bloginfo( 'wpurl' ); ?>/lazy-crazy-acres-links"
            title="Links we think you would like">links</a>
        |
        <a href="<?php bloginfo( 'wpurl' ); ?>/contact-lazy-crazy-acres"
            title="Contact Lazy Crazy Acres">contact</a>
    </p>
    <p class="contact-info">
        &copy; 2011 Lazy Crazy Acres
        |
        845-802-4098
        |
        info@LazyCrazyAcres.com
    </p>
    <p class="credits">
        <a href="http://www.chloeartanddesign.com"
            title="Home page for Chloe Art and Design" target="_blank">
            Website by Chloe Art and Design
        </a>
    </p>
</footer>
</div><!-- end #wrapper -->

<div id="top-nav">
<ul class="top-nav">
    <li class="ir twitter">
        <a href="http://twitter.com/#!/LazyCrazyAcres" target="_blank">Twitter</a>
    </li>
    <li class="ir facebook">
        <a href="http://www.facebook.com/pages/Lazy-Crazy-Acres/127652313955969" target="_blank">
            Facebook</a>
    </li>
    <li>
        <?php
        if ( is_page( 'contact-lazy-crazy-acres' ) ) {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/contact-lazy-crazy-acres" class="active">contact</a>';
        } else {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/contact-lazy-crazy-acres">contact</a>';
        }
        ?>
    </li>
    <li>
        <?php
        if ( !is_page() ) {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/blog" class="active">blog</a>';
        } else {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/blog">blog</a>';
        }
        ?>
    </li>
    <li>
        <?php
        if ( is_page( 'welcome-to-lazy-crazy-acres' ) ) {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/" class="active">home</a>';
        } else {
            echo '<a href="' . get_bloginfo( 'wpurl' ) . '/">home</a>';
        }
        ?>
    </li>
    <li class="lca-cow">
        <img src="<?php echo get_template_directory_uri(); ?>/images/little-cow.gif"
            width="31" height="16" alt="Little Cow" />
    </li>
</ul>
</div>

<?php

$custom_fields = get_post_custom();
$scripts = $custom_fields['script'];

if ( isset( $scripts ) ) { ?>
    <script>var gG={templateDir:'<?php echo get_template_directory_uri() ?>'};</script>
<?php
    foreach ( $scripts as &$path )  {
        if ( $path == 'jquery.js' ) {
            echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';
        } else {
            echo '<script src="' . get_template_directory_uri() . '/js/' . $path . '"></script>';
        }
    }
}

?>
</body>
</html>
