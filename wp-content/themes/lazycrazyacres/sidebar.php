<ul class="sidebar <?php echo get_post_type(); ?>">
<?php
if (get_post_type() == 'page') {
    dynamic_sidebar( 'main-sidebar' );
} else {
    dynamic_sidebar( 'blog-sidebar' );
}
?>
</ul>
