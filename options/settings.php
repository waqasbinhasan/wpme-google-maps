<div class="wpmegm-notice wpmegm-alert" style="display: none;">Saving...</div>

<form method="post" action="options.php" class="wpmegm-form-settings">
	<?php
		settings_fields('wpmegm-settings');
		do_settings_sections('wpmegm-settings');

		$options = get_option('wpmegm_options');

		// Options related to this screen only
		$button_appearance = esc_attr($options["general"]["button_appearance"]);

		$google_maps_api_key = '';

		if(isset($options["general"]["google_maps_api_key"])) {
			$google_maps_api_key = esc_attr($options["general"]["google_maps_api_key"]);
		}
	?>

	<table class="form-table">
		<tr valign="top">
			<th scope="row">Button Appearance</th>
			<td>
				<select name="wpmegm_options[general][button_appearance]">
					<option value="">Default (icon and text)</option>
					<option value="icon" <?php echo ($button_appearance=="icon")?"selected":""; ?>>Icon only</option>
					<option value="text" <?php echo ($button_appearance=="text")?"selected":""; ?>>Text only</option>
				</select>
				<span class="notes">Button appearance on post editor.</span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Google Maps API Key</th>
			<td>
				<input name="wpmegm_options[general][google_maps_api_key]" value="<?php echo $google_maps_api_key;?>" />
				<span class="notes">See <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Obtaining an API key</a> for more information.</span>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>