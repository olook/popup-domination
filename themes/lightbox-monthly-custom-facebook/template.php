<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>" style="margin-left:-10px;">
	<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-top" 	<?php
		if(isset($fields['right_image']) && !empty($fields['right_image'])){
	 		echo  'style="background-image:url( '.$fields['right_image'].'); background-repeat:no-repeat; margin-left: 30px;margin-top: 35px;"';
	 	}
		?>>
			<div class="lightbox-top-content">
				<div class="lightbox-top-text">
			</div>
		</div>
    <script type="text/javascript">
    </script>
    <div class="popup-fb-login-button"></div>
		<div class="lightbox-bottom">
			<p class="secure"><?php echo $fields['footer_note'] ?></p>
		</div>
			<?php echo $promote_link ?>
	</div>
</div>