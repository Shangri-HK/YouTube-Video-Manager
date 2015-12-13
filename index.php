<?php
/**
 * Created by PhpStorm.
 * User: HARDCORE
 * Date: 13/12/2015
 * Time: 11:52
 */

include_once 'content/includes/config.php';

$DeveloperKey = $_DEV_KEY.'Developer_Key.txt';

$handle = fopen($DeveloperKey, 'r');
$DeveloperKey = fread($handle, 100);
fclose($handle);
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>YouTube Video Manager</title>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/override.css">
    <link type="text/javascript" href="js/bootstrap/bootstrap.min.js">
</head>
<body>
TESTING DEV KEY HERE
<br/>
<br/>
No Auth Required Yet, access to dashboard <a href="content/dashboard.php">here</a>

</body>
<footer>

</footer>