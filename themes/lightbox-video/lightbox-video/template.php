<?php if(isset($fields['video']) && !empty($fields['video'])): ?>
<script>
	$f("ipad", "<?php echo $this->plugin_url; ?>inc/flowplayer/flowplayer-3.2.7.swf").ipad();
</script>	
<?php endif; ?>
<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
	<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-top">
			<div class="lightbox-top-content">
				<div class="lightbox-top-text">
					<p class="heading"><?php echo $fields['title'] ?></p>
				</div>
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
		<?php if($provider != 'nm' && $provider != 'form'): ?>
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