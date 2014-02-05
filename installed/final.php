<?php
	session_start();
	unset($_SESSION['sesh_key']);
	session_destroy();
	define('POPUP_DOM_PATH',dirname(dirname(__FILE__)).'/');
	$cpath = POPUP_DOM_PATH.'install/';
	require_once POPUP_DOM_PATH.'popup-domination.php';
	$popdom = new PopUp_Domination();
	require POPUP_DOM_PATH.'config.php';
	$popdom->init($popup_config);
	if($popdom->check_installed()):
		require POPUP_DOM_PATH.'config.php';
		$in = $popdom->in();
		$email = $popdom->option('admin_email');
		$pw = 'Your Chosen Password';
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
				<span class="installstage setup complete">Login Setup</span>
				<span class="installstage confirm selected">Confirmation</span>
			</div>
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device">
                <div class="mainbox" id="popup_domination_tab_look_and_feel">
                    <div class="popdom_contentbox_inside">
                     	<div class="template_fields install_field">
                        	<h3>Congratulations</h3>   	                  	
                            <p class="normal_info">PopUp Domination has been successfully installed on your website.</p>
                            <p class="normal_info">Your login details have been emailed to you.</p>
                            <div class="login_details">
                            	<p>Login Email Address: </p><span class="login_info"><?php echo $email; ?></span>
                                <div class="clear"></div>
                            </div>
                            <div class="login_details">
                            	<p>Login Password: </p><span class="login_info"><em><?php echo $pw; ?></em></span>
                                <div class="clear"></div>
                            </div>
                            <div class="spacing"></div>
                            <h3>Final Step:</h3> 
                            <p class="normal_info">Please <strong>re-name</strong> or <strong>delete</strong> the <strong>"Install"</strong> folder with in the <strong>PopUp Domination</strong> directory.</p>
                            <p class="normal_info">Once, you have re-named or deleted the install folder, <a href="<?php echo $popup_config['url']; ?>">Click Here</a> to head to the login panel.</p>
                        </div>
                    </div>      
                    <div class="clear"></div>
                </div>
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