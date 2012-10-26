<?php
/**
 * Core class to handle the auto embedding of Kulu Valley videos into post content.
 *
 * Description: This allows for the embedding of Kulu Valley videos from their URLs
 * Version: 1.0
 * Author: Ross Tweedie
 * Author URI: http://www.dachisgroup.com
 */
class WpKuluValleyEmbedCore
{
    static $wpdb, $plugin_file, $plugin_path, $plugin_url;

    static $option_name = 'wpkve-settings';

    function __construct()
    {
        global $wpdb;
        self::$wpdb         = $wpdb;
        self::$plugin_path  = dirname( dirname( __FILE__ ) ) . '/';

        self::$plugin_url   = plugin_dir_url(dirname( __FILE__ ) );
    }

    static function get_plugin_file()
    {
        return self::$plugin_file;
    }

    static function get_plugin_path()
    {
        return self::$plugin_path;
    }

    static function get_plugin_url()
    {
        return self::$plugin_url;
    }

    function init()
    {
        // Stub
    }


    function install()
    {
        // Stub
    }

    function uninstall()
    {
        // Stub
    }


    /**
     * Get the options for the plugin
     *
     * @param void
     * @return array
     */
    function get_options()
    {
        $options = get_option( WpKuluValleyEmbedCore::$option_name );

        if ( ! is_array( $options ) ){
            $options = !empty( $options )? unserialize( $options ) : array() ;
        }

        return $options;
    }


    /**
     * Save the options
     *
     * @param array $options
     * @return boolean
     */
    function save_options( $options )
    {
        if ( ! is_array( $options  ) ){
            // $options = serialize( $options );
        }

        update_option( WpKuluValleyEmbedCore::$option_name, $options);

        return true;
    }

}
