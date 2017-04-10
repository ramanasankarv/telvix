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
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="flowplayer-7.0.2/skin/skin.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .modal { position: fixed; top:15%; }
      .modal-dialog{width:50%;margin:auto;}
      .modal-content {
    
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;

    
}
.flowplayer {
  /*background-color: #00abcd;*/
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
        <div class="col-md-3" id="divmenu">
          <?php include('includes/menu.php');?>
        </div>

        <div class="col-md-9">
         	<div class="row">
            	<div class="content-box-large">
              		<div class="panel-heading">

              		</div>
              		<div class="panel-body">
                  
                		<div class="">
                			<label for="add-mobile" class="col-sm-1 control-label">Category</label>
                			<div class="col-sm-2">
                    			<select id="category" name="category" onchange="getList()" class="form-control custom-scroll" title="Click to Select a Category">
                    				<option value="">All</option>
                   	 			</select>
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
        <div class="modal-content" id="video_content">

        </div>
      </div>
    </div>

    


    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>

    

    
    <script src="flowplayer-7.0.2/flowplayer.min.js"></script>
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        

        $.get("api.php?page=category_channel", function(data) {
            var obj = $.parseJSON(data);
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              $('<option>').val(obj[i]).text(obj[i]).appendTo('#category');
              //$('<option>').val(obj[i]).text(obj[i]).appendTo('#mc_src');
            }
           getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });

        // Save edited row
        

        // Add new row
        

      });

      

        function getList(){
          var cat=$("#category").val();
          
          $.get("api.php?page=channel&category="+cat, function(data) {
            var obj = $.parseJSON(data);
            var str="";
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              str+='<div class="col-md-4 panel-warning"><div class="content-box-header panel-heading"><div class="panel-title ">';
              str+=obj[i]["name"]+'</div></div>';
              str+='<div class="content-box-large box-with-header"><a href="javascript:void(0);" onclick="playmovie(\''+obj[i]["name"]+'\')">';
              str+='<img src="'+obj[i]["image"]+'" style="width:100%;"></a></div></div>';
                
            }
            $("#videos").html(str);
           //getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });
        }
        function playmovie(name){
          
          var str='<div class="flowplayer" data-swf="flowplayer-7.0.2/flowplayerhls.swf" data-key="$512206430871778" data-ratio="0.5525"><video autoplay>';
          str+='<source type="application/x-mpegURL" src="http://<?php echo $_SESSION["playeruser"];?>:<?php echo $_SESSION["playerpassword"];?>@5.9.101.139:8000/'+name+':muxer=flv"></video></div>';
            $('#video_content').html(str);
            $('.flowplayer').flowplayer();

          $('#movie-modal').modal('show');
          

          //open_windows("http://5.9.101.139:8000/"+name+".m3u8?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>");
          
        }
        function open_windows(iURL)
{
window.open(iURL);
}


    </script>
      
        
  </body>
</html>