<?php
	session_start();
	if(isset($_SESSION['sesh_key'])):
	define('POPUP_DOM_PATH',dirname(dirname(__FILE__)).'/');
	$cpath = POPUP_DOM_PATH.'install/';
	require_once POPUP_DOM_PATH.'popup-domination.php';
	$popdom = new PopUp_Domination();
	require POPUP_DOM_PATH.'config.php';
	$popdom->init($popup_config);
	if($popdom->check_installed() && $_SESSION['sesh_key'] ==  $popdom->option('install')):
		$in = $popdom->in();
		$newarr = array();	
		$error = false;	
		$allmsg = false;	
		$newarr = array();
		$arr = array('email','siteurl','url','path','pass2');
		$str = array("<"."?"."php",'$popup_config = array();');			
		if(count($_POST) > 0){		
			foreach($arr as $a){		
				if((!isset($in[$a]) || empty($in[$a])) && !$allmsg){			
					$error = true;			
					$allmsg = true;			
					$errormsg .= (($errormsg=='')?'':'<br />').'All fields are required.';			
					$val = '';
				} else {		
					if($a == 'email' && !$popdom->validate_email($in[$a])){				
						$error = true;				
						$errormsg .= (($errormsg=='')?'':'<br />').'Admin email address must be a valid email.';			
					} elseif($a == 'pass2' && (strlen($in[$a]) < 5 || strlen($in[$a]) > 20)){				
						$error = true;				
						$errormsg .= (($errormsg=='')?'':'<br />').'Admin password must be between 5 and 20 characters.';			
					}
					$val = trim($in[$a]);
				}
				$newarr[$a] = $val;
			}
			foreach($arr as $a){				
				$str[] = '$popup_config['.$popdom->escape($a).'] = '.$popdom->escape($newarr[$a]).';';			
			}
			$tmp = array('host','user','pass','prefix','name', 'salt');
			require POPUP_DOM_PATH.'config.php';
			foreach($tmp as $t){
				$str[$t] =  '$popup_config['.$popdom->escape($t).'] = '.$popdom->escape($popup_config[$t]).';';
			}
			if($f = @fopen(POPUP_DOM_PATH.'config.php','w')){
					
				fwrite($f,implode("\n",$str));				
				fclose($f);								
				require POPUP_DOM_PATH.'config.php';
			}else {				
				$errormsg = 'Could not save config.php. Please check there is write access on the popup-domination folder.';			
			}
			foreach($newarr as $a => $b){		
				$$a = $b;	
			}
			$defaults = array(
				  'admin_email' => $newarr['email'],										  
				  'admin_pass' => md5($popup_config['salt'].$newarr['pass2']),	
			);
			foreach($defaults as $a => $b){						
				$popdom->option($a,$b);						
			}
			$to = $popdom->option('admin_email');
			$subject = "Your PopUp Domination Login Deatils";
			$message = "PLEASE DON'T REPLY TO THIS EMAIL
			
			Congratulations and thank you for install PopUp Domination at: ".$popdom->plugin_url.".
			
			You can login to your admin panel with the following details:
			
			Login Email Address: ".$popdom->option('admin_email')."
			
			
			Login Password: ".$newarr['pass2']."
			
			More email information here.
			
			Thanks For choosing PopUp Domination!
			
			To you success,
			
			PopUp Domination Team
			
			";
			$from = "noreply@popupdomination.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			echo '
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	<!--
	window.location = "final.php"
	//-->
	</script>
	';						
			exit;	
		} else {	
			$arr = array('email','pass2');	
			$host = 'localhost';	
			$prefix = 'popup_dom_';	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['PHP_SELF'])).'/';	
			$siteurl = dirname($url);	
			$path = dirname(dirname(__FILE__)).'/';	
			foreach($arr as $a){		
				$$a = '';	
			}
		}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PopUp Domination</title>
        <link href="../admin/css/campaigns.css"  rel='stylesheet' id='install-css' />
	</head>
	<body>		
    	<div class="wrap with-sidebar" id="popup_domination">
			<div class="popup_domination_top_left">
				<img class="logo" src="../admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
				<p>Stand-Alone: 4 Step Install</p>
				<div class="clear"></div>
			</div>
			<form action="" method="post"> 
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">			
			<div id="popup_domination_tabs" class="tab-menu">
				<span class="installstage check complete">License Check</span>
				<span class="installstage connect complete">Database Connect</span>
				<span class="installstage setup selected">Login Setup</span>
				<span class="installstage confirm">Confirmation</span>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
                <div class="mainbox" id="popup_domination_tab_look_and_feel">
                    <div class="popdom_contentbox the_help_box">
                        <h3 class="help">Help</h3>
                        <div class="popdom_contentbox_inside">
                            <p>Remember that the email address entered here will also be sent all future login details when using PopUP Domination.</p>
                            <p>Please also don't edit the 3 pre filled inputs, unless the information in them is wrong.</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="popdom_contentbox_inside">
                    	<div class="error"><?php echo $errormsg; ?></div> 
                     	<div class="template_fields install_field">      	                  	
                            <h3>Your Website Url:</h3>   
                            <span class="example">This is your websites' url. If correct, please do not edit.</span>            
                            <input type="text" name="siteurl" id="siteurl" value="<?php echo $popdom->input_val($siteurl); ?>" />                    	
                            <h3>PopUp Domination URL:</h3> 
                            <span class="example">This is the URL where you will navigation to login to PopUp Domination. This should match the folder you uploaded the files</span>                            <input type="text" name="url" id="url" value="<?php echo $popdom->input_val($url); ?>" />                    	
                            <h3>PopUp Domination Path:</h3> 
                            <span class="example">The Directory Path to PopUp Domination. If correct, please do not edit</span>                   
                            <input type="text" name="path" id="path" value="<?php echo $popdom->input_val($path); ?>" />                        	
                            <h3>Login Email Address:</h3>  
                            <span class="example">The email address that will be used to login and be sent all admin details</span>               
                            <input type="text" name="email" id="email" value="<?php echo $popdom->input_val($email); ?>" />
                            <h3>Login Password:</h3>  
                            <span class="example">The password for logging into PopUp Domination</span> 
                            <input type="text" name="pass2" id="pass2" value="<?php echo $popdom->input_val($pass2); ?>" />  
                        </div>
                    </div>      
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
            <div id="popup_domination_form_submit">
                <p class="submit">
                    <input class="savecamp save-btn" type="submit" name="update" value="Continue to Step 4" />												
                </p>						
            </div>
			<div class="clear"></div>
			</form>
		</div>
        </div>
    	</body>
</html> 
	<?php 
	else:
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PopUp Domination</title>
        <link href="../admin/css/campaigns.css"  rel='stylesheet' id='install-css' />
	</head>
	<body>		
    	<div class="wrap with-sidebar" id="popup_domination">
			<div class="popup_domination_top_left">
				<img class="logo" src="../admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
				<p>Stand-Alone: 4 Step Install</p>
				<div class="clear"></div>
			</div>
			<form action="" method="post"> 
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">			
			<div id="popup_domination_tabs" class="tab-menu">
				<span class="installstage error selected">Error</span>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
                <div class="mainbox" id="popup_domination_tab_look_and_feel">
                    <div class="popdom_contentbox_inside">
                    	<div class="error"><?php echo $errormsg; ?></div> 
                     	<div class="template_fields install_field">      	
                            <h1>You appear to be trying to install PopUp Domination incorrectly, please return to the install section and following the install process and instructions carefully.</h1>
                        </div>
                    </div>                  
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
            <div id="popup_domination_form_submit">						
            </div>
			<div class="clear"></div>
			</form>
		</div>
        </div>
    	</body>
</html> 
	<?php
		endif;
	?>
<?php 
	else:
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PopUp Domination</title>
        <link href="../admin/css/campaigns.css"  rel='stylesheet' id='install-css' />
	</head>
	<body>		
    	<div class="wrap with-sidebar" id="popup_domination">
			<div class="popup_domination_top_left">
				<img class="logo" src="../admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
				<p>Stand-Alone: 4 Step Install</p>
				<div class="clear"></div>
			</div>
			<form action="" method="post"> 
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">			
			<div id="popup_domination_tabs" class="tab-menu">
				<span class="installstage error selected">Error</span>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
                <div class="mainbox" id="popup_domination_tab_look_and_feel">
                    <div class="popdom_contentbox_inside">
                    	<div class="error"><?php echo $errormsg; ?></div> 
                     	<div class="template_fields install_field">      	
                            <h1>You appear to be trying to install PopUp Domination incorrectly, please return to the install section and following the install process and instructions carefully.</h1>
                        </div>
                    </div>                  
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
            <div id="popup_domination_form_submit">						
            </div>
			<div class="clear"></div>
			</form>
		</div>
        </div>
    	</body>
</html> 
<?php
	endif;
?>