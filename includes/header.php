<?php session_start();
if(isset($_SESSION["token"])){
  if($_SESSION["token"]<0){
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
<div class="header">
     <div class="container">
        <div class="row">
           <div class="col-md-5">
              <!-- Logo -->
              <div class="logo">
                  <h1><a href="index.php">Telvix TV</a></h1>
                 
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