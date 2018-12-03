<?php if ( defined( 'ABSPATH' ) ) { ?>
<div class="jackmail_statistics_filter">
	<p class="jackmail_title jackmail_left jackmail_mt_0">
		<?php _e( 'Statistics', 'jackmail-newsletters' ) ?>
		<span class="jackmail_statistics_title" ng-class="s.compare ? 'jackmail_statistics_title_compare' : ''">{{s.page_title}}</span>
		<input ng-hide="s.show_segments" ng-click="s.show_hide_segments()"
		       class="jackmail_green_button jackmail_show_segments_button" type="button"
		       value="<?php esc_attr_e( 'Display segments', 'jackmail-newsletters' ) ?>"/>
		<input ng-show="s.show_segments" ng-click="s.show_hide_segments()"
		       class="jackmail_green_button jackmail_show_segments_button" type="button"
		       value="<?php esc_attr_e( 'Hide segments', 'jackmail-newsletters' ) ?>"/>
	</p>
	<div class="jackmail_statistics_calendar" ng-class="$root.content_loaded ? 'jackmail_statistics_calendar_display' : ''">
		<div jackmail-multiple-calendar
		     jackmail-option="day" jackmail-position="bottom"
		     on-confirm="s.change_filter_date" jackmail-refresh="true"
		     selected-date1="{{$root.filter.selected_date1}}" selected-date2="{{$root.filter.selected_date2}}">
		</div>
	</div>
</div>
<div class="jackmail_statistics_filters">
	<div class="jackmail_statistics_filters_buttons">
		<div ng-repeat="segment in s.selected_segments track by $index"
		     ng-click="s.select_unselect_segment( segment.type, segment.id );s.validate_segments( false )"
		     class="jackmail_statistics_filters_buttons_segment">
			<div class="dashicons dashicons-no-alt"></div>
			<span>{{segment.name}}</span>
		</div>
	</div>
	<div ng-show="s.show_segments" class="jackmail_statistics_filters_dropdown">
		<div class="jackmail_statistics_filters_dropdown_header">
			<div><?php _e( 'Segment name', 'jackmail-newsletters' ) ?></div>
		</div>
		<div class="jackmail_statistics_filters_dropdown_left">
			<p class="jackmail_center jackmail_segment_validation">
				<input ng-click="s.validate_segments( false )"
				       class="jackmail_green_button jackmail_statistics_filters_validate" type="button"
				       value="<?php esc_attr_e( 'OK', 'jackmail-newsletters' ) ?>"/>
			</p>
		</div>
		<div class="jackmail_statistics_filters_dropdown_right">
			<div ng-show="s.segments_type === 'popular' || s.segments_type === 'all'">
				<div ng-repeat="segment in s.segments_popular track by $index">
					<span jackmail-checkbox="segment.selected"
					      ng-click="s.select_unselect_segment( 'popular', segment.id )"
					      checkbox-title="{{segment.name}}">
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>