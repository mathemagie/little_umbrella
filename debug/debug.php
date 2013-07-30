<?php

//if (!empty($_GET['do'])) {
//  echo "coucou";
  //header('Location: http://localhost/little_umbrella/debug.php');
  //exit;
//}
//ini_set('display_errors', '1');
//error_reporting(E_ALL);

function remove_debug() {
    unlink('order.txt');
}

function active_debug() {
    if (file_exists('order.txt')) return 1;
    return 0;
}

function open_umbrella() {
  $fp = fopen('order.txt', 'w');
  fwrite($fp, '1');
  fclose($fp);
}

function close_umbrella() {
  $fp = fopen('order.txt', 'w');
  fwrite($fp, '0');
  fclose($fp);
}

function read_order(){
    $handle = fopen('order.txt', 'r');
  $contents = fread($handle, filesize('order.txt'));
  fclose($handle);
  return $contents;
}

function is_open() {
  $order = read_order();
  if ($order == '1') return 1;
  return 0;
}
  
if ($_GET['do'] == 'open') {
  open_umbrella();
}

if ($_GET['do'] == 'remove') {
  remove_debug();
}

if ($_GET['do'] == 'close') close_umbrella();

if (is_open()) {
  $action_parapluie = 'close';
}else {
  $action_parapluie ='open';
}

if (active_debug()) {
  $action = 'remove';
  $class_button = 'btn-danger';
}else {
  $action='open';
  $class_button = '';
}
      

?>
<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Little umbrella</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
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
      <a class="btn btn-large" type="button" href='debug.php?do=<?php echo $action_parapluie;?>'><?php echo $action_parapluie;?></a>
      </div>
    </div>
    <br/>
    <div class="row-fluid">
      <div class="span3">
      <a class="btn btn-large <?php echo $class_button;?>" type="button" href='debug.php?do=<?php echo $action;?>'><?php echo $action;?> debug mode</a>
      </div>
    </div>
  </div> <!-- /container -->
</body>