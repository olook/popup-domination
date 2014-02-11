<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-premium">
	<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
	<div class="lightbox-header">
		<p class="heading <?php echo $color ?>-header"><?php echo $fields['title'] ?></p>
		<p class="subheading"><?php echo nl2br($fields['short_paragraph']) ?></p>
	</div>
	<div class="lightbox-bottom-main">
		<div class="lightbox-grey-panel">
				<div class="lightbox-downcount <?php echo $color ?>-counter">
					<p class="lightbox-download-nums"><? if(isset($fields['number'])){ echo $fields['number']; }else{ echo' 64058';}?></p>
				</div>
				<div class="lightbox-product-image">
	                <?php
					if(isset($fields['right_image']) && !empty($fields['right_image'])){
						echo '<img src="'.$fields['right_image'].'" alt="" />';
					}
					?>
				</div>
				<div class="lightbox-contentxx">
				</div>
				<div class="lightbox-clear"></div>
			</div>
			<div class="lightbox-arrow <?php echo $color ?>-arrow">
			 &nbsp;
			</div>
			<div class="lightbox-cross">
			 &nbsp;
			</div>
			<div class="lightbox-pricecut">
				<p>Was <strong>$27</strong> now <strong><em>FREE!</em></strong></p>
			</div>
			<?php if($provider != 'nm' && $provider != 'form'): ?>
			<div class="lightbox-signup-panel">
				<p class="heading2"><?php echo nl2br($fields['form_header']) ?></p>
				<div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
				<div class="form">
                	<div>
                		<form id="removeme">
                    		<?php echo $inputs['hidden'].$fstr; ?>
                    		<input type="submit" value="" src="<?php echo $theme_url?>images/trans.png" class="premium-button" />
                    		<p class="secure"><?php echo $fields['footer_note'] ?></p>
                    	</form>
                	</div>
                </div>
			</div>
			<?php else: ?>
			<div class="lightbox-signup-panel">
				<p class="heading2"><?php echo nl2br($fields['form_header']) ?></p>
	            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
	                <div>
	                    <?php echo $inputs['hidden'].$fstr; ?>
	                    <input type="submit" value="" src="<?php echo $theme_url?>images/trans.png" class="premium-button" />
	                    <p class="secure"><?php echo $fields['footer_note'] ?></p>
	                </div>
	            </form>
			</div>
			<?php endif; ?>
		</div>
		<div class="lightbox-clear"></div>	
		<?php echo $promote_link ?>
	</div>
</div>