<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 14:45
 */

include_once 'includes/header.php';
include_once 'includes/config.php';

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=yvm;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    echo "<p class='alert alert-danger'>Error in DB Init :( - ".$e->getMessage()."</p>";
}

$favs = $bdd->query('SELECT * FROM favoris');
$favs = $favs->fetchAll();
$late_favs = $bdd->query('SELECT * FROM favoris ORDER BY date_add DESC LIMIT 20');
$late_favs = $late_favs->fetchAll();
$rate_favs = $bdd->query('SELECT * FROM favoris ORDER BY rating ASC LIMIT 5');
$rate_favs = $rate_favs->fetchAll();

$genres = $bdd->query("SELECT * FROM genres");
$genres = $genres->fetchAll();

$tags = $bdd->query("SELECT * FROM tags");
$tags = $tags->fetchAll();

?>
    <div class="col-lg-2"></div>
    <div class="col-lg-8 player-browse">
        <iframe width="450" height="280" src="https://www.youtube.com/embed/<?php echo $favs[$index = rand(0, sizeof($favs))]['video_id'] ?>" frameborder="0" style="float: left; margin-right: 20px" allowfullscreen></iframe>

    <h1 style="line-height: 35px"><?php echo $favs[$index]['video_name'] ?></h1>
    <br>
    <p><?php echo $favs[$index]['video_desc'] ?></p>
    </div>
    <div class="col-lg-2"></div>

<div class="clearfix"></div>

    <div class="col-lg-2 latest">
        <h1>Latest</h1>
        <br />
        <ul class="latest-content">
            <?php
            foreach ($late_favs as $fav) {
                $thumbnail = unserialize($fav['thumbnails']);
                if (isset($thumbnail->maxres->url))
                    $thumbnail = $thumbnail->maxres->url;
                else if (isset($thumbnail->high->url))
                    $thumbnail = $thumbnail->high->url;
                else if (isset($thumbnail->medium->url))
                    $thumbnail = $thumbnail->medium->url;
                else if (isset($thumbnail->default->url))
                    $thumbnail = $thumbnail->default->url;
                echo '<li class="latest-item" ><img src="'.$thumbnail.'" width="250" height="150"><br/>'.$fav['video_name'].'</li>';
            }
            ?>
        </ul>
    </div>
    <div class="col-lg-8" id="favs">
    <div class="container">
        <h1>Favorites</h1>
        <br />
        <ul class="nav nav-tabs nav-justified">
            <?php
            $first = true;
            foreach ($genres as $genre) {
                echo '<li role="presentation" ';
                if ($first)
                    echo 'class="active"';
                echo ' id="'.$genre['genre_name'].'_slot"><a href="#" class="genre_link" data-id="'.$genre['genre_name'].'">'.substr($genre['genre_name'], 0, 8).'</a></li>';
                $first = false;
            }
            ?>
        </ul>
        <?php
        $first = true;
            foreach ($genres as $genre){
                echo '<div id="'.$genre['genre_name'].'" class="tab_icon"';
                if (!$first)
                    echo ' style="display: none"';
                echo '>';
                echo '<div class="filters" data-id="'.$genre['genre_name'].'"';
                if (!$first)
                    echo 'style="display: none"';
                echo '>';
                $first = false;
                foreach ($tags as $tag) {
                    if($genre['genre_name'] != 'N/A') {
                        if ($tag['genre_id'] == $genre['genre_id'])
                            echo '<button class="btn btn-default btn-sm tag-filter">' . $tag['tag_name'] . '</button>';
                    }
                    else
                        echo '<button class="btn btn-default btn-sm tag-filter">' . $tag['tag_name'] . '</button>';
                }
                echo '</div>';
                echo '<div class="icons-viewer">';
                foreach ($favs as $fav) {
                    if ($fav['video_gender'] == $genre['genre_name']) {
                        $thumbnail = unserialize($fav['thumbnails']);
                        if (isset($thumbnail->maxres->url))
                            $thumbnail = $thumbnail->maxres->url;
                        else if (isset($thumbnail->high->url))
                            $thumbnail = $thumbnail->high->url;
                        else if (isset($thumbnail->medium->url))
                            $thumbnail = $thumbnail->medium->url;
                        else if (isset($thumbnail->default->url))
                            $thumbnail = $thumbnail->default->url;
                        echo "<div class='icon-track' data-id='".$fav['tags']."'>";
                        echo '<img width="200" height="170" src="'.$thumbnail.'"><br /><h4>'.$fav['video_name'].'</h4><br />Gender: '.$fav['video_gender'];
                        echo "</div>";
                    }
                }
                echo '</div>
                </div>';
            }
        ?>

    </div>
    </div>
    <div class="col-lg-2 most_rated">
        <h1>Most Rated</h1>
        <br />
        <ul class="most_rated-content">
            <?php
            foreach ($rate_favs as $fav) {
                $thumbnail = unserialize($fav['thumbnails']);
                if (isset($thumbnail->maxres->url))
                    $thumbnail = $thumbnail->maxres->url;
                else if (isset($thumbnail->high->url))
                    $thumbnail = $thumbnail->high->url;
                else if (isset($thumbnail->medium->url))
                    $thumbnail = $thumbnail->medium->url;
                else if (isset($thumbnail->default->url))
                    $thumbnail = $thumbnail->default->url;
                echo '<li class="latest-item" ><img src="'.$thumbnail.'" width="250" height="150"><br/>'.$fav['video_name'].'</li>';
            }
            ?>
        </ul>
    </div>

