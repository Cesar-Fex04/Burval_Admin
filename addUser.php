<?php
include 'inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

  $userAdd = $users->addNewUserByAdmin($_POST);
}

if (isset($userAdd)) {
  echo $userAdd;
}


 ?>


 <div class="card ">
   <div class="card-header">

   <style>
   input {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      border: 6px solid #ccc;
      border-radius: 10px;
      font-family: 'Blinker', sans-serif;
      font-size: 18px;
   }

   label {
      display: block;
      margin-bottom: 5px;
      font-family: 'Blinker', sans-serif;
      font-size: 16px;
      font-weight: bold;
      color: #333;
   }
   h3 {
      font-family: 'Blinker', sans-serif;
      font-size: 40px;
      font-weight: bold;
      color: #333;
   }

</style>


          <h3 class='text-center'>Add New User</h3>
        </div>
        <div class="card-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <input type="text" name="name" class="form-control" placeholder="Enter your full name">
                </div>
                <div class="form-group">
                  <input type="text" name="username"  class="form-control " placeholder="Enter your username" >
                </div>
                <div class="form-group">
                  <input type="email" name="email"  class="form-control" placeholder="Enter your e-mail">
                </div>
                <div class="form-group">
                  <input type="text" name="mobile"  class="form-control" placeholder="Enter your number">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <select class="form-control" name="roleid" id="roleid">
                      <option value="" disabled selected >Select user role </option>
                      <option value="1">Admin</option>
                      <option value="2">Editor</option>
                      <option value="3">User only</option>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success">Register</button>
                </div>


            </form>
          </div>


        </div>
      </div>

<?php
}else{

  header('Location:index.php');



}
 ?>

  <?php
  include 'inc/footer.php';

  ?>
