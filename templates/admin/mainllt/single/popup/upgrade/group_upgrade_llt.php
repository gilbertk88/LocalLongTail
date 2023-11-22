<style>
.ewm_wrapper_upgrade{
    width: 100%;
    height: 100%;
    background-color: #33333350;
    position: fixed;
    left: 0px;
    top: 0px;
    padding-left: 20%;
	display:none;
}
.ewm_wrapper_inner_upgrade{
    width: 50%;
    background-color: #fff !important;
    position: fixed;
    right: 20%;
	border-radius: 30px;
    top: 150px;
    padding-top: 80px;
    height: 40%;
    padding-left: 20px;
    box-shadow: 0 5px 8px 0 rgb(151 151 151 / 10%), 0 6px 10px 0 rgb( 118 118 118 / 10% ) !important;
    overflow: auto;
}
.ewm_llt_see_price{
	margin: 20px;
	background-color: orange;
	padding: 15px 20px;
	color: white;
	border-radius: 20px;
	border:0px;
	cursor: pointer;
}
.ewm_thanks_upgrade{
	color: #333;
	background: #90ee9087;
	font-size: 16px;
}

</style>

<div class="ewm_wrapper_upgrade">
	<div class="ewm_wrapper_inner_upgrade">
		<center>
			<div>
				<h2>Wow! you have come this far! 😉</h2>
				<span class="ewm_thanks_upgrade">Thank you for choosing Local Longtail plugin!</span>
				<br><br>
				You have reached your max location group limit<br><br>
				Please upgrade your plan to support the development team as they bring you<br><br>
				new and exciting features and security updates!
			</div>
			<?php 
			echo '<br>
			<a href="' . llt_fs()->get_upgrade_url() .'"><input type="button" class="ewm_llt_see_price" value="See pricing"> </a>' ?>
		</center>
	</div>
</div>
