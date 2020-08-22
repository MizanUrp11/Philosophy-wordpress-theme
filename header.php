<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
<title><?php wp_title( '|', true ); ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php wp_head(); ?>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top" <?php body_class( ); ?>>
<?php wp_body_open(); ?>

    <!-- pageheader
    ================================================== -->
    <section class="s-pageheader <?php if (is_home()) {
                                        echo "s-pageheader--home";
                                    } ?>">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo "<h1><a href='" . home_url("/") . "'>" . get_bloginfo("name") . "</a></h1>";
                    }
                    ?>
                    <!-- <a class="logo" href="index.html">
                        <img src="<?php //echo get_template_directory_uri(); 
                                    ?>/assets/images/logo.svg" alt="Homepage">
                    </a> -->
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <?php
                    if(function_exists('get_field')){
                    if (get_field("fb", 'user_2')) {
                    ?>
                        <li>
                            <a href="<?php the_field("fb", 'user_2'); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (get_field("tw", "user_2")) {
                    ?>
                        <li>
                            <a href="<?php echo the_field("tw", "user_2") ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if (get_field("ins", "user_2")) {
                    ?>
                        <li>
                            <a href="<?php echo the_field("ins", "user_2") ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (get_field("pin", "user_2")) {
                    ?>
                        <li>
                            <a href="<?php echo the_field("pin", "user_2") ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                }
                    ?>
                </ul> <!-- end header__social -->

                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <?php echo get_search_form(); ?>

                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

                </div> <!-- end header__search -->



                <?php get_template_part('template-parts/common/navigation'); ?>




            </div> <!-- header-content -->
        </header> <!-- header -->


        <?php
        if (is_home()) {
            get_template_part('template-parts/blog-home/featured');
        }
        ?>

    </section> <!-- end s-pageheader -->