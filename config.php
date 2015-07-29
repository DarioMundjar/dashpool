<?php include "twitteroauth/twitteroauth.php";

header('Content-Type: text/html; charset=utf-8');
$consumer ='d7bvVSzyl9IfI6GRcrBFd8QK9';
$consumersecret ='QhPsiwvN3J7M61vBJEyXGNEVtoCRcEvhpBI5658818Yy0MyCQV';
$accesstoken ='2899846557-8431ljRQmzD3hJP7q0ppvbUChCmgAID0z1E3htv';
$accesstokensecret='za4RuKLTFEz8dNZkXLa0HzhIhcYsZlLT0cAjJeCCxjc0F';
$twitter= new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
$twitter2=new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
$status=$twitter2->get('https://api.twitter.com/1.1/statuses/home_timeline.json');
$timeline=$twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json');
$message="";



require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookClientException.php');
require_once( 'Facebook/FacebookPermissionException.php' );
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
?>
