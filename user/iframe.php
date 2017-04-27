
<!doctype html>

<html>

<head>
   <meta charset="utf-8">

      <title>Flowplayer · Live stream</title>
   
   <!-- optimize mobile versions -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
      <!-- Flowplayer skin -->
   <link rel="stylesheet" href="//releases.flowplayer.org/7.0.3/skin/skin.css">
   
   
   
<style>
.flowplayer {
  background-color: #00abcd;
}
.flowplayer .fp-color-play {
  fill: #eee;
}
</style>
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
      <!-- Flowplayer library -->
<script src="//releases.flowplayer.org/7.0.3/flowplayer.min.js"></script>
<!-- Flowplayer hlsjs engine -->
<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>
   
               
   

</head>

<body>

   <div data-live="true" data-ratio="0.5625" class="flowplayer">
 
   <video data-title="Live stream">
<source type="application/x-mpegurl"
        src="http://5.9.101.139:8000/WEO TV.m3u8?u=ravi:p=123456">
   </video>
 
</div>

</body>
</html>