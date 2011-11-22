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
