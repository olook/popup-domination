<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
		<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="popup-dom-border">
			<div class="lightbox-top">
				<div class="lightbox-top-content">
					<div class="heading"><p><?php echo $fields['title'] ?></p>
				</div>
				<div class="bullet-listx">
					<p><?php echo nl2br($fields['short_paragraph']) ?></p>
				</div>
			</div>
			<?php if($provider != 'form' && $provider != 'nm'): ?>
			<div class="lightbox-bottom">
				<div class="lightbox-signup-panel">
	            <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
	            <div class="form">
	                <div>
	                	<form id="removeme">
		                    <?php echo $inputs['hidden'].$fstr ?>
		                    <div>
		                    	<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
		                    </div>
		                    <div class="secure-note">
								<span class="secure"><?php echo $fields['footer_note'] ?></span>
							</div>
						</form>
	                </div>
	            </div>
	            </div>
			</div>
			<?php else: ?>
			<div class="lightbox-bottom">
				<div class="lightbox-signup-panel">
	            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
	                <div>
	                    <?php echo $inputs['hidden'].$fstr ?>
	                    <div>
	                    	<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
	                    </div>
	                    <div class="secure-note">
							<span class="secure"><?php echo $fields['footer_note'] ?></span>
						</div>
	                </div>
	            </form>	
	            </div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php echo $promote_link ?>
</div>