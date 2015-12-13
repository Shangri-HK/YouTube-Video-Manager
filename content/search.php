<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 14:45
 */

include_once 'includes/config.php';
include_once 'includes/header.php';

$parameters = $_POST['search-query'];
$parameters = str_replace(' ', '%2B', $parameters);

$maxResults = 9;

$query = '?part=snippet&q='.$parameters.'&maxResults='.$maxResults;
echo $query =  $_SEARCH_API.$query.$_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($ch);
curl_close($ch);

$resp = json_decode($resp);

//var_dump($resp);


?>

<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1920px; height: 360px; overflow: hidden; visibility: hidden; background-color: #000000">
    <!-- Loading Screen -->
    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
        <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>
    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1920px; height: 360px; overflow: hidden;">
        <?php
        foreach ($resp->items as $result) {
            if ($result->id->kind == 'youtube#video') {
                echo '<div class="video" id="f" style="display: none">';
                echo '<input hidden id="videoId" value="'.$result->id->videoId.'"/>';
                echo '<input hidden id="videoDesc" value="'.$result->snippet->description.'"/>';
                echo '<h1 style="position: absolute; line-height:36px; top: -17px; left: 15px; color: #ccc;">'.$result->snippet->title.'</h1>';
                echo '<img src="'.$result->snippet->thumbnails->high->url.'">';
                echo '</div>';
            }
            else if ($result->id->kind == 'youtube#playlist') {
                echo '<div style="display: none">';
                echo '<img src="'.$result->snippet->thumbnails->high->url.'">';
                echo '</div>';
            }
        }

        ?>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb03" style="bottom:10px;right:10px;">
        <!-- bullet navigator item prototype -->
        <div data-u="prototype" style="width:21px;height:21px;">
            <div data-u="numbertemplate"></div>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
    <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
</div>

<div class="video-details col-lg-12">

</div>

