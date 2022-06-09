<?php
	$wpmegmOptionPages = array(
		__('Welcome', 'wpme-google-maps') => 'welcome',		// Title => id suffix (also used for {file-name}.php)
		__('Settings', 'wpme-google-maps') => 'settings',
		__('Help', 'wpme-google-maps') => 'help',
		__('Support', 'wpme-google-maps') => 'support'
	);

	$titles = "";
	$contents = "";

	foreach($wpmegmOptionPages as $pageTitle => $pageId) {
		$titles .= "<li><a href='#wpmegm-page-{$pageId}'>{$pageTitle}</a></li>";
	}
?>
<div class="wrap">
	<a href="https://www.facebook.com/pages/WPMadeasy/785993324849159" target="_blank" class="wpmegm-right" style="margin-top: 20px;"><img src="<?=WPME_GMAPS_IMGURL?>/followus.png" /></a>
	<h2><?=WPME_GMAPS_FULLNAME?> Settings</h2>
	<p style="font-size: 11px; margin-top: 0; color: #666;"><?=__('Version', 'wpme-google-maps')?> <?=WPME_GMAPS_VERSION?></p>
	<p><?=WPME_GMAPS_DESCRIPTION?></p>

	<div id="wpmegm-pages">
		<ul>
			<?=$titles?>
		</ul>

		<?php
			foreach($wpmegmOptionPages as $pageTitle => $pageId) {
				echo "<div id='wpmegm-page-{$pageId}'>";

				include(WPME_GMAPS_PATH."/options/".$pageId.".php");

				echo "</div>";

			}
		?>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$( "#wpmegm-pages" ).tabs({
			//active: 1
		});

		$('.wpmegm-form-settings').submit(function(){
			var data =  $(this).serialize();

			$(".wpmegm-notice")
				.removeClass("wpmegm-error")
				.removeClass("wpmegm-success")
				.addClass("wpmegm-alert")
				.html("<span class='dashicons dashicons-info' style='color: #00A8EF;'></span> <?=__('Saving, please wait', 'wpme-google-maps')?>")
				.show();

			$.post('options.php', data).error(function(){
				$(".wpmegm-notice")
					.html("<?=__('Settings were not saved successfully, please try again.', 'wpme-google-maps')?>")
					.removeClass("wpmegm-alert")
					.addClass("wpmegm-error")
					.show();
			}).success(function(){
				$(".wpmegm-notice")
					.html("<?=__('Settings updated.', 'wpme-google-maps')?>")
					.removeClass("wpmegm-alert")
					.addClass("wpmegm-success")
					.show();
			});

			return false;
		});
	});
</script>