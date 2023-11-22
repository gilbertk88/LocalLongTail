<style>
	.ewm_llt_inner_wrapper_location{
		margin: 20px;
		background-color: #fff;
		border-radius: 10px;
		padding: 20px;
	}
	.ewm_llt_main_t_location{
		width: 100%;
	}
	.ewm_llt_header_h_location{
		padding: 10px;
		background-color: #f9f9f9;
		color: #333;
		border-radius: 6px;
	}
	.ewm_llt_header_b_location{
		padding: 4px;
		background-color: #fff;
		color: #607d8b;
	}
	.ewm_llt_main_edit_button_location{
		padding: 10px 30px;
		background-color: skyblue;
		border: 0px solid skyblue;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
	}
	.ewm_llt_new_location{
		background-color: #f9f9f9;
		color: #333;
		float: right;
		margin: 5px 15px 20px 5px;
		border: 3px solid #ccc;
		padding: 10px 30px;
		border-radius: 5px;
		cursor: pointer;
	}
	.ewmLltGroupDeleteButtonLocation{			
		background: #fff;
		border: 0px solid;
		border-radius: 10px;
		padding: 10px;
		cursor: pointer;
		color: #ccc;
	}
	.ewmLltGroupEditButtonLocation{
		padding: 10px;
		background-color: yellowgreen;
		border: 0px;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
		color: #fff;
	}
	.ewm_manage_link_a{
		color: #fff;
	}
</style>

<div class="ewm_llt_wrapper_location">
	<div class="ewm_llt_inner_wrapper_location">
		<div class="ewm_llt_header_main_location">
			<center>
				<h2>Locations Groups</h2>
			</center>
		</div>
		<div class="ewm_llt_body_main_location">
			<input value="New Group" class="ewm_llt_new_location" type="button">
			<?php
				// get main posts
				// create post
				// edit post
			?>
			<table class="ewm_llt_main_t_location" >
				<tr>
					<td class="ewm_llt_header_h_location">
						<center>Group ID</center>
					</td>
					<td class="ewm_llt_header_h_location">
						<center>Group Name</center>
					</td>
					<td class="ewm_llt_header_h_location">
						<center>No. of Locations in Group</center>
					</td>
					<td class="ewm_llt_header_h_location"></td>
				</tr>
				<?php

				$post_parent_list = get_posts([
					// 'post_parent'   => $args['order_id'],
					"post_type"     => "ewmLocalGroup",
					"post_status"   => "active",
					"posts_per_page" => "-1",
					/*'meta_query'    => [
						[
							'key'       => 'ewm_dpm_product_id',
							'value'     => $args['product_id'],
							'compare'   => 'LIKE'
						]
					] */
				]);				

				$main_llt_arr = array();
				foreach ($post_parent_list  as $key_d => $value_d) {

					$post_child_list = get_posts( [
						// 'post_parent'   => $args['order_id'],
						"post_type" => "ewm_local_llt",
						"post_status" => "active",
						"posts_per_page" => "-1",
						"post_parent" => $value_d->ID,
					] );

					$ewm_location_data = get_post_meta( $value_d->ID , 'ewm_location_l', true );

					if( is_array($ewm_location_data) ) {
						$no_of_locations = 0;
						foreach( $ewm_location_data as $K_index => $_value ){
							if($_value == 'true') {
								$no_of_locations++;
							}
						}
					}
					else{
						$no_of_locations = 0;
					}

					?>
					<tr class="ewm_llt_location_name_<?php echo $value_d->ID; ?>" >
						<td class="ewm_llt_header_b_location">
							<center>#<?php echo $value_d->ID; ?></center>
						</td>
						<td class="ewm_llt_header_b_location">
							<center><?php echo $value_d->post_title; ?></center>
						</td>
						<td class="ewm_llt_header_b_location">
							<center><?php echo $no_of_locations; ?></center>
						</td>
						<td class="ewm_llt_header_b_location">
							<center>
								<a class="ewm_manage_link_a" href="<?php echo admin_url( 'admin.php?page=ewm-dpm-lltlocationgroup&ewmLltLocationGroupId=' . $value_d->ID ); ?>" >
									<input type="button" class="ewmLltGroupEditButtonLocation" value="Open" data-llt-location-post-title="<?php echo $value_d->post_title; ?>" data-llt-location-post-id="<?php echo $value_d->ID; ?>">
								</a>
								<span  data-llt-location-post-title="<?php echo $value_d->post_title; ?>" data-llt-location-post-id="<?php echo $value_d->ID; ?>" class="ewmLltGroupDeleteButtonLocation dashicons dashicons-trash"></span>
							</center>
						</td>
					</tr>
				<?php } ?>

			</table>
		</div>
	</div>
</div>

<?php
	$location_list_url = LLT_HOME_DIR . '/templates/admin/locationllt/popup/location_group_popup_llt.php';
	include_once $location_list_url;
?>