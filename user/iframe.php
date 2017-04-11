<html>
	<head>
		<!-- Flowplayer library -->
		<script src="//releases.flowplayer.org/7.0.2/flowplayer.min.js"></script>
		<!-- Flowplayer hlsjs engine -->
		<script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script>
		<!-- Flowplayer quality selector plugin -->
		<script src="//releases.flowplayer.org/vod-quality-selector/flowplayer.vod-quality-selector.js"></script>

		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="flowplayer-7.0.2/skin/skin.css">
	</head>
	<style>
	#qsel {
	  	/*background-image: url(//flowplayer.org/media/img/demos/minimalist.jpg);*/
	}
	@media(-webkit-min-device-pixel-ratio: 2), (min-resolution: 2dppx) {
	  	#qsel {
	    	/*background-image: url(//flowplayer.org/media/img/demos/minimalist@x2.jpg);*/
	  	}
	}
	</style>
	<script>
		// set up info for this demo
		flowplayer(function (api) {
		  api.on("load", function (e, api, video) {
		    document.getElementById("src").innerHTML = video.src;
		  });
		});
		 
		window.onload = function () {
		 
		  flowplayer("#qsel", {
		    // iframe embed config
		    embed: {
		      iframe: "http://demos.flowplayer.org/scripting/qsel-iframe.html"
		    },
		 
		    playlist: [{
		      title: "Minimalist",
		 
		      // template based vod quality selector plugin configuration
		      vodQualities: {
		        template: "//edge.flowplayer.org/bauhaus-{q}.{ext}",
		        qualities: [
		          "160p",
		          { label: "260p", src: "//edge.flowplayer.org/bauhaus.{ext}" },
		          "530p",
		          "800p"
		        ]
		      },
		 
		      sources: [
		        // HLS for automatic quality selection
		        { type: "application/x-mpegurl", src: "http://5.9.101.139:8000/TRTHABERHD.m3u8?u=test:p=123456" },
		 
		        /* manual selection */
		 
		        // default VOD resolution in 2 formats
		        { type: "video/webm", src: "http://test:123456@5.9.101.139:8000/TRTHABERHD:muxer=ts" },
		        { type: "video/mp4",  src: "http://5.9.101.139:8000/TRTHABERHD?u=test:p=123456" },
		 
		        // default VOD resolution via RTMP for Flash in old browsers
		        { type: "video/flash", src: "http://test:123456@5.9.101.139:8000/TRTHABERHD:muxer=flv" }
		      ]
		    }],
		    //rtmp: "rtmp://5.9.101.139:1935/live/TRTHABERHD?u=test&p=123456",
		 
		    // loop playlist
		    loop: true,
		 
		    splash: true,
		    ratio: 5/12
		  });
		 
		};
	</script>
	<body>
		<div id="qsel" class="fp-slim is-closeable">
		  <a class="fp-prev"></a>
		  <a class="fp-next"></a>
		</div>
	</body>
</html>