<?php if ( defined( 'ABSPATH' ) ) { ?>
<div ng-show="$root.display_links_list">
	<div class="jackmail_grid_buttons">
		<div class="jackmail_left">
			<span class="jackmail_statistics_nb_recipients">{{s3.nb_links_grid_total_rows | numberSeparator}}</span>
			<span ng-hide="s3.nb_links_grid_total_rows > 1"><?php _e( 'link', 'jackmail-newsletters' ) ?></span>
			<span ng-show="s3.nb_links_grid_total_rows > 1"><?php _e( 'links', 'jackmail-newsletters' ) ?></span>
		</div>
		<div jackmail-grid-search
		     jackmail-action="s3.get_links_data_search"
		     class="jackmail_right jackmail_grid_buttons_search jackmail_statistics_search">
		</div>
	</div>
	<div class="jackmail_grid_container">
		<div>
			<div class="jackmail_grid jackmail_grid_th" ng-class="$root.grid_service[ 4 ].grid_class">
				<table>
					<tr>
						<th ng-repeat="( key, column ) in s3.links_columns track by $index"
						    ng-click="column.field !== '' && (column.field !== 'url' || s3.nb_links_grid_total_rows < $root.settings.grid_limit) ?
						    s3.links_range_by( column.field ) : ''"
						    class="{{'jackmail_column_' + key}}"
						    ng-class="column.field !== '' && (column.field !== 'url' || s3.nb_links_grid_total_rows < $root.settings.grid_limit) ?
						    'jackmail_column_ordering' : ''">
							<span>{{column.name}}</span>
						</th>
						<th></th>
					</tr>
				</table>
			</div>
			<div class="jackmail_grid jackmail_grid_content_defined"
			     ng-class="$root.grid_service[ 4 ].grid_class"
			     grid-scroll="$root.grid_service[ 4 ]"
			     grid-total="s3.nb_links_grid_total_rows"
			     grid-load="s3.get_links_data_more">
				<table>
					<tr ng-repeat="( key, contact ) in s3.links_grid track by $index">
						<td class="jackmail_column_1">
							<span>{{contact.url}}</span>
						</td>
						<td class="jackmail_column_2 jackmail_statistics_clicks">
							<span>{{contact.clicks | numberSeparator}}</span>
							<span>({{contact.clicks_percent | numberSeparator}} %)</span>
						</td>
						<td class="jackmail_column_3 jackmail_statistics_clickers">
							<span>{{contact.clickers | numberSeparator}}</span>
							<span>({{contact.clickers_percent | numberSeparator}} %)</span>
						</td>
						<td class="jackmail_column_4">
							<input type="button" value="<?php esc_attr_e( 'See more', 'jackmail-newsletters' ) ?>"
							       ng-click="s3.display_link_details( contact.url )" class="jackmail_green_button"/>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div ng-show="s3.links_grid_data_loaded && s3.links_grid.length === 0" class="jackmail_statistics_no_data">
			<?php _e( 'No data', 'jackmail-newsletters' ) ?>
		</div>
	</div>
</div>
<div ng-hide="$root.display_links_list">
	<div class="jackmail_grid_buttons">
		<div class="jackmail_left">
			<input ng-show="!$root.display_links_list && s3.nb_links_grid_total_rows !== ''"
			       type="button" value="<?php esc_attr_e( 'Previous', 'jackmail-newsletters' ) ?>"
			       ng-click="s3.hide_link_details()" class="jackmail_green_button"/>
			<span class="jackmail_statistics_link_detail_title">
				<?php _e( 'Link:', 'jackmail-newsletters' ) ?> {{s3.link_details}}
			</span>
		</div>
		<div jackmail-grid-search
		     jackmail-action="s3.get_link_details_data_search"
		     class="jackmail_right jackmail_grid_buttons_search jackmail_statistics_search">
		</div>
	</div>
	<div class="jackmail_grid_container">
		<div>
			<div class="jackmail_grid jackmail_grid_th" ng-class="$root.grid_service[ 5 ].grid_class">
				<table>
					<tr>
						<th ng-repeat="( key, column ) in s3.link_details_columns track by $index"
						    ng-click="column.field === 'email' || (column.field === 'clicks'|| s3.nb_link_details_grid_total_rows < $root.settings.grid_limit) ?
						    s3.link_details_range_by( column.field ) : ''"
						    class="{{'jackmail_column_' + key}}"
						    ng-class="column.field === 'email' || (column.field === 'clicks'|| s3.nb_link_details_grid_total_rows < $root.settings.grid_limit) ?
						    'jackmail_column_ordering' : ''">
							<span>{{column.name}}</span>
						</th>
					</tr>
				</table>
			</div>
			<div class="jackmail_grid jackmail_grid_content_defined"
			     ng-class="$root.grid_service[ 5 ].grid_class"
			     grid-scroll="$root.grid_service[ 5 ]"
			     grid-total="s3.nb_link_details_grid_total_rows"
			     grid-load="s3.get_link_details_data_more">
				<table>
					<tr ng-repeat="( key, contact ) in s3.link_details_grid track by $index">
						<td class="jackmail_column_1">
							<span>{{contact.email}}</span>
						</td>
						<td class="jackmail_column_2">
							<span>{{contact.clicks | numberSeparator}}</span>
						</td>
						<td class="jackmail_column_3">
							<span>{{contact.opens | numberSeparator}}</span>
						</td>
						<td class="jackmail_column_4">
							<span>
								{{contact.unsubscribes > 0 ?
								'<?php esc_attr_e( 'Yes', 'jackmail-newsletters' ) ?>' :
								'<?php esc_attr_e( 'No', 'jackmail-newsletters' ) ?>'}}
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div ng-show="s3.link_details_grid_data_loaded && s3.link_details_grid.length === 0" class="jackmail_statistics_no_data">
			<?php _e( 'No data', 'jackmail-newsletters' ) ?>
		</div>
	</div>
</div>
<?php } ?>