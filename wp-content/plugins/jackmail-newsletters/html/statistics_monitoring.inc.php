<?php if ( defined( 'ABSPATH' ) ) { ?>
<div class="jackmail_grid_buttons">
	<div class="jackmail_left">
		<span class="jackmail_statistics_nb_recipients">{{s2.nb_monitoring_grid_total_rows| numberSeparator}}</span>
		<span ng-hide="s2.nb_monitoring_grid_total_rows > 1"><?php _e( 'unique recipient', 'jackmail-newsletters' ) ?></span>
		<span ng-show="s2.nb_monitoring_grid_total_rows > 1"><?php _e( 'unique recipients', 'jackmail-newsletters' ) ?></span>
	</div>
	<div class="jackmail_statistics_retarget"
	     ng-show="$root.grid_service[ 0 ].nb_selected === 1 && s.page_title_type === 'campaign'">
		<span jackmail-tooltip-right
		      jackmail-tooltip="<?php esc_attr_e( 'Re-send the campaign to people who didn\'t open/click it', 'jackmail-newsletters' ) ?>">
			<input ng-click="s2.create_campaign_unopened()" class="jackmail_green_button" type="button"
			       value="<?php esc_attr_e( 'Retarget this campaign', 'jackmail-newsletters' ) ?>"/>
		</span>
	</div>
	<div jackmail-grid-search
	     jackmail-action="s2.get_monitoring_data_search"
	     class="jackmail_right jackmail_grid_buttons_search jackmail_statistics_search">
	</div>
</div>
<div class="jackmail_grid_container">
	<div class="jackmail_grid_header" ng-class="s2.monitoring_view === 'simplified' ? 'jackmail_grid_header_statistics_simplified' : ''">
		<span class="jackmail_statistics_grid_header_title">
			<?php _e( 'Details for selected recipients', 'jackmail-newsletters' ) ?>
		</span>
		<input ng-click="s2.export_stats_recipients()" class="jackmail_m_l_10 jackmail_right jackmail_grid_export" type="button"
		       value="<?php esc_attr_e( 'Export', 'jackmail-newsletters' ) ?>"/>
		<div class="jackmail_right" jackmail-dropdown-button button-value="<?php esc_attr_e( 'Manage the columns', 'jackmail-newsletters' ) ?>"
		     titles-clicks-grid="s2.monitoring_columns" titles-clicks-grid-checked="$root.grid_service[ 1 ].grid_classes"
		     titles-clicks-grid-event="$root.grid_service[ 1 ].display_or_hide_column( key )"
		     titles-clicks-grid-repeat-filter="s2.monitoring_columns_displayed">
		</div>
		<div button-class="jackmail_dropdown_button_container jackmail_grid_columns_button jackmail_right" jackmail-dropdown-button
		     button-value="{{s2.monitoring_view === 'detailled' ? '<?php echo esc_js( __( 'Detailed reading', 'jackmail-newsletters' ) ) ?>' : '<?php echo esc_js( __( 'Simplified reading', 'jackmail-newsletters' ) ) ?>'}}"
		     titles-clicks-array="s2.monitoring_views_select_titles"
		     titles-clicks-array-event="s2.select_monitoring_view( key )">
		</div>
	</div>
	<div ng-show="s2.monitoring_view === 'detailled'">
		<div class="jackmail_grid jackmail_grid_th" ng-class="$root.grid_service[ 1 ].grid_class">
			<table>
				<tr>
					<th ng-repeat="( key, column ) in s2.monitoring_columns track by $index"
					    ng-click="column.field !== '' ? s2.monitoring_range_by( column.field ) : ''" class="{{'jackmail_column_' + key}}"
					    ng-class="column.field !== '' ? 'jackmail_column_ordering' : ''">
						<span>{{column.name}}</span>
					</th>
				</tr>
			</table>
		</div>
		<div class="jackmail_grid jackmail_grid_content_defined" ng-class="$root.grid_service[ 1 ].grid_class"
		     grid-scroll="$root.grid_service[ 1 ]"
		     grid-total="s2.nb_monitoring_grid_total_rows"
		     grid-load="s2.get_monitoring_data_more">
			<table>
				<tr ng-repeat="( key, contact ) in s2.monitoring_grid | limitTo: $root.grid_service[ 1 ].nb_lines_grid track by $index">
					<td class="jackmail_column_0">
						<span ng-click="s2.display_recipient_details( contact.email )" class="jackmail_green jackmail_cursor_pointer">
							{{contact.email}}
						</span>
					</td>
					<td class="jackmail_column_1">
						<span>{{contact.nbOpen | numberSeparator}}</span>
					</td>
					<td class="jackmail_column_2">
						<span>{{contact.nbHit | numberSeparator}}</span>
					</td>
					<td class="jackmail_column_3 statistics_ok_nok">
						<span class="dashicons"
						      ng-class="( contact.nbOpenDesktop > 0 || contact.nbHitDesktop > 0 ) ? 'dashicons-yes' : 'dashicons-no-alt'"></span>
					</td>
					<td class="jackmail_column_4 statistics_ok_nok">
						<span class="dashicons"
						      ng-class="( contact.nbOpenMobile > 0 || contact.nbHitMobile > 0 ) ? 'dashicons-yes' : 'dashicons-no-alt'"></span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div ng-show="s2.monitoring_view === 'simplified'" class="jackmail_statistics_simplified jackmail_grid_content_defined"
	     grid-scroll="$root.grid_service[ 1 ]"
	     grid-total="s2.nb_monitoring_grid_total_rows"
	     grid-load="s2.get_monitoring_data_more">
		<div ng-repeat="( key, contact ) in s2.monitoring_grid | limitTo: $root.grid_service[ 1 ].nb_lines_grid track by $index"
		     class="jackmail_statistics_simplified_info" ng-class="contact.show_details ? 'jackmail_statistics_simplified_selected' : ''">
			<div class="jackmail_statistics_simplified_info_content">
				<div class="jackmail_statistics_simplified_info_img">
					<img ng-src="{{$root.settings.jackmail_url}}img/statistics_contact.png" alt=""/>
				</div>
				<div class="jackmail_statistics_simplified_info_data">
					<span ng-click="s2.display_recipient_details( contact.email )" class="jackmail_bold jackmail_cursor_pointer">
						{{contact.email}}
					</span>
					<br/>
					<span class="jackmail_grey">
						<span><?php _e( 'Openings:' ) ?> {{contact.nbOpen | numberSeparator}}</span>
						<span><?php _e( 'Clicks:' ) ?> {{contact.nbHit | numberSeparator}}</span>
					</span>
				</div>
				<div class="jackmail_statistics_simplified_info_dropdown">
					<span ng-hide="contact.show_details" ng-click="s2.monitoring_details( key )" class="dashicons dashicons-arrow-down-alt2"></span>
					<span ng-show="contact.show_details" ng-click="s2.monitoring_details( key )" class="dashicons dashicons-arrow-up-alt2"></span>
				</div>
			</div>
			<div ng-show="contact.show_details" class="jackmail_statistics_simplified_info_details" ng-class="$root.grid_service[ 1 ].grid_class">
				<div class="jackmail_column_1">
					<div><?php _e( 'Total opens:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbOpen | numberSeparator}}</span></div>
				</div>
				<div class="jackmail_column_1 jackmail_column_3">
					<div><?php _e( 'Opens on desktop:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbOpenDesktop | numberSeparator}}</span></div>
				</div>
				<div class="jackmail_column_1 jackmail_column_4">
					<div><?php _e( 'Opens on mobile:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbOpenMobile | numberSeparator}}</span></div>
				</div>
				<div class="jackmail_column_2">
					<div><?php _e( 'Total clicks:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbHit | numberSeparator}}</span></div>
				</div>
				<div class="jackmail_column_2 jackmail_column_3">
					<div><?php _e( 'Clicks on desktop:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbHitDesktop | numberSeparator}}</span></div>
				</div>
				<div class="jackmail_column_2 jackmail_column_4">
					<div><?php _e( 'Clicks on mobile:', 'jackmail-newsletters' ) ?></div>
					<div><span>{{contact.nbHitMobile | numberSeparator}}</span></div>
				</div>
			</div>
		</div>
	</div>
	<div ng-show="s2.monitoring_grid_data_loaded && s2.monitoring_grid.length === 0" class="jackmail_statistics_no_data">
		<?php _e( 'No data', 'jackmail-newsletters' ) ?>
	</div>
</div>
<?php } ?>