<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}


?>



<div class="card">
  <div class="card-header">
    <h3 class='text-center'><i class="fas fa-sign-in-alt mr-2"></i>User login</h3>
  </div>
 
  <div class="card-body">


    <div style="width:600px; margin:0px auto">

      <form class="" action="" method="post">
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email address">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
          <button type="submit" name="login" class="btn btn-success">Login</button>
        </div>


      </form>
    </div>


  </div>
</div>



<?php
include 'inc/footer.php';

?>