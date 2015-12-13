<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 14:45
 */

include_once 'includes/header.php';
include_once '../config.php';

$parameters = $_POST['search-query'];
$parameters = str_replace(' ', '%2B', $parameters);

$query = '?part=snippet&q='.$parameters;
echo $query =  $_SEARCH_API.$query.$_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($ch);
curl_close($ch);

$resp = json_decode($resp);

var_dump($resp);

foreach ($resp->items as $result) {
    echo 'video ID: '.$result->id->videoId.'<br/>';
}

?>

<iframe width="560" height="315" src="https://www.youtube.com/embed/YhQh5i_dlhA" frameborder="0" allowfullscreen></iframe>

