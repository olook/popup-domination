<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>" style="margin-left:-10px;">
	<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-top" 	<?php
		if(isset($fields['right_image']) && !empty($fields['right_image'])){
	 		echo  'style="background-image:url( '.$fields['right_image'].'); background-repeat:no-repeat; background-size: 92.2% 93%; margin-left: 30px;margin-top: 35px;"';
	 	}
		?>>
			<div class="lightbox-top-content">
				<div class="lightbox-top-text">
			</div>
		</div>
		<?php if($provider != 'form' && $provider != 'nm'): ?>
		<div class="lightbox-middle-bar">
			<div class="lightbox-signup-panel">
           	<div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
	            <div class="form">
                	<div>
                		<form id="removeme">
                    		<?php echo $inputs['hidden'].$fstr; ?>
                    		<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
                    	</form>
                	</div>
                </div>
            </div>
            </div>
		</div>
		<?php else: ?>
		<div class="lightbox-middle-bar">
			<div class="lightbox-signup-panel">
            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
                <div>
                    <?php echo $inputs['hidden'].$fstr; ?>
                    <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
                </div>
            </form>
            </div>
		</div>
		<?php endif; ?>
		<div class="lightbox-bottom">
			<p class="secure"><?php echo $fields['footer_note'] ?></p>
		</div>
			<?php echo $promote_link ?>
	</div>
</div>