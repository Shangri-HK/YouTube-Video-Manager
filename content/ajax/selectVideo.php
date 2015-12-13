<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 18:24
 */

include_once '../includes/config.php';


$vid = $_GET['videoId'];

$query = '?part=snippet&id='.$vid;
echo $query =  $_VIDEOS_API.$query.$_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($ch);
curl_close($ch);

$resp = json_decode($resp);

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
    <div class="container">
    <div class="col-lg-2">

    </div>
    <div id="detail">
        <h1>Description</h1>
        <div id="description">
            <br>
            <?php foreach ($resp->items as $items) :?>
            <p><?php echo $items->snippet->description; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-lg-2">

    </div>
</div>
</div>