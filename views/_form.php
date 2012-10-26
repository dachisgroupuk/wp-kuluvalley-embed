<?php
    $subdomain = ( isset( $options['subdomain'] ) && !empty( $options['subdomain'] ) )? $options['subdomain'] : 'testing' ;
?>
<form method="post" action="" enctype="multipart/form-data">
	<?php wp_nonce_field( 'wpkve-settings', '_wpnonce-wpkve-settings' ); ?>
    <table class="form-table">
		<tr valign="top">
			<th scope="row"><label for"subdomain"><?php _e( 'Subdomain' , 'wpkve'); ?></label></th>
			<td>
                <input class="medium-text" type="text" name="subdomain" value="<?php echo ( isset( $options['subdomain'] ) && !empty( $options['subdomain'] ) )? $options['subdomain'] : '' ;?>">
            </td>
		</tr>
	</table>
    <p class="notes"><strong>Note:</strong> The subdomain is unique to each client on Kulu Valley. It is the part between the <i>http://</i> and the <i>.kuluvalley.com</i>.</p><p>For example in following video URL <i>http://<?php echo $subdomain;?>.kuluvalley.com/video/U5pc4Mf3hZq</i>, the subdomain would be <i><?php echo $subdomain ;?></i>.</p>
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e( 'Save settings' , 'drupal-import-from-csv'); ?>" />
	</p>
</form>
