<?php

require_once '/home/dev/mathemagie.net/www/little_umbrella/client_js/pusher-php-server-master/lib/Pusher.php';

$app_id = '34650';
$app_key = 'b001467f86773130f94c';
$app_secret = '0e41706b1a3e771927ab';

$woeid = '615702';

$weather_feed = file_get_contents("http://weather.yahooapis.com/forecastrss?w=" . $woeid . "&u=c");
$weather = simplexml_load_string($weather_feed);
if(!$weather) die('weather failed');
$copyright = $weather->channel->copyright;

$channel_yweather = $weather->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0");

foreach($channel_yweather as $x => $channel_item) 
    foreach($channel_item->attributes() as $k => $attr) 
        $yw_channel[$x][$k] = $attr;
    
$item_yweather = $weather->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
//var_dump($item_yweather);

foreach($item_yweather as $x => $yw_item) {
    foreach($yw_item->attributes() as $k => $attr) {
        if($k == 'day') $day = $attr;
        if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;    } 
        else { $yw_forecast[$x][$k] = $attr; }
    }
}
$day = substr($yw_forecast['condition']['date'],0,stripos($yw_forecast['condition']['date'],','));

//echo "<" . $yw_forecast['forecast'][$day]['code'] . ">";

$code_weather = $yw_forecast['forecast'][$day]['code'];

$status[0] = array("19","20","21","22","23","24","29","31","30","32","34","45");//parapluie fermÃ
$status[1] = array("0","1","2","3","4","5","11");//ouvert

//$code_weather = "4";//fake code
//echo $code_weather;
foreach (array_keys($status) as $st) {
	if (in_array($code_weather,$status[$st])) {
		$right_status = $st;
	}
	
}
echo "status :" . $right_status . "\n";
//$right_status= 0;
$pusher = new Pusher( $app_key, $app_secret, $app_id );
//$pusher->trigger( 'test_channel', 'my_event', '' );
if (!$right_status) {
	$pusher->trigger( 'test_channel', 'close_umbrella', '' );
}else {
	$pusher->trigger( 'test_channel', 'open_umbrella', '' );
}
?>
