<?php
define('ATTACHMENTS_SETTINGS_SCREEN', false);
add_filter('attachments_default_instance', '__return_false');

function alpha_my_attachments($attachments)
{
    $post_id = null;
    if (isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])) {
        $post_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
    if(!$post_id || get_post_format( $post_id ) != "gallery"){
        return;
    }
    $fields         = array(
        array(
            'name'      => 'title',                         // unique field name
            'type'      => 'text',                          // registered field type
            'label'     => __('Title', 'alpha'),    // label to display
            'default'   => 'title',                         // default value upon selection
        ),
    );

    $args = array(
        'label'         => 'Gallery',
        'post_type'     => array('post'),
        'filetype'      => "image",  // no filetype limit
        'note'          => 'Attach image here!',
        'append'        => true,
        'button_text'   => __('Attach Image', 'attachments'),
        'fields'        => $fields,

    );

    $attachments->register('gallery', $args); // unique instance name
}

add_action('attachments_register', 'alpha_my_attachments');
