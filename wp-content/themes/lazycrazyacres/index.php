<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php the_post(); ?>
<div id="main" role="main"><div class="inner">
<div id="page-<?php the_ID(); ?>" class="page-content">
<div class="content">
<?php the_content(); ?>
<div>
</div>
<?php get_sidebar(); ?>
</div></div><!-- end #main .inner -->

<?php get_footer(); ?>
