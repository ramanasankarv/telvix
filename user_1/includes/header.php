<?php
if(isset($_SESSION["playertoken"])){
  if($_SESSION["playertoken"]<0){
    $str='<a href="#">Login</a>';
  }else
  {
    $str='<a href="#" onclick="logout();">Logout</a>';
  }
}
else{
  $str='<a href="#">Login</a>';
}
?>
<style type="text/css">
  .menumovies{font-size: 25px !important;}
</style>
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-3">
              <!-- Logo -->
              <div class="logo">
                  <h1><a href="channel.php">Telvix TV</a></h1>
                 
              </div>
           </div>
           <div style="float: left;">
              <div class="logo menudiv" id="menulive">             
                    <h1><a href="channel.php">Live TV</a></h1>
              </div>
                  
          </div>
          <div class="col-md-2">
              <div class="logo menudiv" id="menumovies">             
                    <h1><a href="movies.php">Movies</a></h1>
              </div>
                  
          </div>
            <div class="col-md-2" style="float:right;">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                        <li><?php echo $str?></li>
                      </ul>
                    </nav>
                </div>
             </div>
        </div>
     </div>
</div>
<script type="text/javascript">
  function logout(){
    $.get("api.php?page=logout", function(data) {
            location.href="login.html"; 
            
        }).fail(function() { alert('Unable to save data, please try again later.'); });
  }
</script>