<style>
	#wpfooter {
		position: relative !important;
	}
	.ewm_llt_inner_wrapper_setting{
		margin: 20px;
		background-color: #fff;
		border-radius: 15px;
		padding: 20px;
	}
	.ewm_llt_main_t_setting{
		width: 100%;
	}
	.ewm_llt_header_h_setting{
		padding: 4px;
		background-color: #607d8b;
		color: white;
		border-radius: 5px;
	}
	.ewm_llt_header_b_setting{
		padding: 4px;
		background-color: #fff;
		color: #333;
	}
	.ewm_llt_main_edit_button_setting{
		padding: 5px 10px;
		background-color: #f0f0f1;
		border: 2px solid #f0f0f1;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
	}
	.ewm_llt_button_new_main_setting{
		background-color: #607d8b;
		color: #fff;
		float: right;
		margin: 5px;
		border:0px;
		padding: 8px 15px;
		border-radius: 30px;
		cursor: pointer;
	}
	.ewm_llt_header_h_f{
		float: left;
		min-width: 99%;
		padding: 5px;
		font-weight: 500;
		font-size: 14px;
	}
	.ewm_llt_header_h_s{
		float: left;
		width: 99%;
		padding:5px;
	}
	.ewm_llt_setting_details{
		border-radius:5px !important;
		width: 100%;
		padding: 5px 15px !important;
		border-radius: 5px !important;
	}
	.ewm_llt_main_t_setting{
		overflow:auto;
	}
	.ewm_llt_header_h_b{
		padding: 20px 0px 30px 0px;
    	margin-top: 20px;
    	overflow: auto;
    	width: 99%;
	}
	.ewm_llt_h_b_submit{
		border: 2px solid #ccc;
		color: #333;
		font-weight: bold;
		padding: 10px;
		border-radius: 10px;
		width: 50%;
		cursor: pointer;
		margin-top: 40px;
		background-color: #f9f9f9;
	}
</style>

<div class="ewm_llt_wrapper_setting">
	<div class="ewm_llt_inner_wrapper_setting">
		<div class="ewm_llt_header_main_setting">
			<center><h2>LLT Setting</h2></center>
		</div>
		<div class="ewm_llt_header_main_setting">
		</div>
		<div class="ewm_llt_body_main_setting">
			<div class="ewm_llt_main_t_setting" >
				<div>
					<div class="ewm_llt_header_h_f">
						Industry
						<?php
						$ewm_s_f_industry = get_option( 'ewm_s_f_industry' );
						// var_dump($ewm_s_f_industry );
						// if(  $ewm_s_f_industry !== false ){
						$HVAC = $ewm_s_f_industry == 'HVAC' ? 'selected' : '' ;
						$Plumbing = $ewm_s_f_industry == 'Plumbing' ? 'selected': '' ;
						// }
						?>
					</div>
					<div class="ewm_llt_header_h_s">
						<select type="text" class="ewm_llt_setting_details" data-option-name="" id="ewm_setting_f_industry">
							<option value="Unselected">Select an Industry</option>
							<option value="HVAC" <?php echo $HVAC; ?> >HVAC</option>
							<option value="Plumbing" <?php echo $Plumbing; ?> >Plumbing</option>
						</select>
					</div>
					<div class="ewm_llt_header_h_b">
						<center>
							<input type="button" value="Save Settings" class="ewm_llt_h_b_submit" id="ewm_llt_save_settings">
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
