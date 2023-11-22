
<style>
	#wpfooter {
		position: relative !important;
	}
	.ewm_llt_inner_wrapper{
		margin: 20px;
		background-color: #fff;
		border-radius: 30px;
		padding: 20px;
	}
	.ewm_llt_main_t{
		width: 100%;
	}
	.ewm_llt_header_h{
		padding: 4px;
		background-color: #607d8b;
		color: white;
		border-radius: 5px;
	}
	.ewm_llt_header_b{
		padding: 4px;
		background-color: #fff;
		color: #607d8b;
	}
	.ewm_llt_item_edit_button{
		padding: 5px 10px;
		background-color: #f0f0f1;
		border: 2px solid #f0f0f1;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
	}
</style>

<div class="ewm_llt_wrapper">
	<div class="ewm_llt_inner_wrapper">
		<div class="ewm_llt_header_main">
			<center><h2>LLT Items</h2></center>
		</div>
		<div class="ewm_llt_body_main">
			<?php
			// get main posts
			// create post.
			// edit post.
			?>
			<table class="ewm_llt_main_t" >
				<tr>
					<td class="ewm_llt_header_h"><center>Title</center></td>
					<td class="ewm_llt_header_h"><center>Parent Post</center></td>
					<td class="ewm_llt_header_h"><center>Date</center></td>
					<td class="ewm_llt_header_h"></td>
				</tr>
				<?php

				$post_parent_list = get_posts([
					"post_status" 	=> "publish",
					"posts_per_page"=> "-1",
					'meta_query'  	=> [
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

				$main_llt_arr = array();
				foreach ( $post_parent_list  as $key_d => $value_d ) { 
				/*
					$current_user_id = get_current_user_id();
					$post_data = [
						'ID' 		=> $value_d->ID,
						'post_status' 	=> 'publish',
						"post_author"   => $current_user_id,
						"post_date"     => date( 'Y-m-d H:i:s' ),
						"post_date_gmt" => date( 'Y-m-d H:i:s' ),
						"post_modified" => date( 'Y-m-d H:i:s' ),
						"post_modified_gmt" => date( 'Y-m-d H:i:s' ),
					];
					global  $wp_error;
				*/
				// $update_status = wp_update_post( $post_data, $wp_error );
					
				?>
					<tr>
						<td class="ewm_llt_header_b">
							<?php echo $value_d->post_title; ?>
						</td>						
						<td class="ewm_llt_header_b">
							<?php								
								$parent_post_title = 'Post Deleted';
								$url_n = '#';
								$value_d_post_parent = get_post( $value_d->post_parent );
								if( $value_d_post_parent !== NULL ) {			
									$parent_post_title = $value_d_post_parent->post_title ;
									$url_n = admin_url('admin.php?page=ewm-dpm-mainllt&ewm_llt_id=' . $value_d_post_parent->ID );
								}
								echo '<a href="'.$url_n.'" target="blank">' . $parent_post_title . ' (#' . $value_d->post_parent . ') </a>';
							?>
						</td>
						<td class="ewm_llt_header_b">
							<?php echo $value_d->post_date; ?>
						</td>
						<td class="ewm_llt_header_b">
							<center><a target="blank" href="<?php echo admin_url('post.php?post='.$value_d->ID.'&action=edit'); ?>"><input type="button" class="ewm_llt_item_edit_button" value="Edit Child Post" data-llt-item-post-id="<?php echo $value_d->ID; ?>"></a></center>
						</td>
					</tr>
				<?php } ?>			
			</table>
		</div>
	</div>
</div>
