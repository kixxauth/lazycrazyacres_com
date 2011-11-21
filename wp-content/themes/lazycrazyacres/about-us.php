<?php
/*
Template Name: About-Us
*/
get_header();
the_post(); ?>

<div id="main" role="main"><div class="inner">
<div id="page-<?php the_ID(); ?>" class="page-content">
    <p class="page-links">
        <a href="<?php bloginfo( 'wpurl' ); ?>/how-we-farm">How We Farm</a>
        &nbsp;|&nbsp;
        <a href="<?php bloginfo( 'wpurl' ); ?>/history-of-lazy-crazy-acres">Crystal Valley Farm</a>
        &nbsp;|&nbsp;
        <a href="<?php bloginfo( 'wpurl' ); ?>/press">Press</a>
    </p>
    <?php lca_page_title_frame(); ?>
    <div class="content">
    <?php the_content(); ?>
    <div>
</div>
<?php get_sidebar(); ?>
</div></div><!-- end #main .inner -->

<?php get_footer(); ?>
