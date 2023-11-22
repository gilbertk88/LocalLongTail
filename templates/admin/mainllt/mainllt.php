<style>
	#wpfooter {
		position: relative !important;
	}
	.ewm_llt_inner_wrapper{
		margin: 20px;
		background-color: #fff;
		border-radius: 10px;
		padding: 20px;
	}
	.ewm_llt_main_t{
		width: 100%;
	}
	.ewm_llt_header_h{
		padding: 10px;
		background-color: #f9f9f9;
		color: #333;
		border-radius: 6px;
	}
	.ewm_llt_header_b{
		padding: 4px;
		background-color: #fff;
		color: #333;
	}
	.ewm_llt_main_edit_button{
		padding: 10px;
		background-color: yellowgreen;
		border: 0px;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
		color: #fff;
		float: left;
	}
	.ewm_llt_button_new_main{
		background-color: #f9f9f9;
		color: #333;
		float: right;
		margin: 5px 15px 20px 5px;
		border: 3px solid #ccc;
		padding: 10px 30px;
		border-radius: 5px;
		cursor: pointer;
	}
	.ewmLltDeleteButtonP{
		background: #fff;
		border: 0px;
		border-radius: 10px;
		padding: 10px;
		cursor: pointer;
		float:left;
		margin:5px;
		color: #ccc;
	}
	.ewm_manage_p_section{ 
		width: 120px; 
	}

</style>

<div class="ewm_llt_wrapper">
	<div class="ewm_llt_inner_wrapper">
		<div class="ewm_llt_header_main">
			<center><h2>Parent Post</h2></center>
		</div>
		<div class="ewm_llt_header_main">
			<a href="<?php echo admin_url('admin.php?page=ewm-dpm-mainllt&ewm_llt_id=0'); ?>"><input type="button" value="New Parent Post" class="ewm_llt_button_new_main"></a>
		</div>
		<div class="ewm_llt_body_main">
			<?php
			// get main posts
			// create post.
			// edit post.
			?>
			<table class="ewm_llt_main_t" >
				<tr>
					<td class="ewm_llt_header_h"><center>ID</center></td>
					<td class="ewm_llt_header_h"><center>Title</center></td>
					<td class="ewm_llt_header_h"><center>No. of Sections</center></td>
					<td class="ewm_llt_header_h"><center>No. Child Posts</center></td>
					<td class="ewm_llt_header_h"><center>Created</center></td>
					<td class="ewm_llt_header_h"></td>
				</tr>
				<?php

				$post_parent_list = get_posts( [
					"post_type"     => "ewm_main_llt",
					"post_status"   => "active",
					"posts_per_page" => "-1",
				] );

				$main_llt_arr = array();

				foreach ($post_parent_list  as $key_d => $value_d) { 
				
					$ewmPSections = get_posts( [

						"post_status" => "active",
						"post_parent" => $value_d->ID,
						"post_type"   => "ewmPSection",
						"posts_per_page"	=> "-1",

					] );

					$_item_posts = get_posts( [

						"post_status" => "publish",
						"posts_per_page" => "-1",
						'post_parent' => $value_d->ID,
						'meta_query' => [
							[
								'relation' => 'AND',
								[
									'key' => 'ewm_dpm_post_type',
									'value' => 'llt_child',
									'compare' => '='
								]
							]
						]

					] );

					?>

					<tr class ="ewm_llt_single_main_r_<?php echo $value_d->ID; ?>" >
						<td class="ewm_llt_header_b">
							<center>#<?php echo $value_d->ID; ?></center>
						</td>
						<td class="ewm_llt_header_b">
							<center>
								<?php 
									if( 'sample_keyword_title' == $value_d->post_title ) {
										echo 'Title not set';
									}
									else {
										echo $value_d->post_title;
									}
								?>
							</center>
						</td>
						<td class="ewm_llt_header_b">
							<center><?php echo count( $ewmPSections ); ?></center>
						</td>
						<td class="ewm_llt_header_b">
							<center><?php echo count($_item_posts) ; ?></center>
						</td>
						<td class="ewm_llt_header_b">
							<center><?php echo $value_d->post_date; ?></center>
						</td>
						<td class="ewm_llt_header_b">
							<center>							
								<div class="ewm_manage_p_section">
									<input type="button" class="ewm_llt_main_edit_button" value="Open" data-llt-post-id="<?php echo $value_d->ID; ?>" >
									<span data-llt-p-id="<?php echo $value_d->ID; ?>" class="ewmLltDeleteButtonP dashicons dashicons-trash"></span>
								</div>
							</center>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

