<?php
/* Plugin Name:	Custom Scripts 54 Description:	Eigene Scripte und Stylesheets einbinden Version:		2.0.1 Author:			Matthias Marx | Agentur 54 Author URI:		https://www.agentur54.de License:		GPL-2.0+ License URI:	http://www.gnu.org/licenses/gpl-2.0.txt
 
This plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
 
This plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along with This plugin. If not, see {URI to Plugin License}. */

if (!defined('ABSPATH')) {
    die;
}

add_action('wp_enqueue_scripts', 'custom_enqueue_files');
/**
 * Loads <list assets here>.
 */
function custom_enqueue_files()
{

    wp_enqueue_style(
        'lightgallery-css',
        plugin_dir_url(__FILE__) . '/assets/css/lightgallery-bundle.min.css',
        array(),
        '2.3.4'
    );

    wp_enqueue_script(
        'lightgallery-js',
        plugin_dir_url(__FILE__) . '/assets/js/lightgallery.min.js',
        array(),
        '2.3.4',
        true
    );

    wp_enqueue_script(
        'lightgallery-thumbnail',
        plugin_dir_url(__FILE__) . '/assets/js/lg-thumbnail.min.js',
        array(),
        '1.0.0',
        true
    );

    wp_enqueue_style(
        'fonts-main',
        plugin_dir_url(__FILE__) . '/assets/css/fonts.css',
        array(),
        '2.3.4'
    );

    wp_enqueue_style(
        'swiper-js-css',
        plugin_dir_url(__FILE__) . '/assets/css/swiper-bundle.min.css',
        array(),
        '8.1.4'
    );

    wp_enqueue_script(
        'swiper-js',
        plugin_dir_url(__FILE__) . 'assets/js/swiper-bundle.min.js',
        array(),
        '8.1.4',
        true
    );

    wp_enqueue_style(
        'frontend-souderweld-css',
        plugin_dir_url(__FILE__) . 'dist/css/main.min.css',
        array(),
        null
    );


    wp_enqueue_script(
        'split-js',
        plugin_dir_url(__FILE__) . 'src/script/split-ends.js',
        array(),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'custom-menu-js',
        plugin_dir_url(__FILE__) . 'src/script/custom-menu.js',
        array(),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'menu-js',
        plugin_dir_url(__FILE__) . 'src/script/menu.js',
        array(),
        '1.0.1',
        true
    );

    wp_enqueue_script(
        'main-js',
        plugin_dir_url(__FILE__) . 'dist/js/main.bundle.js',
        array('gsap-main', 'gsap-scrolltrigger', 'gsap-scrollto'),
        '1.0.0',
        true
    );



    /*GSAP GREENSOCK ANIMATIONS*/
    wp_enqueue_script(
        'gsap-main',
        plugin_dir_url(__FILE__) . '/assets/js/gsap.min.js',
        array(),
        '1.0.0',
        true
    );

    /*Custom Scripts*/
    wp_enqueue_script(
        'custom-js',
        plugin_dir_url(__FILE__) . '/assets/js/custom.js',
        array(),
        '1.0.0',
        true
    );

    //Hier werden die .js Dateien aus den custom blocks geladen -> vllt findet jemand heraus, wie man die richtig aus der .json lädt

    wp_enqueue_script(
        'mitarbeiter-block-js',
        plugin_dir_url(__FILE__) . '/blocks/mitarbeiter/script.js',
        array(),
        '1.0.0',
        true
    );

    wp_enqueue_script(
        'geschichte-block-js',
        plugin_dir_url(__FILE__) . '/blocks/geschichte/script.js',
        array(),
        '1.0.0',
        true
    );



    /*54 Masterpiece Console Message*/
    wp_enqueue_script(
        'fiftyfour-masterpiece-console',
        plugin_dir_url(__FILE__) . 'assets/js/fiftyfourmasterpiece.min.js',
        array(),
        '1.0.0',
        true
    );
}


add_action('admin_enqueue_scripts', 'enqueue_backend_files');
function enqueue_backend_files()
{
    wp_enqueue_style(
        'backend-souderweld-css',
        plugin_dir_url(__FILE__) . 'dist/css/backend.min.css',
        array(),
        null
    );
}

add_action('enqueue_block_editor_assets', 'enqueue_gutenberg_assets_files');
function enqueue_gutenberg_assets_files()
{
    wp_enqueue_style(
        'fonts-main',
        plugin_dir_url(__FILE__) . '/assets/css/fonts.css',
        array(),
        '2.3.4'
    );

    wp_enqueue_style(
        'frontend-souderweld-css',
        plugin_dir_url(__FILE__) . 'dist/css/main.min.css',
        array(),
        null
    );

    wp_enqueue_style(
        'backend-souderweld-css',
        plugin_dir_url(__FILE__) . 'dist/css/backend.min.css',
        array(),
        null
    );

    wp_enqueue_style(
        'ff-editor-style',
        plugin_dir_url(__FILE__) . '/assets/css/style-index.css',
        array(),
        microtime()
    );

    wp_enqueue_script(
        'ff-editor-script',
        plugin_dir_url(__FILE__) . '/assets/js/editor.js',
        array(),
        microtime(),
        true
    );
}


/** Farbpaleten anpassen */

function disable_color_palette()
{
    add_theme_support('editor-color-palette');
    add_theme_support('disable-custom-colors');
}
add_action('after_setup_theme', 'disable_color_palette');

function customize_color_palette()
{
    add_theme_support('editor-color-palette', array(
            array(
            'name' => __('Petrol'),
            'slug' => 'petrol',
            'color' => '#0094A0',
        ),
            array(
            'name' => __('Red'),
            'slug' => 'red',
            'color' => '#E2574C',
        ),
            array(
            'name' => __('Black'),
            'slug' => 'black',
            'color' => '#000000',
        ),
    ));
}
add_action('after_setup_theme', 'customize_color_palette');

function theme_custom_gradients()
{
    add_theme_support('editor-gradient-presets', array(
            array(
            'name' => __('Semitransparent Blau zu Violett', 'souderweld'),
            'gradient' => 'linear-gradient(90deg, rgba(130, 203, 230, .4) 0, rgba(124, 128, 159, .4) 100%)',
            'slug' => 'semitransparent-blue-to-violet'
        ),
            array(
            'name' => __('Semitransparent Violett zu Blau', 'souderweld'),
            'gradient' => 'linear-gradient(90deg, rgba(124, 128, 159, .4) 0, rgba(130, 203, 230, .4) 100%)',
            'slug' => 'semitransparent-violet-to-blue'
        ),
    ));
}

add_action('after_setup_theme', 'theme_custom_gradients');

/** Farpaletten anpassen ENDE */

add_action('init', 'register_blocks');
function register_blocks()
{
    register_block_type(__DIR__ . '/blocks/post-list');
    register_block_type(__DIR__ . '/blocks/header-section');
    register_block_type(__DIR__ . '/blocks/mitarbeiter');
    register_block_type(__DIR__ . '/blocks/geschichte');
    register_block_type(__DIR__ . '/blocks/heading-text-wrap');
    register_block_type(__DIR__ . '/blocks/button-cta');
	register_block_type(__DIR__ . '/blocks/wissen');
    register_block_type(__DIR__ . '/blocks/jobs');
}


// Add custom image sizes for responsive design
add_theme_support('post-thumbnails');
add_image_size('img-480', 480, 9999);
add_image_size('img-640', 640, 9999);
add_image_size('img-720', 720, 9999);
add_image_size('img-960', 960, 9999);
add_image_size('img-1168', 1168, 9999);
add_image_size('img-1440', 1440, 9999);
add_image_size('img-1920', 1920, 9999);

// allow gutenberg editor to read our custom image sizes

function my_custom_sizes($sizes)
{
    return array_merge($sizes, array(
        'img-480' => 'img-480',
        'img-640' => 'img-640',
        'img-720' => 'img-720',
        'img-960' => 'img-960',
        'img-1168' => 'img-1168',
        'img-1440' => 'img-1440',
        'img-1920' => 'img-1920',
    ));
}
add_filter('image_size_names_choose', 'my_custom_sizes');


// SRCSET IMAGES

/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */
function responsive_image($image_id, $image_size, $max_width)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);

        // set the srcset with various image sizes
        $image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

        // generate the markup for the responsive image
        echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';

    }
}



// Include other PHP Functions, to use on the page
include(plugin_dir_path(__FILE__) . 'functions/general-functions.php');
include(plugin_dir_path(__FILE__) . 'functions/colors-in-gutenberg.php');

add_filter('show_admin_bar', '__return_false');
