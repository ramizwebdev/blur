<?php 
/*
 *  Author: Ramiz Theba | @dev_ramiz_1707
 *  URL: Blur.com | @blur
 *  Custom functions, support, custom post types and more.
 */

    /*------------------------------------*\
        External Modules/Files
        Load any external files you have here
    \*------------------------------------*/    

    /**
     * Include the TGM_Plugin_Activation class.
     */
    require_once 'class-tgm-plugin-activation.php';

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

    // Blur branding 
    function blue_update_footer_admin() 
    {
        echo '<span id="footer-thankyou">Thank you creating with <a href="https://github.com/dev-ramiz-1707/blur" target="_blank">Blur Theme</a>, Developed by <a href="https://github.com/dev-ramiz-1707" target="_blank">Dev_ramiz_1707</a></span>';
    }

    /**
     * Register the required plugins for this theme.
     *
     * In this example, we register five plugins:
     * - one included with the TGMPA library
     * - two from an external source, one from an arbitrary source, one from a GitHub repository
     * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
     *
     * The variables passed to the `tgmpa()` function should be:
     * - an array of plugin arrays;
     * - optionally a configuration array.
     * If you are not changing anything in the configuration array, you can remove the array and remove the
     * variable from the function call: `tgmpa( $plugins );`.
     * In that case, the TGMPA default settings will be used.
     *
     * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
     */
    function blur_register_required_plugins() {
        /*
        * Array of plugin arrays. Required keys are name and slug.
        * If the source is NOT from the .org repo, then source is also required.
        */
        $plugins = array(           
           
            array(
                'name'      => 'Elementor',
                'slug'      => 'elementor',
                'required'  => false,
            ),
            
            array(
                'name'      => 'Unyson',
                'slug'      => 'unyson',
                'required'  => true,
            ),
            
            array(
                'name'        => 'Rank Math SEO',
                'slug'        => 'seo-by-rank-math',
                'is_callable' => 'wpseo_init',
                'required'  => false,
            ),

        );

        /*
        * Array of configuration settings. Amend each line as needed.
        *
        * TGMPA will start providing localized text strings soon. If you already have translations of our standard
        * strings available, please help us make TGMPA even better by giving us access to these translations or by
        * sending in a pull-request with .po file(s) with the translations.
        *
        * Only uncomment the strings in the config array if you want to customize the strings.
        */
        $config = array(
            'id'           => 'blur',                  // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'blur-install-plugins',  // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa( $plugins, $config );
    }


    /*------------------------------------*\
	    Actions + Filters + ShortCodes
    \*------------------------------------*/

    // Add Actions
    add_action('init', 'blur_header_scripts'); // Add Custom Scripts to wp_head
    add_action('wp_enqueue_scripts', 'blue_styles'); // Add Theme Stylesheet
    add_filter('admin_footer_text', 'blue_update_footer_admin'); // Blur Branding hook
    add_action( 'tgmpa_register', 'blur_register_required_plugins' ); // Required plugin validation.

    

?>