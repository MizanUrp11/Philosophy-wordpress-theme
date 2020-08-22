<?php
$philosophy_audio_link = "";
if (function_exists("the_field")) :
    $philosophy_audio_link = get_field("source_file");
?>
    <article <?php post_class( 'masonry__brick entry format-audio' ); ?> data-aos="fade-up">

        <div class="entry__thumb">
            <a href="<?php the_permalink(); ?>" class="entry__thumb-link">
                <?php the_post_thumbnail('philosophy-square'); ?>
            </a>
            <div class="audio-wrap">
                <audio id="player" src="<?php echo get_template_directory_uri(); ?> <?php echo wp_kses_post($philosophy_audio_link); ?>" width="100%" height="42" controls="controls"></audio>
            </div>
        </div>

        <?php echo get_template_part('/template-parts/common/post/summary'); ?>

    </article> <!-- end article -->
<?php endif; ?>