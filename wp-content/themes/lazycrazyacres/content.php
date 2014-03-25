<article class="post">
<header>
    <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>"
            title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?></a>
    </h2>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
        <p><?php lca_posted_on(); ?></p>
    </div><!-- .entry-meta -->
    <?php endif; ?>
</header>
<div class="content">
<?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
</div>
<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
<footer>
    <?php edit_post_link( 'Admin Edit', '<span class="edit-link">', '</span>' ); ?>
</footer>
</article>
