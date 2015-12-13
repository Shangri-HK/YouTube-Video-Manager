<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 18:24
 */

include_once '../includes/config.php';


$vid = $_GET['videoId'];
$query_video = '?part=snippet&id='.$vid;
$query_video =  $_VIDEOS_API.$query_video.$_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $query_video);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($ch);

curl_close($ch);

$resp = json_decode($resp);
//var_dump($resp);

foreach ($resp->items as $items) {
    $channel = $items->snippet->channelId;
}
$query_channel = '?part=snippet&id='.$channel;
$query_channel = $_CHANNELS_API.$query_channel.$_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $query_channel);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$channel = curl_exec($ch);

curl_close($ch);
$channel = json_decode($channel);
//var_dump($channel);

?>

<div id="player">
    <div class="col-lg-2">

    </div>
    <div id="iframe col-lg-8">
<!--        <iframe width="1280" height="720" src="https://www.youtube.com/embed/--><?php //echo $vid ?><!--" frameborder="0" allowfullscreen></iframe>-->
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div id="details">
    <div class="col-lg-3">
        <div id="channel">
            <h1>Channel</h1>
            <?php
            foreach ($channel->items as $chan) {
                echo "<br />";
                echo "<img height='250' width='250' src='".$chan->snippet->thumbnails->high->url."' alt='Channel's avatar' style='text-align:center;'/>";
                echo "<br />";
                echo "<h2>".$chan->snippet->title."</h2>";
                echo "<p style='text-align: justify'>".$chan->snippet->description."</p>";
            }
            ?>
        </div>
    </div>
    <div id="detail" class="col-lg-6">
        <h1>Description</h1>
        <div id="description">
            <br>
            <?php foreach ($resp->items as $items) :?>
            <p style="text-align: justify"><?php echo $items->snippet->description; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-lg-3" id="actions">
        <h1>Actions</h1>
        <br />
        <div class="form-group">
        <label for="videoURL">video URL</label>
        <input type="text" class="form-control" id="videoURL" value="http://www.youtube.com/watch?v=<?php echo $vid; ?>">
            <br />
            <button class="btn btn-default form-control"><span class="fa fa-star fa-1x">&nbsp;</span>Add to Favorites</button>
            <br />
            <br />
            <button class="btn btn-default form-control"><span class="fa fa-plus fa-1x">&nbsp;</span>Add to Playlist</button>
        </div>
    </div>
</div>