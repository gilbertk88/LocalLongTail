<style>
	.ewm_edit_sections_field{
		width: 100%;
		height: 100%;
		background-color: #33333350;
		position: fixed;
		left: 0px;
		top: 0px;
		padding-left: 20%;
		display: none;
	}
	.ewm_llt_body_single{
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
	.ewm_header_menu_options{
		width: 100%;
		overflow: auto;
	}
	.ewm_close_edit_section{	
		float: right;
		margin: 25px;
		border-radius: 10px;
		background-color: #f0f0f1 !important;
		border: 0px solid #ccc;
		padding: 10px;
		cursor: pointer;
	}
	.ewm_llt_header_input_full{
		width: 100%;
		border-radius: 3px !important;
		padding: 5px 15px !important;
		border: 2px solid #ccc !important;
	}
	.yourclass{ height : 250px;}
	.ewmImageDisplay{
		height: 200px;
	}
	.ewmSelectImage{
		background: #9acd32;
		border-radius: 10px;
		padding: 10px 15px;
		border: 0px solid #333;
		box-shadow: 0 5px 8px 0 rgb(193 192 192 / 17%), 0 6px 10px 0 rgb(215 215 215 / 10%) !important;
		cursor: pointer;
		color: #fff;
	}
	.ewmImageSecLeft{
		width: 60%;
		float: left;
	}
	.ewm_llt_inner_field_input{
		margin: 6px 0px;
	}
	.ewm_llt_inner_field{
		width: 90%;
		overflow: auto;
	}
	#ewmImageIcon{
		float: left;
		padding: 15px;
	}
	.ewmServiceLeft{
		font-weight: bold;
	}
	.ewmServiceRight{
		padding: 0px;
	}
	.ewmServiceRightInput{
		float: left;
		width: 100%;
		padding: 5px 10px !important;
		border-radius: 8px !important;
		margin-top: 5px;
		border: 2px solid #ccc !important;
	}
	.ewmImageSW{
		padding: 10px 0px;
	}
	.ewmSaveSingleSection{
		border-radius: 15px;
		margin: 23px;
		padding: 10px 30px;
		background-color: #f9f9f9 !important;
		border: 2px solid #ccc !important;
		cursor: pointer;
		background: #fff;
	}
	.mce-container-body .mce-stack-layout{}
	#mceu_24{
		border-radius: 10px !important;
	}
	#ewm_llt_header_error{
		color: red;
		font-size: 10px;
		width: 100%;
		padding: 5px;
		overflow: auto;
	}
	#ewm_image_error_message{
		color: red;
		font-size: 10px;
		width: 100%;
		padding: 5px;
		overflow: auto;
	}
	#ewm_service_error_message{
		color: red;
		font-size: 10px;
		width: 100%;
		padding: 5px;
		overflow: auto;
	}

</style>

<div class="ewm_edit_sections_field">
	<div class="ewm_llt_body_single">
		<div class="ewm_header_menu_options">
			<input type="button" class="ewm_close_edit_section" value="Close" />
		</div>
		<div class="ewm_llt_inner_field">
			<div class="ewm_llt_inner_field_header">				
			</div>
			<div class="ewm_llt_inner_field_input">
				<input type="text" placeholder="Enter Section Heading" class="ewm_llt_header_input_full" value="<?php echo $ewm_post_title; ?>">
				<span id="ewm_llt_header_error"></span>
			</div>
		</div>
		<div class="ewm_llt_inner_field">
			<div class="ewm_llt_inner_field_input">
				<?php
					wp_editor( $ewm_post_content , 'ewm_llt_main_content', $settings = array('editor_class'=>'yourclass') );
				?>
			</div>
		</div>
		<div class="ewm_llt_inner_field">
			<div class="ewm_llt_inner_field_header"></div>
			<div class="ewm_llt_inner_field_input">
				<div id="ewmImageIcon"></div>
				<input id="ewmImageURL" type="hidden">
				<div class="ewmImageSecLeft">
					<div class="ewmImageSW">
						<div>
							<input type="button" value="Select Image..." click="ewmSelectImage()" class="ewmSelectImage" >
							<span id="ewm_image_error_message"></span>
						</div>
					</div>
					<div class="ewmImageSW">
						<div class="ewmServiceLeft"> Service Name </div>
						<div class="ewmServiceRight">
							<input type="text" class="ewmServiceRightInput">
							<span id="ewm_service_error_message"></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="ewm_llt_inner_field">
			<div class="ewm_llt_inner_field_save">
				<center>
					<input type="button" value="Save" class="ewmSaveSingleSection" data-ewm-llt-id="<?php echo $_GET['ewm_llt_id']; ?>">
					<span class="ewmSave_message_bottom"></span>
				</center>
			</div>
		</div>
	</div>
</div>
