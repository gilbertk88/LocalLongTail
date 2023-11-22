<style>
.ewm_llt_background_main{
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
.ewm_llt_background_inner{
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
.ewm_llt_background_inner_close{
	float:right;
	margin:20px;
	border-radius: 10px;
	background-color:#f9f9f9 !important;
	border: 0px solid #ccc;
	padding: 15px;
	cursor:pointer;
}
.ewm_llt_menu_top{
	width: 100%;
	overflow: auto;
}
.ewm_llt_keyword_select_left{
    width: 38%;
    float: left;
    background-color: var(--e-context-warning-tint-1);
    color: var(--wc-secondary-text);
    height: 100%;
    padding: 8px;
    border-radius: 5px;
}
.ewm_llt_main_body{
	width: 90%;
	float: left;
	margin-left: 5%;
	padding-bottom: 50px;
}
.ewm_llt_tabs_50{
    width: 49%;
    float: left;
    background: #fff;
    padding: 7px;
    border: 1px #cccccc90 solid;
    border-radius: 3px;
    cursor: pointer;
	color: #333;
}
.ewm_llt_tabs_50_active{
    background: var(--wc-secondary);
    color: #333;
}
.ewm_llt_submenu_main{
	width:100%;
	overflow: auto;
}
.ewm_llt_subbody_main{
	width:100%;
	overflow: auto;
}
.ewm_llt_locations_single{
    padding: 10px 0px 3px 12px;
    margin: 0px 30px;
    border: 0px;
    border-radius: 5px;
    background: #f9f9f9c4;
}
.ewm_llt_locations_list{
    width: 100%;
    background: #cccccc17;
    border-radius: 8px;
}
.ewm_llt_no_keyword_selected{
	padding: 100px 20px 20px 20px;
	color: #515151;
	display: none;
}
.ewm_llt_generate_long_tail_list{
    width: 90%;
    padding: 25px 30px;
    background: #f9f9f9;
    margin-left: 5%;
    border-radius: 10px;
}
.ewm_llt_ttle{
	background: #646970;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
}
.ewm_llt_generate_long_tail_button{
    border-radius: 15px;
    margin: 23px;
    padding: 10px 30px;
    background-color: #f9f9f9 !important;
    border: 2px solid #ccc !important;
    cursor: pointer;
    background: #fff;
}
.ewm_llt_generate_long_tail_menu{
	width:100%;
	padding: 0px;
}
.ewm_llt_generate_long_tails{
	width: 95%;
	display: none;
	
}
.ewm_dpm_single_title_link{
    width: 100%;
    padding: 6.8px;
    border: 0px solid #cccccc2e;
    margin-bottom: 2px;
    border-radius: 3px;
}
.ewm_llt_locations_single_all{
	color: #333;
	padding: 8px;
	border-radius: 3px;
	margin-top: 20px;
	width: 98%;
	border: 0px;
}
.ewm_llt_checkbox_item_all{}
.ewm_llt_kw_table{
	display: none;
}
.ewm_llt_single_raw{
	border: 1px solid #fff;
	padding: 5px;
}
.ewm_llt_edit_kw_item{
	background-color: #8eadbf;
	cursor: pointer;
	border-radius: 30px;
	padding: 8px 10px;
	border: 0px #333 solid;
	color: #fff;
}
.ewm_llt_edit_kw_item_new{
	background-color: #333;
	cursor: pointer;
	border-radius: 30px;
	padding: 8px 10px;
	border: 0px var(--wc-blue) solid;
	color: #fff;
	margin: 30px;
}
.ewm_llt_left_kw_item{
	border-bottom: #fff;
	min-width: 260px;
	padding: 10px;
}
.ewm_llt_keyword_edit_wrapper{
	width: 100%;
	padding: 15px;
}
.ewm_llt_kw_edit_area{
    width: 96.8%;
    margin: 10px;
}
.ewm_llt_edit_kw_t{
    float: left;
    padding: 15px 8px 0px 10px;
}
.ewm_llt_keyword_edit{
	background-color: #fcb92c66;
	border-radius: 10px;
}
.ewm_llt_keyword_edit_link{
	width: 100%;
}
.ewm_llt_kw_edit_link_1{
	float: left;
}
.ewm_llt_kw_edit_link_2{
	float: left;
}
.ewm_llt_kw_edit_link_3{
	float: left;
}
.ewm_llt_kw_edit_link_4{
	float: left;
}
.ewm_llt_left_kw_item{
	cursor:pointer;
}
.ewm_llt_menu_key_manager{
	width:100%;
}
.ewm_llt_menu_l_s, .ewm_llt_menu_r_s{
    float: left;
    background-color: #9acd3230;
    color: #333;
    border-radius: 15px;
    width: 49%;
    cursor: pointer;
    padding: 10px;
	border:2px solid #fff;
}
.ewm_dpm_single_title_link_a{
	color:#333 !important;
}
.ewm_llt_generate_message_response{
	padding:5px;
}
</style>

<div class="ewm_llt_background_main">
	<div class="ewm_llt_background_inner">
		<div class="ewm_llt_menu_top">
			<input type="button" value="Close[x]" class="ewm_llt_background_inner_close">
		</div>
		<div class="ewm_llt_menu_key_manager">			
			<input type="button" class="ewm_llt_menu_l_s" value="Manage Location Groups">
			<input type="button" class="ewm_llt_menu_r_s" value="Generate/ View Children Posts">
		</div>

		<div class="ewm_llt_l_key_section">			
			<div class="ewm_llt_keyword_select_left">
				<table class="ewm_llt_kw_table">
					<tr class="ewm_llt_single_raw">
						<td class="ewm_llt_left_kw_item"></td>
						<td><input type="button" value="New Keyword" class="ewm_llt_edit_kw_item_new" data-keyword-id=""></td>
					</tr>
					<?php

						$post_parent_list_keyword = get_posts( [
							"post_status"       => "publish",
							"post_parent"       => $_GET['ewm_llt_id'],            
							"post_type"         => "ewmkeyword",
							"posts_per_page"	=> "-1",
						] );
						
						foreach ( $post_parent_list_keyword as $k_list => $v_list ) {
						?>
						<tr class="ewm_llt_single_raw ewm_llt_keyword_name_<?php echo $v_list->ID; ?>" >
							<td class="ewm_llt_left_kw_item ewm_llt_left_kw_item_<?php echo $v_list->ID; ?>">
								<?php 
									echo $v_list->post_title;
								?>
							</td>
							<td>
								<input type="button" value="edit keyword" class="ewm_llt_edit_kw_item" data-keyword-id="<?php echo $v_list->ID; ?>">
							</td>
						</tr>
						<?php } ?>
				</table>
			</div>

				<div class="ewm_llt_no_keyword_selected">
					<center>
						Select an option on the left to get started.
					</center>
				</div>
				<?php
					// var_dump( get_post_meta( 1208 ) );
					$_keyword_id = 0;
					// $single_input_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/single_input_llt.php';
					// include $single_input_url;
					// foreach( $post_parent_list_keyword as $k_n => $v_n ){
						// $_keyword_id = $v_n->ID;
						$single_input_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/single_input_llt.php';
						include $single_input_url;
					//}

				?>
			</div>
			<?php

				$generating_value = "Generate child posts now";

			?>

			<div class="ewm_llt_generate_long_tails">
				<div class="ewm_llt_generate_long_tail_menu">
					<center>
						<input type="button" value="<?php echo $generating_value; ?>" class="ewm_llt_generate_long_tail_button ewm_llt_generate_long_tail_button_<?php echo $_keyword_id; ?>" data-keyword-id="<?php echo $_keyword_id; ?>" >
						<span class="ewm_llt_generate_message_response"></span>
					</center>
				</div>
				<div class="ewm_llt_generate_long_tail_list ewm_llt_generate_llt_list_" >
					<?php

						// foreach ( $_keyword_item_posts as $k_d => $v_d ) {

							echo '<div class="ewm_dpm_single_title_link">
								<span class="ewm_llt_ttle"> Parent Title: <span class="ewm_llt_post_title_d">'. $ewm_post_title .' </span> </span>
							</div>';

							$_item_posts = get_posts( [
								"post_status" => "publish",
								"posts_per_page" => "-1",
								'post_parent' => $_GET['ewm_llt_id'],
								'meta_query' => [
									[
										'relation'        => 'AND',
										[
											'key'       => 'ewm_dpm_post_type',
											'value'     => 'llt_child',
											'compare'   => '='
										]
									]
								]
							] );

							// var_dump( $_item_posts );
							foreach ( $_item_posts as $_item_k => $_item_v ) {

								$_item_v_URL = admin_url('post.php?post='.  $_item_v->ID .'&action=edit');
								echo '<div class="ewm_dpm_single_title_link">
									<a class="ewm_dpm_single_title_link_a" href="'.$_item_v_URL.'">'. $_item_v->post_title .'</a>
								</div>';

							}
						//}
					?>
				</div>
			</div>
		</div>

	</div>
	
</div>

<input type="hidden" name="ewm_llt_keyword_id_" class="ewm_llt_keyword_id_">
<input type="hidden" name="ewm_llt_random_details" class="ewm_llt_random_details">
<input type="hidden" name="ewm_llt_main_id" class="ewm_llt_main_id" value="<?php echo $_GET['ewm_llt_id'] ; ?>">
<input type="hidden" name="ewm_keyword_client_status" class="ewm_keyword_client_status" value="new_keyword">
