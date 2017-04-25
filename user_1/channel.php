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
    <link rel="stylesheet" href="flowplayer-7.0.2/skin/skin.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .modal { position: fixed; top:20%; }
      .modal-dialog{width:35%;margin:auto;}
      .modal-content {
    
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;

    
}
#channelul li{float:left;list-style: none;padding:5px; color:#000;font-size:15px;}
#channelul li a{color:#000;}
#channelul li a.active{color:#f05f40;}
#video_content{height: 432px;
  width: 768px;}
.flowplayer {
  /*background-color: #00abcd;*/
  height: 432px;
  width: 768px;
}
.flowplayer .fp-color-play {
  fill: #eee;
}
    </style>
  </head>
  <body>
    <?php include('includes/header.php');?>
    <div class="page-content">
      <div class="row">
        <h3></h3>
        <div id="video_content">

        </div>
        <br>
        <div class="col-md-9">
         	<div class="row">
            	<div class="content-box-large">
              		<div class="panel-heading">

              		</div>
              		<div class="panel-body">
                  
                		<div class="">
                			<div class="col-sm-10" id="channels">

                    			
                			</div>
                		</div>

              		</div>
          		</div>
          	</div>
        </div>
        <div class="col-md-9">
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

    

    
    <script src="flowplayer-7.0.2/flowplayer.min.js"></script>
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        

        $.get("api.php?page=category_channel", function(data) {
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
          $.get("api.php?page=channel&category="+cat, function(data) {
            var obj = $.parseJSON(data);
            var str="";
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              str+='<div class="col-md-4 panel-warning"><div class="content-box-header panel-heading"><div class="panel-title ">';
              str+=obj[i]["name"]+'</div></div>';
              str+='<div class="content-box-large box-with-header"><a href="javascript:void(0);" id="'+i+'channel" onclick="playmovie(\''+obj[i]["name"]+'\')">';
              str+='<img src="'+obj[i]["image"]+'" style="width:100%;"></a></div></div>';
                
            }
            $("#videos").html(str);
            $("#0channel").click();
           //getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });
        }
        function playmovie(name){
          
          var str='<div class="flowplayer"  data-swf="flowplayer-7.0.2/flowplayerhls.swf" data-qualities="160p,260p,530p,800p" data-default-quality="260p" data-analytics="UA-27182341-1" data-key="$512206430871778"><video controls>';
          str+='<source type="application/x-mpegURL" src="http://<?php echo $_SESSION["playeruser"];?>:<?php echo $_SESSION["playerpassword"];?>@5.9.101.139:8000/'+name+':muxer=flv"></video></div>';
            $('h3').html(name);
            $('#video_content').html(str);
            $('.flowplayer').flowplayer();

         // $('#movie-modal').modal('show');
          

          //open_windows("http://5.9.101.139:8000/"+name+".m3u8?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>");
          
        }
        function open_windows(iURL)
{
window.open(iURL);
}


    </script>
      
        
  </body>
</html>