<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 20/12/2015
 * Time: 02:46
 */

if (isset($_GET['videoId']) && (!empty($_GET['videoId']))) {
    $videoId = $_GET['videoId'];
    $videoId = substr($videoId, strrpos($videoId, "/") +1);

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=yvm;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        echo "ERROR DB";
    }

    $videoExists = $bdd->query("SELECT * FROM history WHERE video_id ='".$videoId."'");
    $videoExists = $videoExists->fetchAll();

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
        $videoName = addslashes($items->snippet->title);
        $thumbnails = addslashes(serialize($items->snippet->thumbnails));
    }

    echo (isset($videoName) && (!empty($videoName))) ? '' : "<p class='alert alert-danger'>Not added :( Code 13 in actionsVideo.php</p>";
    echo (isset($thumbnails) && (!empty($thumbnails))) ? '' : "<p class='alert alert-danger'>Not added :( Code 17 in actionsVideo.php</p>";

    if (!empty($videoExists) && (isset($videoExists))) {
        if($bdd->exec("UPDATE history (video_id, video_name, thumbnails, time_played, last_visited) VALUES ('".$videoId."', '".$videoName."', '".$thumbnails."', '".($videoExists['time_played'] + 1)."', '".SQL_TIMESTAMP."') WHERE video_id = '".$videoId."'"))
            echo 'UPDATE_SUCCESS';
        else
            echo 'UPDATE_FAILED';
    }
    else {
        if($bdd->exec("INSERT INTO history (video_id, video_name, thumbnails, time_played, last_visited) VALUES ('".$videoId."', '".$videoName."', '".$thumbnails."', '".($videoExists['time_played'] + 1)."', '".SQL_TIMESTAMP."')"))
            echo 'INSERT_SUCCESS';
        else
            echo 'INSERT_FAILED';
    }
}