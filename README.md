SS
==
Simple class for SocialSender
https://socialsender.ru/api/index.php


Usage:

	$app_id = 100;
	$app_secret = "this_is_secreeeeet";
		
	$SS=new SS($app_id, $app_secret);
	$user_add = $SS->api('User/add', array('uids'=>implode(',',array(46748311))));
	$tasks = $SS->api('Task/list');
