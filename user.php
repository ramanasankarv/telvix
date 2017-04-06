<?php session_start();
if(isset($_SESSION["token"])){
	if($_SESSION["token"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
$page="user";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Telvix TV - Users</title>
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
              <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal" onclick="$('#add-movie_no').val($('#example tr').length)"><b>Add User</b></button> 
            </div>
                 
          
            <div class="panel-body">
              <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>Password</th>
                      <th>Group</th>
                      <th>Expired Time</th>
                      <th>IP</th>
                      <th>macid</th>
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
              <h4 class="modal-title" id="add-modal-label">Add new User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label for="add-firstname" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-name" name="name" placeholder="name" required>
                    <input type="hidden" class="form-control" id="add-movie_no" name="movie_no" placeholder="movie_no" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-email" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-password" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                    <select id="add-group" name="group" class="form-control" required>
                    
                  </select>
                  
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Expired Time</label>
                <div class="col-sm-10" >
                    <input type="text" class="form-control" id="add-expired_time" name="expired_time" placeholder="Expired Time" required>
                    
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">IP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-ip" name="ip" placeholder="IP">
                </div>
              </div>

              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">MAC Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="add-macid" name="macid" placeholder="macid">
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
                <label for="email" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                  <select id="group" name="group" class="form-control" required>
                    
                  </select>
                    
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Expired Time</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="expired_time" name="expired_time" placeholder="Expired Time" required>
                </div>
              </div>
  
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">IP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ip" name="ip" placeholder="IP">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">MAC Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="macid" name="macid" placeholder="MAC Address">
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


    <div class="modal fade" id="edit-more-modal" tabindex="-1" role="dialog" aria-labelledby="edit-more-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-more-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit selected row</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-more-id" value="" class="hidden">
                <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">User</label>
                <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control" id="username" name="username" readonly="true" placeholder="username" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">IP 2</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="user2ndip" name="user2ndip" placeholder="IP">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">IP 3</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user3rdip" name="user3rdip" placeholder="IP" >
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">IP 4</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user4thip" name="user4thip" placeholder="IP" >
                </div>
              </div>
  
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">IP 5</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user5thip" name="user5thip" placeholder="IP">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Rating Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rating_password" name="rating_password" placeholder="Rating Password">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Level</label>
                <div class="col-sm-10"> 
                    <select name="level" id="level">
                      <option value="0">User</option>
                      <option value="1">Administrator</option>
                      <option value="2">Super Reseller</option>
                      <option value="3">Reseller</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Pay Model</label>
                <div class="col-sm-10"> 
                    <select name="paymodel" id="paymodel">
                      <option value="Free">Free</option>
                      <option value="Post">Post</option>
                      <option value="Pre">Pre</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Max. Connections</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="maxconnection" name="maxconnection" placeholder="Max. Connections">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Active Connections</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="curconnection" name="curconnection" placeholder="Active Connections">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">User Point</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_point" name="user_point" placeholder="User Point">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Smart Phone No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="smart_phone" name="smart_phone" placeholder="Smart Phone">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Tablet ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tablet" name="tablet" placeholder="Tablet">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Desktop ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desktop" name="desktop" placeholder="Desktop">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">TV ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tv" name="tv" placeholder="TV">
                </div>
              </div>

              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" name="city" placeholder="TV">
                </div>
              </div>

              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">ZIP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Tel Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel Phone">
                </div>
              </div>
              <div class="form-group">
                <label for="add-mobile" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
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
    
     <link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
     <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 

    <script type="text/javascript" language="javascript" class="init">
    var movies_count=1;
      $(document).ready(function() {

        $(function () {
          $('#add-expired_time').datepicker({
            format: 'm/d/yyyy'
          });
          $('#expired_time').datepicker({
            format: 'm/d/yyyy'
          });
        });
        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        // Initialize datatable
        $('#example').dataTable({
          "aProcessing": true,
          "aServerSide": true,
          "sAjaxSource": "api.php?page=user"
        });

        $.get("api.php?page=group_list", function(data) {
            var obj = $.parseJSON(data);
            for(var i=0;i<obj.length;i++){
              console.log(obj[i]);
              $('<option>').val(obj[i].name).text(obj[i].name).appendTo('#group');
              $('<option>').val(obj[i].name).text(obj[i].name).appendTo('#add-group');
            }
           getList(); 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });

        // Save edited row
        $("#edit-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=user_update&id=" + $('#edit-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            location.reload(); 
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        $("#edit-more-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=user_more_update&id=", $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            $('#edit-more-modal').modal('hide')
            //location.reload(); 
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        // Add new row
        $("#add-form").on("submit", function(event) {
          //console.log($(this).serialize());
          event.preventDefault();
          $.post("api.php?page=user_add", $(this).serialize(), function(data) {
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
      function editRow(name,password,group,expired_time,userip,macid) {
        //console.log(id);
        if ( 'undefined' != typeof name ) {
          $('#name').val(name);
          $('#password').val(password);
          $('#group').val(group);
          $('#expired_time').val(expired_time);
          $('#ip').val(userip);
          $('#macid').val(macid);

          $('#edit-modal').modal('show')
          
        } else alert('Unknown row id.');
      }

      // Remove row
      function removeRow(id) {
        if ( 'undefined' != typeof id ) {
          confirmDialog('Are you sure you want delete the user', function(){
              //My code to delete
            $.get('api.php?page=user_delete&id=' + id, function() {
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

        function moreRow(id){
        $.get('api.php?page=user_more&id=' + id, function(obj) {
            console.log(obj);    
            var data = JSON.parse(obj);
            console.log(data);
            for(var i=0;i<data.length;i++){
              console.log(data[i]);
              if(data[i].search("username=")==0){
                $("#username").val(data[i].replace("username=", ""));
              }
              else if(data[i].search("user2ndip=")==0){
                $("#user2ndip").val(data[i].replace("user2ndip=", ""));
              }else if(data[i].search("user3rdip=")==0){
                $("#user3rdip").val(data[i].replace("user3rdip=", ""));
              }
              else if(data[i].search("user4thip=")==0){
                $("#user4thip").val(data[i].replace("user4thip=", ""));
              }
              else if(data[i].search("user5thip=")==0){
                $("#user5thip").val(data[i].replace("user5thip=", ""));
              }
              else if(data[i].search("rating_password=")==0){
                $("#rating_password").val(data[i].replace("rating_password=", ""));
              }
              else if(data[i].search("level=")==0){
                $("#level").val(data[i].replace("level=", ""));
               
              }
              else if(data[i].search("maxconnection=")==0){
                $("#maxconnection").val(data[i].replace("maxconnection=", ""));
              }
              else if(data[i].search("curconnection=")==0){
                $("#curconnection").val(data[i].replace("curconnection=", ""));
              }
              else if(data[i].search("paymodel=")==0){
                var temp=data[i].replace("paymodel=", "");
                if(temp!="")
                  $("#paymodel").val(temp);
              }
              else if(data[i].search("user_point=")==0){
                $("#user_point").val(data[i].replace("user_point=", ""));
              }
              else if(data[i].search("smart_phone=")==0){
                $("#smart_phone").val(data[i].replace("smart_phone=", ""));
              }
              else if(data[i].search("tablet=")==0){
                $("#tablet").val(data[i].replace("tablet=", ""));
              }
              else if(data[i].search("desktop=")==0){
                $("#desktop").val(data[i].replace("desktop=", ""));
              }
              else if(data[i].search("tv=")==0){
                $("#tv").val(data[i].replace("tv=", ""));
              }
              else if(data[i].search("first_name=")==0){
                $("#first_name").val(data[i].replace("first_name=", ""));
              }
              else if(data[i].search("last_name=")==0){
                $("#last_name").val(data[i].replace("last_name=", ""));
              }
              else if(data[i].search("address=")==0){
                $("#address").val(data[i].replace("address=", ""));
              }
              else if(data[i].search("city=")==0){
                $("#city").val(data[i].replace("city=", ""));
              }
              else if(data[i].search("zip=")==0){
                $("#zip").val(data[i].replace("zip=", ""));
              }
              else if(data[i].search("tel=")==0){
                $("#tel").val(data[i].replace("tel=", ""));
              }
              else if(data[i].search("email=")==0){
                $("#email").val(data[i].replace("email=", ""));
              }
            }
            $('#edit-more-modal').modal('show');
        }).fail(function() { alert('Unable to fetch data, please try again later.') });   
      }
    </script>
  </body>
</html>