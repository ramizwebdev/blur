<?php 
/*
 *  Author: Ramiz Theba | @dev_ramiz_1707
 *  URL: Blur.com | @blur
 *  Custom functions, support, custom post types and more.
 */

    /*------------------------------------*\
        External Modules/Files
    \*------------------------------------*/

    // Load any external files you have here

    /*------------------------------------*\
        Theme Support
    \*------------------------------------*/

    if (function_exists('add_theme_support'))
    {
        // Add Menu Support
        add_theme_support('menus');

        // Add Thumbnail Theme Support
        add_theme_support('post-thumbnails');
        add_image_size('large', 700, '', true); // Large Thumbnail
        add_image_size('medium', 250, '', true); // Medium Thumbnail
        add_image_size('small', 120, '', true); // Small Thumbnail
        add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

        // Add Support for Custom Backgrounds - Uncomment below if you're going to use        
        add_theme_support('custom-background');

        // Add Support for Custom Header - Uncomment below if you're going to use
        add_theme_support('custom-header');

        // Add Support for Custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

        // Enables post and comment RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Localisation Support
        load_theme_textdomain('blur', get_template_directory() . '/languages');

        // Add Support for post formats
        add_theme_support( 'post-formats', array( 'image', 'quote', 'video', 'aside', 'gallery' ) );

        // Add Support for title tags
        add_theme_support( 'title-tag' );

        // Add Support for HTML5
        $args = array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        );
        add_theme_support( 'html5', $args );

    }

    if (!isset($content_width))
    {
        $content_width = 900;
    }


    /*------------------------------------*\
	    Functions
    \*------------------------------------*/

    // Blur navigation
    function blur_nav()
    {
        wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
            )
        );
    }

    // Load Blur scripts (header.php)
    function blur_header_scripts()
    {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

            wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
            wp_enqueue_script('conditionizr'); // Enqueue it!

            wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
            wp_enqueue_script('modernizr'); // Enqueue it!

            wp_register_script('blur', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
            wp_enqueue_script('blur'); // Enqueue it!
        }
    }

    // Load Blue styles
    function blue_styles()
    {
        wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0', 'all');
        wp_enqueue_style('normalize'); // Enqueue it!

        wp_register_style('blur', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
        wp_enqueue_style('blur'); // Enqueue it!
    }

    /*------------------------------------*\
	    Actions + Filters + ShortCodes
    \*------------------------------------*/

    // Add Actions
    add_action('init', 'blur_header_scripts'); // Add Custom Scripts to wp_head
    add_action('wp_enqueue_scripts', 'blue_styles'); // Add Theme Stylesheet

?>