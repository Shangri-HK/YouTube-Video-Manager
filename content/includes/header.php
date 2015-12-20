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
    <script type="text/javascript" src="../js/slider/jssor.slider.mini.js"></script>
    <script type="text/javascript" src="../js/video-actions.js"></script>
    <script>
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
                $AutoPlay: false,
                $AutoPlaySteps: 3,
                $SlideDuration: 160,
                $SlideWidth: 480,
                $SlideSpacing: 0,
                $Cols: 4,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,
                    $Steps: 3
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$,
                    $SpacingX: 1,
                    $SpacingY: 1
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

    <style>

        /* jssor slider bullet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        .jssorb03 {
            position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
            position: absolute;
            /* size of bullet elment */
            width: 21px;
            height: 21px;
            text-align: center;
            line-height: 21px;
            color: white;
            font-size: 12px;
            background: url('img/b03.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }

        /* jssor slider arrow navigator skin 03 css */
        /*
        .jssora03l                  (normal)
        .jssora03r                  (normal)
        .jssora03l:hover            (normal mouseover)
        .jssora03r:hover            (normal mouseover)
        .jssora03l.jssora03ldn      (mousedown)
        .jssora03r.jssora03rdn      (mousedown)
        */
        .jssora03l, .jssora03r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('img/a03.png') no-repeat;
            overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
    </style>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/override.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div id="logo">
            <a href="dashboard.php">
                <img src="img/logo.png" width="450" height="100">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="search">

            <form class="form-search" role="search" action="search.php" method="post">
                <div class="form-group">
                    <input type="text" name="search-query" class="form-control" placeholder="Search">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default search-submit">Search</button>
                </div>
            </form>

        </div><!-- /.navbar-collapse -->

        <div id="playlists">
            <a href="playlists.php">
                <span><i class="fa fa-list fa-2x"></i></span>
                <h1>Playlists</h1>
            </a>
        </div>

        <div id="browse">
            <a href="browse.php">
                <span><i class="fa fa-folder fa-2x"></i></span>
                <h1>Browse</h1>
            </a>
        </div>

        <div id="stats">
            <a href="stats.php">
                <span><i class="fa fa-bar-chart fa-2x"></i></span>
                <h1>Stats</h1>
            </a>
        </div>
    </div><!-- /.container-fluid -->
</nav>
