<?php if ( defined( 'ABSPATH' ) ) { ?>
<div ng-controller="StatisticsController as s">
	<div class="jackmail_header_container">
		<div class="jackmail_header">
			<div>
				<div class="jackmail_header_menu" jackmail-header-menu></div>
				<div class="jackmail_header_buttons">
					<div jackmail-search></div>
				</div>
			</div>
		</div>
	</div>
	<div ng-hide="$root.show_help2">
		<div class="jackmail_content">
			<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_header.inc.php'; ?>
		</div>
		<div class="jackmail_statistics_content">
			<div class="jackmail_statistics_content_left jackmail_statistics_simplified">
				<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_campaigns.inc.php'; ?>
			</div>
			<div class="jackmail_statistics_content_right">
				<div class="jackmail_statistics_items">
					<div ng-click="$root.show_hide_item( 'synthesis' )"
					     ng-class="$root.show_item === 'synthesis' ? 'jackmail_statistics_item_selected' : 'jackmail_statistics_item_not_selected'">
						<?php _e( 'Summary', 'jackmail-newsletters' ) ?>
					</div>
					<div ng-if="!$root.settings.is_freemium"
					     ng-click="$root.show_hide_item( 'monitoring' )"
					     ng-class="$root.show_item === 'monitoring' ? 'jackmail_statistics_item_selected' : 'jackmail_statistics_item_not_selected'">
						<?php _e( 'Behavioral tracking', 'jackmail-newsletters' ) ?>
					</div>
					<div ng-if="$root.settings.is_freemium"
					     class="jackmail_statistics_item_disabled jackmail_statistics_item_not_selected">
						<span jackmail-tooltip="<?php esc_attr_e( 'Please buy a premium offer to unlock this feature.<br/><a target="blank" href="https://www.jackmail.com/pricing/">View pricing</a>.', 'jackmail-newsletters' ) ?>"
						      jackmail-tooltip-middle>
							<?php _e( 'Behavioral tracking', 'jackmail-newsletters' ) ?>
						</span>
					</div>
					<div ng-click="$root.show_hide_item( 'links' )"
					     ng-class="$root.show_item === 'links' || $root.show_item === 'link_details' ? 'jackmail_statistics_item_selected' : 'jackmail_statistics_item_not_selected'">
						<?php _e( 'Links', 'jackmail-newsletters' ) ?>
					</div>
					<div ng-click="$root.show_hide_item( 'technologies' )"
					     ng-class="$root.show_item === 'technologies' ? 'jackmail_statistics_item_selected' : 'jackmail_statistics_item_not_selected'">
						<?php _e( 'Technologies', 'jackmail-newsletters' ) ?>
					</div>
				</div>
				<div class="jackmail_statistics_controller_container">
					<div ng-controller="StatisticsSynthesisController as s1"
					     ng-show="$root.show_item === 'synthesis'" class="jackmail_statistics_container">
						<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_synthesis.inc.php' ?>
					</div>
					<div ng-controller="StatisticsMonitoringController as s2"
					     ng-show="$root.show_item === 'monitoring'" class="jackmail_statistics_monitoring">
						<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_monitoring.inc.php' ?>
					</div>
					<div ng-controller="StatisticsLinksController as s3"
					     ng-show="$root.show_item === 'links' || $root.show_item === 'link_details'" class="jackmail_statistics_links">
						<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_links.inc.php' ?>
					</div>
					<div ng-controller="StatisticsTechnologiesController as s4"
					     ng-show="$root.show_item === 'technologies'" class="jackmail_statistics_container">
						<?php include_once plugin_dir_path( __FILE__ ) . 'statistics_technologies.inc.php' ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>