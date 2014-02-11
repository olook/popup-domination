<?php 
	if($this->option('facebook_enabled') != 'Y'):
		console.log('You need to setup your facebook app to the plugin, please go http://developers.facebook.com/ to do so.');
	endif;
	if(isset($fields['video']) && !empty($fields['video'])): ?>
<script>
	$f("ipad", "<?php echo $this->plugin_url; ?>inc/flowplayer/flowplayer-3.2.7.swf").ipad();
</script>	
<?php endif; ?>
<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
<div class="lightbox-overlay"></div>

	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
	<div class="lightbox-background-grey">
		<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
			<div class="lightbox-border">
				<div class="lightbox-top">
					<div class="lightbox-top-content">
						<div class="video">
			            <?php 
						if(isset($fields['video-embed']) && !empty($fields['video-embed'])){
							echo $fields['video-embed'];
						}
						else if(isset($fields['video']) && !empty($fields['video'])){
							echo '<a href="'.$fields['video'].'" style="display:block;width:700px;height:330px" id="ipad"></a> ';
						}
						?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="lightbox-middle-bar">
					<div class="arrow-left-dark  arrow-<?php echo $color ?>-left-dark">
					</div>
					<div class="arrow-left arrow-<?php echo $color ?>-left">
					</div>
					<div class="facebook_box">
				    <?php if ($user): ?>
				     <?php if($provider != 'form' && $provider != 'nm'): ?>
				     <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
				     <div class="lightbox-signup-panel" style="display:none;">
		            		<div class="form">
			    	  			<div>	
			    	  				<form id="removeme">
				        				<?php echo $inputs['hidden'].$fstr; ?>
				        				<input type="hidden" class="fbname" value="<?php if(isset($UserName) && !empty($UserName)){ echo $UserName;}else{ echo 'none';} ?>" />
										<input type="hidden" class="fbemail" value="<?php if(isset($user_profile['email']) && !empty($user_profile['email'])){ echo $user_profile['email'];}else{ echo 'none';} ?>" />
			            				<input type="submit" value="" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
			            			</form>
			              		</div>
			          		</div>
			          	</div>
			     
			          <?php else: ?>
			           <form id="fb-form" method="post" action="<?php echo $form_action ?>"<?php echo $target ?> style="display:none;">
			    	  	  <div>
				        	<?php echo $inputs['hidden'].$fstr; ?>
			            	<input type="submit" value="" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
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
				        	</a>
				        	<div id="fb-root"></div>
				        <?php else: ?>
				        	<fb:login-button size="medium" scope="email,publish_stream">Connect with Facebook</fb:login-button>
				        	<div id="fb-root"></div>
				        <?php endif; ?>
				      </div>
					<?php endif ?>
				</div>
				<div class="arrow-right-dark arrow-<?php echo $color ?>-right-dark">
				</div>
				<div class="arrow-right arrow-<?php echo $color ?>-right">
				</div>
				<div class="clear"></div>
				<p class="secure"><?php echo $fields['footer_note'] ?></p>
			</div>
		</div>
			
	</div>

<?php echo $promote_link ?>
</div>
<?php if ($user): ?>
	<script type="text/javascript">
		jQuery('document').ready(function(){
			jQuery('.lightbox-signup-panel .name').val('<?php echo $UserName; ?>');
			jQuery('.lightbox-signup-panel .email').val('<?php echo $user_profile['email']; ?>');			
		});
	</script>
<?php endif ?>