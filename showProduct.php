
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


if (isset($deactiveId)) {
  echo $deactiveId;
}


if (isset($activeId)) {
  echo $activeId;
}


 ?>
 <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
  $deleteProduct = $product->removeProduct($id_product);
  if ($deleteProduct) {
      echo '<div class="alert alert-success">Producto removido exitosamente</div>';
      // Redireccionar a la página principal o a una página de confirmación
      header('Location: index.php');
      exit;
  } else {
      echo '<div class="alert alert-danger">Error al quitar el producto</div>';
  }
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
    <h3><i class="fas fa-users mr-2"></i>Our products <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
      <?php
        $username = Session::get('username');
        if (isset($username)) {
          echo $username;
        }
        ?>

      </span>
    </strong>

</span></h3>
  </div>
<div class="card-body pr-2 pl-2">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width: 100%; max-width: 100%;">
        <thead>
          <tr>
            <th class="text-center">id_product</th>
            <th class="text-center">Name</th>
            <th class="text-center">price</th>
            <th class="text-center">Date</th>
            <th class="text-center">Category</th>
            <th class="text-center">Amount</th>
        
            <th class="text-center" width="25%">Action</th>
          </tr>
        </thead>
        <tbody>
          
<?php


$allProducts = $product->getAllProducts();
if ($allProducts) {
    $i = 0;
    foreach ($allProducts as $value) {
        $i++;
        ?>
        <tr class="text-center">
            <td><?php echo $value->id_product; ?></td>
            <td><?php echo $value->Name; ?></td>
            <td><?php echo $value->Price; ?></td>
            <td><?php echo $value->Date; ?></td>
            <td><?php echo $value->Category; ?></td>
            <td><?php echo $value->Amount; ?></td>
            <!-- Add more columns as needed -->
            <td>
                <?php if (Session::get("roleid") == '1') { ?>
                <!-- Actions for admin -->
                <a class="btn btn-info btn-sm" href="viewProduct.php?id=<?php echo $value->id_product; ?>">Modify</a>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr class="text-center">
        <td>No products available now!</td>
    </tr>
    <?php
}

?>
</tbody>
      </table>
    </div>
  </div>
</div>


<?php
  include 'inc/footer.php';

  ?>
