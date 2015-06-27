<?php
    session_start(); 
    
    require_once "twitteroauth/autoload.php"; 
    use Abraham\TwitterOAuth\TwitterOAuth;
    require_once "common.php";

    define("OAUTH_CALLBACK", "http://127.0.0.1/php/twitter-matching/callback.php");

    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

    $_SESSION['oauth_token'] = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

    $url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));

    header( 'location: '. $url );
     
?>
