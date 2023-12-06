<?php

/**
 * Custom functions / External files
 */

require_once 'includes/custom-functions.php';


/**
 * Add support for useful stuff
 */

if ( function_exists( 'add_theme_support' ) ) {

    // Add support for document title tag
    add_theme_support( 'title-tag' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    // add_image_size( 'custom-size', 700, 200, true );

    // Add Support for post formats
    // add_theme_support( 'post-formats', ['post'] );
    // add_post_type_support( 'page', 'excerpt' );
}


/**
 * Hide admin bar
 */

 add_filter( 'show_admin_bar', '__return_false' );


/**
 * Remove junk
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/**
 * Remove comments feed
 *
 * @return void
 */

/**
 * Enqueue scripts
 */
function byte_myke_enqueue_scripts() {
    // wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Font+Family' );
    wp_enqueue_style( 'google_icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' );
    wp_deregister_script('jquery');
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/style.css?' . filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_style( 'materialize_css', get_stylesheet_directory_uri() . '/assets/css/materialize.min.css?' . filemtime( get_stylesheet_directory() . '/assets/css/materialize.min.css' ) );
    wp_enqueue_script( 'materialize_js', get_stylesheet_directory_uri() . '/assets/js/materialize.min.js?' . filemtime( get_stylesheet_directory() . '/assets/js/materialize.min.js' ), [], null, true );
}
add_action( 'wp_enqueue_scripts', 'byte_myke_enqueue_scripts' );

//Dev only scripts :
function byte_myke_enqueue_dev_only_scripts() {
    wp_enqueue_style( 'main_dev_styles', get_stylesheet_directory_uri() . '/assets/css/main.css?' . filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
    wp_enqueue_script( 'main_dev_scripts', get_stylesheet_directory_uri() . '/assets/js/main.js?' . filemtime( get_stylesheet_directory() . '/assets/js/main.js' ), [], null, true );
}

add_action( 'wp_enqueue_scripts', 'byte_myke_enqueue_dev_only_scripts' );

//Production only scripts :
// function byte_myke_enqueue_prod_only_scripts() {
//     wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js?' . filemtime( get_stylesheet_directory() . '/assets/js/scripts.min.js' ), [], null, true );
//     wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/main.css?' . filemtime( get_stylesheet_directory() . '/assets/css/main.min.css' ) );
// }
// add_action( 'wp_enqueue_scripts', 'byte_myke_enqueue_prod_only_scripts' );


/**
 * Add async and defer attributes to enqueued scripts
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 * @return void
 */

// function defer_scripts( $tag, $handle, $src ) {

// 	// The handles of the enqueued scripts we want to defer
// 	$defer_scripts = [
//         'SCRIPT_ID'
//     ];

//     // Find scripts in array and defer
//     if ( in_array( $handle, $defer_scripts ) ) {
//         return '<script type="text/javascript" src="' . $src . '" defer="defer"></script>' . "\n";
//     }
    
//     return $tag;
// } 

// add_filter( 'script_loader_tag', 'defer_scripts', 10, 3 );


/**
 * Add custom scripts to head
 *
 * @return string
 */

function add_gtag_to_head() {

    // Check is staging environment
    if ( strpos( get_bloginfo( 'url' ), '.test' ) !== false ) return;

    // Google Analytics
    $tracking_code = 'UA-*********-1';
    
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_code; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo $tracking_code; ?>');
        </script>
    <?php
}

add_action( 'wp_head', 'add_gtag_to_head' );



/**
 * Remove unnecessary scripts
 *
 * @return void
 */

function deregister_scripts() {
    wp_deregister_script( 'wp-embed' );
}

add_action( 'wp_footer', 'deregister_scripts' );


/**
 * Remove unnecessary styles
 *
 * @return void
 */

function deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_print_styles', 'deregister_styles', 100 );


/**
 * Shortcodes
 *
 * @param array $atts
 * @param string $content
 * @return void
 */

/**
 * Get post thumbnail url
 *
 * @param string $size
 * @param boolean $post_id
 * @param boolean $icon
 * @return void
 */

function get_post_thumbnail_url( $size = 'full', $post_id = false, $icon = false ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $thumb_url_array = wp_get_attachment_image_src(
        get_post_thumbnail_id( $post_id ), $size, $icon
    );
    return $thumb_url_array[0];
}

//custom post types
/*
* Creating a function to create our CPT
*/
  
// Our custom post type function
function create_post_type(  string $singular = 'Customer', 
                            string $plural = 'Customers', 
                            string $menu_icon = 'dashicons-carrot',
                            bool $hierarchical = FALSE, 
                            bool $has_archive = TRUE, 
                            string $description = '' ) {
        //Here, the default post type if no argument is passed to create_post_type() will be Customer CPT

        register_post_type( $singular, array(
        'public'            => TRUE,
        'show_in_rest'      => TRUE,
        'description'       => $description,
        'menu_icon'         => $menu_icon,
        'hierarchical'      => $hierarchical,
        'has_archive'       => $has_archive,
        'supports'          => array('title', 'editor', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'comments'),
        'labels' => array(
            'name'                      => $plural,
            'singular_name'             => $singular,
            'add_new'                   => 'Add New '.$singular,
            'add_new_item'              => 'New '.$singular,
            'edit_item'                 => 'Edit '.$singular,
            'view_item'                 => 'View '.$singular,
            'view_items'                => 'View '.$plural,
            'search_items'              => 'Search '.$plural,
            'not_found'                 => 'No '.$plural.' Found',
            'all_items'                 => 'All '.$plural,
            'archives'                  => $plural.' Archives',
            'attributes'                => $singular.' Attributes',
            'insert_into_item'          => 'Insert into '.$singular,
            'uploaded_to_this_item'     => 'Uploaded to this '.$singular,
            'featured_image'            => $singular.' Featured image',
            'set_featured_image'        => 'Set '.$singular.' featured image',
            'remove_featured_image'     => 'Remove '.$singular.' featured image',
            'use_featured_image'        => 'Use as '.$singular.' featured image',
            'filter_items_list'         => 'Filter '.$plural.' list',
            'filter_by_date'            => 'Filter '.$plural.' by date',
            'items_list_navigation'     => $plural.' list navigation',
            'items_list'                => $plural.' list',
            'item_published'            => $singular.' published.',
            'item_published_privately'  => $singular.' published privately.',
            'item_reverted_to_draft'    => $singular.' reverted to draft.',
            'item_scheduled'            => $singular.' scheduled.',
            'item_updated'              => $singular.' updated.',
            'item_link'                 => $singular.' link'
        ),

        'rewrite'           => array(
            'slug'                      => strtolower($plural),
            'pages'                     => TRUE,
        )
    ));
    
}
function create_posttype() {
  //simple custom post type
    // register_post_type( 'custom_post_types',
    //     array(
    //         'labels' => array(
    //             'name' => __( 'Custom post types' ),
    //             'singular_name' => __( 'Custom post type' )
    //         ),
    //         'public' => true,
    //         'has_archive' => true,
    //         'rewrite' => array('slug' => 'custom_post_types'),
    //         'show_in_rest' => true,
  
    //     )
    // );
    //advanced custom post type
    create_post_type('resource', 'resources', 'dashicons-paperclip');
}
add_action( 'init', 'create_posttype' );
