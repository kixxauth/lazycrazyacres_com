<?php
/*
Template Name: Creamery
*/
get_header();
the_post(); ?>

<div id="main" role="main"><div class="inner">
<div id="page-<?php the_ID(); ?>" class="page-content creamery">
    <p class="page-links">
        &raquo; <a href="<?php bloginfo( 'wpurl' ); ?>/where-to-buy">Find Out Where to Buy</a>
    </p>
    <?php lca_page_title_frame(); ?>
    <div class="content">
    <?php the_content(); ?>
    </div>
</div>
<?php get_sidebar(); ?>
</div></div><!-- end #main .inner -->

<?php get_footer(); ?>
