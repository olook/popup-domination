	<?php require_once('aweber_api/aweber_api.php');
	// Replace with the keys of your application
	// NEVER SHARE OR DISTRIBUTE YOUR APPLICATIONS'S KEYS!
	$consumerKey    = "Ak2fhDbJXFTAy6FTq80pAoPc ";
	$consumerSecret = "oC2bGapJRbPo19fJrdLKhGRhIDOtCiNd8EQ7FI0H";
	$aweber = new AWeberAPI($consumerKey, $consumerSecret);
	
	if (empty($_COOKIE['accessToken'])) {
	    if (empty($_GET['oauth_token'])) {
	        $callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	        list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
	        setcookie('requestTokenSecret', $requestTokenSecret);
	        setcookie('callbackUrl', $callbackUrl);
	        header("Location: {$aweber->getAuthorizeUrl()}");
	        exit();
	    }
	
	    $aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
	    $aweber->user->requestToken = $_GET['oauth_token'];
	    $aweber->user->verifier = $_GET['oauth_verifier'];
	    list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
	    setcookie('accessToken', $accessToken);
	    setcookie('accessTokenSecret', $accessTokenSecret);
	    header('Location: '.$_COOKIE['callbackUrl']);
	    exit();
	}
	$account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);""
	?>