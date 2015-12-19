<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 19/12/2015
 * Time: 13:34
 */

function linksParser($link) {
    $link = preg_replace("/(http:\/\/[^\s]+)/", "<a href=\"$1\" target=\"_blank\">$1</a>", $link);
    $link = preg_replace("/(https:\/\/[^\s]+)/", "<a href=\"$1\" target=\"_blank\">$1</a>", $link);
    return $link;
}