<?php session_start();
if(isset($_SESSION["playertoken"])){
	if($_SESSION["playertoken"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
$page="group";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Telvix TV - Groups</title>
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
          <div class="content-box-large">
            <div class="panel-heading">
              <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal" onclick="$('#add-movie_no').val($('#example tr').length)"><b>Add Group</b></button> 
            </div>
                 
          
            <div class="panel-body">
              <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Connection</th>
                      <th>Channel No</th>
                      <th>Movie Category</th>
                      
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          
         </div>
        </div>

      </div>
    <?php include('includes/footer.php');?>
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
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        // Initialize datatable
        $('#example').dataTable({
          "aProcessing": true,
          "aServerSide": true,
          "sAjaxSource": "api.php?page=group"
        });

      });

    </script>
  </body>
</html>