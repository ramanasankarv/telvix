<?php session_start();
if(isset($_SESSION["playertoken"])){
	if($_SESSION["playertoken"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
$page="egp";
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
          <div class="row">
              <div class="content-box-large">
              <div class="panel-heading">

              </div>
              <div class="panel-body">
                  
                <div class="">
                <label for="add-mobile" class="col-sm-1 control-label">Channel</label>
                <div class="col-sm-2">
                    <select id="channel" name="channel" class="form-control custom-scroll" title="Click to Select a Channel">
                    
                    </select>
                </div>
                </div>

                <div class="">
                <label for="add-mobile" class="col-sm-1 control-label">Year</label>
                <div class="col-sm-2">
                    <select id="viewyear" name="viewyear" class="form-control custom-scroll" title="Click to Select Year">
                      <option value="2016">2016</option>
                      <option value="2017" selected>2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                    </select>
                </div>
                </div>

                <div class="">
                <label for="add-mobile" class="col-sm-1 control-label">Month</label>
                <div class="col-sm-2">
                    <select id="viewmonth" name="viewmonth" class="form-control custom-scroll" title="Click to Select Year">
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04" selected>04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                </div>
                </div>

                <button type="button"  class="btn btn-primary btn-sm pull-right" onclick="getList()"><b>Query</b></button>
              </div>
          </div>
          </div>
          </div>
          <div class="col-md-9">
            <div class="row">
            <div class="content-box-large">
              
              <div class="panel-body">
                <div class="table-responsive">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                    <thead>
                      <tr>
                        <th>Start Time</th>
                        <th>Stop Time</th>
                        <th>Program Title</th>
                        <th>Program Description</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            
           </div>
          </div>
          
        </div>

      </div>
    <?php include('includes/footer.php');?>
    </div>
    

    

    

    <!-- Modal confirm -->
    <div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" id="confirmMessage">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
              </div>
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
    
    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        

        $.get("api.php?page=channel_list", function(data) {
            var obj = $.parseJSON(data);
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              $('<option>').val(obj[i].ch_no).text(obj[i].ch_name).appendTo('#channel');
              //$('<option>').val(obj[i]).text(obj[i]).appendTo('#mc_src');
            }
           getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });


      });


        function getList(){
          var ch_no=$("#channel").val();
          var from_year=$("#viewyear").val();
          var from_month=$("#viewmonth").val();
          var to_month=$("#viewmonth").val();
          // Initialize datatable
          $('#example').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            "sAjaxSource": "api.php?page=epg&ch_no="+ch_no+"&from_year="+from_year+"&from_month="+from_month+"&to_month="+to_month
          }); 
        }
    </script>
  </body>
</html>