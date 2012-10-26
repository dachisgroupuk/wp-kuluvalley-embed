<?php
/**
 * Admin class to control the administration system options and pages
 *
 * Description: This allows for the embedding of Kulu Valley videos from their URLs
 * Version: 1.0
 * Author: Ross Tweedie
 * Author URI: http://www.dachisgroup.com
 */
class WpKuluValleyEmbedAdmin extends WpKuluValleyEmbedCore
{
    function init()
    {
        parent::init();

        add_action( 'admin_menu', array( __CLASS__, 'add_admin_pages' ) );

        register_deactivation_hook( $this->plugin_file, array( $this, 'uninstall' ) );
    }

    /**
     * Add the administration menu for the plugin
     *
     * @param void
     * @return void
     */
    function add_admin_pages()
    {
        add_media_page( __( 'Kulu Valley Embed' , 'imv'), __( 'Kulu Valley Embed' , 'imv'), 'create_users', 'kulu-embed', array( __CLASS__, 'index_page' ) );
    }


    function index_page()
    {
        $message = null;

        if ( isset( $_POST['_wpnonce-wpkve-settings'] ) ) {
			check_admin_referer( 'wpkve-settings', '_wpnonce-wpkve-settings' );

            // Get the subdomain.
            $subdomain = isset( $_POST['subdomain'] ) ? $_POST['subdomain'] : '';

            if ( $subdomain ){

                $options = get_option( WpKuluValleyEmbedCore::$option_name );

                $options['subdomain'] = $subdomain;

                update_option( WpKuluValleyEmbedCore::$option_name, $options);

                $message = __( 'The settings have been saved', 'wpkve') ;
            }
        }

        $options = get_option( WpKuluValleyEmbedCore::$option_name );

        include( WpKuluValleyEmbedAdmin::get_plugin_path() . 'views/admin-index.php' );
    }


    /**
     * Uninstall option
     *
     * This will be called when the plugin is disactivated or uninstalled.
     *
     * It will remove the wpkve settings from the options database table
     */
    function uninstall()
    {
        //When the plugin is uninstalled or deactivation, cleanup the options
        delete_option( WpKuluValleyEmbedAdmin::$option_name );
    }

}
