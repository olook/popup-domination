<?php 
	if($this->option('facebook_enabled') != 'Y'):
		console.log('You need to setup your facebook app to the plugin, please go http://developers.facebook.com/ to do so.');
	endif;
?>
<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
		<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="popup-dom-border">
			<div class="lightbox-top">
				<div class="lightbox-top-content">
					<div class="heading"><p><?php echo $fields['title'] ?></p></div>
				
				<div class="bullet-listx">
					<p><?php echo nl2br($fields['short_paragraph']) ?></p>
				</div>
			</div>
			
			<div class="lightbox-bottom">
				<div class="left fb-left">
					<p><?php echo $fields['fb_header'] ?></p>
					<div class="facebook_box">
					    <?php if ($user): ?>
		                  <div>
							<a href="#" class="social_buttons sb_24 sb_facebook got_user">
						      	<span class="span"><?php echo $fields['facebook_button']; ?></span>
						    </a>
						    <div id="fb-root"></div>
					      </div>
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
					    <?php 
							$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
							$url = explode('?code=',$url);
							$finalurl = $url[0];
						?>	
					 </div>
					 <div class="stats">
							<div class="inner">
								<iframe src="http://www.facebook.com/plugins/like.php?app_id=172159922857003&amp;href=<? echo $finalurl; ?>&amp;send=false&amp;layout=button_count&amp;width=49&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:35px;" allowTransparency="true"></iframe>
								<a href="#" class="wallpost">Send</a>
								<div class="clear"></div>
							</div>
						</div>
						<div class="facebook">
							<div class="nub"></div>
							<div class="fbmessage">
								
								<div class="body">
									<p>Message:</p>
									<div class="message"><?php echo $fields['fb-message']; ?></div>
									<div class="clear"></div>
									<p class="link">Link: </p><p class="link">http://<? echo $finalurl; ?></p>
									<div class="clear"></div>
								</div>
								<div class="foot">
									<a class="cancel" href="#">Cancel</a>
									<a class="send" href="#">Send</a>
									<div class="clear"></div>
								</div>
								
							</div>
						</div>
				</div>
				<div class="left">
					<p><?php echo $fields['form_header'] ?></p>
					
					<?php if($provider != 'form' && $provider != 'nm'): ?>
					<div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
					<div class="lightbox-signup-panel">
	            	<div class="form">
		                <div>
		                	<form id="removeme">
		                    	<?php echo $inputs['hidden'].$fstr ?>
		                    	<input type="hidden" class="fbname" value="<?php if(isset($UserName) && !empty($UserName)){ echo $UserName;}else{ echo 'none';} ?>" />
								<input type="hidden" class="fbemail" value="<?php if(isset($user_profile['email']) && !empty($user_profile['email'])){ echo $user_profile['email'];}else{ echo 'none';} ?>" />
		                    	<div>
		                    		<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
		                    	</div>
		                    </form>
		                </div>
	            	</div>
	            	</div>
					
					<?php else: ?>
					<form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
		                <div>
		                    <?php echo $inputs['hidden'].$fstr ?>
		                  	<input type="hidden" class="fbname" value="<?php if(isset($UserName) && !empty($UserName)){ echo $UserName;}else{ echo 'none';} ?>" />
							<input type="hidden" class="fbemail" value="<?php if(isset($user_profile['email']) && !empty($user_profile['email'])){ echo $user_profile['email'];}else{ echo 'none';} ?>" />
		                    <div>
		                    	<input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>images/trans.png" class="<?php echo $button_color?>-button" />
		                    </div>
		                </div>
	            	</form>	
	            	<?php endif; ?>
				</div>
				<div class="right">
					<p><?php echo $fields['social_header'] ?></p>
					<?php if(function_exists('get_bloginfo')): ?>
						<p class="rss"><a href="<?php echo get_bloginfo('rss2_url'); ?>">Subscribe via RSS</a></p>
					<?php endif; ?>
					<p class="twitter"><a href="http://twitter.com/#!/<? echo $fields['twitter']; ?>">Follow us on Twitter</a></p>
				</div>

				<div class="clear"></div>
				<div class="secure-note">
					<span class="secure"><?php echo $fields['footer_note'] ?></span>
				</div>
			</div>
		</div>
	</div>
	<?php echo $promote_link ?>
</div>
	<script type="text/javascript">
		jQuery('document').ready(function(){
		<?php if ($user): ?>	
			jQuery('.lightbox-signup-panel .name').val('<?php echo $UserName; ?>');
			jQuery('.lightbox-signup-panel .email').val('<?php echo $user_profile['email']; ?>');
		<?php endif; ?>
			jQuery('.wallpost').click(function(){
				jQuery('.facebook').show();
			});
			jQuery('.fbmessage .foot .send').click(function(){
				var message = jQuery('.fbmessage .message').text();
				jQuery('.fbmessage .body').children().fadeOut();
				jQuery('.fbmessage .body').html('<img src="<?php echo $this->theme_url; ?>social-4/images/loading.gif" />');
				jQuery.ajax({
					url:"<?php echo $this->theme_url; ?>social-4/src/postfb.php",
					type:'POST',
					data:'message='+message+'&url=http://<?php echo $finalurl; ?>',
					
					success:function(results){
						jQuery('.facebook').fadeOut();
					}
				});
			});
			jQuery('.fbmessage .foot .cancel').click(function(){
				jQuery('.facebook').hide();
			})
		});
</script>