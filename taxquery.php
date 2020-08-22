<?php

/**
 * Template Name: Tax Query Template
 */

$philosophy_tax_query_args = array(
    'taxonomy' => 'book',
    'posts_per_page' => -1,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'language',
                'field' => 'slug',
                'terms' => array('bangla')
            ),
            array(
                'taxonomy' => 'language',
                'field' => 'slug',
                'operator' => 'NOT IN',
                'terms' => array('english')
            )
        ),
        array(
            'taxonomy' => 'genre',
            'field' => 'slug',
            'terms' => array('classic')
        )
    )
);

$philosophy_tax_query_res = new WP_Query($philosophy_tax_query_args);
// print_r($philosophy_tax_query_res);
while ($philosophy_tax_query_res->have_posts()) {
    $philosophy_tax_query_res->the_post();
    the_title();
    echo "<br>";
}
wp_reset_query();
