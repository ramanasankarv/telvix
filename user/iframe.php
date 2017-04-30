<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>HLS Demo</title>
    <link rel="stylesheet" href="https://cdn.plyr.io/1.8.2/plyr.css">
    <style type="text/css">
      body {
  max-width: 1024px;
}
    </style>
  </head>
  <body>
    <video preload="none" id="player" autoplay controls crossorigin></video>
    <script src="https://cdn.plyr.io/1.8.2/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/hls.js/latest/hls.js"></script>
  </body>
  <script type="text/javascript">
    (function () {
  var video = document.querySelector('#player');

  if (Hls.isSupported()) {
    var hls = new Hls();
    hls.loadSource('http://5.9.101.139:8000/TRT1HD.m3u8?u=test:p=123456');
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      video.play();
    });
  }
  
  plyr.setup(video);
})();
  </script>
</html>