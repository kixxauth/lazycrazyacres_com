<?php
/*
Template Name: Calendar
*/
get_header();
the_post(); ?>

<div id="main" role="main"><div class="inner">
<div id="page-<?php the_ID(); ?>" class="page-content contact-us">
    <?php lca_page_title_frame(); ?>
    <div class="content">
    <?php the_content(); ?>
    </div>
</div>
</div></div><!-- end #main .inner -->
<?php get_footer(); ?>
