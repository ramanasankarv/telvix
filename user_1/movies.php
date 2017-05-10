<?php session_start();
if(isset($_SESSION["playertoken"])){
	if($_SESSION["playertoken"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
$page="channel";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Telvix TV - Player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="plugin/swfobject.js"></script>
    <style type="text/css">
    .header .container{margin: auto; max-width: 1145px; padding: 0px;}
    
      .modal { position: fixed; top:20%; }
      .modal-dialog{width:35%;margin:auto;}
      .modal-content {
    
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;

    
}
#related .panel-warning{width:141px;}
#channelul li{float:left;list-style: none;padding:5px; color:#000;font-size:15px;}
#channelul li a{color:#000;}
#channelul li a.active{color:#f05f40;}
#video_content{height: 492px;
  width: 875px;}
.flowplayer {
  /*background-color: #00abcd;*/
  height: 492px;
  width: 875px;
}
.flowplayer .fp-color-play {
  fill: #eee;
}
#menumovies h1,#menulive h1{font-size:24px !important;}
    </style>
  </head>
  <body>
    <?php include('includes/header.php');?>
    <div class="page-content" style="max-width: 1145px; margin: auto;">
      <div class="row" >
        <div style="float:left;width: 768px;">
        <h3></h3>
        <div id="video_content" >
        <video width="875" height="492" autoplay id="player" controls></video>
        </div>
        <br>
        <script type="text/javascript">
sa_client = "de1a9e4ce1b54949e8871899b2bc3685";
sa_code = "4e3ead44ff7dd42a7f40d1faadacc595";
sa_protocol = ("https:"==document.location.protocol)?"https":"http";
sa_pline = "0";
sa_maxads = "3";
sa_bgcolor = "FFFFFF";
sa_bordercolor = "BDD631";
sa_superbordercolor = "BDD631";
sa_linkcolor = "001EB5";
sa_desccolor = "000000";
sa_urlcolor = "788300";
sa_b = "0";
sa_format = "banner_728x60";
sa_width = "728";
sa_height = "60";
sa_location = "0";
sa_radius = "0";
sa_borderwidth = "1";
sa_font = "0";
</script>
<script type="text/javascript" src="//sa.entireweb.com/sense2.js"></script>
        </div>
        <div style="float:right;padding-right:30px;width: 250px;" >
        <h4 style="padding-top: 20px;">Related Channels</h4>
        <div id="related">
        
        </div>
        </div>
        <br>
        <div style="clear: both; width: 100%; margin-top: 20px;" class="col-md-9">
         	<div class="row">
            	<div class="content-box-large">
              		
              		<div class="panel-body">
                  
                		<div class="">
                			<div class="col-sm-10" id="channels">

                    			
                			</div>
                		</div>

              		</div>
          		</div>
          	</div>
        </div>
        <div class="col-md-9"  style="width: 100%;">
           	<div class="row" id="videos">
			  		</div>
          
        </div>

      </div>
    <?php include('includes/footer.php');?>
    </div>
    
    <!-- Video channel -->
    <div class="modal fade" id="movie-modal" tabindex="-1" role="dialog" aria-labelledby="movie-modal-label">
      <div class="modal-dialog" role="document">
        
      </div>
    </div>

    


    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

    

    
    <script type="text/javascript">
    var player = null;
    
    var ua = window.navigator.userAgent.toLowerCase();
    if (/(ipod|iphone|ipad|macintosh|android)/.test(ua) && /^(?!.*chrome).*$/.test(ua) && /safari/.test(ua)) {
      player = document.getElementById("player");
      player.play()
    } else {
    
    function jsbridge(playerId, event, data) {
        player = player || document.getElementById(playerId);
    }
    }  
      
    </script>
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        

        $.get("api.php?page=category_list", function(data) {
            var obj = $.parseJSON(data);
            var str="<ul id='channelul'>";
            var temp="";
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              var clss="";
              if(i==0){
                temp=obj[i];
                clss="active";  
              }
              str+="<li><a href='#' onclick='getList(\""+obj[i]+"\")' class='"+clss+"' id='"+obj[i]+"'>"+obj[i]+"</a></li>";
              //$('<option>').val(obj[i]).text(obj[i]).appendTo('#category');
              //$('<option>').val(obj[i]).text(obj[i]).appendTo('#mc_src');
            }
            str+="</ul>";
            $("#channels").html(str);
           getList(temp); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });

        // Save edited row
        

        // Add new row
        

      });

      

        function getList(cat){
          //var cat=$("#category").val();
          $("li a.active").removeClass("active");
          $("#"+cat).addClass("active");
          $.get("api.php?page=movies&category="+cat, function(data) {
            var obj = $.parseJSON(data);
            var str="";
            var realted="";
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              str+='<div class="col-md-3 panel-warning"><div class="content-box-header panel-heading"><div class="panel-title ">';
              str+=obj[i]["name"]+'</div></div>';
              str+='<div class="content-box-large box-with-header"><a href="javascript:void(0);" id="'+i+'channel" onclick="playmovie(\''+obj[i]["name"]+'\')">';
              str+='<img src="'+obj[i]["image"]+'" style="width:100%;"></a></div></div>';
              if(i>=1) {
                realted+='<div class="panel-warning"><div class="content-box-header panel-heading"><div class="panel-title ">';
                realted+=obj[i]["name"]+'</div></div>';
                realted+='<div class="content-box-large box-with-header"><a href="javascript:void(0);" id="'+i+'channel" onclick="playmovie(\''+obj[i]["name"]+'\')">';
                realted+='<img src="'+obj[i]["image"]+'" style="width:100%;"></a></div></div>';
              }
                
            }
            $("#videos").html(str);
            $("#0channel").click();
            if(realted!=""){
              $("h4").show();
              $("#related").show();
              $("#related").html(realted); 
            }
            else{
              $("h4").hide();
              $("#related").hide();
            }
           //getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });
        }
        function playmovie(name){
          
    //       var str='<div class="flowplayer"  data-swf="flowplayer-7.0.2/flowplayerhls.swf" data-qualities="160p,260p,530p,800p" data-default-quality="260p" data-analytics="UA-27182341-1" data-key="$512206430871778"><video controls>';
    //       str+='<source type="application/x-mpegURL" src="http://<?php echo $_SESSION["playeruser"];?>:<?php echo $_SESSION["playerpassword"];?>@5.9.101.139:8000/'+name+':muxer=flv"></video></div>';
             $('h3').html(name);
    //         $('#video_content').html(str);
    //         $('.flowplayer').flowplayer({screen: {
    //     width: 768,
    //     height: 432
    // }});

         // $('#movie-modal').modal('show');
          

          //open_windows("http://5.9.101.139:8000/"+name+".m3u8?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>");

            var parameters = {
              src: "http://5.9.101.139:8000/"+name+"?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>",
              autoPlay: true,
              verbose: true,
              controlBarAutoHide: true,
              controlBarPosition: "bottom",
              javascriptCallbackFunction: "jsbridge",
              plugin_hls: "plugin/flashlsOSMF.swf",
              hls_minbufferlength: -1,
              hls_maxbufferlength: 300,
              hls_lowbufferlength: 3,
              hls_seekmode: "KEYFRAME",
              hls_startfromlevel: -1,
              hls_seekfromlevel: -1,
              hls_live_flushurlcache: false,
              hls_info: true,
              hls_warn: true,
              hls_error: true,
              hls_fragmentloadmaxretry : -1,
              hls_manifestloadmaxretry : -1,
              hls_capleveltostage : false,
              hls_maxlevelcappingmode : "downscale"
            };
            
            swfobject.embedSWF(
              "plugin/GrindPlayer.swf",
              "player",
              875,
              492,
              "10.1.0",
              "expressInstall.swf",
              parameters,
              {
                allowFullScreen: "true"
              },
              {
                name: "player"
              }
            );
          
          
        }
        function open_windows(iURL)
{
window.open(iURL);
}


    </script>
      
        
  </body>
</html>