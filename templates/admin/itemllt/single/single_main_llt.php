<style>
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
		background-color: #333;
		color: white;
	}
	.ewm_llt_header_b{
		padding: 4px;
		background-color: #fff;
		color: #333;
	}
	.ewm_llt_main_edit_button{
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
			<center><h2>Main LLT</h2></center>
		</div>
		<div class="ewm_llt_body_main">
			<?php
			// get main posts
			// create post.
			// edit post.
			?>
			<table class="ewm_llt_main_t" >
				<tr>
					<td class="ewm_llt_header_h"><center>Heading</center></td>
					<td class="ewm_llt_header_h"><center>No. of Children</center></td>
					<td class="ewm_llt_header_h"><center>Stage</center></td>
					<td class="ewm_llt_header_h"></td>
				</tr>
				<?php

				$post_parent_list = get_posts([
					// 'post_parent'   => $args['order_id'],
					"post_type"     => "ewm_main_llt",
					"post_status"   => "active",
					/*'meta_query'    => [
						[
							'key'       => 'ewm_dpm_product_id',
							'value'     => $args['product_id'],
							'compare'   => 'LIKE'
						]
					] */
				]);

				$main_llt_arr = array();
				foreach ($post_parent_list  as $key_d => $value_d) { ?>
					<tr>
						<td class="ewm_llt_header_b">
							<?php echo $value_d->ID; ?>
						</td>
						<td class="ewm_llt_header_b">
							<?php echo $value_d->post_title; ?>
						</td>
						<td class="ewm_llt_header_b">
							<?php echo $value_d->post_date; ?>
						</td>
						<td class="ewm_llt_header_b">
							<center><input type="button" class="ewm_llt_main_edit_button" value="Edit Local Long Tail" data-llt-post-id="<?php echo $value_d->ID; ?>"></center>
						</td>
					</tr>
				<?php } ?>			
			</table>
		</div>
	</div>
</div>
