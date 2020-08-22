<?php get_header();?>


<!-- s-content
    ================================================== -->
<section class="s-content">

    <h4 class="text-center">
        <?php
            $philosophy_single_cat_title = single_cat_title();
        _e( $philosophy_single_cat_title, "philosophy" );?>
    </h4>
    <?php
        $philosophy_term = get_queried_object();
        $philosophy_term_meta = get_term_meta( $philosophy_term->term_id, 'language_featured_image', true );
        if ( isset( $philosophy_term_meta['language_image'] ) && $philosophy_term_meta['language_image'] > 0 ) {
            echo wp_get_attachment_image( $philosophy_term_meta['language_image'], 'medium' );
        }
    ?>
    <div class="row masonry-wrap">
        <div class="masonry">

            <div class="grid-sizer"></div>

            <?php
                while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/post-formats/post', get_post_format() );
                }
            ?>


        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->



        <div class="row">
            <div class="col-full">
                <?php
                    the_posts_pagination( array(
                        'type'     => 'list',
                        'mid_size' => 3,
                    ) );
                ?>

            </div>
        </div>
</section> <!-- s-content -->




<?php get_footer();?>