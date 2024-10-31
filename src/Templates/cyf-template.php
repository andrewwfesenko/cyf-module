<?php

use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();

if (function_exists('get_fields')) {
    $context['fields'] = get_fields();
}


Timber::render('cyf-template.twig', $context);
