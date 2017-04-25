
<!doctype html>

<html>

<head>
   <meta charset="utf-8">

      <title>Flowplayer · Live stream</title>
   
   <!-- optimize mobile versions -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
      <!-- Flowplayer skin -->
   <link rel="stylesheet" href="//releases.flowplayer.org/7.0.3/skin/skin.css">
   
   <!-- Minimal styling for this standalone page, can be removed -->
   <link rel="stylesheet" href="http://demos.flowplayer.org/media/css/demo.css">
   <!-- Syntax highlighting of source code, can be removed -->
   <link rel="stylesheet" href="http://demos.flowplayer.org/media/css/pygments.css">
   
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
     <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
         <!-- Flowplayer library -->
    <script src="flowplayer-7.0.2/flowplayer.min.js"></script>
         <!-- The hlsjs plugin for playback of HLS without Flash in modern browsers -->
   
               
   

</head>

<body>

   <div id="content">

      <h1>Flowplayer · Live stream</h1>

<div data-live="true" data-ratio="0.5625" class="flowplayer">

   <div class="flowplayer"  data-swf="flowplayer-7.0.2/flowplayerhls.swf" data-qualities="160p,260p,530p,800p" data-default-quality="260p" data-analytics="UA-27182341-1" data-key="$512206430871778"><video controls><source type="application/x-mpegURL" src="http://ravi:123456@5.9.101.139:8000/WEO TV:muxer=flv"></video></div>

</div>


<!-- for flashls testing only, DO NOT USE IN PRODUCTION! -->
<script>
$('.flowplayer').flowplayer();
</script>
</body>
</html>