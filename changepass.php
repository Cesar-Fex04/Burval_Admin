<?php
include 'inc/header.php';
Session::CheckSession();
 ?>
 <?php

 if (isset($_GET['id'])) {
   $userid = (int)$_GET['id'];

 }



 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
    $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
 }



 if (isset( $changePass)) {
   echo  $changePass;
 }
  ?>

<style>

h3 {
    font-family: 'Blinker', sans-serif;
    font-size: 40px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-top: 20px;
  }

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
  
  </style>


 <div class="card ">
   <div class="card-header">

          <h3>Change your password <span class="float-right"> <a href="profile.php?id=<?php  ?>" class="btn btn-primary">Back</a> </h3>
        </div>
        <div class="card-body">



          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <input type="password" name="old_password"  class="form-control" placeholder="Old password">
              </div>
              <div class="form-group">
                <input type="password" name="new_password"  class="form-control" placeholder="New password">
              </div>


              <div class="form-group">
                <button type="submit" name="changepass" class="btn btn-success">Change password</button>
              </div>


          </form>
        </div>


      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
