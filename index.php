
<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>

<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


 ?>
<style>

.table-responsive {
  max-width: 100%;
  overflow-x: auto;
}

.card {
  width: 100%;
  max-width: 100%;
}

.table {
  table-layout: auto; /* O ajustar a 'fixed' si prefieres que las celdas tengan un ancho fijo */
}

@media (max-width: 768px) {
  .table th, .table td {
    font-size: 12px; /* Reduce el tamaño de fuente en pantallas pequeñas */
  }

  .btn-sm {
    padding: 0.2rem 0.4rem; /* Ajustar botones para pantallas pequeñas */
  }
}

</style>


     <div class="card" style="margin: auto; display: auto; max-width: 100%; overflow-x: auto;">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>User list <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
        <?php
        $username = Session::get('username');
        if (isset($username)) {
          echo $username;
        }
        ?>
      </span>
    </strong></span></h3>
  </div>
  <div class="card-body pr-2 pl-2">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width: 100%; max-width: 100%;">
        <thead>
          <tr>
            <th class="text-center">SL</th>
            <th class="text-center">Name</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email address</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Status</th>
            <th class="text-center">Created</th>
            <th class="text-center" width="25%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allUser = $users->selectAllUserData();
          if ($allUser) {
            $i = 0;
            foreach ($allUser as $value) {
              $i++;
          ?>
            <tr class="text-center" <?php if (Session::get("id") == $value->id) { echo "style='background:#d9edf7'"; } ?>>
              <td><?php echo $i; ?></td>
              <td><?php echo $value->name; ?></td>
              <td><?php echo $value->username; ?> <br>
                <?php if ($value->roleid == '1') {
                  echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                } elseif ($value->roleid == '2') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                } elseif ($value->roleid == '3') {
                  echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                } ?>
              </td>
              <td><?php echo $value->email; ?></td>
              <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
              <td>
                <?php if ($value->isActive == '0') { ?>
                <span class="badge badge-lg badge-info text-white">Active</span>
                <?php } else { ?>
                <span class="badge badge-lg badge-danger text-white">Deactive</span>
                <?php } ?>
              </td>
              <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at); ?></span></td>
              

               <!--
                -->
              
              <td>
                <?php if (Session::get("roleid") == '1') { ?>
                <!-- Actions for admin -->
                <a class="btn btn-success btn-sm" href="profile.php?id=<?php echo $value->id; ?>">View</a>
                <a class="btn btn-info btn-sm" href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                <a class="btn btn-danger btn-sm" href="?remove=<?php echo $value->id; ?>">Remove</a>
                <?php if ($value->isActive == '0') { ?>
                <a class="btn btn-warning btn-sm" href="?deactive=<?php echo $value->id; ?>">Disable</a>
                <?php } elseif ($value->isActive == '1') { ?>
                <a class="btn btn-secondary btn-sm" href="?active=<?php echo $value->id; ?>">Active</a>
                <?php } ?>
                <?php } ?>
              </td>
            </tr>
          <?php }} else { ?>
            <tr class="text-center">
              <td>No user available now!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



  <?php
  include 'inc/footer.php';

  ?>
