<?php /* Template Name: About Us Template */?>

<?php
    the_post();
    get_header();
?>


<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-standard">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?php the_title();?>
            </h1>

        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <div class="s-content__post-thumb">
                <?php the_post_thumbnail( 'large' );?>
            </div>
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            <?php the_content();?>


            <div class="row block-1-2 block-tab-full">
                <?php
                    if ( is_active_sidebar( "about-us" ) ) {
                        dynamic_sidebar( "about-us" );
                    }
                ?>
            </div>
            <div class="row block-1-2 block-tab-full">
                <?php
                    $philosophy_page_meta = get_post_meta( get_the_ID(), 'page_metabox', true );
                    echo '<h2>' . esc_html( $philosophy_page_meta['page_heading'] ) . '</h2>';
                    echo '<p>' . esc_html( $philosophy_page_meta['page_excerpt'] ) . '</p>';
                    // if ( $philosophy_page_meta['is_favorite'] ) {
                    //     echo '<p>' . __( 'Switch On', 'philosophy' ) . '</p>';
                    // } else {
                    //     echo '<p>' . __( 'Switch Off', 'philosophy' ) . '</p>';
                    // }
                    // if ( $philosophy_page_meta['is_favorite'] ) {
                    //     $is_favorite_text = $philosophy_page_meta['is_favorite_text'];
                    //     echo '<p>' . esc_html__( $is_favorite_text, 'philosophy' ) . '</p>';
                    // } else {
                    //     echo '<p>' . __( 'Switch Off', 'philosophy' ) . '</p>';
                    // }
                ?>
            </div>


        </div> <!-- end s-content__main -->

    </article>




</section> <!-- s-content -->



<?php get_footer();?>