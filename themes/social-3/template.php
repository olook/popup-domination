<?php 
	if($this->option('facebook_enabled') != 'Y'):
		console.log('You need to setup your facebook app to the plugin, please go http://developers.facebook.com/ to do so.');
	endif;
?>
<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
<div class="lightbox-overlay"></div>	
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
	<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-grey-panel">
			<div class="lightbox-inner">
				<p class="heading"><?php echo $fields['title'] ?></p>
				<p class="small-para">
					<?php echo nl2br($fields['short_paragraph']) ?>				
				</p>
				<div class="bullet-listx">
                    <ul class="bullet-list"><?php
                        $count = 1;
                        if(isset($list_items) && count($list_items) > 0):
                            foreach($list_items as $l):
                                if($count>4)
                                    break;?>
                        <li><?php echo $l ?></li><?php
                                $count++;
                           endforeach;
                        endif;?>
                    </ul>
					<div class="lightbox-clear"></div>
				</div>
				<div class="lightbox-signup-panel-corner"></div>
				<div class="lightbox-signup-panel">
					<p class="heading2"><?php echo $fields['form_header'] ?></p>
					<div class="facebook_box">
					    <?php if ($user): ?>
					    <?php 
							$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
							$url = explode('?code=',$url);
							$finalurl = $url[0];
						?>	
						<?php if($provider != 'form' && $provider != 'nm'): ?>
	            		<div class="form" style="display:none;">
				    	  <div>
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
		                  <div>
		                  	  <div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
						      <a href="#" class="social_buttons sb_24 sb_facebook got_user">
						      	<span class="span"><?php echo $fields['facebook_button']; ?></span>
						      </a>
						      <div id="fb-root"></div>
					      </div>
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
									<div class="message"><? echo $fields['fb-message']; ?></div>
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
					    </div>
						<div class="stats"></div>
					    <?php endif ?>
				</div>
				<div class="lightbox-clear"></div>
				<p class="secure"><?php echo $fields['footer_note'] ?></p>
				
			</div>
			<div class="lightbox-clear"></div>
		</div>
		<div class="lightbox-clear"></div>	
		<?php echo $promote_link ?>
		<div class="lightbox-clear"></div>
	</div>
</div>
	<script type="text/javascript">
<?php if ($user): ?>	
	
		jQuery('document').ready(function(){
			jQuery('.lightbox-signup-panel .name').val('<?php echo $UserName; ?>');
			jQuery('.lightbox-signup-panel .email').val('<?php echo $user_profile['email']; ?>');
			jQuery('.wallpost').click(function(){
				jQuery('.facebook').show();
			});
			jQuery('.fbmessage .foot .send').click(function(){
				var message = jQuery('.fbmessage .message').text();
				jQuery('.fbmessage .body').children().fadeOut();
				jQuery('.fbmessage .body').html('<img src="<?php echo $this->theme_url; ?>social-3/images/loading.gif" />');
				jQuery.ajax({
					url:"<?php echo $this->theme_url; ?>social-3/src/postfb.php",
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

<?php endif ?>
	</script>