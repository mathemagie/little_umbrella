<?php

require_once 'client_js/pusher-php-server-master/lib/Pusher.php';

$app_id = '34650';
$app_key = 'b001467f86773130f94c';
$app_secret = '0e41706b1a3e771927ab';

if ($_GET['do'] == 'change') {
	$pusher = new Pusher( $app_key, $app_secret, $app_id );
	$pusher->trigger( 'test_channel', 'my_event', '' );
}
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Little umbrella debug </title>
  <link href="debug/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <style>
    .button-icon { max-width: 75px; }
    .tile {
      border-left: 1px solid #444;
      padding: 5px;
      list-style: none;
    }
    .btn { width: 100%; }
  </style>
</head>
<body>
  <div class="container">

  <h1>Little umbrella debug</h1><br/>

    <div class="row-fluid">
      <div class="span3">
      <a class="btn btn-large" type="button" href='test.php?do=change'>change state</a>
      </div>
    </div>
    <br/>

  </div> <!-- /container -->
</body>
