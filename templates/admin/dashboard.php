<style>
	
	.ewm_llt_outer_wrapper{
		margin: 40px 20px;
    	background-color: #fff;
    	padding: 10px;
    	border-radius: 10px;
	}

	.ewm_llt_analytcs_first{
		width: 25%;
		margin: 10px;
		padding: 39px;
		float: left;
		background: #f9f9f952;
		color: #646970;
		border-radius: 10px;
		border: 0px solid #ccc;
		box-shadow: 0 5px 8px 0 #dcdcde, 0 6px 10px 0 #dcdcde !important;
	}
	.ewm_llt_analytcs_second{
		width: 25%;
		margin: 10px;
		padding: 39px;
		float: left;
		background: #f9f9f952;
		color: #646970;
		border-radius: 10px;
		border: 0px solid #ccc;
		box-shadow: 0 5px 8px 0 #dcdcde, 0 6px 10px 0 #dcdcde !important;
	}
	.ewm_llt_analytcs_third {
		width: 25%;
		margin: 10px;
		padding: 39px;
		float: left;
		background: #f9f9f952;
		color: #646970;
		border-radius: 10px;
		border: 0px solid #ccc;
		box-shadow: 0 5px 8px 0 #dcdcde, 0 6px 10px 0 #dcdcde !important;
	}
	.ewm_llt_title_analys{
		width: 100%;
	}
	.ewm_llt_title_number{
		width: 100%;
		padding: 15px 0px 10px 0px;
		font-size: 59px;
	}
	.ewm_llt_outer_wrapper{
		overflow: auto;
	}
	.ewm_llt_analytcs_forth{
		width: 94%;
		padding: 40px 20px 30px 20px;
		border: 1px solid #cccccc1a;
		overflow: auto;
		margin: 50px 10px 10px 10px;
		border-radius: 10px;
		box-shadow: 0 5px 8px 0 #dcdcde, 0 6px 10px 0 #dcdcde !important;
	}
	.ewm_llt_title_number_list{
		padding:20px;
	}
	.ewm_llt_title_analys_l{
		font-size:20px;
		font-weight: 400;
		color: #898888;
	}
	.ewm_llt_top_analy{
		width: 100%;
		overflow: auto;
		padding-bottom: 10px;
	}
	.ewm_llt_group_title_l{
		padding: 15px;
		float: left;
		margin: 10px;
		border: 2px solid #cccccc57;
		border-radius: 10px;
	}
	.ewm_llt_locationgroup_l{
		color: #333;
		text-decoration: none;
	}
	#wpfooter {
		position: relative !important;
	}
	
</style>

<?php
	
	$ewm_main_llt = get_posts([
		"post_status"           => "active",
		"post_type"             => "ewm_main_llt",
		"posts_per_page" => "-1",
	]);

	$ewm_main_llt_count = count($ewm_main_llt);

	$ewm_local_llt = get_posts( [
		"post_status"    => "active",
		"post_type"      => "ewm_local_llt",
		"posts_per_page" => "-1",
	]);

	$ewm_local_llt_count = count( $ewm_local_llt );

	$ewm_llt_item = get_posts([
		"post_status"    => "publish",
		"post_type"      => "post",
		"posts_per_page" => "-1",
		'meta_query'  => [ 
			[
            	'relation' => 'AND',
            	[
            		'key'     => 'ewm_dpm_post_type',
            		'value'   => 'llt_child',
            		'compare' => '=',
				],
			]
		],

	]);
	
	$ewm_llt_item_count = count( $ewm_llt_item );

	$ewm_location_groups = get_posts([
		"post_status"    => "active",
		"post_type"      => "ewmLocalGroup",
		"posts_per_page" => "-1",
	]);

	// var_dump( get_post( 2202 ) );
	// echo '<br><br><br>';
	// var_dump( get_post_meta( 2202 ) );

?>

<div class="ewm_llt_outer_wrapper">
	<div class="ewm_llt_outer_wrapper">
		<div class="ewm_llt_top_analy">
			<div class="ewm_llt_analytcs_first">
				<div class="ewm_llt_title_analys">
					<center>No. of Parent Posts</center>
				</div>
				<div class="ewm_llt_title_number">
					<center><?php echo $ewm_main_llt_count; ?></center>
				</div>
			</div>
			<div class="ewm_llt_analytcs_second">
				<div class="ewm_llt_title_analys"><center>No. of Child Posts</center></div>
				<div class="ewm_llt_title_number"><center><?php echo $ewm_llt_item_count; ?></center></div>
			</div>
			<div class="ewm_llt_analytcs_third">
				<div class="ewm_llt_title_analys"><center>No. of Location Groups</center></div>
				<div class="ewm_llt_title_number"><center><?php echo count( $ewm_location_groups ) ; ?><center></div>
			</div>
		</div>
		<div class="ewm_llt_analytcs_forth">
			<div class="ewm_llt_title_analys_l"><center>Location Group</center></div>
			<div class="ewm_llt_title_number_list"><center>
				<?php 
				foreach( $ewm_location_groups as $k_g => $v_g ) { 
					$ewm_location_l = get_post_meta( $v_g->ID, 'ewm_location_l', true );
					$ewm_location_l_count = 0;

					if( is_array( $ewm_location_l ) ) {
						$ewm_location_l_count = count( $ewm_location_l );
					}
					$lltlocationgroup_l = admin_url( 'admin.php?page=ewm-dpm-lltlocationgroup&ewmLltLocationGroupId='.$v_g->ID );
					echo '<span class="ewm_llt_group_title_l"> <a class="ewm_llt_locationgroup_l" href="'.$lltlocationgroup_l.'">'.$v_g->post_title . '( '.$ewm_location_l_count.' Locations)</a></span>';
				}
				?>
			<center></div>
		</div>
	</div>
</div>
