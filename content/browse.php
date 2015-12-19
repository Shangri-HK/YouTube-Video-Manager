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
$late_favs = $bdd->query('SELECT * FROM favoris ORDER BY date_add ASC LIMIT 20');
$late_favs = $late_favs->fetchAll();
$rate_favs = $bdd->query('SELECT * FROM favoris ORDER BY rating ASC LIMIT 5');
$rate_favs = $rate_favs->fetchAll();
?>
<div class="col-lg-2">
    <br>
    <br>
    <br>
    <h3>Latest</h3>
    <?php
    foreach ($late_favs as $fav) {
        echo '<p>'.$fav['video_name'].'</p>';
    }
    ?>
</div>
<div class="col-lg-8">
<div class="container">
    <h1>Favorites</h1>
    <br />
    <ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="active" id="all_slot"><a href="#" id="all_link">All</a></li>
        <li role="presentation" id="dub_slot"><a href="#" id="dub_link">Dub</a></li>
        <li role="presentation" id="techno_slot"><a href="#" id="techno_link">Techno</a></li>
        <li role="presentation" id="electro_h_slot"><a href="#" id="electro_h_link">Electro / House</a></li>
        <li role="presentation" id="variety_slot"><a href="#" id="variety_link">Variety</a></li>
    </ul>
    <div id="all">
    <?php
    foreach ($favs as $fav) {
        echo "<div style='display: inline; float: left; width: 250px;height: 200px;'>";
        echo $fav['video_name'].'<br />Channel:'.$fav['channel_name'];
        echo "</div>";
    }
    ?>
    </div>
    <div id="dub" style="display: none">
        <?php
        foreach ($rate_favs as $fav) {
            echo "<div style='display: inline; float: left; width: 250px;height: 200px; color:red'>";
            echo $fav['video_name'].'<br />Channel:'.$fav['channel_name'];
            echo "</div>";
        }
        ?>
    </div>
    <div id="techno" style="display: none">
<p>qsdqsdsqdssq</p>
    </div>
    <div id="electro_h" style="display: none">
<p>sqqsdsqdqsddqssdsd</p>
    </div>
    <div id="variety" style="display: none">
<p>qsddqsdsqqsdqsdqsdqsdqds</p>
    </div>
</div>
</div>
<div class="col-lg-2">
    <br>
    <br>
    <br>
    <h3>Most Rated</h3>
    <?php
    foreach ($rate_favs as $fav) {
        echo '<p>'.$fav['video_name'].'</p>';
    }
    ?>
</div>