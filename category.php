<?php get_header(); ?>


<!-- s-content
================================================== -->
<section class="s-content">
    
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <?php echo apply_filters("philosophy_text","Hello","world","Mizan") ?>
            <h1><?php _e("Category:","philosophy"); ?> <?php single_cat_title(); ?></h1>
            <?php
            if (!have_posts()) {

            ?>
                <p class="lead">
                    <?php echo __('No Posts in this category','philosophy'); ?>
                </p>
            <?php
            } else {
            ?>
                <p class="lead">
                    <?php echo category_description(); ?>
                </p>
            <?php
            }
            ?>
            <?php do_action("philosophy_category_page", single_cat_title('', false)); ?>
        </div>
    </div>


    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/post-formats/post', get_post_format());
            }
            ?>


        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->


    <div class="row">
        <div class="col-full">
            <nav class="pgn">
                <?php the_pagination_links(); ?>
            </nav>
        </div>
    </div>
</section> <!-- s-content -->


<?php get_footer(); ?>