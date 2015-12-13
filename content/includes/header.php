<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 12:41
 */

include_once 'config.php';

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>YouTube Video Manager</title>

    <script type="text/javascript" src="../js/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/override.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div id="logo">
            <h1>YouTube Video Manager</h1>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="search">

            <form class="form-search" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-default search-submit">Search</button>
                </div>
            </form>

        </div><!-- /.navbar-collapse -->

        <div id="playlists">
            <h2>Playlists</h2>
        </div>

        <div id="browse">
            <h2>Browse</h2>
        </div>

        <div id="stats">
            <h2>Stats</h2>
        </div>
    </div><!-- /.container-fluid -->
</nav>
