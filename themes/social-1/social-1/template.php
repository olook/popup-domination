<?php 
	if($this->option('facebook_enabled') != 'Y'):
		console.log('You need to setup your facebook app to the plugin, please go http://developers.facebook.com/ to do so.');
	endif;
?>
	<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
		<div class="lightbox-overlay"></div>
		<div class="lightbox-main lightbox-color-premium">
			<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
			<div class="lightbox-border-inner">
				<div class="lightbox-inner">
					<div class="lightbox-header">
						<p class="heading <?php echo $color ?>-header"><?php echo $fields['title'] ?></p>
						<p class="subheading"><?php echo nl2br($fields['short_paragraph']) ?></p>
					</div>
					<div class="lightbox-bottom-main">
							<div class="lightbox-grey-panel">
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
							<div class="lightbox-middle">
								<ul class="bullet-list"><?php
				                    $count = 1;
				                    if(isset($list_items) && count($list_items) > 0):
				                        foreach($list_items as $l):
				                            if($count>5)
				                                break;?>
				                    <li><?php echo $l ?></li><?php
				                            $count++;
				                        endforeach;
				                    endif;?>
				                </ul>
							</div>
							<div class="lightbox-signup-panel signup-color-<?php echo $color ?>">
								<div class="lightbox-signup-panel-border">
									<p class="heading2 "><?php echo nl2br($fields['form_header']) ?></p>
									<div class="facebook_box">
									
								    <?php if ($user): ?>
								     <?php if($provider != 'form' && $provider != 'nm'): ?>
								      <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
							    	  <div class="lightbox-signup-panel form" style="display:none;">
							    	  	  <div id="fb-form" title="facebook">
							    	  	  	<form id="removeme">
								        		<?php echo $inputs['hidden'].$fstr; ?>
		                    					<input type="hidden" class="fbname" value="<?php if(isset($UserName) && !empty($UserName)){ echo $UserName;}else{ echo 'none';} ?>" />
												<input type="hidden" class="fbemail" value="<?php if(isset($user_profile['email']) && !empty($user_profile['email'])){ echo $user_profile['email'];}else{ echo 'none';} ?>" />
						                		<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
						                	</form>
						                  </div>
					                  </div>
					                  <?php else: ?>
					                  <form id="fb-form" method="post" action="<?php echo $form_action ?>"<?php echo $target ?> style="display:none;">
							    	  <div>
								        	<?php echo $inputs['hidden'].$fstr; ?>
								       		<input type="hidden" class="fbname" value="<?php if(isset($UserName) && !empty($UserName)){ echo $UserName;}else{ echo 'none';} ?>" />
											<input type="hidden" class="fbemail" value="<?php if(isset($user_profile['email']) && !empty($user_profile['email'])){ echo $user_profile['email'];}else{ echo 'none';} ?>" />
						                	<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
						                  </div>
					                  </form>
					                  <?php endif; ?>
								      	<a href="#" class="social_buttons sb_24 sb_facebook got_user">
						      				<span class="span"><?php echo $fields['facebook_button']; ?></span>
						      			</a>
						      			<div id="fb-root"></div>
								    <?php else: ?>
								      <div>
								      <?php if($version != 's-a'): ?>
								       	<a href="<?php echo $loginUrl; ?>" class="social_buttons sb_24 sb_facebook">
								        	<span class="span">Connect <span class="thin">with</span> Facebook</span>
								        	<div id="fb-root"></div>
								        </a>
								        <?php else: ?>
								        	<fb:login-button size="medium" scope="email,publish_stream">Connect with Facebook</fb:login-button>
								        	<div id="fb-root"></div>
								        <?php endif; ?>
								      </div>
								    <?php endif ?>
								    
								   	</div>
								   	<p class="secure"><?php echo $fields['footer_note'] ?></p>
							   	</div>
							</div>
						</div>
					</div>
				</div>
			<div class="lightbox-clear"></div>	
			<?php echo $promote_link ?>
		</div>
</div>
<?php if ($user): ?>
	<script type="text/javascript">
		jQuery('document').ready(function(){
			jQuery('.lightbox-signup-panel .name').val('<?php echo $UserName; ?>');
			jQuery('.lightbox-signup-panel .email').val('<?php echo $user_profile['email']; ?>');
		});
	</script>
<?php endif ?>