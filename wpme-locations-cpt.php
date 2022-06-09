<?php
// Register Locations Custom Post Type - Since v2.0
if ( ! function_exists('wpme_register_locations_cpt') ) {
	function wpme_register_locations_cpt() {

		$labels = array(
			'name'                => _x( 'WPME Google Map Locations', 'Post Type General Name', 'wpme-google-maps' ),
			'singular_name'       => _x( 'WPME Google Map Location', 'Post Type Singular Name', 'wpme-google-maps' ),
			'menu_name'           => __( 'Locations', 'wpme-google-maps' ),
			//'name_admin_bar'      => __( 'WPME Google Map', 'wpme-google-maps' ),
			//'parent_item_colon'   => __( 'WPME Google Maps', 'wpme-google-maps' ),
			'all_items'           => __( 'Manage Locations', 'wpme-google-maps' ),
			'add_new_item'        => __( 'Add New Location', 'wpme-google-maps' ),
			'add_new'             => __( 'Add New Location', 'wpme-google-maps' ),
			'new_item'            => __( 'New Location', 'wpme-google-maps' ),
			'edit_item'           => __( 'Edit Location', 'wpme-google-maps' ),
			'update_item'         => __( 'Update Location', 'wpme-google-maps' ),
			'view_item'           => __( 'View Location', 'wpme-google-maps' ),
			'search_items'        => __( 'Search Locations', 'wpme-google-maps' ),
			'not_found'           => __( 'Not found', 'wpme-google-maps' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wpme-google-maps' ),
		);
		$args = array(
			'label'               => __( 'WPME Map Location', 'wpme-google-maps' ),
			'description'         => __( 'Defines a location to place on map.', 'wpme-google-maps' ),
			'labels'              => $labels,
			'supports'            => array( 'title'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'edit.php?post_type=wpme-maps',
			//'menu_position'       => 58,
			'menu_icon'           => 'dashicons-pressthis',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'wpme-locations', $args );

	}
	add_action( 'init', 'wpme_register_locations_cpt', 0 );

	// Register meta box for custom fields
	function wpme_locations_meta_box_add() {
		add_meta_box( 'wpme-locations-meta', 'Location Options', 'wpme_locations_meta_box_cb', 'wpme-locations', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'wpme_locations_meta_box_add' );

	function wpme_locations_meta_box_cb($post) {
		$wpmegm_params = get_post_custom($post->ID);
		$wpmegm_param_address = isset($wpmegm_params['wpmegm-param-address'])?esc_attr($wpmegm_params['wpmegm-param-address'][0]):'';
		$wpmegm_param_marker = isset($wpmegm_params['wpmegm-param-marker'])?esc_attr($wpmegm_params['wpmegm-param-marker'][0]):'';
		$wpmegm_param_marker_custom = isset($wpmegm_params['wpmegm-param-marker-custom'])?esc_attr($wpmegm_params['wpmegm-param-marker-custom'][0]):'';
		$wpmegm_param_infowindow = isset($wpmegm_params['wpmegm-param-infowindow'])?$wpmegm_params['wpmegm-param-infowindow'][0]:'';
		$wpmegm_param_map = isset($wpmegm_params['wpmegm-param-map'])?esc_attr($wpmegm_params['wpmegm-param-map'][0]):'';

		// We'll use this nonce field later on when saving.
		wp_nonce_field('wpme_locations_meta_box_nonce', 'meta_box_nonce');
		?>
		<div class="wpmegm-controls-group" style="float: inherit">
			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-address" class="wpmegm-control-label"><?=__('Address', 'wpme-google-maps')?> <span class="required wpmegm-right"><?=__('(required)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-address" name="wpmegm-param-address" value="<?php echo $wpmegm_param_address; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="address" data-required="1" placeholder="This field is required" />
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<div class="wpmegm-preview" style="float: right; width: 10%; text-align: right;">
					<img src="" style="display: none;" />
				</div>
				<label for="wpmegm-control-marker" class="wpmegm-control-label" style="float: left; width: 89%;"><?=__('Marker Icon', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-marker" name="wpmegm-param-marker" class="wpmegm-control-select wpmegm-param wpmegm-opt-a" data-param-name="marker" style="float: inherit; width: 89%;">
					<option value="">Default</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/blue.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/blue.png"); ?>>Blue</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/green.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/green.png"); ?>>Green</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/litegreen.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/litegreen.png"); ?>>Lite Green</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/orange.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/orange.png"); ?>>Orange</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/pink.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/pink.png"); ?>>Pink</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/red.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/red.png"); ?>>Red</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/skyblue.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/skyblue.png"); ?>>Sky Blue</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/teal.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/teal.png"); ?>>Teal</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/teapink.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/teapink.png"); ?>>Tea Pink</option>
					<option value="<?php echo WPME_GMAPS_IMGURL; ?>/markers/yellow.png" <?php selected($wpmegm_param_marker, WPME_GMAPS_IMGURL."/markers/yellow.png"); ?>>Yellow</option>
					<option value="custom" <?php selected($wpmegm_param_marker, "custom"); ?>>Custom URL</option>
				</select>
				<input type="text" id="wpmegm-control-marker-custom" name="wpmegm-param-marker-custom" value="<?php echo $wpmegm_param_marker_custom; ?>" class="wpmegm-control-text wpmegm-param wpmegm-opt-b" data-param-name="marker" style="float: inherit; width: 89%; <?php if($wpmegm_param_marker!="custom") {?>display: none;<?php } ?>" />
				<span class="notes" style="float: left; width: 89%;"><?=__('URL to a custom .png/.jpg/.gif image to use as marker icon. Default is Google Map Pin Icon.', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit; clear: both; padding-top: 10px;">
				<label for="wpmegm-control-infowindow-wrap" class="wpmegm-control-label" style="float: inherit"><?=__('Content for Info Window', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<?php
					$settings = array(
						'media_buttons' => false,
						'teeny' => true,
						'textarea_rows' => '7',
						'textarea_name' => 'wpmegm-param-infowindow'
					);

					wp_editor( $wpmegm_param_infowindow, "wpmegm-control-infowindow", $settings );
				?>
				<span class="notes" style="float: left; width: 89%;"><?=__('Leave blank to display address in the info window.', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit; clear: both; padding-top: 10px;">
				<label for="wpmegm-control-map" class="wpmegm-control-label"><?=__('Use with Map', 'wpme-google-maps')?> <span class="required wpmegm-right"><?=__('(required)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-map" name="wpmegm-param-map" class="wpmegm-control-select wpmegm-param" data-param-name="map">
					<?php
						$args = array(
							'posts_per_page' => -1,
							'post_type' => 'wpme-maps',
							'orderby' => 'title',
							'order' => 'ASC'
						);
						$maps = get_posts($args);

						foreach ($maps as $map):
					?>
							<option value="<?php echo $map->ID; ?>" <?php selected($wpmegm_param_map, $map->ID); ?>><?php echo get_the_title($map->ID); ?></option>
					<?php
						endforeach;
						wp_reset_postdata();
					?>
				</select>
			</div>
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#wpmegm-control-marker").on("change", function(){
					var v = $(this).val();

					if(v !== "" && v !== "custom") {
						//var src = '<?php echo WPME_GMAPS_IMGURL; ?>/markers/' + v;
						$(".wpmegm-preview img").attr("src", v);
						$(".wpmegm-preview img").show();
					} else {
						$(".wpmegm-preview img").attr("src", "").hide();
						$(".wpmegm-preview img").hide();
					}

					if(v == "custom") {
						$(".wpmegm-opt-b").show();
					} else {
						$(".wpmegm-opt-b").val("");
						$(".wpmegm-opt-b").hide();
					}

				});
			});
		</script>
	<?php
	}

	// Save Custom Fields
	function wpme_locations_meta_box_save( $post_id ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'wpme_locations_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		//if( !current_user_can( 'edit_post' ) ) return;

		// Make sure data is set before trying to save it
		if( isset( $_POST['wpmegm-param-address'] ) )
			update_post_meta( $post_id, 'wpmegm-param-address', esc_attr( $_POST['wpmegm-param-address'] ) );

		if( isset( $_POST['wpmegm-param-infowindow'] ) )
			update_post_meta( $post_id, 'wpmegm-param-infowindow', $_POST['wpmegm-param-infowindow']);

		if( isset( $_POST['wpmegm-param-marker'] ) )
			update_post_meta( $post_id, 'wpmegm-param-marker', esc_attr( $_POST['wpmegm-param-marker'] ) );

		if( isset( $_POST['wpmegm-param-marker-custom'] ) )
			update_post_meta( $post_id, 'wpmegm-param-marker-custom', esc_attr( $_POST['wpmegm-param-marker-custom'] ) );

		// Post Relation - link it with Selected Map
		if( isset( $_POST['wpmegm-param-map'] ) )
			update_post_meta( $post_id, 'wpmegm-param-map', esc_attr( $_POST['wpmegm-param-map'] ) );
	}
	add_action( 'save_post', 'wpme_locations_meta_box_save' );

	// Add short code column to maps posts list
	function wpme_locations_columns_head($defaults) {
		unset($defaults['date']);

		$defaults['map'] = __('Map');
		$defaults['date'] = __('Date');

		return $defaults;
	}
	function wpme_locations_columns_content($column_name, $post_ID) {
		if ($column_name == 'map') {
			$map_id = get_post_meta($post_ID, 'wpmegm-param-map', true);
			$map_title = get_the_title($map_id);

			echo "<a href='post.php?post={$map_id}&action=edit'>{$map_title}</a> ({$map_id})";
		}

		if($column_name == 'date') {
			echo get_the_date();
		}
	}
	add_filter('manage_wpme-locations_posts_columns', 'wpme_locations_columns_head', 10);
	add_action('manage_wpme-locations_posts_custom_column', 'wpme_locations_columns_content', 10, 2);
}