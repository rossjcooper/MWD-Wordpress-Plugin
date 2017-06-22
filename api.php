<?php
/*
 * This file is useful for adding api routes into.
 * We use the JsonResponse class to send properly formatted json responses.
 */
use MWDPlugin\Example;
use Symfony\Component\HttpFoundation\JsonResponse;


add_action( 'wp_ajax_mwd_example', 'mwd_example' );
add_action( 'wp_ajax_nopriv_mwd_example', 'mwd_example' );

/**
 * Send all Example records we have in the database.
 */
function mwd_example() {
    $data = Example::all();
    (new JsonResponse($data))->send();
    wp_die();
}