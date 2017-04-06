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
          <button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add Channel</b></button> 
        </div>
                 
          
          <div class="panel-body">
            <div class="table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Src</th>
                    <th>Icon</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Status</th>
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

    <!--  Edit more Channel -->
    <div class="modal fade" id="edit-more-modal" tabindex="-1" role="dialog" aria-labelledby="edit-more-modal-label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form class="form-horizontal" id="edit-more-form">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="edit-modal-label">Edit More selected row</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-more-id" value="" class="hidden">
                <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="edit-more-name" name="name" placeholder="name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Main URL</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="edit-more-src" name="src" placeholder="Src" readonly required>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">2nd URL</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="sr2" name="sr2" placeholder="Src" >
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">3rd URL</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="sr3" name="sr3" placeholder="Src" >
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Channel SID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sid" name="sid" placeholder="SID" >
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">EPG Channel ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="epg_channel_id" name="epg_channel_id" placeholder="EPG Channel ID" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Multicast Adapter IP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly id="netip" name="netip" placeholder="Multicast Adapter IP" required>
                </div>
              </div>

              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Bitrate Tolerance</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bitratetype" name="bitratetype" placeholder="Bitrate Tolerance" required>
                </div>
              </div>

              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Catch Up Days</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="catch_up_days" name="catch_up_days" placeholder="Catch Up Days" required>
                </div>
              </div>

              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Proxy Mode</label>
                <div class="col-sm-10">
                    <select id="forward" name="forward">
                      <option value=0>0</option>
                      <option value=1>1</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Cache On Demand</label>
                <div class="col-sm-10">
                    <select id="cacheondemand" name="cacheondemand">
                      <option value=0>0</option>
                      <option value=1>1</option>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">HTTP Live Streaming</label>
                <div class="col-md-10">
                    <select id="bitratetype" name="bitratetype" onchange="changeStream(this.value)">
                      <option value=0>Disabled</option>
                      <option value=1>Constant Bitrate</option>
                      <option value=2>Adaptive Bitrate</option>
                    </select>
                </div>
              </div>

              <div class="form-group" id="stream1">
                <label for="mobile" class="col-sm-2 control-label">Mobile Bitrate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobilebitrate" name="mobilebitrate" placeholder="Mobile Bitrate">
                </div>
              </div>
              <div class="form-group" id="stream2">
                <label for="mobile" class="col-sm-2 control-label">SD Bitrate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sdbitrate" name="sdbitrate" placeholder="SD Bitrate">
                </div>
              </div>
              <div class="form-group" id="stream3">
                <label for="mobile" class="col-sm-2 control-label">HD Bitrate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hdbitrate" name="hdbitrate" placeholder="HD Bitrate">
                </div>
              </div>
              <div class="form-group" id="stream4">
                <label class="col-md-2 control-label">Video Format</label>
                <div class="col-md-10">
                    <select id="video_format" name="video_format">
                      <option value='H264'>H264</option>
                      <option value='H265'>H265</option>
                    </select>
                </div>
              </div>

              <div class="form-group"  id="stream5">
                <label class="col-md-2 control-label">Audio Format</label>
                <div class="col-md-10">
                    <select id="audio_format" name="audio_format">
                      <option value='aac'>aac</option>
                      <option value='mp3'>mp3</option>
                    </select>
                </div>
              </div>

              <div class="form-group" id="stream6">
                <label class="col-md-2 control-label">Encoding Speed</label>
                <div class="col-md-10">
                    <select id="preset" name="preset">
                      <option value='ultrafast'>ultrafast</option>
                      <option value='fast'>fast</option>
                      <option value='medium'>medium</option>
                      <option value='slow'>slow</option>
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
      $(document).ready(function() {

        // ATW
        if ( top.location.href != location.href ) top.location.href = location.href;

        // Initialize datatable
        $('#example').dataTable({
          "aProcessing": true,
          "aServerSide": true,
          "bAutoWidth" : true,
          "sAjaxSource": "api.php?page=channel"
        });

        // Save edited row
        $("#edit-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=channel_update&id=" + $('#edit-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            location.reload(); 
          }).fail(function() { alert('Unable to save data, please try again later.'); });
        });

        $("#edit-more-form").on("submit", function(event) {
          event.preventDefault();
          $.post("api.php?page=channel_more_update&id=" + $('#edit-more-id').val(), $(this).serialize(), function(data) {
            var obj = $.parseJSON(data);
            $('#edit-more-modal').modal('hide')
            //location.reload(); 
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
      // More Channel

      function moreRow(id){
        $.get('api.php?page=channel_more&id=' + id, function(obj) {
            console.log(obj);    
            var data = JSON.parse(obj);
            console.log(data);
            for(var i=0;i<data.length;i++){
              console.log(data[i]);
              if(data[i].search("CH=")==0){
                $("#edit-more-id").val(data[i].replace("CH=", ""));
              }
              else if(data[i].search("name=")==0){
                $("#edit-more-name").val(data[i].replace("name=", ""));
              }else if(data[i].search("src=")==0){
                $("#edit-more-src").val(data[i].replace("src=", ""));
              }
              else if(data[i].search("sr2=")==0){
                $("#sr2").val(data[i].replace("sr2=", ""));
              }
              else if(data[i].search("sr3=")==0){
                $("#sr3").val(data[i].replace("sr3=", ""));
              }
              else if(data[i].search("sid=")==0){
                $("#sid").val(data[i].replace("sid=", ""));
              }
              else if(data[i].search("tolerance=")==0){
                $("#tolerance").val(data[i].replace("tolerance=", ""));
              }
              else if(data[i].search("forward=")==0){
                $("#forward").val(data[i].replace("forward=", ""));
              }
              else if(data[i].search("bitratetype=")==0){
                $("#bitratetype").val(data[i].replace("bitratetype=", ""));
              }
              else if(data[i].search("video_format=")==0){
                $("#video_format").val(data[i].replace("video_format=", ""));
              }
              else if(data[i].search("audio_format=")==0){
                $("#audio_format").val(data[i].replace("audio_format=", ""));
              }
              else if(data[i].search("mobilebitrate=")==0){
                $("#mobilebitrate").val(data[i].replace("mobilebitrate=", ""));
              }
              else if(data[i].search("sdbitrate=")==0){
                $("#sdbitrate").val(data[i].replace("sdbitrate=", ""));
              }
              else if(data[i].search("hdbitrate=")==0){
                $("#hdbitrate").val(data[i].replace("hdbitrate=", ""));
              }
              else if(data[i].search("preset=")==0){
                $("#preset").val(data[i].replace("preset=", ""));
              }
              else if(data[i].search("cacheondemand=")==0){
                $("#cacheondemand").val(data[i].replace("cacheondemand=", ""));
              }
              else if(data[i].search("netip=")==0){
                $("#netip").val(data[i].replace("netip=", ""));
              }
              else if(data[i].search("catch_up_days=")==0){
                $("#catch_up_days").val(data[i].replace("catch_up_days=", ""));
              }
              else if(data[i].search("epg_channel_id=")==0){
                $("#epg_channel_id").val(data[i].replace("epg_channel_id=", ""));
              }
            }
            $('#edit-more-modal').modal('show');
        }).fail(function() { alert('Unable to fetch data, please try again later.') });   
      }
      // Remove row
      function removeRow(id) {
        if ( 'undefined' != typeof id ) {
          confirmDialog('Are you sure you want delete the channel', function(){
              //My code to delete
            $.get('api.php?page=channel_delete&id=' + id, function() {
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