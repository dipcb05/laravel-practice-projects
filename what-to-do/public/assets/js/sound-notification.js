<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('YOUR_APP_KEY', {
      cluster: 'YOUR_APP_CLUSTER',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(data.message);
      var audio = new Audio('path/to/sound.mp3');
      audio.play();
    });
</script>
