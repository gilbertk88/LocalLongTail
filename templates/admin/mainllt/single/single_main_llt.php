<?php
	if ($_GET['ewm_llt_id'] == 0) {
		$EwmLLT_llt_post_id = EwmLLT::create_llt_posts();
		$ewm_llt_new_main_url = admin_url( '/admin.php?page=ewm-dpm-mainllt&ewm_llt_id='.$EwmLLT_llt_post_id );
		echo "<script type='text/javascript'>
			window.location.replace('".$ewm_llt_new_main_url ."');
		</script>";
	}
?>

<style>
	.ewm_llt_inner_wrap{
		margin: 20px;
		background-color: #fff;
		border-radius: 10px;
		padding: 20px;
	}
	.ewm_llt_inner_field{
		padding: 5px 30px 5px 5px;
	}
	.ewm_llt_inner_field_header{
		font-size: 15px;
		font-weight: 500;
	}
	.ewm_llt_inner_field_save{
		width: 100%;
	}
	#ewmSaveSingleSection{
		border: 1px solid #ff7300;
		color: #ff7300;
		font-weight: bold;
		padding: 10px;
		border-radius: 10px;
		cursor: pointer;
		margin-top: 40px;
		background-color: #fff;
	}
	.ewm_llt_ground_menu{
		width: 100%;
		overflow: auto;
		padding:30px 0px;
	}
	.ewm_llt_header_items_manager{
		padding: 10px 30px;
		background-color: green;
		border: 0px;
		margin: 5px;
		border-radius: 15px;
		cursor: pointer;
		float: right;
		box-shadow: 0 5px 8px 0 rgb(193 192 192 / 26%), 0 6px 10px 0 rgb(215 215 215 / 10%) !important;
		color: #fff;
	}
	.ewm_llt_header_items_manager_delete{
		padding: 10px 30px;
		margin: 5px 15px;
		border-radius: 15px;
		cursor: pointer;
		float: right;
		box-shadow: 0 5px 8px 0 rgb(193 192 192 / 26%), 0 6px 10px 0 rgb(215 215 215 / 10%) !important;
		color: #fff;
	}
	.ewm_llt_header_items_manager_wrapper{
		overflow: auto;
	}
	.ewm_llt_header_items_manager_shortcode{
		width:100%;
	}
	.ewm_llt_shortcode_d_item{
		background-color: #9acd324f;
		padding: 10px 30px;
		font-size: 14px;
		overflow: auto;
		border-radius: 10px;
		color: #333;
		width: 95%;
		box-shadow: 0 5px 8px 0 rgb(193 192 192 / 26%), 0 6px 10px 0 rgb(215 215 215 / 10%) !important;
	}
	.ewm_llt_shortcode_single_item{		
		margin-top: 20px;
		width: 100%;
		height: 40px;
		padding-bottom: 9px;
	}
	#ewm_llt_delete_main_post_keyword{
		background-color:darkseagreen;
		color: #fff;
	}
	.ewm_llt_body_single{
		width: 900px;
	}
	.wp-ewm_llt_main_content-wrap{
		max-height: 200px;
	}
	.ewm_parent_post_section{
		width: 60%;
		border-radius: 10px;
		padding: 12px;
		border: #ccc6 solid 1px;
		overflow: auto;
		margin: 10px 10px 20px 10px;
		box-shadow: 0 5px 8px 0 rgb(193 192 192 / 26%), 0 6px 10px 0 rgb(215 215 215 / 10%) !important;
	}
	.ewm_parent_post_section_title{
		float: left;
		color: dimgrey;
		padding: 10px;
		font-weight: 500;
		font-size: 14px;
	}
	.ewm_parent_post_section_manage{
		float: right;
		border-radius: 5px;
		border: 2px solid #ccc;
		cursor: pointer;
		padding: 10px;
		background: #fff;
	}
	.ewm_parent_section{
		width: 100%;
	}
	.ewmSectionsWrappersSection{
		width: 100%;
	}
	.ewm_parent_add_section{
		border: 2px solid #ccc;
		color: #ff7300;
		font-weight: bold;
		padding: 10px;
		border-radius: 10px;
		width: 50%;
		cursor: pointer;
		margin-top: 40px;
	}
	.ewm_parent_title_section{
		font-weight: bold;
		font-size: 18px;
		padding: 20px;
		display: none;
	}
	.ewm_parent_post_section_delete{
		float:right;
		border:0px ;
		border-radius:10px;
		padding:10px;
		margin-right: 5px;
		cursor: pointer;
		color:#ccc;
	}
	.ewm_main_ttl_text{
		width: 100% !important;
		padding: 40px 0px 10px 0px !important;
		border-radius: 10px !important;
	}
	.ewm_main_ttl_text_wrapper{
		font-weight: bold;
		font-size: 18px;
		padding: 20px;
	}
	.ewm_main_ttl_text_inner{
		width: 62.5% !important;
		padding: 5px 25px !important;
		border-radius: 5px !important;
		border: 3px solid #ccc5 !important;
		margin-bottom: 10px;
	}
	#wpfooter {
		position: relative !important;
	}
</style>

<div class="ewm_llt_wrapper">
<div class="ewm_llt_inner_wrap">
	<div class="ewm_llt_header_single">
		<center></center>
	</div>
	<div>
	<div class="ewm_llt_ground_menu">
		<div class="ewm_llt_header_items_manager_delete" id="ewm_llt_delete_main_post_keyword" data-ewm-llt-id="<?php echo $_GET['ewm_llt_id']; ?>">
			<center>Delete parent post</center>
		</div>
		<div class="ewm_llt_header_items_manager ewm_llt_header_items_content">
			<center>Manage locations & child posts</center>
		</div>
	</div>
	<div class="ewm_llt_header_items_manager_wrapper">
		<div class="ewm_llt_header_items_manager_shortcode">
			<div class="ewm_llt_shortcode_single_item">
				<center>
					<div class="ewm_llt_shortcode_d_item">
						Location shortcode: <b>[LLT_Location]</b>
					</div>
				</center>
			</div>
		</div>
	</div>
	
	<input value="<?php echo $_GET['ewm_llt_id']; ?>" id="ewm_llt_main_id" type="hidden">

	</div>
	<?php

		$__main_llt_post = $ewmdsm_main_llt_d = get_post( $_GET['ewm_llt_id'] );

		// var_dump( $__main_llt_post);
		/*
			$convert_each_keyword = EwmLLT::convert_each_keyword([
				'keyword_data' => $__main_llt_post, // $v_list,
				'main' => $__main_llt_post,
			]);
			$convert_each_keyword = EwmLLT::renameImage( [
				"post_id" => 1794,
				"location" => "Loccation 3"
			] );
			var_dump( $convert_each_keyword );
			$convert_each_keyword = EwmLLT::ajax_generate_main_llt( [ 'ewmdsm_main_llt_id'=>$_GET['ewm_llt_id']  ] );
			var_dump( $convert_each_keyword );
		*/

		$llt_locations = get_post_meta( $_GET['ewm_llt_id'] , 'llt_locations' , true );

		$ewm_post_title = '';
		$ewm_post_content = '';
		// var_dump($_GET['ewm_llt_id']);

		if( $_GET['ewm_llt_id'] > 0 ){

			$ewm_llt_post = get_post( $_GET['ewm_llt_id'] );			
			if( $ewm_llt_post->post_content !== 'sample_keyword_content' ){
				$ewm_post_content = $ewm_llt_post->post_content;
			}
			if( $ewm_llt_post->post_title !== 'sample_keyword_title' ) {
				$ewm_post_title = $ewm_llt_post->post_title ;
			}

		}

		$ewm_llt_main_id = $_GET['ewm_llt_id'];

		// var_dump( $ewm_llt_post->post_content );
		// var_dump( $ewm_llt_post->post_title );
		// ewm_llt_id=1744

		$ewm_get_post_list = get_post( [
			"post_status" => "publish",
			"post_parent" => $ewm_llt_main_id,
			"post_type" => "ewmkeyword",
			"posts_per_page"	=> "-1",
		] );

	?>

	<div class="ewm_parent_section">

		<div class ="ewm_main_ttl_text" >
			<center>
				<?php 
					if( is_object( $ewm_llt_post ) ){

						$ewm_llt_title = $ewm_llt_post->post_title;

					}
					// echo $ewm_llt_post->post_title;
				?>
				<input type='text' class="ewm_main_ttl_text_inner" value="<?php echo $ewm_llt_title; ?>" >
			</center>
		</div>
		<div class="ewm_parent_title_section" >
			<center>Parent Sections</center>
		</div>

	</div>
	<?php

	$ewmPSections = get_posts( [
		"post_status" => "active",
        "post_parent" => $_GET['ewm_llt_id'],
		"post_type" => "ewmPSection",
		"posts_per_page" => "-1",
		"orderby" => "ID",
		"order" => "ASC", // "DESC", // ASC
	] );

	// $mp = get_post( $_GET['ewm_llt_id'] );
	// var_dump( $mp );

	?>
	<div class="ewmSectionsWrappersSection">
		<center>
		<?php 
			foreach( $ewmPSections as $section_k => $section_v ){
		?>
			<div class="ewm_parent_post_section" data-section-id="<?php echo $section_v->ID; ?>" id="parent_section_<?php echo $section_v->ID; ?>">
				<div class="ewm_parent_post_section_title">
					<?php echo $section_v->post_title; ?>
				</div>							
				<span data-section-id="<?php echo $section_v->ID; ?>" class="ewm_parent_post_section_delete dashicons dashicons-trash"></span>
				<div class="ewm_parent_post_section_manage" data-section-id="<?php echo $section_v->ID; ?>" >
					Open
				</div>
			</div>
		<?php } ?>
		</center>
	</div>

	<div class="ewm_parent_section">
		<center>
			<div class="ewm_parent_add_section" >
				Add Section +
			</div>
		</center>
	</div>
	
</div>
</div>

<?php
	$items_list_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/items_popup_llt.php';
	include $items_list_url;
?>

<?php
	$items_list_url = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/single_section_submit.php';
	include $items_list_url;
	// var_dump( $items_list_url );	
?>

<script type="text/javascript">
	var ewm_llt_location_list	= [];
	<?php 
	if( array_key_exists( 'ewm_llt_id', $_GET ) ){
		if ( $_GET['ewm_llt_id'] > 0 ) {
			echo 'activate_keyword_page = true ; ';
		}
	}
	?>
</script>

<input id = 'ewmParentId' type="hidden" value="<?php echo $_GET['ewm_llt_id']; ?>" />
<input id = 'ewmParentSectionId' type="hidden" >

<?php

	$parent_post_upgrade_llt = LLT_HOME_DIR . '/templates/admin/mainllt/single/popup/upgrade/parent_post_upgrade_llt.php';
	$EwmLLT_is_allowed = EwmLLT::is_allowed_parent();
	if( $EwmLLT_is_allowed == 'not_allowed' ) {
		// include $parent_post_upgrade_llt;
	}

?>

