<?php

require_once 'client_js/pusher-php-server/lib/Pusher.php';

$app_id = '34650';
$app_key = 'b001467f86773130f94c';
$app_secret = '0e41706b1a3e771927ab';

$pusher = new Pusher( $app_key, $app_secret, $app_id );

$pusher->trigger( 'test_channel', 'my_event', 'hello world' );

echo "OK";
?>