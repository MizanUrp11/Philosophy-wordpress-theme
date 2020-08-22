<?php get_header(); ?>


<!-- s-content
    ================================================== -->
<section class="s-content">

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
                <?php 
                the_posts_pagination(array(
                    'type'=>'list',
                    'mid_size'=> 3,
                )); 
                ?>
                
            </div>
        </div>
</section> <!-- s-content -->




<?php get_footer(); ?>