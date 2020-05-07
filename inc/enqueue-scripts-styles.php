<?php

function enqueue_scripts_styles() {
    // Get the theme data.
    $the_theme = wp_get_theme();
    $version = $the_theme->get( 'Version' );

    wp_enqueue_style( 
      'google-font', 
      'https://fonts.googleapis.com/css2?family=Lato:wght@300;700&display=swap',
      array(),
    );

    wp_enqueue_style( 
      'bootstrap-css', 
      'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
      array(),
      '4.4.1'
    );
    
    wp_enqueue_style( 
      'wpstarter-main-style', 
      get_template_directory_uri() . '/dist/css/app.css', 
      array('bootstrap-css', 'google-font'),
      $version
    );

    wp_enqueue_script( 
      'wpstarter-main-scripts', 
      get_template_directory_uri() . '/dist/js/app.js', 
      array( 'jquery' ), 
      $version, 
      true 
    );

    wp_enqueue_script( 
      'popper-js', 
      'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', 
      array( 'jquery' ), 
      $version, 
      true 
    );

    wp_enqueue_script( 
      'bootstrap-js', 
      'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', 
      array( 'jquery', 'popper-js' ), 
      $version, 
      true 
    );

    // wp_enqueue_script( 
    //   'isotope-layout', 
    //   'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', 
    //   array( 'jquery' ), 
    //   $version, 
    //   false 
    // );

    $translation_array = array( 'theme_path' => get_stylesheet_directory_uri() );
    wp_localize_script( 'wpstarter-main-scripts', 'theme_vars', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles' );

// Enqueue frontend and editor styles
function enqueue_blocks_frontend_editor_assets() {
    $the_theme = wp_get_theme();
    
    wp_enqueue_style( 
      'block-acf-style', 
      get_template_directory_uri() . '/dist/css/blocks-style.css', 
      array(), 
      $the_theme->get( 'Version' )
    );
}

// add_action( 'enqueue_block_assets', 'enqueue_blocks_frontend_editor_assets' );

// Enqueue editor only styles
function enqueue_blocks_editor_assets() {
    $the_theme = wp_get_theme();
  
    wp_enqueue_style( 
      'block-acf-editor-style', 
      get_template_directory_uri() . '/dist/css/blocks-style-editor.css', 
      array( 'block-acf-style'), 
      $the_theme->get( 'Version' )
    );
}

add_action( 'enqueue_block_editor_assets', 'enqueue_blocks_editor_assets' );


function wpstarter_stop_loading_wp_embed_and_jquery() {
	if ( !is_admin() ) {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );        
    wp_deregister_script('wp-embed');
	}
}
add_action('init', 'wpstarter_stop_loading_wp_embed_and_jquery');