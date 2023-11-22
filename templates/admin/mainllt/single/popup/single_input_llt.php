<?php

	$_s_keyword_name = '';

	if( $_keyword_id > 0 ){

		$_keyword_data = get_post( $_keyword_id );
		// var_dump( $_keyword_data->post_title );
		$_s_keyword_name = $_keyword_data->post_title;

	}
	
?>
<style>
	.ewm_llt_delete_kw_t{
		width:100%;
		overflow:auto;
		padding: 10px;
	}
	.ewm_dpm_delete_keyword{
		float:right;
		background:#f78537;
		color:black;
		border:0px solid black;
		padding: 10px;
		border-radius: 30px;
		cursor: pointer;
	}
	.ewm_llt_location_group_title{
		padding: 10px 30px;
		font-size: 15px;
		font-weight: bold;
	}
	.ewm_create_location_group{
		border-radius: 15px;
		margin: 23px;
		padding: 10px 30px;
		background-color: #f9f9f9 !important;
		border: 2px solid #ccc !important;
		cursor: pointer;
		background: #fff;
		text-decoration: none;
		color:#333;
	}
	.ewm_create_location_group_t{
		padding: 10px;
	}
	.ewm_create_location_group_b{
		padding: 10px;
	}
</style>

<div class="ewm_llt_main_body" id="ewm_llt_main_wrapper_<?php echo $_keyword_id; ?>">
	<div class="ewm_llt_subbody_main">
		<div class="ewm_llt_locations_list">
			<!--
			<div class="ewm_llt_keyword_edit_wrapper">				
				<div class="ewm_llt_delete_kw_t">
					<?php if( $_keyword_id > 0 ) { ?>
						<input value="Delete Keyword" type="button" class="ewm_dpm_delete_keyword" data-keyword-id="<?php echo $_keyword_id; ?>" />
					<?php } ?>
				</div>
				<div class="ewm_llt_edit_kw_t">
					Keyword
				</div>
				<div class="ewm_llt_keyword_edit">
					<input type="text" value="<?php echo $_s_keyword_name ; ?>" class="ewm_llt_kw_edit_area ewm_llt_kw_edit_area_<?php echo $_keyword_id; ?>" data-keyword-id="<?php echo $_keyword_id; ?>">
				</div>
				<div class="ewm_llt_keyword_edit_link">
					<span class="ewm_llt_kw_edit_link_1"><?php echo get_site_url(); ?>/</span>
					<span class="ewm_llt_kw_edit_link_2"><?php					
						echo str_replace(" ", "-", $_s_keyword_name );
					?></span>
					<span class="ewm_llt_kw_edit_link_3">/</span>
					<span class="ewm_llt_kw_edit_link_4">city-nj</span>
				</div>
			</div> -->
			<div class="ewm_llt_locations_single_all">
				<!--
				<span>
					<input type="checkbox" class="ewm_llt_checkbox_item_all ewm_llt_checkbox_item_all_<?php echo $_keyword_id; ?>" data-keyword-id="<?php echo $_keyword_id; ?>" >
				</span>
				<span>
					Select/ Deselect All
				</span>
				-->
				<div class="ewm_llt_location_group_title">
					Location Groups
				</div>
			</div>

			<?php

			$post_parent_list = get_posts([
				"post_type"     => "ewmLocalGroup",
				"post_status"   => "active",
				"posts_per_page"	=> "-1",
			]);

			$llt_locations = maybe_unserialize( get_post_meta( $_GET['ewm_llt_id'] , 'llt_locations', true ) );
			if( is_string( $llt_locations ) || $llt_locations == false ){
				$llt_locations = [];
			}

			if( count($post_parent_list) == 0 ){
				$lltlocationgroup_url = admin_url( 'admin.php?page=ewm-dpm-lltlocationgroup' );
				echo '<center>
					<div class="ewm_create_location_group_t">
						There are no locations groups
					</div>
					<div class="ewm_create_location_group_b">
						<a href="'. $lltlocationgroup_url .'" class="ewm_create_location_group">Create location group</a>
					</div>
				</center>';
			}

			foreach( $post_parent_list as $_key_l => $_value_l ) {
				$_is_checked = '';
				if( array_key_exists( $_value_l->ID ,$llt_locations) ){
					if ($llt_locations[$_value_l->ID ] == 'true') {
						$_is_checked = 'checked';
					}
				}
			?>
				<div class="ewm_llt_locations_single">
					<span>
						<input type="checkbox" class="ewm_llt_checkbox_item ewm_llt_checkbox_<?php echo $_keyword_id; ?> " data-keyword-id="<?php echo $_keyword_id; ?>" data-location-id="<?php echo $_value_l->ID ; ?>" <?php echo $_is_checked; ?> />
					</span>
					<span>
						<?php echo $_value_l->post_title ; ?>
					</span>
				</div>
			<?php }	?>
			<div>
			</div>
			<div class="ewm_llt_locations_single_all">
				<!--
				<span>
					<input type="checkbox" class="ewm_llt_checkbox_item_all" data-keyword-id="<?php echo $_keyword_id; ?>" />
				</span>
				<span>
					Select/ Deselect All
				</span>
				-->
			</div>
		</div>
	</div>
</div>


