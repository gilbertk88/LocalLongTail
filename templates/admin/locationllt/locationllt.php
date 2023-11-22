<style>
	#wpfooter {
		position: relative !important;
	}
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
		border-radius: 5px;
	}
	.ewm_llt_header_b_location{
		padding: 4px;
		background-color: #fff;
		color: #607d8b;
	}
	.ewm_llt_main_edit_button_location{
		padding: 10px 10px;
		background-color: yellowgreen;
		border: 0px;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
		color: #fff;
	}
	.ewm_llt_new_location{
		float: right;
		background-color: #f9f9f9;
		color: #333;
		border: 0px;
		padding: 10px 15px;
		border-radius: 10px;
		cursor: pointer;
		margin: 5px;
		border: 2px solid #ccc;
	}
	.ewm_llt_main_delete_button_location{
		background: #fff;
		border: 0px;
		border-radius: 10px;
		padding: 10px;
		cursor: pointer;
		color:#ccc;
	}
	.ewm_group_name_edit_text{
		padding: 10px;
		border-radius: 8px;
		border: 2px solid #ccc;
	}
	.ewm_llt_s_search_item{
		float: left;
		padding: 10px;
		border-radius: 5px;
		border: #ccc 2px solid;
		margin: 10px 10px 10px 0px;
		cursor: pointer;
		background: #f6f7f7 !important;
	}
</style>

<div class="ewm_llt_wrapper_location">
	<div class="ewm_llt_inner_wrapper_location">
		<div class="ewm_llt_header_main_location">
			<center>
				<?php 
					$ewmLltLocationGroup = get_post( $_GET['ewmLltLocationGroupId'] );
					$ewm_location_l = get_post_meta( $_GET['ewmLltLocationGroupId'], 'ewm_location_l' , true );
					// var_dump($ewm_location_l);
				?>
				<h2>
					Locations Group Name(#<?php echo $_GET['ewmLltLocationGroupId'] ; ?>): <input value= "<?php echo $ewmLltLocationGroup->post_title; ?>" class="ewm_group_name_edit_text" data-ewm-group-id = "<?php echo $_GET['ewmLltLocationGroupId']; ?>" />
				</h2>
			</center>
		</div>
		<div class="ewm_llt_body_main_location">
			<input value="New Child Location" class="ewm_llt_new_location" type="button">
			<?php
				// get main posts
				// create post
				// edit post	
			?>
			<table class="ewm_llt_main_t_location" >
				<tr>
					<td class="ewm_llt_header_h_location">
						<center>Child Locations</center>
					</td>
					<td class="ewm_llt_header_h_location"></td>
				</tr>

				<?php
				/*
					$post_parent_list = get_posts([
						"post_type" => "ewm_local_llt",
						"post_status" => "active",
						"posts_per_page" => "-1",
						"post_parent" => $_GET['ewmLltLocationGroupId'],
					]);
				*/

				$main_llt_arr = array();
				if( !is_array( $ewm_location_l ) ){
					$ewm_location_l = [] ;
				}

				foreach ( $ewm_location_l as $key_d => $status ) {

					if( $status == 'true') {
						$value_d = get_post( $key_d );
						$value_d_ID = $key_d ;
						$value_d_post_title = '' ;

						if( is_object( $value_d ) ){
							$value_d_post_title = $value_d->post_title ;
						}
    				?>
					<tr class="ewm_llt_location_name_<?php echo $value_d->ID; ?>" >
						<td class="ewm_llt_header_b_location">
							<center><?php echo $value_d_post_title; ?> (#<?php echo $value_d_ID; ?>)</center>
						</td>
						<td class="ewm_llt_header_b_location">
							<center>
								<input type="button" class="ewm_llt_main_edit_button_location" value="Open" data-llt-location-post-title="<?php echo $value_d_post_title; ?>" data-llt-location-post-id="<?php echo $value_d_ID; ?>">
								<span data-llt-location-post-title="<?php echo $value_d_post_title; ?>" data-llt-location-post-id="<?php echo $value_d_ID; ?>" class="ewm_llt_main_delete_button_location dashicons dashicons-trash"></span>
							</center>
						</td>
					</tr>
					<?php
					}

				}

				?>

			</table>
		</div>
	</div>
</div>

<?php
	$location_list_url = LLT_HOME_DIR . '/templates/admin/locationllt/popup/location_popup_llt.php';
	include_once $location_list_url;
?>

<input type="hidden" id="ewmPostGroup" value="<?php echo $_GET[ 'ewmLltLocationGroupId' ]; ?>"/>
