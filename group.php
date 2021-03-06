<?php session_start();
if(isset($_SESSION["token"])){
	if($_SESSION["token"]<0){
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    
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
                      <th>Action</th>
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
    

    <!--  Add Movie -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="add-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="add-modal-label">Add new Group</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label for="add-firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-name" name="name" placeholder="name" required>
                    <input type="hidden" class="form-control" id="add-group_no" name="group_no" placeholder="group_no" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-email" class="col-sm-2 control-label">Connection</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-connection" name="connection" placeholder="Connection" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Channel No</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-channel_no" name="channel_no" placeholder="Channel No" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Movie Category</label>
                <div class="col-sm-10">
                    <select multiple="multiple" id="add-mc_src" name="mc_src[]" class="form-control custom-scroll" title="Click to Select a Movie Category">
                    <option value="all">All</option>
                    </select>
                </div>
              </div>
              
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
            </form>
        </div>
      </div>
    </div>
    </div>

    <!--  Edit Channel -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit selected row</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id" value="" class="hidden">
                <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control" id="name" name="name" placeholder="name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Connection</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="connection" name="connection" placeholder="Connection" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Channel No</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="channel_no" name="channel_no" placeholder="Channel No" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Movie Category</label>
                <div class="col-sm-10">
                    <select multiple="multiple" id="mc_src" name="mc_src[]" class="form-control custom-scroll" title="Click to Select a Movie Category">
                    <option value="all">All</option>
                    </select>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
      </div>
    </div>

    <!-- Video channel -->
    <div class="modal fade" id="channel-modal" tabindex="-1" role="dialog" aria-labelledby="channel-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
      </div>
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


    <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    
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

        $.get("api.php?page=movie_cat", function(data) {
            var obj = $.parseJSON(data);
            for(var i=0;i<obj.length;i++){
              $('<option>').val(obj[i]).text(obj[i]).appendTo('#add-mc_src');
              $('<option>').val(obj[i]).text(obj[i]).appendTo('#mc_src');
            }
            
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });

        // Save edited row
        $("#edit-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=group_update&id=" + $('#edit-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            location.reload(); 
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        // Add new row
        $("#add-form").on("submit", function(event) {
          console.log($(this).serialize());
          event.preventDefault();
          $.post("api.php?page=group_add", $(this).serialize(), function(data) {
            console.log(data);
            if(data=="1"){
              location.reload();  
            }
            else{
              alert("Unable to save data, please try again later."); 
            }
            //var obj = $.parseJSON(data);
            
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

      });

      // Edit row
      function editRow(id,name,password,group,expired_time) {
        //console.log(id);
        if ( 'undefined' != typeof name ) {
          $('#name').val(name);
          $('#connection').val(password);
          $('#channel_no').val(group);
          //$('#mc_src').val(expired_time);
          
          $('#edit-id').val(id);
          $('#edit-modal').modal('show')
          
        } else alert('Unknown row id.');
      }

      // Remove row
      function removeRow(id) {
        if ( 'undefined' != typeof id ) {
          confirmDialog('Are you sure you want delete the Group', function(){
              //My code to delete
            $.get('api.php?page=group_delete&id=' + id, function() {
              $('a[data-id="row-' + id + '"]').parent().parent().remove();
            }).fail(function() { alert('Unable to fetch data, please try again later.') });
          });
        } else alert('Unknown row id.');
      }

      function confirmDialog(message, onConfirm){
          var fClose = function(){
          modal.modal("hide");
          };
          var modal = $("#confirmModal");
          modal.modal("show");
          $("#confirmMessage").empty().append(message);
          $("#confirmOk").one('click', onConfirm);
          $("#confirmOk").one('click', fClose);
          $("#confirmCancel").one("click", fClose);
        }
    </script>
  </body>
</html>