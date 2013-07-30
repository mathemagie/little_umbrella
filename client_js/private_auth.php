<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('pusher-php-server/lib/Pusher.php');
require_once('config.php');

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
?>