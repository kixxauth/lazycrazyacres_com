<article class="post">
<header>
    <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>"
            title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?></a>
    </h2>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
        <?php lca_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
</header>
<div class="entry-content">
    <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . 'Pages:' . '</span>', 'after' => '</div>' ) ); ?>
</div>
<footer>
    <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
</footer>
</article>
