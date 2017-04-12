

<!doctype html>

<html>

<head>
   <meta charset="utf-8">

   <title>Flowplayer hlsjs plugin · Standalone demo · Flowplayer</title>

   <!-- optimize mobile versions -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- The Flowplayer skin -->
   <link rel="stylesheet" href="//releases.flowplayer.org/7.0.2/skin/skin.css">

   <!-- Minimal styling for this standalone page (can be removed) -->
   <style>
   body {
      font-family: "myriad pro", tahoma, verdana, arial, sans-serif;
      font-size: 14px;
      margin: 0;
      padding: 0;
   }
   #content {
      margin: 50px auto;
      max-width: 982px;
   }
   
</style>

   <!-- CSS for this demo -->
   <link rel="stylesheet" href="//flowplayer.org/media/css/demos/plugins/hlsjs.css">
   
   
   <!-- Flowplayer-->
   <script src="//releases.flowplayer.org/7.0.2/flowplayer.min.js"></script>

   <!-- recommended: the hlsjs engine plugin -->
   <script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>



</head>

<body>
<div id="content">

<div id="fp-hlsjs" class="is-closeable"></div>

<script>
flowplayer("#fp-hlsjs", {
    splash: true,
    ratio: 9/16,

    // optional: HLS levels offered for manual selection
    hlsQualities: [-1, 1, 3, 6],

    clip: {
        title: "...", // updated on ready
        sources: [
            { type: "application/x-mpegurl",
              src:  "//5.9.101.139:8000/TRTHABERHD.m3u8?u=test:p=123456" },
            { type: "video/flash",
              src:  "http://test:123456@5.9.101.139:8000/TRTHABERHD:muxer=flv" }
        ]
    },
    embed: false

}).on("ready", function (e, api, video) {
    document.querySelector("#fp-hlsjs .fp-title").innerHTML =
            api.engine.engineName + " engine playing " + video.type;

});
</script>


</div><!--/end content -->
</body>

</html>