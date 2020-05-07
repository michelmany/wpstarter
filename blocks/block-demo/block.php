<?php

function register_block_demo() {
  acf_register_block( array(
    'name'				      => 'block_demo',
    'title'				      => 'Block demo',
    'render_callback'	  => 'render_block_demo',
    'category'			    => 'custom-blocks',
    'icon'              => 'slides',
    'keywords'			    => array( 'demo' ),
  ) );
}

function render_block_demo() {
  $context = Timber::context();
  $context['acf'] = get_fields();
  
  Timber::render('blocks/block_demo/block.twig', $context);
}

add_action('acf/init', 'register_block_demo');