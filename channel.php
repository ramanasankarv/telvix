<?php session_start();
if(isset($_SESSION["token"])){
	if($_SESSION["token"]<0){
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
    <title>Telvix TV - Channel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dataTables.css">
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
          <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add Channel</b></button>        
          <div class="row">
            <div class="table-responsive demo-x content">
              <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Src</th>
                    <th>Icon</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Bitrate</th>
                    <th style="background-image: none;width:100px;">Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    <?php include('includes/footer.php');?>

    <!--  Add Channel -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="add-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="add-modal-label">Add new Channel</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label for="add-firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-name" name="name" placeholder="name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-email" class="col-sm-2 control-label">Src</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-src" name="src" placeholder="Src" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-icon" name="icon" placeholder="Icon" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-category" name="category" placeholder="Category" required>
                </div>
              </div>
            
            <div class="form-group">
                <label for="add-type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="add-type" name="type">
                      <option value="live">live</option>
                      <option value="delay">delay</option>
                      <option value="dvr">dvr</option>
                      <option value="inactive">inactive</option>
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Src</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="src" name="src" placeholder="Src" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="category" name="category" placeholder="Category" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="type" name="type">
                      <option value="live">live</option>
                      <option value="delay">delay</option>
                      <option value="dvr">dvr</option>
                      <option value="inactive">inactive</option>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
      $(document).ready(function() {

        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        // Initialize datatable
        $('#example').dataTable({
          "aProcessing": true,
          "aServerSide": true,
          "ajax": "api.php?page=channel"
        });

        // Save edited row
        $("#edit-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=channel_update&id=" + $('#edit-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            location.reload(); 
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        // Add new row
        $("#add-form").on("submit", function(event) {
          //console.log($(this).serialize());
          event.preventDefault();
          $.post("api.php?page=channel_add", $(this).serialize(), function(data) {
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
      function editRow(id,category,icon,type1) {
        console.log(id);
        if ( 'undefined' != typeof id ) {
          $.getJSON('api.php?page=channel_view&ch_no=' + id, function(obj) {
            console.log(obj);
            msg=obj;
            for(var i=0;i<msg.length;i++){
              if(msg[i].search("CH=")==0){
                var res = msg[i].replace("CH=", "");
                $('#edit-id').val(res);
              }else if(msg[i].search("name=")==0){
                var res = msg[i].replace("name=", "");
                $('#name').val(res);
              }else if(msg[i].search("src=")==0){
                var res = msg[i].replace("src=", "");
                $('#src').val(res);
              }else if(msg[i].search("src=")==0){
                var res = msg[i].replace("src=", "");
                $('#src').val(res);
              }
              $('#category').val(category);
              $('#icon').val(icon);
              $('#type').val(type1);
            }
            
            
            $('#edit-modal').modal('show')
          }).fail(function() { alert('Unable to fetch data, please try again later.') });
        } else alert('Unknown row id.');
      }

      // Remove row
      function removeRow(id) {
        if ( 'undefined' != typeof id ) {
          $.get('api.php?page=channel_delete&id=' + id, function() {
            $('a[data-id="row-' + id + '"]').parent().parent().remove();
          }).fail(function() { alert('Unable to fetch data, please try again later.') });
        } else alert('Unknown row id.');
      }
    </script>
  </body>
</html>