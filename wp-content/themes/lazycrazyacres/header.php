<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Lazy Crazy Acres</title>
  <meta name="description" content="Catskill Mountain grazing farm producting farmstead ice creams and bottled creamline milk.">
  <meta name="author" content="Lazy Crazy Acres">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
  <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.93064.js"></script>
</head>

<body><div id="wrapper">

<?php
lca_header_frame(); ?>

<nav id="navigation">
    <ul class="navigation">
        <li><a href="<?php bloginfo( 'wpurl' ); ?>/about-lazy-crazy-acres"
            <?php if ( is_page( 'about-lazy-crazy-acres' ) ) { echo 'class="active"'; } ?>
            title="All About Lazy Crazy Acres">
            <?php lca_title_by_path('about-lazy-crazy-acres'); ?></a></li>

        <li><a href="<?php bloginfo( 'wpurl' ); ?>/lazy-crazy-acres-creamery"
            <?php if ( is_page( 'lazy-crazy-acres-creamery' ) ) { echo 'class="active"'; } ?>
            title="The Lazy Crazy Acres Creamery">
            <?php lca_title_by_path('lazy-crazy-acres-creamery'); ?></a></li>

        <li><a href="<?php bloginfo( 'wpurl' ); ?>/lazy-crazy-acres-farm-table"
            <?php if ( is_page( 'lazy-crazy-acres-farm-table' ) ) { echo 'class="active"'; } ?>
            title="Good Home Cooking from Lazy Crazy Acres">
            <?php lca_title_by_path('lazy-crazy-acres-farm-table'); ?></a></li>

        <li><a href="<?php bloginfo( 'wpurl' ); ?>/lazy-crazy-acres-event-calendar"
            <?php if ( is_page( 'lazy-crazy-acres-event-calendar' ) ) { echo 'class="active"'; } ?>
            title="The Lazy Crazy Acres Calendar">
            <?php lca_title_by_path('lazy-crazy-acres-event-calendar'); ?></a></li>

        <li><a href="<?php bloginfo( 'wpurl' ); ?>/lazy-crazy-acres-links"
            <?php if ( is_page( 'lazy-crazy-acres-links' ) ) { echo 'class="active"'; } ?>
            title="Links we think you would like">
            <?php lca_title_by_path('lazy-crazy-acres-links'); ?></a></li>
    </ul>
</nav>
