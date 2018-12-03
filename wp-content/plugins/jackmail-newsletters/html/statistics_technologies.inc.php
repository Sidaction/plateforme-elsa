<?php if ( defined( 'ABSPATH' ) ) { ?>
<div id="jackmail_chartjs_technologies_tooltip"></div>
<div class="jackmail_statistics_technologies_graphics">
	<div>
		<p class="jackmail_technologies_title"><?php _e( 'Desktop/mobile distribution', 'jackmail-newsletters' ) ?></p>
		<div class="jackmail_statistics_technologies_numbers">
			<div>
				<span>{{s4.technologies_os_total.desktop_percent}} %</span>
				<br/>
				<span><?php _e( 'Desktops', 'jackmail-newsletters' ) ?></span>
			</div>
			<div>
				<span>{{s4.technologies_os_total.mobile_percent}} %</span>
				<br/>
				<span><?php _e( 'Mobiles / Tablets', 'jackmail-newsletters' ) ?></span>
			</div>
		</div>
		<div ng-show="s4.technologies_os_details.length > 0" class="jackmail_statistics_technologies_graphic_container">
			<div>
				<p ng-repeat="value in s4.technologies_os_details | limitTo: 5 | filter: type = 'desktop' track by $index">
					<span ng-style="{ 'background': value.color }"></span>
					{{value.percent}} % {{value.name}}
				</p>
			</div>
			<div ng-repeat="value in s4.technologies_graphic track by $index" class="jackmail_statistics_technologies_graphic">
				<canvas width="130" height="130" id="jackmail_chartjs_technologies_os"></canvas>
			</div>
			<div>
				<p ng-repeat="value in s4.technologies_os_details | limitTo:5 | filter: type = 'mobile' track by $index">
					{{value.percent}} % {{value.name}}
					<span ng-style="{ 'background': value.color }"></span>
				</p>
			</div>
		</div>
	</div>
	<div>
		<p class="jackmail_technologies_title"><?php _e( 'Email tools', 'jackmail-newsletters' ) ?></p>
		<div class="jackmail_statistics_technologies_numbers">
			<div>
				<span>{{s4.technologies_softwares_total.application_percent}} %</span>
				<br/>
				<span><?php _e( 'Desktop clients', 'jackmail-newsletters' ) ?></span>
			</div>
			<div>
				<span>{{s4.technologies_softwares_total.webmail_percent}} %</span>
				<br/>
				<span><?php _e( 'Web based clients', 'jackmail-newsletters' ) ?></span>
			</div>
		</div>
		<div ng-show="s4.technologies_softwares_details.length > 0" class="jackmail_statistics_technologies_graphic_container">
			<div>
				<p ng-repeat="value in s4.technologies_softwares_details | limitTo: 5 | filter: type = 'application' track by $index">
					<span ng-style="{ 'background': value.color }"></span>
					{{value.percent}} % {{value.name}}
				</p>
			</div>
			<div ng-repeat="value in s4.technologies_graphic track by $index" class="jackmail_statistics_technologies_graphic">
				<canvas width="130" height="130" id="jackmail_chartjs_technologies_softwares"></canvas>
			</div>
			<div>
				<p ng-repeat="value in s4.technologies_softwares_details | limitTo:5 | filter: type = 'webmail' track by $index">
					{{value.percent}} % {{value.name}}
					<span ng-style="{ 'background': value.color }"></span>
				</p>
			</div>
		</div>
	</div>
</div>
<div>
	<p class="jackmail_technologies_title"><?php _e( 'Profile distribution', 'jackmail-newsletters' ) ?></p>
	<div class="jackmail_technologies_selectors_container">
		<div><?php _e( 'First variable', 'jackmail-newsletters' ) ?></div>
		<div class="jackmail_dropdown_button_container" ng-mouseleave="$root.grid_service[ 2 ].hide_columns_button()">
			<span jackmail-dropdown-button-visible span-title="{{s4.technologies_first_selected.name}}"
			      ng-click="$root.grid_service[ 2 ].display_or_hide_columns_button()"></span>
			<div ng-show="$root.grid_service[ 2 ].display_columns_button" ng-click="$root.grid_service[ 2 ].hide_columns_button()">
				<div class="jackmail_dropdown_button_border_container">
					<span class="jackmail_dropdown_button_border_top"></span>
					<span class="jackmail_dropdown_button_border_top2"></span>
				</div>
				<div class="jackmail_dropdown_button_content">
					<span ng-repeat="technologie in s4.technologies_first track by $index"
					      ng-show="technologie.name !== s4.technologies_second_selected.name"
					      ng-click="s4.check_or_uncheck_technology_first( technologie.value )"
					      class="jackmail_dropdown_button_click {{s4.technologies_first_selected.value === technologie.value ? 'jackmail_dropdown_button_choice_selected' : ''}}">
						{{technologie.name}}
					</span>
				</div>
			</div>
		</div>
		<div><?php _e( 'Second variable', 'jackmail-newsletters' ) ?></div>
		<div class="jackmail_dropdown_button_container" ng-mouseleave="$root.grid_service[ 3 ].hide_columns_button()">
			<span jackmail-dropdown-button-visible span-title="{{s4.technologies_second_selected.name}}"
			      ng-click="$root.grid_service[ 3 ].display_or_hide_columns_button()"></span>
			<div ng-show="$root.grid_service[ 3 ].display_columns_button" ng-click="$root.grid_service[ 3 ].hide_columns_button()">
				<div class="jackmail_dropdown_button_border_container">
					<span class="jackmail_dropdown_button_border_top"></span>
					<span class="jackmail_dropdown_button_border_top2"></span>
				</div>
				<div class="jackmail_dropdown_button_content">
					<span ng-repeat="technologie in s4.technologies_second track by $index"
					      ng-show="technologie.name !== s4.technologies_first_selected.name"
					      ng-click="s4.check_or_uncheck_technology_second( technologie.value )"
					      class="jackmail_dropdown_button_click {{s4.technologies_second_selected.value === technologie.value ? 'jackmail_dropdown_button_choice_selected' : ''}}">
						{{technologie.name}}
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="jackmail_technologies_grid">
		<div class="jackmail_grid_container">
			<div class="jackmail_grid_header">
				<span class="jackmail_statistics_grid_header_title"><?php _e( 'Profiles', 'jackmail-newsletters' ) ?></span>
			</div>
			<div class="jackmail_grid jackmail_grid_th" ng-class="$root.grid_service[ 3 ].grid_class">
				<table>
					<tr>
						<th ng-show="s4.technologies_first_selected.value === 'messagerie'"
						    ng-click="s4.technology_range_by( 'messagerie' )" class="jackmail_column_ordering">
							<span><?php _e( 'Email client', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_first_selected.value === 'type_messagerie'"
						    ng-click="s4.technology_range_by( 'type_messagerie' )" class="jackmail_column_ordering">
							<span><?php _e( 'Email client category', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_first_selected.value === 'os'"
						    ng-click="s4.technology_range_by( 'os' )" class="jackmail_column_ordering">
							<span><?php _e( 'O.S.', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_first_selected.value === 'type_device'"
						    ng-click="s4.technology_range_by( 'type_device' )" class="jackmail_column_ordering">
							<span><?php _e( 'Device category', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_second_selected.value === 'messagerie'"
						    ng-click="s4.technology_range_by( 'messagerie' )" class="jackmail_column_ordering">
							<span><?php _e( 'Email client', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_second_selected.value === 'type_messagerie'"
						    ng-click="s4.technology_range_by( 'type_messagerie' )" class="jackmail_column_ordering">
							<span><?php _e( 'Email client category', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_second_selected.value === 'os'"
						    ng-click="s4.technology_range_by( 'os' )" class="jackmail_column_ordering">
							<span><?php _e( 'O.S.', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-show="s4.technologies_second_selected.value === 'type_device'"
						    ng-click="s4.technology_range_by( 'type_device' )" class="jackmail_column_ordering">
							<span><?php _e( 'Device category', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-click="s4.technology_range_by( 'openings' )" class="jackmail_column_ordering">
							<span><?php _e( 'Openings', 'jackmail-newsletters' ) ?></span>
						</th>
						<th ng-click="s4.technology_range_by( 'percent' )" class="jackmail_column_ordering">
							<span><?php _e( 'Distribution', 'jackmail-newsletters' ) ?></span>
						</th>
					</tr>
				</table>
			</div>
			<div class="jackmail_grid jackmail_grid_content_defined" ng-class="$root.grid_service[ 3 ].grid_class">
				<table>
					<tr ng-repeat="technology in s4.technologies_grid track by $index" ng-hide="technology.hidden">
						<td ng-show="s4.technologies_first_selected.value === 'messagerie'">
							{{technology.messagerie | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_first_selected.value === 'type_messagerie'">
							{{technology.type_messagerie | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_first_selected.value === 'os'">
							{{technology.os | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_first_selected.value === 'type_device'">
							{{technology.type_device | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_second_selected.value === 'messagerie'">
							{{technology.messagerie | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_second_selected.value === 'type_messagerie'">
							{{technology.type_messagerie | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_second_selected.value === 'os'">
							{{technology.os | firstUppercaseOthersLowercase}}
						</td>
						<td ng-show="s4.technologies_second_selected.value === 'type_device'">
							{{technology.type_device | firstUppercaseOthersLowercase}}
						</td>
						<td>
							{{technology.openings | numberSeparator}}
						</td>
						<td>
							<span class="jackmail_green">{{technology.percent}} %</span>
						</td>
					</tr>
				</table>
			</div>
			<div ng-show="s.nb_technologies_grid === 0" class="jackmail_statistics_no_data">
				<?php _e( 'No data', 'jackmail-newsletters' ) ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>