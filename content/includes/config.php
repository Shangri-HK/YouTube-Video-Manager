<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 12:47
 */


/* PATH CONFIGURATION */

$_BASE      = 'C:/wamp/www/YouTube-Video-Manager/';
$_CSS       = $_BASE.'css/';
$_JS        = $_BASE.'js/';
$_DEV_KEY   = $_BASE.'Developer_Key/';
$_CONTENT   = $_BASE.'content/';
$_INCLUDES  = $_CONTENT.'includes/';

/* RETRIEVING DEVELOPER KEY */

$DeveloperKey = $_DEV_KEY.'Developer_Key.txt';

$handle = fopen($DeveloperKey, 'r');
$_API_KEY = fread($handle, 100);
fclose($handle);

/* API SETTINGS */

$_BASE_API      = 'https://www.googleapis.com/youtube/v3/';
$_SEARCH_API    = $_BASE_API.'search';
$_VIDEOS_API    = $_BASE_API.'videos';
$_CHANNELS_API   = $_BASE_API.'channels';

$_API_KEY       = '&key='.$_API_KEY;

