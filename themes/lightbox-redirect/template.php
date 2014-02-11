<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>" <?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
		<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		
		<div class="lightbox-top">
			<div class="lightbox-top-content">
				<p class="title"><?php echo $fields['title'] ?></p>
				<div class="clear"></div>
			</div>
		</div>
		
		
		<div class="main content">
			<div class="left">
				<?php
				if(isset($fields['right_image']) && !empty($fields['right_image'])){
					echo '<img src="'.$fields['right_image'].'" alt="" />';
				}
				?>
			</div>
			<div class="right">
				<div class="heading"><?php echo $fields['header'] ?></div>
				<div class="sub-heading"><?php echo $fields['sub_header'] ?></div>
				<div class="form-heading"><?php echo $fields['form_header'] ?></div>
				<div class="bullet-listx">
	                <ul class="bullet-list">
	       			<?php $count = 1;
	                    if(isset($list_items) && count($list_items) > 0):
	                        foreach($list_items as $l):
	                            if($count>3)
	                                break;?>
	                    <li><?php echo $l ?></li><?php
	                            $count++;
	                        endforeach;
	                    endif;?>
	                </ul>
				</div>
				
				
				
				<?php if($provider != 'form' && $provider != 'nm'): ?>
					<div class="lightbox-signup-panel">
						<div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
			            <div class="form">
			                <div>
			                    <?php echo $inputs['hidden'].$fstr; ?>
			                    <input id="submitbutton" name="submitbutton" type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>/images/trans.png" class="<?php echo $button_color?>-button" />
			                </div>
			            </div>
			            <div class="close-button">
			            	<a id="close-button" href="#"><span><?php echo $fields['exit_button'] ?></span></a>
			            </div>
					</div>
					<?php else: ?>
					<div class="lightbox-signup-panel">
			            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
			                <div>
			                    <?php echo $inputs['hidden'].$fstr ?>
			                    <input id="submitbutton" name="submitbutton" type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>/images/trans.png" class="<?php echo $button_color?>-button" />
			                </div>
			            </form>
			            <div class="close-button">
			            	<a id="close-button" href="#"><span><?php echo $fields['exit_button'] ?></span></a>
			            </div>
		            </div>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="lightbox-bottom">
			<p class="secure"><?php echo $fields['footer_note'] ?></p>
		</div>
		<?php echo $promote_link ?>
	</div>
</div>