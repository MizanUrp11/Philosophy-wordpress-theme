<?php
    require_once get_theme_file_path( '/inc/tgm.php' );
    require_once get_theme_file_path( '/lib/attachments.php' );
    require_once get_theme_file_path( '/inc/cmb2-attached-posts.php' );
    require_once get_theme_file_path( '/lib/codestar-framework/cs-framework.php' );
    require_once get_theme_file_path( '/inc/cs.php' );

    if ( site_url() == 'http://localhost/wp' ) {
        define( "VERSION", time() );
    } else {
        define( "VERSION", wp_get_theme()->get( 'Version' ) );
    }
    ;

    if ( !isset( $content_width ) ) {
        $content_width = 960;
    }

    function philosophy_theme_setup() {
        load_theme_textdomain( 'philosophy', get_theme_file_path( "/languages" ) );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-logo' );
        add_theme_support( 'html5', array( 'search-form', 'comment-list' ) );
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'quote', 'audio', 'video', 'link' ) );
        add_editor_style( '/assets/css/editor-style.css' );
        register_nav_menu( "topmenu", __( "Top Menu", "philosophy" ) );
        register_nav_menu( "footerleft", __( "Footer Left Menu", "philosophy" ) );
        register_nav_menu( "footermiddle", __( "Footer Middle Menu", "philosophy" ) );
        register_nav_menu( "footerright", __( "Footer Right Menu", "philosophy" ) );

        add_image_size( 'philosophy-square', 400, 400, true );
    }
    add_action( 'after_setup_theme', 'philosophy_theme_setup' );

    function philosophy_assets() {
        wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/font-awesome/css/font-awesome.min.css' ), null, VERSION );
        wp_enqueue_style( 'philosophy-fonts', get_theme_file_uri( '/assets/css/fonts.css' ), null, '1.0.0' );
        wp_enqueue_style( 'philosophy-base-css', get_theme_file_uri( '/assets/css/base.css' ), null, VERSION );
        wp_enqueue_style( 'philosophy-vendor-css', get_theme_file_uri( '/assets/css/vendor.css' ), null, '1.0.0' );
        wp_enqueue_style( 'philosophy-main-css', get_theme_file_uri( '/assets/css/main.css' ), null, '1.0.0' );
        wp_enqueue_style( 'philosophy-leaflet-css', '//unpkg.com/leaflet@1.6.0/dist/leaflet.css', null, '1.0.0' );
        wp_enqueue_style( 'philosophy-tiny-css', get_theme_file_uri( '/assets/css/tiny-slider.css' ), null, '1.0.0' );

        wp_enqueue_style( 'philosophy-css', get_stylesheet_uri(), null, VERSION );

        wp_enqueue_script( 'modernizr', get_theme_file_uri( 'assets/js/modernizr.js' ), null, '1.0.0', false );
        wp_enqueue_script( 'pace-min', get_theme_file_uri( 'assets/js/pace.min.js' ), null, '1.0.0', false );
        wp_enqueue_script( 'leaflet-js', '//unpkg.com/leaflet@1.6.0/dist/leaflet.js', null, '1.0.0', false );
        wp_enqueue_script( 'plugins', get_theme_file_uri( 'assets/js/plugins.js' ), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'tiny-plugins', get_theme_file_uri( 'assets/js/tiny-slider.js' ), array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'main', get_theme_file_uri( 'assets/js/main.js' ), array( 'jquery' ), '1.0.0', true );
        if ( is_singular() ) {
            wp_enqueue_script( "comment-reply" );
        }
        if ( is_page_template( 'ajax-page.php' ) ) {
            wp_enqueue_script( 'ajax-test', get_theme_file_uri( 'assets/js/ajaxTest.js' ), array( 'jquery' ), VERSION, true );
            $ajaxurl = admin_url( 'admin-ajax.php' );
            wp_localize_script( 'ajax-test', 'urls', array( 'ajaxurl' => $ajaxurl ) );
        }
        wp_enqueue_script( 'custom-js', get_theme_file_uri( 'assets/js/script.js' ), array( 'jquery' ), VERSION, true );
    }
    add_action( 'wp_enqueue_scripts', 'philosophy_assets' );

    function the_pagination_links() {
        global $wp_query;
        $links = paginate_links(
            array(
                'current'  => max( 1, get_query_var( 'paged' ) ),
                'total'    => $wp_query->max_num_pages,
                'type'     => 'list',
                'mid_size' => 3,
            )
        );
        $links = str_replace( 'page-numbers', 'pgn__num', $links );
        $links = str_replace( "<ul class='pgn__num'>", "<ul>", $links );
        $links = str_replace( "next pgn__num", "pgn__next", $links );
        $links = str_replace( "prev pgn__num", "pgn__prev", $links );
        echo esc_url( $links );
        wp_reset_query();
    }

    remove_action( 'term_description', 'wpautop' );

    function philosophy_widgets() {
        register_sidebar( array(
            'name'          => __( 'About Us', 'philosophy' ),
            'id'            => 'about-us',
            'description'   => __( 'Widgets in this area ', 'philosophy' ),
            'before_widget' => '<div id="%1$s" class="col-block %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="quarter-top-margin">',
            'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
            'name'          => __( 'Contact Us', 'philosophy' ),
            'id'            => 'contact-us',
            'description'   => __( 'Left Widgets in this area ', 'philosophy' ),
            'before_widget' => '<div id="%1$s" class="col-six tab-full %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="">',
            'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
            'name'          => __( 'Contact Us Map', 'philosophy' ),
            'id'            => 'contact-us-map',
            'description'   => __( 'Map Widgets in this area ', 'philosophy' ),
            'before_widget' => '<div id="%1$s" class="map-wrap %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => '',
        ) );
        register_sidebar( array(
            'name'          => __( 'Footer Right Section', 'philosophy' ),
            'id'            => 'footer-right',
            'description'   => __( 'Footer Right section ', 'philosophy' ),
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'philosophy_widgets' );

    function philosophy_search_form( $form ) {
        $home_dir = home_url( "/" );
        $label = __( "Search for:", "philosophy" );
        $search = __( "Search", "philosophy" );
        $search_placeholder = __( "Type Keywords", "philosophy" );
        $post_type = <<<PT
    <input type="hidden" name="post_type" value="post">
    PT;
        if ( is_post_type_archive( 'book' ) ) {
            $post_type = <<<PT
        <input type="hidden" name="post_type" value="book">
        PT;
        }
        $newForm = <<<FORM
    <form role="search" method="get" class="header__search-form" action="{$home_dir}">
        <label>
            <span class="hide-content">{$label}</span>
            <input type="search" class="search-field" placeholder="{$search_placeholder}" value="" name="s" title="{$label}" autocomplete="off">
        </label>
        {$post_type}
        <input type="submit" class="search-submit" value="{$search}">
    </form>
FORM;

        return $newForm;
    }
    add_filter( 'get_search_form', "philosophy_search_form" );

    $args[] = array(
        'avatar_size' => 50,
    );
    function mytheme_comment( $comment, $depth, $args ) {
        if ( 'div' === $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
    ?>
    <<?php echo wp_kses_post( $tag ); ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' );?>>
        <div class="comment__avatar">
            <?php $avatar = get_avatar( $comment, $args['avatar_size'] );
                    echo wp_kses_post( $avatar );
                ?>
        </div>
        <div class="comment__content">

            <div class="comment__info">
                <?php printf( '<cite>%s</cite>', get_comment_author_link() );?>

                <div class="comment__meta">
                    <time class="comment__time">
                        <?php printf( '%1$s @ %2$s', get_comment_date(), get_comment_time() );?>
                    </time>
                    <a class="reply" href="
                    <?php
                        comment_reply_link( array_merge(
                                array(
                                    'add_below' => $add_below,
                                    'depth'     => $depth,
                                    'max-depth' => $args['max_depth'],
                                )
                            ) );
                        ?>
                    ">Reply</a>
                </div>
            </div>

            <div class="comment__text">
                <?php comment_text();?>
            </div>

        </div>
    <?php
        }

        function before_title_content() {
            echo '<p>This is before title</p>';
        }
        add_action( 'philosophy_before_title', 'before_title_content' );

        function after_title_content() {
            echo '<p>This is after title</p>';
        }
        add_action( 'philosophy_after_title', 'after_title_content' );

        function beginning_category_page( $category_title ) {
            if ( "No Posts" == $category_title ) {
                $visit_count = get_option( "category_new" );
                echo _e( "Total visit: ", "philosophy" ) . esc_html( $visit_count );
                $visit_count++;
                update_option( "category_new", $visit_count );
            }
        }
        add_action( "philosophy_category_page", "beginning_category_page" );

        function philosophy_text( $text1, $text2, $text3 ) {
            return strtolower( $text1 ) . " " . strtoupper( $text2 ) . " " . strtolower( $text3 );
        }
        add_filter( "philosophy_text", "philosophy_text", 10, 3 );

        function philosophy_chapter_link_rewrite( $post_link, $id ) {
            $p = get_post( $id );

            if ( is_object( $p ) && 'chapter' == get_post_type( $p ) ) {
                $parent_book_id = get_field( "parent_books" );
                $parent_chapter_post = get_post( $parent_book_id );
                $post_link = str_replace( "%book%", $parent_chapter_post->post_name, $post_link );
            }

            if ( is_object( $p ) && 'book' == get_post_type( $p ) ) {

                $genre = wp_get_post_terms( $p->ID, array( 'genre' ) );

                if ( is_array( $genre ) && count( $genre ) > 0 ) {
                    $slug = $genre[0]->slug;
                    $post_link = str_replace( "%genre%", $slug, $post_link );
                } else {
                    $slug = 'generic';
                    $post_link = str_replace( "%genre%", $slug, $post_link );
                }
            }

            return $post_link;
        }
        add_filter( 'post_type_link', 'philosophy_chapter_link_rewrite', 1, 2 );

        function philosophy_footer_tag_heading_fix( $title ) {
            if ( is_post_type_archive( 'book' ) || is_tax( 'language' ) ) {
                $title = __( 'Languages', 'philosophy' );
            }
            return $title;
        }
        add_filter( 'philosophy_footer_tag_heading', 'philosophy_footer_tag_heading_fix' );

        function philosophy_tag_items_languages( $tags ) {
            if ( is_post_type_archive( 'book' ) || is_tax( 'language' ) ) {
                $tags = get_terms( array(
                    'taxonomy'   => 'language',
                    'hide_empty' => false,
                ) );
            }
            return $tags;
        }
        add_filter( 'philosophy_tag_items', 'philosophy_tag_items_languages' );

        //Ajax request for only logged in users
        function philosophy_ajax_function() {
            $info = $_POST['info'];
            echo strtoupper( $info );
            die();
        }
        add_action( 'wp_ajax_ajaxtest', 'philosophy_ajax_function' );

        //Ajax request for all users
        function philosophy_ajax_nopriv_function() {
            if ( check_ajax_referer( 'ajaxtest', 's' ) ) {
                $info = $_POST['info'];
                echo strtoupper( $info ) . ' logged out';
                die();
            }
        }
        add_action( 'wp_ajax_nopriv_ajaxtest', 'philosophy_ajax_nopriv_function' );

        //To limit nonce lifetime for 20 seconds
        //     function philosophy_nonce_life() {
        //         return 20;
    //     }
    // add_filter( 'nonce_life', 'philosophy_nonce_life' );