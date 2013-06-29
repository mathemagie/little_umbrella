<?php
$weather_feed = file_get_contents("http://weather.yahooapis.com/forecastrss?w=615702&u=c");
$weather = simplexml_load_string($weather_feed);
if(!$weather) die('weather failed');
$copyright = $weather->channel->copyright;

$channel_yweather = $weather->channel->children("http://xml.weather.yahoo.com/ns/rss/1.0");

foreach($channel_yweather as $x => $channel_item) 
    foreach($channel_item->attributes() as $k => $attr) 
        $yw_channel[$x][$k] = $attr;
    
//echo $yw_channel['location']['city'];

$item_yweather = $weather->channel->item->children("http://xml.weather.yahoo.com/ns/rss/1.0");
//var_dump($item_yweather);

foreach($item_yweather as $x => $yw_item) {
    foreach($yw_item->attributes() as $k => $attr) {
        if($k == 'day') $day = $attr;
        if($x == 'forecast') { $yw_forecast[$x][$day . ''][$k] = $attr;    } 
        else { $yw_forecast[$x][$k] = $attr; }
    }
}
//print_r($yw_forecast);
//echo $yw_forecast['condition']['code'];
$day = substr($yw_forecast['condition']['date'],0,stripos($yw_forecast['condition']['date'],','));
//echo $day . "\n";
//echo $yw_forecast['forecast'][$day]['text'] . "|";

//echo "<" . $yw_forecast['forecast'][$day]['code'] . ">";
//echo "<" . $yw_forecast['forecast'][$day]['code'] . ">";
$code_weather = $yw_forecast['forecast'][$day]['code'];
echo $code_weather;
echo "<0>";

//var_dump($yw_forecast)
?>
