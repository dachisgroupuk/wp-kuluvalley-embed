<?php
/**
 * Frontend class to handle the auto embedding of Kulu Valley videos into post content.
 *
 * Description: This allows for the embedding of Kulu Valley videos from their URLs
 * Version: 1.0
 * Author: Ross Tweedie
 * Author URI: http://www.dachisgroup.com
 */
class WpKuluValleyEmbedFrontend extends WpKuluValleyEmbedCore
{
    static $subdomain;

    function init()
    {
        parent::init();

        $subdomain = WpKuluValleyEmbedFrontend::get_subdomain();

        /**
         * Add the Kulu Valley embeds
         */
        wp_embed_register_handler( 'kuluvalley', '#https://' . $subdomain . '\.kuluvalley\.com/view/(?<video_id>[A-za-z0-9]+)#i', array( __CLASS__, 'wp_embed_handler_kuluvalley' ) );
    }


    /**
     * Get the subdomain for the video URL.
     *
     * @param void
     * @return string
     */
    private function get_subdomain( ){

        if ( isset( WpKuluValleyEmbedFrontend::$subdomain ) && !empty( WpKuluValleyEmbedFrontend::$subdomain ) ){
            return WpKuluValleyEmbedFrontend::$subdomain;
        }

        $options = get_option( WpKuluValleyEmbedFrontend::$option_name );

        WpKuluValleyEmbedFrontend::$subdomain = ( isset( $options['subdomain'] ) && !empty( $options['subdomain']) )? $options['subdomain'] : 'www';

        return WpKuluValleyEmbedFrontend::$subdomain;
    }
    

    /**
    * The Kulu Valley embed handler callback.
    *
    * Kulu Valley does not support oEmbed.
    *
    * @see WP_Embed::register_handler()
    * @see WP_Embed::shortcode()
    *
    * @param array $matches The regex matches from the provided regex when calling {@link wp_embed_register_handler()}.
    * @param array $attr Embed attributes.
    * @param string $url The original URL that was matched by the regex.
    * @param array $rawattr The original unmodified attributes.
    * @return string The embed HTML.
    */
    function wp_embed_handler_kuluvalley( $matches, $attr, $url, $rawattr ) {

        // Initialise the variables
        $options = $video_id = $width = $height = $subdomain = null;

        $options = get_option( WpKuluValleyEmbedFrontend::$option_name );

        $subdomain = WpKuluValleyEmbedFrontend::get_subdomain();

        $video_id = isset ( $matches['video_id'] ) ? $matches['video_id'] : '';

        // If the user supplied a fixed width AND height, use it
        if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
            $width  = (int) $rawattr['width'];
            $height = (int) $rawattr['height'];
        } else {
            list( $width, $height ) = wp_expand_dimensions( 425, 344, $attr['width'], $attr['height'] );
        }

        $js = <<<JS
<script type="text/javascript" src="https://{$subdomain}.kuluvalley.com/widgets/1/application.js"></script>
<script type="text/javascript">
    // <![CDATA[
    KV.widget({
        "guid": "{$video_id}",
        "type": "thumbnail",
        "playerType": "full",
        "packshot": {
            "width": {$width}
            }
        });
    // ]]>
</script>
JS;

    	return apply_filters( 'embed_kuluvalley', $js, $matches, $attr, $url, $rawattr );
    }

}
