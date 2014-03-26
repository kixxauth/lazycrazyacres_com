<?php
/*
Template Name: Contact-Us
*/
get_header();
the_post(); ?>

<div id="main" role="main"><div class="inner">
<div id="page-<?php the_ID(); ?>" class="page-content contact-us">
    <?php lca_page_title_frame(); ?>
    <div class="content">
    <?php the_content(); ?>
    </div>
    <form id="contact-form" action="<?php bloginfo( 'wpurl' ); ?>/contact-us-post/" method="POST">
        <fieldset class="first">
            <label for="id_name" class="lca">name:</label>
            <input id="id_name" type="text" class="lca" name="contact_name" size="32" />
        </fieldset>
        <fieldset>
            <label for="id_email" class="lca">email:</label>
            <input id="id_email" type="text" class="lca" name="contact_email" size="30" />
        </fieldset>
        <fieldset>
            <label for="id_comment" class="lca">leave a comment:</label>
            <textarea id="id_comment" class="lca" name="contact_message"
                cols="50" rows="8"></textarea>
        </fieldset>
        <fieldset class="form-buttons">
            <input type="reset" value="clear" class="lca" />
            <input type="submit" value="submit" class="lca" />
        </fieldset>
    </form>
    <div id="thank-you" style="display: none;">
        <p>Thanks so much for dropping us a note!</p>
    </div>
</div>
</div></div><!-- end #main .inner -->

<script type="text/html">
$('#contact-form').submit(function (ev) {
    ev.preventDefault();
    var re = /^[a-z0-9][^\(\)\<\>\@\,\;\:\\\"\[\]]*\@[a-z0-9][a-z0-9\-\.]*\.[a-z]{2,4}$/i;
    var email = $('#id_email').val();
    if (!email) {
        alert("Ooops. Make sure you enter your email address before sending the form.");
        return false;
    }
    if (!re.test(email)) {
        alert("Ooops. Try re-typing your email address, it doesn't look correct");
        return false;
    }
});
</script>

<?php get_footer(); ?>
