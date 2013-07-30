<!DOCTYPE html><html>
<head>
    <meta charset="utf-8">
    <title>Little Umbrella</title>
  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://js.pusher.com/2.0/pusher.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // Enable pusher logging - don't include this in production
        Pusher.log = function(message) {
          if (window.console && window.console.log) window.console.log(message);
        };

        // Flash fallback logging - don't include this in production
        WEB_SOCKET_DEBUG = true;
        Pusher.channel_auth_endpoint = "private_auth.php";
        var pusher = new Pusher('b001467f86773130f94c');
        var channel = pusher.subscribe('private-test_channel');
         channel.bind('pusher:subscription_succeeded', function() {
      var el = document.getElementById('subscription_status');
      el.innerText = 'Subscribed!';
      el.className = 'subscribed';
    });
        pusher.connection.bind('state_change', function(states) {
        // states = {previous: 'oldState', current: 'newState'}
          $('div#status').text("Pusher's current state is " + states.current);
      });
        function move_umbrella() {
           var triggered = channel.trigger('client-my_event', { "test" : "open" });
        }
      

      </script>

</head>
  <body>
    <div id="pano_container">
       <div id="status"></div><br/>
       <a href="javascript:move_umbrella()" id="move_umbrella_call">moveumbrella</a>
     <div>Subscription status: <span id="subscription_status">Not subscribed</span></div>
    </div>
  </body>
</html>