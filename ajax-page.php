<?php

/**
 * Template Name: Ajax Page
 */
get_header();
?>

<section class="s-content">
    <div class="row masonry-wrap">
        <form action="<?php echo home_url('/'); ?>" method="post">
            <label for="info">Name</label>
            <input type="text" name="name" id="info">
            <?php wp_nonce_field('ajaxtest'); ?>
            <input type="submit" value="post via ajax" id="ajaxSubmit">
        </form>


    </div>
</section>


<?php get_footer(); ?>