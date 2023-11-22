<style>
	.ewm_llt_background_main_lcl{
		width: 100%;
		height: 100%;
		background-color: #33333350;
		position:fixed;
		left: 0px;
		top: 0px;
		padding-left: 20%;
		display:none;
		z-index: 1000000;
	}
	.ewm_llt_background_inner_lcl{
		width: 80%;
		background-color: #fff !important;
		float: right;
		position: fixed;
		right: 0px;
		top: 0px;
		padding-top: 30px;
		height: 100%;
		padding-left: 20px;
		box-shadow: 0 5px 8px 0 rgb(151 151 151 / 10%), 0 6px 10px 0 rgb( 118 118 118 / 10% ) !important;
		overflow: auto;
	}
	.ewm_llt_background_inner_close_lcl{
		float: right;
		margin: 20px;
		border-radius: 10px;
		background-color: #f9f9f9 !important;
		border: 0px solid #ccc;
		padding: 12px 15px;
		cursor: pointer;
	}
	.ewm_llt_menu_top_lcl{
		width: 100%;
		overflow: auto;
	}
	.ewm_llt_main_body_lcl{
		width: 100%;
	}
	.ewm_llt_tabs_50_lcl{
		width: 49%;
		float: left;
		background: #fff;
		padding: 7px;
		border: 1px #646970 solid;
		border-radius: 9px;
		cursor: pointer;
	}
	.ewm_llt_tabs_50_active_lcl{
		background: #646970;
		color: #fff;
	}
	.ewm_llt_submenu_main_lcl{
		width:100%;
		overflow: auto;
	}
	.ewm_llt_subbody_main_lcl{
		width:100%;
		overflow: auto;
	}
	.ewm_llt_locations_single_lcl{
		padding: 50px;
		margin: 10px;
		border: 0px solid #dcdcde;
		border-radius: 5px;
	}
	.ewm_llt_locations_list_lcl{
		padding-bottom: 80px;
	}
	.ewm_llt_checkbox_item_lcl{
		padding: 5px 15px !important;
		width: 100% !important;
		border-radius: 10px !important;
		border: 1px #ccc solid !important;
	}
	.ewm_llt_locations_single_item_lcl{
		width:100%;
		overflow: auto;
		padding: 5px;
	}
	.ewm_llt_save_location_lcl{
		background-color: #f9f9f9;
		border-radius: 10px;
		color: #333;
		border: 2px #ccc solid;
		padding: 12px;
		cursor: pointer;
	}
	.ewm_llt_t_menu{
		width: 100%;
		padding: 8px;
	}
	.ewm_llt_delete_b_t{
		background-color: red;
		color: white;
		border-radius: 30px;
		border: 0px;
		float: right;
		padding: 8px;
		cursor: pointer;
	}
</style>

<div class="ewm_llt_background_main_lcl">
	<div class="ewm_llt_background_inner_lcl">
		<div class="ewm_llt_menu_top_lcl">
			<input type="button" value="Close[x]" class="ewm_llt_background_inner_close_lcl">
		</div>
		<div class="ewm_llt_main_body_lcl">
			<div class="ewm_llt_submenu_main_lcl">
			</div>
			<div class="ewm_llt_subbody_main_lcl">
				<div class="ewm_llt_locations_list_lcl">
					
						<div class="ewm_llt_locations_single_lcl">
							<div class="ewm_llt_t_menu">
								<!-- <input type="button" class="ewm_llt_delete_b_t" value="Delete Location"> -->
							</div>
							<div class="ewm_llt_locations_single_item_lcl">
								<center>Location Name</center>
							</div>
							<div  class="ewm_llt_locations_single_item_lcl">
								<center>
									<input type="text" class="ewm_llt_checkbox_item_lcl">
									<div class="ewm_llt_search_list_display">
									</div>
								</center>
							</div>
							<div  class="ewm_llt_locations_single_item_lcl">
								<center>
									<input type="button" class="ewm_llt_save_location_lcl" value="Save Location">
									<span class="ewm_llt_child_message_save_success"></span>
								</center>
							</div>
						</div>
					
						<div>						
						</div>
				</div>
			</div>
		</div>

	</div>

<?php

	$group_upgrade_llt = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/upgrade/child_location_upgrade_llt.php';
	// $EwmLLT_is_allowed = EwmLLT::is_allowed();
	// if( $EwmLLT_is_allowed == 'not_allowed' ) {
		include $group_upgrade_llt;
	// }

?>

</div>
