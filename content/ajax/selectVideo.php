<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 18:24
 */

include_once '../includes/config.php';
include_once '../includes/func.php';

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=yvm;charset=utf8', 'root', '');
    $genres = $bdd->query("SELECT * FROM genres");
    $genres = $genres->fetchAll();
}
catch(Exception $e)
{
    echo 'ERROR DB';
}


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
        <iframe width="1280" height="720" src="https://www.youtube.com/embed/<?php echo $vid ?>" frameborder="0" allowfullscreen></iframe>
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
                $chan_id = $chan->id;
                $chan_name = $chan->snippet->title;
                echo "<br />";
                echo "<img height='250' width='250' src='".$chan->snippet->thumbnails->high->url."' alt='Channel's avatar' style='text-align:center;'/>";
                echo "<br />";
                echo "<h2>".$chan->snippet->title."</h2>";
                echo "<p style='text-align: justify'>".str_replace("\n", "<br />", linksParser($chan->snippet->description))."</p>";
            }
            ?>
        </div>
    </div>
    <div id="detail" class="col-lg-6">
        <h1>Description</h1>
        <div id="description">
            <br>
            <?php foreach ($resp->items as $items) {
                $vid_name = $items->snippet->title;
                echo '<p style="text-align: justify">' .str_replace("\n", "<br />", linksParser($items->snippet->description)). '</p>';
            } ?>
        </div>
    </div>
    <div class="col-lg-3" id="actions">
        <h1>Actions</h1>
        <br />
        <div class="form-group">
            <label for="videoURL">video URL</label>
            <input type="text" class="form-control" id="videoURL" value="http://www.youtube.com/watch?v=<?php echo $vid; ?>">
            <br />
            <button class="btn btn-default form-control" data-toggle="modal" data-target="#modalFavs"><span class="fa fa-star fa-1x">&nbsp;</span>Add to Favorites</button>
            <input hidden type="text" value="<?php echo (isset($vid) && !empty($vid)) ? $vid: 0 ?>" id="videoId">
            <input hidden type="text" value="<?php echo (isset($vid_name) && !empty($vid_name)) ? $vid_name: 0 ?>" id="videoName">
            <input hidden type="text" value="<?php echo (isset($chan_id) && !empty($chan_id)) ? $chan_id : 0 ?>" id="channelId">
            <input hidden type="text" value="<?php echo (isset($chan_name) && !empty($chan_name)) ? $chan_name : 0 ?>" id="channelName">
            <br />
            <br />
            <button class="btn btn-default form-control"><span class="fa fa-plus fa-1x">&nbsp;</span>Add to Playlist</button>
        </div>
        <div id="alert-disp"></div>

    </div>
</div>

<div id="modalFavs" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add to Favoritesr</h4>
            </div>
            <div class="modal-body">
                <label for="genre">Pick a gender for this track :</label>
                <select class="form-control" id="genre">
                    <?php
                        foreach ($genres as $genre) {
                            echo '<option id="genre_opt">'.$genre['genre_name'].'</option>';
                        }
                    ?>
                </select>
                <br />
                <div id="tags">

                </div>
                <button class="btn btn-info form-control" id="submit_new_genre" style="display: none">Add new genre</button>
                <button id="add_favs" class="btn btn-default form-control" data-toggle="modal" data-target="#modalFavs"><span class="fa fa-star fa-1x">&nbsp;</span>Add to Favorites</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
