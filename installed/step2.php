<?php
	session_start();
	if(isset($_SESSION['sesh_key']) && $_GET['step'] == $_SESSION['sesh_key']):
	define('POPUP_DOM_PATH',dirname(dirname(__FILE__)).'/');
	$cpath = POPUP_DOM_PATH.'install/';
	require_once POPUP_DOM_PATH.'popup-domination.php';
	$popdom = new PopUp_Domination();
	$in = $popdom->in();
	$arr = array('host','user','pass','prefix','name');
		if(count($_POST) > 0){	
		$newarr = array();	
		$error = false;	
		$allmsg = false;	
		$newarr = array();	
		foreach($arr as $a){		
			if((!isset($in[$a]) || empty($in[$a])) && !$allmsg){			
				$error = true;			
				$allmsg = true;			
				$errormsg .= (($errormsg=='')?'':'<br />').'All fields are required.';			
				$val = '';
			} else {		
				if($a == 'prefix' && preg_match("{[^a-z0-9_]$}i",$in[$a])){				
					$error = true;				
					$errormsg .= (($errormsg=='')?'':'<br />').'Prefix can only contain letters, numbers and underscore\'s ( _ )';			
				}
				$val = trim($in[$a]);
			}
			$newarr[$a] = $val;
		}	
		if(!$error){		
			$con = $popdom->test_connection($newarr);		
			if(!$con[0]){			
				$errormsg = $con[1];			
				$error = true;		
			}	
		}
		foreach($newarr as $a => $b){		
			$$a = $b;	
		}
		if(!$error){		
			$newarr['salt'] = $popdom->generate_salt();			
			$arr = array('host','user','pass','prefix','name','path','siteurl','url','salt');			
			$str = array("<"."?"."php",'$popup_config = array();');			
			foreach($arr as $a){				
				$str[] = '$popup_config['.$popdom->escape($a).'] = '.$popdom->escape($newarr[$a]).';';			
			}			
			if($f = @fopen(POPUP_DOM_PATH.'config.php','w')){				
				fwrite($f,implode("\n",$str));				
				fclose($f);								
				require POPUP_DOM_PATH.'config.php';								
				$sql = 'CREATE TABLE '.$popdom->escape($newarr['prefix'],false).'options (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(64) NOT NULL DEFAULT \'\', `value` longtext NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `name` (`name`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';				
				if(!mysql_query($sql)){					
					$errormsg = 'Could not create the options database table `'.$newarr['prefix'].'options`.<br />MySQL Error: '.mysql_error().'. ('.mysql_errno().')<br /><br />Query to be executed:<br />'.$sql.'<br /><br />';				
				} else {
					$sql = 'CREATE TABLE '.$popdom->escape($newarr['prefix'],false).'campaigns (`id` int(25) unsigned NOT NULL AUTO_INCREMENT, `campaign` varchar(250) NOT NULL, `data` longtext NOT NULL, `desc` longtext NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `campaign` (`campaign`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
					mysql_query($sql);
					$sql = 'CREATE TABLE '.$popdom->escape($newarr['prefix'],false).'analytics (`id` int(25) unsigned NOT NULL AUTO_INCREMENT, `campname` varchar(250) NOT NULL, `views` int(25) NOT NULL, `conversions` int(25) NOT NULL, `rating` int(25) NOT NULL, `previousdata` longtext NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
					mysql_query($sql);
					$sql = 'CREATE TABLE '.$popdom->escape($newarr['prefix'],false).'ab (`id` int(25) unsigned NOT NULL AUTO_INCREMENT, `campaigns` varchar(250) NOT NULL, `absettings` longtext NOT NULL, `astats` longtext NOT NULL, `rating` varchar(250) NOT NULL, `name` varchar(250) NOT NULL, `desc` longtext NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `name` (`name`) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
					mysql_query($sql);
					$ins = $popdom->check_installed();				
					if($ins[0] || $ins[1] == 'Success! You have installed PopUp Domination, please delete your install folder.'){						
						$defaults = array('template' => 'lightbox',										  
										  'color' => 'blue',										  
										  'cookie_time' => 7,										  
										  'delay' => 0,										  
										  'button_color' => 'red',										  
										  'show' => serialize(array('everywhere' => 'Y')),										  									  
										  'last_modified' => gmdate("D, d M Y H:i:s"),										  
										  'show_opt' => 'open',										  
										  'unload_msg' => 'Would you like to signup to the newsletter before you go?',										  
										  'impression_count' => 0,										  
										  'new_window' => 'N',										  
										  'promote' => 'Y',
										  'install' => $popdom->escape($_SESSION['sesh_key'],false) 
										  );						
						foreach($defaults as $a => $b){							
							$popdom->option($a,$b);						
						}
						echo '
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	<!--
	window.location = "step3.php"
	//-->
	</script>
	';						
						exit;					
					} else {						
						$errormsg = 'Could not insert options into the database. Please check this user has the correct privileges<br /><br />';					
					}				
				}			
			} else {				
				$errormsg = 'Could not save config.php. Please check there is write access on the popup-domination folder.';			
			}		
		}
	} else {	
		$arr = array('user','pass','name','email','pass2','receipt_key');	
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
				<span class="installstage connect selected">Database Connect</span>
				<span class="installstage setup">Login Setup</span>
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
                            <p>Your database details can be found either in your cpanel of your hosting</p>
                            <p>or you can contact your hosting and ask them for all the details required on this page.</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="popdom_contentbox_inside">
                    	<div class="error"><?php echo $errormsg; ?></div> 
                     	<div class="template_fields install_field">      	
                            <h3>Database Host:</h3> 
                            <span class="example">This will normally be Localhost</span>             
                            <input type="text" name="host" id="host" value="<?php echo $popdom->input_val($host); ?>" />                   	
                            <h3>Database Username:</h3>   
                            <span class="example">Username for access to the database. You may have to set this up in your cPanel or eqivlent</span>            
                            <input type="text" name="user" id="user" value="<?php echo $popdom->input_val($user); ?>" />                     	
                            <h3>Database User Password:</h3> 
                            <span class="example">Password for the Username enter in the previous field</span>                 
                            <input type="text" name="pass" id="pass" value="<?php echo $popdom->input_val($pass); ?>" />                    	
                            <h3>Database Name:</h3> 
                            <span class="example">The Database's name you want to install PopUp Domination to</span>                   
                            <input type="text" name="name" id="name" value="<?php echo $popdom->input_val($name); ?>" />                      	
                            <h3>Database Table Prefix:</h3>  
                            <span class="example">Only change this if you are install PopUp Domination into a database which has a table with the same prefix</span>               
                            <input type="text" name="prefix" id="prefix" value="<?php echo $popdom->input_val($prefix); ?>" /> 
                        </div>
                    </div>                  
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
            <div id="popup_domination_form_submit">
                <p class="submit">
                    <input class="savecamp save-btn" type="submit" name="update" value="Continue to Step 3" />												
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