<?php /* Template Name: Contact Template */ ?>

<?php
the_post();
get_header(); ?>


<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-standard">

        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                <?php the_title(); ?>
            </h1>

        </div> <!-- end s-content__header -->


        <div class="col-full s-content__main">


            <div>
                <?php
                if (is_active_sidebar("contact-us-map")) {
                    dynamic_sidebar("contact-us-map");
                }
                ?>
            </div>


            <?php the_content(); ?>

            <div class="row">
                <?php
                if (is_active_sidebar("contact-us")) {
                    dynamic_sidebar("contact-us");
                }
                ?>
            </div>


            <h3><?php _e("Say Hello.","philosophy"); ?></h3>

            <div>
                <?php
                if (get_field("contact_form_shortcode")) {
                    echo do_shortcode(get_field("contact_form_shortcode"));
                }
                ?>
            </div>



        </div> <!-- end s-content__main -->

    </article>




</section> <!-- s-content -->



<?php get_footer(); ?>