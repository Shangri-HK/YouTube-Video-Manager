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
 * 21: missing genre
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
            if (isset($_GET['tags']) && (!empty($_GET['tags'])))
                $tags = $_GET['tags'];

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
                $video_desc = addslashes($items->snippet->description);
                $channelId = addslashes($items->snippet->channelId);
                $channelName = addslashes($items->snippet->channelTitle);
                $thumbnails = addslashes(serialize($items->snippet->thumbnails));
            }

            echo (isset($videoName) && (!empty($videoName))) ? '' : "<p class='alert alert-danger'>Not added :( Code 13 in actionsVideo.php</p>";
            echo (isset($channelId) && (!empty($channelId))) ? '' : "<p class='alert alert-danger'>Not added :( Code 14 in actionsVideo.php</p>";
            echo (isset($channelName) && (!empty($channelName))) ? '' : "<p class='alert alert-danger'>Not added :( Code 15 in actionsVideo.php</p>";
            echo (isset($video_desc) && (!empty($video_desc))) ? '' : "<p class='alert alert-danger'>Not added :( Code 16 in actionsVideo.php</p>";
            echo (isset($thumbnails) && (!empty($thumbnails))) ? '' : "<p class='alert alert-danger'>Not added :( Code 17 in actionsVideo.php</p>";

            if($bdd->exec("INSERT INTO favoris (video_id, video_name, video_gender, thumbnails, channel_id, channel_name, video_desc, tags) VALUES ('".$videoId."', '".$videoName."', '".$videoGender."', '".$thumbnails."', '".$channelId."', '".$channelName."', '".$video_desc."', '".$tags."')"))
                echo "<p class='alert alert-success'>Successfully added to favs !</p>";
            else
                echo "<p class='alert alert-danger'>Not added - Error in DB Req :(</p>";
        }
        break;
        case 'loadingTags': {
            if (isset($_GET['genre']) && (!empty($_GET['genre'])))
                $genre = $_GET['genre'];
            else
                echo "<p class='alert alert-danger'>Failed to load Tags :( Code 21 in actionsVideo.php</p>";

            if($tags = $bdd->query("SELECT * FROM tags INNER JOIN genres ON (genres.genre_id = tags.genre_id) WHERE genres.genre_name = '".$genre."'")) {
                foreach ($tags as $tag) {
                    echo '<button class="btn btn-default btn-sm" id="tag">'.$tag['tag_name'].'</button>';
                }
                echo '<br />';
                echo '<br />';
            }
            else {
                echo "<p class='alert alert-danger'>Failed to load Tags :( Code 22 in actionsVideo.php</p>";
            }

        }

    }
}
else {
    echo "<p class='alert alert-danger'>Not added :( Function not found in actionsVideo.php</p>";
}