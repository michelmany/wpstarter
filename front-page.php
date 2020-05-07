<?php 

$context = Timber::context();
$context['post'] = new Timber\Post();

Timber::render( 'home.twig', $context );