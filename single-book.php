<?php
get_header();
the_post();
?>


<!-- s-content
    ================================================== -->
<section class="s-content s-content--narrow s-content--no-padding-bottom">

    <article class="row format-standard">

        <div class="s-content__header col-full">
            <?php
            do_action("philosophy_before_title");
            ?>
            <h1 class="s-content__header-title">
                <?php the_title(); ?>
            </h1>
            <?php
            do_action('philosophy_after_title');
            ?>
            <ul class="s-content__header-meta">
                <li class="date"><?php the_date(); ?></li>
                <li class="cat">
                    In
                    <?php echo get_the_category_list(' '); ?>
                </li>
            </ul>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <div class="s-content__post-thumb">
                <?php the_post_thumbnail('large'); ?>
            </div>
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            <?php
            the_content();
            wp_link_pages();

            $philosophy_attached_chapters = get_post_meta(get_the_ID(), 'attached_cmb2_attached_posts', true);
            if ($philosophy_attached_chapters) {
                foreach ($philosophy_attached_chapters as $pac) {
                    $philosophy_chapter_title = get_the_title($pac);
                    $philosophy_chapter_link = get_the_permalink($pac);
            ?>
                    <a href="<?php echo esc_attr($philosophy_chapter_link) ?>"><?php echo esc_html($philosophy_chapter_title) ?></a><br>
            <?php
                }
            }

            ?>

            <p class="s-content__tags">
                <span>Post Tags</span>

                <span class="s-content__tag-list">
                    <?php echo get_the_tag_list(); ?>
                </span>
            </p> <!-- end s-content__tags -->

            <p class="s-content__tags">
                <span><?php _e("Languages", "philosophy"); ?></span>

                <span class="s-content__tag-list">
                    <?php the_terms(get_the_ID(), 'language', '', '', ''); ?>
                </span>
            </p> <!-- end s-content__tags -->

            <div class="s-content__author">
                <img src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>">

                <div class="s-content__author-about">
                    <h4 class="s-content__author-name">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta("ID"))); ?>"><?php the_author(); ?></a>
                    </h4>

                    <p>
                        <?php echo get_the_author_meta('description'); ?>
                    </p>

                    <ul class="s-content__author-social">
                        <?php
                        $philosophy_facebook = get_field('facebook', "user_" . get_the_author_meta('ID'));
                        $philosophy_twitter = get_field('twitter', "user_" . get_the_author_meta('ID'));
                        $philosophy_google_plus = get_field('google_plus', "user_" . get_the_author_meta('ID'));
                        $philosophy_instagram = get_field('instagram', "user_" . get_the_author_meta('ID'));
                        ?>
                        <?php if ($philosophy_facebook) : ?>
                            <li><a href="<?php echo esc_url($philosophy_facebook); ?>">Facebook</a></li>
                        <?php endif; ?>
                        <?php if ($philosophy_google_plus) : ?>
                            <li><a href="<?php echo esc_url($philosophy_google_plus); ?>">Google Plus</a></li>
                        <?php endif; ?>
                        <?php if ($philosophy_twitter) : ?>
                            <li><a href="<?php echo esc_url($philosophy_twitter); ?>">Twitter</a></li>
                        <?php endif; ?>
                        <?php if ($philosophy_instagram) : ?>
                            <li><a href="<?php echo esc_url($philosophy_instagram); ?>">Instagram</a></li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>

            <div class="s-content__pagenav">
                <div class="s-content__nav">
                    <?php
                    $philosophy_previous_post = get_previous_post();
                    if ($philosophy_previous_post) :
                    ?>
                        <div class="s-content__prev">
                            <a href="<?php echo get_the_permalink($philosophy_previous_post); ?>" rel="prev">
                                <span><?php _e("Previous Post", "philosophy"); ?></span>
                                <?php echo get_the_title($philosophy_previous_post); ?>
                            </a>
                        </div>

                    <?php endif; ?>
                    <?php
                    $philosophy_next_post = get_next_post();
                    if ($philosophy_next_post) :
                    ?>
                        <div class="s-content__next">
                            <a href="<?php echo get_the_permalink($philosophy_next_post); ?>" rel="next">
                                <span><?php _e('Next Post', 'philosophy') ?></span>
                                <?php echo get_the_title($philosophy_next_post); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div> <!-- end s-content__pagenav -->

        </div> <!-- end s-content__main -->

    </article>


    <!-- comments
        ================================================== -->
    <?php
    if (!post_password_required()) {
        if (comments_open()) {
            comments_template();
        }
    }
    ?>

</section> <!-- s-content -->




<?php get_footer(); ?>