<?php

define( 'CS_ACTIVE_FRAMEWORK', true ); // default true
define( 'CS_ACTIVE_METABOX', true ); // default true
define( 'CS_ACTIVE_TAXONOMY', true ); // default true
define( 'CS_ACTIVE_SHORTCODE', true ); // default true
define( 'CS_ACTIVE_CUSTOMIZE', false ); // default true
define( 'CS_ACTIVE_LIGHT_THEME', true ); // default false

function philosophy_cs_metabox() {
    CSFramework_Metabox::instance( array() );
    CSFramework_Shortcode_Manager::instance( array() );
    CSFramework_Taxonomy::instance( array() );
}

add_action( 'init', 'philosophy_cs_metabox' );

function philosophy_cs_metabox_options( $options ) {
    $page_id = 0;
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $page_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    $current_page_template = get_post_meta( $page_id, '_wp_page_template', true );
    if ( !in_array( $current_page_template, array( 'about.php', 'contact.php' ) ) ) {
        return $options;
    }

    $options[] = array(
        'id'        => 'page_metabox',
        'title'     => 'Page Meta Info',
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page_section1',
                'title'  => 'Page Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'      => 'page_heading',
                        'type'    => 'text',
                        'default' => __( 'Page Heading', 'philosophy' ),
                        'title'   => __( 'Page Heading', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'page_excerpt',
                        'type'    => 'textarea',
                        'default' => __( 'Page Excerpt', 'philosophy' ),
                        'title'   => __( 'Page Excerpt', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'is-favorite',
                        'title'   => __( 'Is favorite', 'philosophy' ),
                        'type'    => 'switcher',
                        'default' => 0,
                    ),
                    array(
                        'id'         => 'is-favorite-extra',
                        'title'      => __( 'Is favorite Extra', 'philosophy' ),
                        'type'       => 'switcher',
                        'default'    => 0,
                        'dependency' => array( 'is-favorite', '==', '1' ),
                    ),

                    array(
                        'id'         => 'checkbox-text-extra',
                        'title'      => __( 'checkbox Text', 'philosophy' ),
                        'type'       => 'text',
                        'dependency' => array( 'is-favorite', '==', '1' ),
                    ),

                    array(
                        'id'      => 'support-language',
                        'type'    => 'checkbox',
                        'title'   => 'First Checkbox',
                        'options' => array(
                            'bangla'  => 'Bangla',
                            'english' => 'English',
                            'french'  => 'French',
                        ),
                    ),
                    array(
                        'id'         => 'checkbox-text',
                        'title'      => __( 'checkbox Text', 'philosophy' ),
                        'type'       => 'text',
                        'dependency' => array( 'support-language_bangla|support-language_english', '==|==', '1|1' ),
                    ),

                ),
            ),
            array(
                'name'   => 'page_section2',
                'title'  => 'Extra Settings',
                'icon'   => 'fa fa-book',
                'fields' => array(
                    array(
                        'id'      => 'page_heading2',
                        'type'    => 'text',
                        'default' => __( 'Page Heading2', 'philosophy' ),
                        'title'   => __( 'Page Heading2', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'page_excerpt2',
                        'type'    => 'textarea',
                        'default' => __( 'Page Excerpt2', 'philosophy' ),
                        'title'   => __( 'Page Excerpt2', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'is-favorite-extra',
                        'title'   => __( 'Is favorite', 'philosophy' ),
                        'type'    => 'switcher',
                        'default' => 1,
                    ),
                ),
            ),
        ),
    );
    return $options;
}
add_filter( 'cs_metabox_options', 'philosophy_cs_metabox_options' );

function philosophy_upload_field( $options ) {
    $options[] = array(
        'id'        => 'page_metabox_upload',
        'title'     => 'Page Upload Info',
        'post_type' => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page_section1',
                // 'title'  => 'Upload Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'       => 'page_upload',
                        'type'     => 'upload',
                        'title'    => __( 'Upload Image', 'philosophy' ),
                        'settings' => array(
                            'upload_type'  => 'image',
                            'button_title' => __( 'Select Image', 'philosophy' ),
                            'frame_title'  => __( 'Select an Image', 'philosophy' ),
                            'insert_title' => __( 'Use this Image', 'philosophy' ),
                        ),
                    ),
                    array(
                        'id'        => 'page_upload_image',
                        'type'      => 'image',
                        'title'     => __( 'Upload Image', 'philosophy' ),
                        'add_title' => __( 'Add an Image', 'philosophy' ),
                    ),
                    array(
                        'id'          => 'opt_gallery',
                        'type'        => 'gallery',
                        'title'       => 'Gallery',
                        'add_title'   => 'Add Images',
                        'edit_title'  => 'Edit Images',
                        'clear_title' => 'Remove Images',
                    ),
                    array(
                        'id'     => 'opt-fieldset-1',
                        'type'   => 'fieldset',
                        'title'  => 'Fieldset',
                        'fields' => array(
                            array(
                                'id'    => 'opt-text',
                                'type'  => 'text',
                                'title' => 'Text',
                            ),
                            array(
                                'id'        => 'page_upload_image_section',
                                'type'      => 'image',
                                'title'     => __( 'Upload Image', 'philosophy' ),
                                'add_title' => __( 'Add an Image', 'philosophy' ),
                            ),
                            array(
                                'id'    => 'opt-switcher',
                                'type'  => 'switcher',
                                'title' => 'Switcher',
                            ),
                        ),
                    ),

                    array(
                        'id'              => 'opt-group-1',
                        'type'            => 'group',
                        'title'           => 'Group',
                        'button_title'    => 'Add Section',
                        'accordion_title' => 'Section',
                        'fields'          => array(
                            array(
                                'id'          => 'opt-select',
                                'type'        => 'select',
                                'title'       => 'Select a page',
                                'placeholder' => 'Select an option',
                                'options'     => 'posts',
                                'query_args'  => array(
                                    'post_type'      => 'book',
                                    'order_by'       => 'post_date',
                                    'posts_per_page' => -1,
                                ),
                            ),

                        ),
                    ),
                ),
            ),

        ),
    );
    return $options;
}
add_filter( 'cs_metabox_options', 'philosophy_upload_field' );

function philosophy_conditional_meta_field( $options ) {

    $page_id = 0;
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $page_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    $page_meta_info = get_post_meta( $page_id, 'page_metabox_conditionsl', true );

    $options[] = array(
        'id'        => 'page_metabox_conditionsl',
        'title'     => 'Page Upload Info',
        'post_type' => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page_section_condition',
                // 'title'  => 'Upload Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'          => 'opt_select_content',
                        'type'        => 'select',
                        'title'       => 'Select post or content',
                        'placeholder' => 'Select an option',
                        'options'     => array(
                            'none'    => 'None',
                            'book'    => 'Book',
                            'chapter' => 'Chapter',
                        ),
                    ),
                ),
            ),
        ),
    );

    if ( isset( $page_meta_info['opt_select_content'] ) && 'book' == $page_meta_info['opt_select_content'] ) {
        $options[] = array(
            'id'        => 'page_book_metabox_condition_text',
            'title'     => 'Book text section',
            'post_type' => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => array(
                array(
                    'name'   => 'page_book_section_condition_text',
                    // 'title'  => 'Upload Settings',
                    'icon'   => 'fa fa-image',
                    'fields' => array(
                        array(
                            'id'    => 'book_content',
                            'type'  => 'text',
                            'title' => 'Some text',
                        ),
                    ),
                ),
            ),
        );
    }

    if ( isset( $page_meta_info['opt_select_content'] ) && 'chapter' == $page_meta_info['opt_select_content'] ) {
        $options[] = array(
            'id'        => 'page_chapter_metabox_condition_text',
            'title'     => 'Chapter text section',
            'post_type' => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => array(
                array(
                    'name'   => 'page_chapter_section_condition_text',
                    // 'title'  => 'Upload Settings',
                    'icon'   => 'fa fa-image',
                    'fields' => array(
                        array(
                            'id'    => 'chapter_content',
                            'type'  => 'text',
                            'title' => 'Some text',
                        ),
                    ),
                ),
            ),
        );
    }
    return $options;
}
add_filter( 'cs_metabox_options', 'philosophy_conditional_meta_field' );

function philosophy_shortcode_meta( $options ) {
    $options[] = array(
        'name'       => 'group_1',
        'title'      => 'Add Map from codestar',
        'shortcodes' => array(

            array(
                'name'   => 'map',
                'title'  => 'Add bing Map',
                'fields' => array(
                    array(
                        'id'      => 'title',
                        'type'    => 'text',
                        'title'   => 'Title',
                        'default' => 'Our location',
                    ),
                    array(
                        'id'      => 'description',
                        'type'    => 'text',
                        'title'   => 'Description',
                        'default' => 'Map description',
                    ),
                    array(
                        'id'      => 'width',
                        'type'    => 'text',
                        'title'   => 'Width',
                        'default' => '100%',
                    ),
                    array(
                        'id'      => 'height',
                        'type'    => 'text',
                        'title'   => 'Height',
                        'default' => '500',
                    ),
                    array(
                        'id'      => 'lat',
                        'type'    => 'text',
                        'title'   => 'lat',
                        'default' => '23.713522',
                    ),
                    array(
                        'id'      => 'lon',
                        'type'    => 'text',
                        'title'   => 'lon',
                        'default' => '90.446144',
                    ),
                    array(
                        'id'      => 'zoom',
                        'type'    => 'text',
                        'title'   => 'zoom',
                        'default' => '14',
                    ),
                ),
            ),

        ),
    );
    return $options;
}
add_filter( 'cs_shortcode_options', 'philosophy_shortcode_meta' );

function philosophy_language_featured_image( $options ) {
    $options[] = array(
        'id'       => 'language_featured_image',
        'taxonomy' => 'language', // or array( 'category', 'post_tag' )

        // begin: fields
        'fields'   => array(
            array(
                'id'    => 'language_image',
                'type'  => 'image',
                'title' => 'Set an image for language',
            ),

        ), // end: fields
    );
    return $options;
}
add_filter( 'cs_taxonomy_options', 'philosophy_language_featured_image' );

function philosophy_admin_panel_metabox() {
    $settings = array(
        'menu_title'      => __( 'Philosophy Options', 'philosophy' ),
        // 'menu_type'       => 'main',
        'menu_type'       => 'submenu',
        'menu_parent'     => 'themes.php',
        'menu_slug'       => 'philosophy_option_panel',
        'framework_title' => __( 'Philosophy Options', 'philosophy' ),
        'menu_icon'       => 'dashicons-welcome-widgets-menus',
        'menu_position'   => 20,
        'ajax_save'       => false,
        'show_reset_all'  => true,
    );
    $options = philosophy_cs_frameword_options();
    new CSFramework( $settings, $options );
}
add_action( 'init', 'philosophy_admin_panel_metabox' );

function philosophy_cs_frameword_options() {
    $options = array();
    $options[] = array(
        'name'   => 'footer_options',
        'title'  => __( 'Footer Options', 'philosophy' ),
        'fields' => array(
            array(
                'id'      => 'footer_tag',
                'type'    => 'switcher',
                'title'   => __( 'Is tags area is available', 'philosophy' ),
                'default' => 0,
            ),
        ),
    );
    $options[] = array(
        'id'        => 'cs_admin_metabox_social',
        'title'     => 'Social Links',
        'post_type' => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'SocialLinks',
                'title'  => 'Social Links',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'    => 'facebook_social',
                        'type'  => 'text',
                        'title' => 'facebook',
                    ),
                    array(
                        'id'    => 'twitter_social',
                        'type'  => 'text',
                        'title' => 'Twitter',
                    ),
                    array(
                        'id'    => 'linkedIn_social',
                        'type'  => 'text',
                        'title' => 'LinkedIn',
                    ),
                ),
            ),
        ),
    );
    $options[] = array(
        'id'        => 'cs_admin_metabox_2',
        'title'     => 'Chapter text section 2',
        'post_type' => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page_chapter_section_condition_text',
                'title'  => 'Upload Settings 2',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'    => 'chapter_content_new_2',
                        'type'  => 'text',
                        'title' => 'Some text',
                    ),
                ),
            ),
        ),
    );
    return $options;
}
// add_filter( 'cs_framework_options', 'philosophy_cs_frameword_options' );