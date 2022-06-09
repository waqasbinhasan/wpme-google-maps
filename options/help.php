<h2>Short Code Usage</h2>
<p><code>[wpme-gmaps address=&quot;123 Main Street, Sydney 12345, Australia&quot;]</code> (Basic Mode)</p>
<p><code>[wpme-gmaps map=&quot;99&quot;]</code> (Advanced Mode)</p>
<p>There are more attributes available, which you can use to configure the map results.</p>
<h2>Short Code Attributes</h2>
<table width="100%" border="0" cellpadding="10" class="wpmegm-table">
	<tr>
		<td width="10%" bgcolor="#EEE"><strong>Attribute</strong></td>
		<td width="60%" bgcolor="#EEE"><strong>Description</strong></td>
		<td width="10%" bgcolor="#EEE">&nbsp;</td>
		<td width="20%" bgcolor="#EEE"><strong>Default Value</strong></td>
	</tr>
	<tr>
		<td><code>map</code></td>
		<td>ID of a saved map.<br />
			If used, all other attributes are ignored and values are taken from saved map and locations.</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td><code>address</code></td>
		<td>Full street address to point on the map.<br />
			i.e. 123 Main Street, Sydney 12345, Australia</td>
		<td>Required</td>
		<td>-</td>
	</tr>
	<tr>
		<td><code>width</code></td>
		<td>Width of the map in % or px.<br />
			i.e. 100% or 1100px</td>
		<td>Optional</td>
		<td>100%</td>
	</tr>
	<tr>
		<td><code>height</code></td>
		<td>Height of the map in % or px<br />
			i.e. 50% or 400px</td>
		<td>Optional</td>
		<td>400px</td>
	</tr>
	<tr>
		<td><code>marker</code></td>
		<td>URL of the map marker icon.<br />
			i.e. http://example.com/wp-content/uploads/pointer.png<br><br>
			Or select from available markers:<br>
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/blue.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/green.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/litegreen.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/orange.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/pink.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/red.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/skyblue.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/teal.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/teapink.png" />
			<img src="<?php echo WPME_GMAPS_IMGURL; ?>/markers/yellow.png" />
		</td>
		<td>Optional</td>
		<td>Google Map's default marker icon</td>
	</tr>
	<tr>
		<td><code>zoom</code></td>
		<td>Initial zoom level of the map - 0 to 20 (or above, depending on supported level for Map Type)<br />
			i.e. 8, 15 or 20</td>
		<td>Optional</td>
		<td>15</td>
	</tr>
	<tr>
		<td><code>type</code></td>
		<td>Map type (as supported by Google Maps)<br />
			i.e. ROADMAP, SATELLITE, HYBRID or TERRAIN</td>
		<td>Optional</td>
		<td>ROADMAP</td>
	</tr>
	<tr>
		<td><code>swheel</code></td>
		<td>Mouse scroll wheel support<br />
			i.e. enable or disable</td>
		<td>Optional</td>
		<td>disable</td>
	</tr>
	<tr>
		<td><code>controls</code></td>
		<td>Map controls (zoom, pan, navigate or etc)<br />
			i.e. show or hide</td>
		<td>Optional</td>
		<td>show</td>
	</tr>
	<tr>
		<td><code>cache</code></td>
		<td>Cache control for map results. If enabled, the results are cached for 30 days. If you want to force fresh results always, disable caching.<br />
			i.e. enable or disable</td>
		<td>Optional</td>
		<td>enable</td>
	</tr>
	<tr>
		<td><code>class</code></td>
		<td>CSS class(es) to use with map's DIV<br />
			i.e. my-map-class</td>
		<td>Optional</td>
		<td>wpme-gmap</td>
	</tr>
	<tr>
		<td><code>id</code></td>
		<td>CSS ID to use with map's DIV. This ID is also used as map object ID<br />
			i.e. my-map (do not use # sign before ID)</td>
		<td>Optional</td>
		<td>wpme-gmap</td>
	</tr>
</table>
<p>&nbsp;</p>