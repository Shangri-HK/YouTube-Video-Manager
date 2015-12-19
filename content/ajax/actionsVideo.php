<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 19/12/2015
 * Time: 14:44
 *
 * ERROR CODES:
 * 10 : operation aborted - function not found
 * 11/12/13/14/15 : operation aborted - missing data
 * 50 : operation aborted - db error
 *
 * SUCCESS CODES:
 * 200: OK
 */

include_once '../includes/config.php';

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=yvm;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    echo "<p class='alert alert-danger'>Not added :( Error in DB Init :( - ".$e->getMessage()."</p>";
}


if (isset($_GET['function']) && (!empty($_GET['function']))) {
    $function = $_GET['function'];

    switch ($function) {
        case 'addFav': {
            if (isset($_GET['videoId']) && (!empty($_GET['videoId'])))
                $videoId = addslashes($_GET['videoId']);
            else
                echo "<p class='alert alert-danger'>Not added :( Code 11 in actionsVideo.php</p>";
            if (isset($_GET['videoGender']) && (!empty($_GET['videoGender'])))
                $videoGender = addslashes($_GET['videoGender']);
            else
                echo "<p class='alert alert-danger'>Not added :( Code 12 in actionsVideo.php</p>";

            $query_video = '?part=snippet&id='.$videoId;
            $query_video =  $_VIDEOS_API.$query_video.$_API_KEY;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $query_video);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($ch);

            curl_close($ch);

            $resp = json_decode($resp);

            foreach ($resp->items as $items) {
                $videoName = $items->snippet->title;
                $channelId = $items->snippet->channelId;
                $channelName = $items->snippet->channelTitle;
            }

            echo (isset($videoName) && (!empty($videoName))) ? '' : "<p class='alert alert-danger'>Not added :( Code 13 in actionsVideo.php</p>";
            echo (isset($channelId) && (!empty($channelId))) ? '' : "<p class='alert alert-danger'>Not added :( Code 14 in actionsVideo.php</p>";
            echo (isset($channelName) && (!empty($channelName))) ? '' : "<p class='alert alert-danger'>Not added :( Code 15 in actionsVideo.php</p>";

            if($bdd->exec("INSERT INTO favoris (video_id, video_name, video_gender, channel_id, channel_name) VALUES ('".$videoId."', '".$videoName."', '".$videoGender."', '".$channelId."', '".$channelName."')"))
                echo "<p class='alert alert-success'>Successfully added to favs !</p>";
            else
                echo "<p class='alert alert-danger'>Not added - Error in DB Req :(</p>";
        }

    }
}
else {
    echo "<p class='alert alert-danger'>Not added :( Function not found in actionsVideo.php</p>";
}