<?php
// Register Maps Custom Post Type - Since v2.0
if ( ! function_exists('wpme_register_maps_cpt') ) {
	function wpme_register_maps_cpt() {

		$labels = array(
			'name'                => _x( 'WPME Google Maps', 'Post Type General Name', 'wpme-google-maps' ),
			'singular_name'       => _x( 'WPME Google Map', 'Post Type Singular Name', 'wpme-google-maps' ),
			'menu_name'           => __( 'WPME Google Maps', 'wpme-google-maps' ),
			//'name_admin_bar'      => __( 'WPME Google Map', 'wpme-google-maps' ),
			//'parent_item_colon'   => __( 'WPME Google Maps', 'wpme-google-maps' ),
			'all_items'           => __( 'All Maps', 'wpme-google-maps' ),
			'add_new_item'        => __( 'Add New Map', 'wpme-google-maps' ),
			'add_new'             => __( 'Add New Map', 'wpme-google-maps' ),
			'new_item'            => __( 'New Map', 'wpme-google-maps' ),
			'edit_item'           => __( 'Edit Map', 'wpme-google-maps' ),
			'update_item'         => __( 'Update Map', 'wpme-google-maps' ),
			'view_item'           => __( 'View Map', 'wpme-google-maps' ),
			'search_items'        => __( 'Search Maps', 'wpme-google-maps' ),
			'not_found'           => __( 'Not found', 'wpme-google-maps' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wpme-google-maps' ),
		);
		$args = array(
			'label'               => __( 'WPME Map', 'wpme-google-maps' ),
			'description'         => __( 'Defines a map entry.', 'wpme-google-maps' ),
			'labels'              => $labels,
			'supports'            => array( 'title', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 99,
			'menu_icon'           => WPME_GMAPS_IMGURL.'/icon-wpmegm24x24.png', //'dashicons-location-alt',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'wpme-maps', $args );

	}
	add_action( 'init', 'wpme_register_maps_cpt', 0 );

	// Register meta box for custom fields
	function wpme_maps_meta_box_add() {
		add_meta_box( 'wpme-maps-meta', 'Map Options', 'wpme_maps_meta_box_cb', 'wpme-maps', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'wpme_maps_meta_box_add' );

	function wpme_maps_meta_box_cb($post) {
		$wpmegm_params = get_post_custom($post->ID);
		$wpmegm_param_width = isset($wpmegm_params['wpmegm-param-width'])?esc_attr($wpmegm_params['wpmegm-param-width'][0]):'';
		$wpmegm_param_height = isset($wpmegm_params['wpmegm-param-height'])?esc_attr($wpmegm_params['wpmegm-param-height'][0]):'';
		$wpmegm_param_zoom = isset($wpmegm_params['wpmegm-param-zoom'])?esc_attr($wpmegm_params['wpmegm-param-zoom'][0]):'';
		$wpmegm_param_type = isset($wpmegm_params['wpmegm-param-type'])?esc_attr($wpmegm_params['wpmegm-param-type'][0]):'';
		$wpmegm_param_swheel = isset($wpmegm_params['wpmegm-param-swheel'])?esc_attr($wpmegm_params['wpmegm-param-swheel'][0]):'';
		$wpmegm_param_controls = isset($wpmegm_params['wpmegm-param-controls'])?esc_attr($wpmegm_params['wpmegm-param-controls'][0]):'';
		$wpmegm_param_cache = isset($wpmegm_params['wpmegm-param-cache'])?esc_attr($wpmegm_params['wpmegm-param-cache'][0]):'';
		$wpmegm_param_class = isset($wpmegm_params['wpmegm-param-class'])?esc_attr($wpmegm_params['wpmegm-param-class'][0]):'';
		$wpmegm_param_id = isset($wpmegm_params['wpmegm-param-id'])?esc_attr($wpmegm_params['wpmegm-param-id'][0]):'';

		//print_r($wpmegm_params);

		// We'll use this nonce field later on when saving.
		wp_nonce_field('wpme_maps_meta_box_nonce', 'meta_box_nonce');
		?>
		<div class="wpmegm-controls-group" style="float: inherit">
			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-width" class="wpmegm-control-label"><?=__('Map Width', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-width" name="wpmegm-param-width" value="<?php echo $wpmegm_param_width; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="width" />
				<span class="notes"><?=__('i.e. 50% or 400px - default is 100%', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-height" class="wpmegm-control-label"><?=__('Map Height', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-height" name="wpmegm-param-height" value="<?php echo $wpmegm_param_height; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="height" />
				<span class="notes"><?=__('i.e. 50% or 400px - default is 400px', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-zoom" class="wpmegm-control-label"><?=__('Initial Zoom Level', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-zoom" name="wpmegm-param-zoom" value="<?php echo $wpmegm_param_zoom; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="zoom" />
				<span class="notes"><?=__('Default is 15 - lower value zoom out while higher value zoom in the map.', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-type" class="wpmegm-control-label"><?=__('Map Type', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-type" name="wpmegm-param-type" class="wpmegm-control-select wpmegm-param" data-param-name="type">
					<option value="">-- Select --</option>
					<option value="HYBRID" <?php selected($wpmegm_param_type, 'HYBRID'); ?>>HYBRID</option>
					<option value="ROADMAP" <?php selected($wpmegm_param_type, 'ROADMAP'); ?>>ROADMAP (default)</option>
					<option value="SATELLITE" <?php selected($wpmegm_param_type, 'SATELLITE'); ?>>SATELLITE</option>
					<option value="TERRAIN" <?php selected($wpmegm_param_type, 'TERRAIN'); ?>>TERRAIN</option>
				</select>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-swheel" class="wpmegm-control-label"><?=__('Mouse Scroll Wheel', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-swheel" name="wpmegm-param-swheel" class="wpmegm-control-select wpmegm-param" data-param-name="swheel">
					<option value="">-- Select --</option>
					<option value="disable" <?php selected($wpmegm_param_swheel, 'disable'); ?>>Disable (default)</option>
					<option value="enable" <?php selected($wpmegm_param_swheel, 'enable'); ?>>Enable</option>
				</select>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-controls" class="wpmegm-control-label"><?=__('Map Controls', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-controls" name="wpmegm-param-controls" class="wpmegm-control-select wpmegm-param" data-param-name="controls">
					<option value="">-- Select --</option>
					<option value="hide" <?php selected($wpmegm_param_controls, 'hide'); ?>>Hide</option>
					<option value="show" <?php selected($wpmegm_param_controls, 'show'); ?>>Show (default)</option>
				</select>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-cache" class="wpmegm-control-label"><?=__('Cache', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<select id="wpmegm-control-cache" name="wpmegm-param-cache" class="wpmegm-control-select wpmegm-param" data-param-name="cache">
					<option value="">-- Select --</option>
					<option value="disable" <?php selected($wpmegm_param_cache, 'disable'); ?>>Disable</option>
					<option value="enable" <?php selected($wpmegm_param_cache, 'enable'); ?>>Enable (default)</option>
				</select>
				<span class="notes"><?=__('If enabled, stores results in cache for 30 days - which improves speed. If you want to get fresh results every time, do not enable cache.', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-class" class="wpmegm-control-label"><?=__('CSS: Map DIV Class(es)', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-class" name="wpmegm-param-class" value="<?php echo $wpmegm_param_class; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="class" />
				<span class="notes"><?=__('Default is wpme-gmap', 'wpme-google-maps')?></span>
			</div>

			<div class="wpmegm-control" style="float: inherit">
				<label for="wpmegm-control-id" class="wpmegm-control-label"><?=__('CSS: Map DIV ID', 'wpme-google-maps')?> <span class="optional wpmegm-right"><?=__('(optional)', 'wpme-google-maps')?></span></label>
				<input type="text" id="wpmegm-control-id" name="wpmegm-param-id" value="<?php echo $wpmegm_param_id; ?>" class="wpmegm-control-text wpmegm-param" data-param-name="id" />
				<span class="notes"><?=__('Default is wpme-gmap - do not include # (hash) sign. This ID is also used as map object ID.', 'wpme-google-maps')?></span>
			</div>
		</div>
	<?php
	}

	// Save Custom Fields
	function wpme_maps_meta_box_save( $post_id ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'wpme_maps_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		//if( !current_user_can( 'edit_post' ) ) return;

		// Make sure data is set before trying to save it
		if( isset( $_POST['wpmegm-param-width'] ) )
			update_post_meta( $post_id, 'wpmegm-param-width', esc_attr( $_POST['wpmegm-param-width'] ) );

		if( isset( $_POST['wpmegm-param-height'] ) )
			update_post_meta( $post_id, 'wpmegm-param-height', esc_attr( $_POST['wpmegm-param-height'] ) );

		if( isset( $_POST['wpmegm-param-zoom'] ) )
			update_post_meta( $post_id, 'wpmegm-param-zoom', esc_attr( $_POST['wpmegm-param-zoom'] ) );

		$param_type = (isset($_POST['wpmegm-param-type']) && !empty($_POST['wpmegm-param-type']))?$_POST['wpmegm-param-type']:"ROADMAP";
		update_post_meta($post_id, 'wpmegm-param-type', esc_attr($param_type));

		$param_swheel = (isset($_POST['wpmegm-param-swheel']) && !empty($_POST['wpmegm-param-swheel']))?$_POST['wpmegm-param-swheel']:'disable';
		update_post_meta($post_id, 'wpmegm-param-swheel', $param_swheel);

		$param_controls = (isset($_POST['wpmegm-param-controls']) && !empty($_POST['wpmegm-param-controls']))?$_POST['wpmegm-param-controls']:'show';
		update_post_meta($post_id, 'wpmegm-param-controls', $param_controls);

		$param_cache = (isset($_POST['wpmegm-param-cache']) && !empty($_POST['wpmegm-param-cache']))?$_POST['wpmegm-param-cache']:'enable';
		update_post_meta($post_id, 'wpmegm-param-cache', $param_cache);

		if( isset( $_POST['wpmegm-param-class'] ) )
			update_post_meta( $post_id, 'wpmegm-param-class', esc_attr( $_POST['wpmegm-param-class'] ) );

		if( isset( $_POST['wpmegm-param-id'] ) )
			update_post_meta( $post_id, 'wpmegm-param-id', esc_attr( $_POST['wpmegm-param-id'] ) );

	}
	add_action( 'save_post', 'wpme_maps_meta_box_save' );

	// Register meta box for attached locations
	function wpme_maps_meta_box_locations() {
		add_meta_box( 'wpme-maps-locations', 'Locations on this map', 'wpme_maps_meta_box_locations_cb', 'wpme-maps', 'side', 'default' );
	}
	add_action( 'add_meta_boxes', 'wpme_maps_meta_box_locations' );

	function wpme_maps_meta_box_locations_cb($post) {
		$post_status = $post->post_status;

		if($post_status != "auto-draft" && $post_status != "draft") {
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'wpme-locations',
				'orderby' => 'title',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'wpmegm-param-map',
						'value' => $post->ID
					)
				)
			);
			$locations = get_posts($args);

			echo "<table width='100%' cellpadding='5' cellspacing='0'>";

			foreach($locations as $location) {
				echo "<tr>";
				echo "<td style='width: 80%; border-bottom: 1px solid lightgray;'>".$location->post_title."</td>";
				echo "<td style='width: 20%; text-align: right; border-bottom: 1px solid lightgray;'><a href='post.php?post={$location->ID}&action=edit'>Edit</a></td>";
				echo "</tr>";
			}

			echo "<tr>";
			echo "<td colspan='2' style='padding-top: 20px; text-align: center;'><a href='post-new.php?post_type=wpme-locations' class='page-title-action'>Add New Location</a></td>";
			echo "</tr>";

			echo "</table>";

			wp_reset_postdata();
		}
	}

	// Register meta box for map's short code
	function wpme_maps_meta_box_sc() {
		add_meta_box( 'wpme-maps-sc', 'Short Code', 'wpme_maps_meta_box_sc_cb', 'wpme-maps', 'side', 'high' );
	}
	add_action( 'add_meta_boxes', 'wpme_maps_meta_box_sc' );

	function wpme_maps_meta_box_sc_cb($post) {
		$post_status = $post->post_status;

		if($post_status != "auto-draft" && $post_status != "draft") {
			echo "<div style='text-align: center;'>";
			echo "<code style='display: block;'>[wpme-gmap map={$post->ID}]</code>";
			echo "</div>";
		}
	}

	// Add short code column to maps posts list
	function wpme_maps_columns_head($defaults) {
		unset($defaults['date']);

		$defaults['short_code'] = __('Short Code');
		$defaults['date'] = __('Date');

		return $defaults;
	}
	function wpme_maps_columns_content($column_name, $post_ID) {
		if ($column_name == 'short_code') {
			echo "<code>[wpme-gmap map={$post_ID}]</code>";
		}

		if($column_name == 'date') {
			echo get_the_date();
		}
	}
	add_filter('manage_wpme-maps_posts_columns', 'wpme_maps_columns_head', 10);
	add_action('manage_wpme-maps_posts_custom_column', 'wpme_maps_columns_content', 10, 2);
}