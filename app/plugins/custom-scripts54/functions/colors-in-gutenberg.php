<?php 
/*
Plugin Name:  MA Oxygen Colors Gutenberg
Description:  Provide Oxygen colors in Gutenberg
Author:       <a href="https://www.altmann.de/">Matthias Altmann</a>
Version:      1.0.1
Plugin URI:   https://www.altmann.de/en/blog-en/code-snippet-oxygen-colors-in-gutenberg/
Description:  en: https://www.altmann.de/en/blog-en/code-snippet-oxygen-colors-in-gutenberg/
              de: https://www.altmann.de/blog/code-snippet-oxygen-farben-in-gutenberg/
Copyright:    © 2020-2021, Matthias Altmann

Version History:
Date		Version		Description
---------------------------------------------------------------------------------------------------------------------
2020-12-29				Development start
2020-12-29 	1.0.0		Initial Release 
2021-03-21  1.0.1       Bug Fix: Only initialize if Oxygen plugin is active
                        (Thanks to Adrien Robert for reporting!)

*/

class MA_Oxygen_Colors_Gutenberg {
    const TITLE     	= 'MA Oxygen Colors Gutenberg';
	const SLUG	    	= 'ma_oxygen_colors_gutenberg';
    const VERSION   	= '1.0.1';
    
    // Configuration
	private static $debug				= false;    // caution! may produce a lot of output
    private static $timing				= false;    // caution! may produce a lot of output
    private static $add_black_white     = true;     // automatically add black and white colors
    private static $allow_custom_color  = true;     // allow custom color settings in Gutenberg

    //-------------------------------------------------------------------------------------------------------------------
	static function init() {
        if (	!wp_doing_ajax() 														// skip for ajax
            && 	!wp_doing_cron()														// skip for cron
            && 	(!array_key_exists('heartbeat',$_REQUEST))								// skip for hearbeat
        ) {
            global $wp;
            add_action('after_setup_theme', [__CLASS__, 'palette_backend']);
            add_action('enqueue_block_assets', [__CLASS__, 'palette_frontend']);
        }
    }
    
    //-------------------------------------------------------------------------------------------------------------------
    // Add Oxygen's global colors to Gutenberg's backend editor palette
    static function palette_backend() {
        $st = microtime(true);

        $gutenberg_colors = [];
        if (self::$add_black_white) {
            // add black and white
            $gutenberg_colors[] = [ 'name' => 'black', 'slug' => 'color-black', 'color' => '#000000' ];
            $gutenberg_colors[] = [ 'name' => 'white', 'slug' => 'color-white', 'color' => '#ffffff' ];
        }
        // add oxygen global colors
        $oxy_colors = oxy_get_global_colors();
        foreach($oxy_colors['colors'] as $oxy_color) {
            $gutenberg_colors[] = [ 'name' => $oxy_color['name'], 'slug' => 'color-'.$oxy_color['id'], 'color' => $oxy_color['value'] ];
        }
        add_theme_support( 'editor-color-palette', $gutenberg_colors );
        if (!self::$allow_custom_color) {
            add_theme_support( 'disable-custom-colors' );
        }

        if (WP_DEBUG && self::$debug) {error_log(sprintf('%s::%s() gutenberg_colors: %s',self::TITLE,__FUNCTION__,print_r($gutenberg_colors,true)));}
		$et = microtime(true);
		if (WP_DEBUG && self::$timing) {error_log(sprintf('%s::%s() Timing: %.5f sec.',self::TITLE,__FUNCTION__,$et-$st));}
    }

    //-------------------------------------------------------------------------------------------------------------------
    // Add corresponding CSS to frontend Gutenberg blocks
    static function palette_frontend(){
        $st = microtime(true);

        $gutenberg_colors_frontend_css = "";
        if (self::$add_black_white) {
            // add black and white
            $gutenberg_colors_frontend_css .= '.has-color-black-color{color:#000000;}';
            $gutenberg_colors_frontend_css .= '.has-color-black-background-color{background-color:#000000;}';
            $gutenberg_colors_frontend_css .= '.has-color-white-color{color:#ffffff;}';
            $gutenberg_colors_frontend_css .= '.has-color-white-background-color{background-color:#ffffff;}';
        }
        // add oxygen global colors
        $oxy_colors = oxy_get_global_colors();
        foreach( $oxy_colors['colors'] as $oxy_color) {
            $gutenberg_colors_frontend_css .= '.has-color-'.$oxy_color['id'].'-color {color:'.$oxy_color['value'].'}';
            $gutenberg_colors_frontend_css .= '.has-color-'.$oxy_color['id'].'-background-color{background-color:'.$oxy_color['value'].'}';
        }
        wp_register_style('gutenberg-oxygen-colors', false );
        wp_enqueue_style('gutenberg-oxygen-colors');
        wp_add_inline_style('gutenberg-oxygen-colors', $gutenberg_colors_frontend_css );

        if (WP_DEBUG && self::$debug) {error_log(sprintf('%s::%s() gutenberg_colors_frontend_css: %s',self::TITLE,__FUNCTION__,print_r($gutenberg_colors_frontend_css,true)));}
		$et = microtime(true);
		if (WP_DEBUG && self::$timing) {error_log(sprintf('%s::%s() Timing: %.5f sec.',self::TITLE,__FUNCTION__,$et-$st));}

    }
    
}
// only initialize if Oxygen plugin is active
if (defined('CT_VERSION')) {
    MA_Oxygen_Colors_Gutenberg::init();
}
