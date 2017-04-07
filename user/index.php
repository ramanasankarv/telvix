<?php session_start();
if(isset($_SESSION["playertoken"])){
	if($_SESSION["playertoken"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
$page="index";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Telvix TV - Player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="../css/styles.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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

    


    <link href="../vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="../vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>

    <link href="../vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
    <script src="../vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 
    <script src="flowplayer-7.0.2/flowplayer.min.js"></script>
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        

        $.get("api.php?page=category_list", function(data) {
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
          
          $.get("api.php?page=movies&category="+cat, function(data) {
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
          var str='<div class="flowplayer" data-swf="flowplayer.swf" data-key="$512206430871778" data-ratio="0.4167"><video>';
          str+='<source type="video/webm" src="http://5.9.101.139:8000/'+name+'?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>">';
         str+='<source type="video/mp4"  src="http://5.9.101.139:8000/'+name+'?u=<?php echo $_SESSION["playeruser"];?>:p=<?php echo $_SESSION["playerpassword"];?>"></video></div>'; 
          $("#video_content").html(str);
          $('#movie-modal').modal('show');
        }
    </script>
  </body>
</html>