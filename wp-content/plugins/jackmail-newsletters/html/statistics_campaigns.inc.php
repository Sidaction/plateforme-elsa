<?php if ( defined( 'ABSPATH' ) ) { ?>
<div class="jackmail_statistics_content_left_title">
	<span jackmail-checkbox="$root.grid_service[ 0 ].nb_selected === s.campaigns_grid.length && $root.grid_service[ 0 ].nb_selected > 0"
	      ng-click="s.grid_select_or_unselect_all()"
	      ng-hide="s.campaigns_grid.length === 0">
	</span>
	<?php _e( 'Campaigns', 'jackmail-newsletters' ) ?>
</div>
<div ng-show="s.nb_campaigns === 0" class="jackmail_statistics_no_campaign">
	<?php _e( 'No campaigns', 'jackmail-newsletters' ) ?>
</div>
<div ng-style="{'maxHeight': s.left_height() + 'px'}" class="jackmail_statistics_content_left_campaigns">
	<div ng-repeat="( key, campaign ) in s.campaigns_grid track by $index"
	     class="jackmail_statistics_simplified_info"
	     ng-class="campaign.show_details ? 'jackmail_statistics_simplified_selected' : ''">
		<div class="jackmail_statistics_simplified_info_content">
			<div class="jackmail_statistics_simplified_info_selector">
				<span jackmail-checkbox="campaign.selected"
				      ng-click="s.grid_select_or_unselect_row( key )">
				</span>
			</div>
			<div class="jackmail_statistics_simplified_info_data">
				<span class="jackmail_bold">{{campaign.name}}</span>
				<br/>
				<span class="jackmail_grey">
				<span>
					<span><?php _e( 'Mailing date:', 'jackmail-newsletters' ) ?></span>
					<span>{{campaign.formatted_date_campaign_sent}}</span>
				</span>
				<span>
					{{campaign.nb_contacts_valids | numberSeparator}}
					<span ng-show="campaign.type === 'campaign'">
						<span ng-hide="campaign.nb_contacts_valids > 1"><?php _e( 'contact', 'jackmail-newsletters' ) ?></span>
						<span ng-show="campaign.nb_contacts_valids > 1"><?php _e( 'contacts', 'jackmail-newsletters' ) ?></span>
					</span>
					<span ng-show="campaign.type !== 'campaign'">
						<span ng-hide="campaign.nb_contacts_valids > 1"><?php _e( 'email', 'jackmail-newsletters' ) ?></span>
						<span ng-show="campaign.nb_contacts_valids > 1"><?php _e( 'emails', 'jackmail-newsletters' ) ?></span>
					</span>
				</span>
			</span>
			</div>
			<div class="jackmail_statistics_simplified_info_dropdown">
				<span ng-hide="campaign.show_details" ng-click="s.campaign_details( key )" class="dashicons dashicons-arrow-down-alt2"></span>
				<span ng-show="campaign.show_details" ng-click="s.campaign_details( key )" class="dashicons dashicons-arrow-up-alt2"></span>
			</div>
		</div>
		<div ng-show="campaign.show_details" class="jackmail_statistics_simplified_info_details {{$root.grid_service[ 0 ].grid_class}}">
			<div class="jackmail_column_0">
				<div><?php _e( 'Last modification:', 'jackmail-newsletters' ) ?></div>
				<div>{{campaign.updated_date_gmt | formatedDate : 'gmt_to_timezone' : 'hours'}}</div>
			</div>
			<div class="jackmail_column_2">
				<div><?php _e( 'Type:', 'jackmail-newsletters' ) ?></div>
				<div>{{campaign.type | campaignType}}</div>
			</div>
			<div class="jackmail_column_3">
				<div><?php _e( 'Campaign name:', 'jackmail-newsletters' ) ?></div>
				<div>{{campaign.name}}</div>
			</div>
			<div class="jackmail_column_4">
				<div><?php _e( 'Subject:', 'jackmail-newsletters' ) ?></div>
				<div>{{campaign.object}}</div>
			</div>
			<p>
				<img ng-src="{{campaign.preview}}"/>
			<p>
		</div>
	</div>
</div>
<?php } ?>