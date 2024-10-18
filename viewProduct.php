<?php
// Inicia el buffer de salida para evitar problemas con la redirección

ob_start();
include 'inc/header.php';
require_once 'classes/Product.php';
$product = new Product();

if (isset($_GET['id'])) {
    $id_product = (int) preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateProduct = $product->updateProduct($id_product, $_POST);
    if ($updateProduct) {
        // Redirige después de actualizar el producto
        header('Location: http://localhost/Admin_Panel_Management_PHP_MYSQL-master/showProduct.php');
        exit();  // Finaliza el script después de la redirección
    } else {
        echo '<div class="alert alert-danger">Error al actualizar el producto</div>';
        ob_flush(); // Envía la salida si hay un error
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteProduct = $product->removeProduct($id_product);
    if ($deleteProduct) {
        // Redirige después de eliminar el producto
        header('Location: http://localhost/Admin_Panel_Management_PHP_MYSQL-master/showProduct.php');
        exit();  // Finaliza el script después de la redirección
    } else {
        echo '<div class="alert alert-danger">Error al eliminar el producto</div>';
        ob_flush(); // Envía la salida si hay un error
    }
}

$getproductInfo = $product->getProductById($id_product);
?>

<div class="card" style="width: 60%; margin: 0 auto; margin-top: 0%; min-height: 700px; font-size: 14px;"> <!-- Ajusta la altura mínima -->
    <div class="card-header text-center">
        <h3 style="font-size: 18px;">View Product</h3> <!-- Tamaño de la letra más pequeño -->
    </div>
    <div class="card-body">
        <?php if ($getproductInfo) { ?>
            <div style="width:100%; margin:0px auto;">
                <form action="" method="POST">
                    <div class="form-group pt-3">
                        <label for="id_product">ID del producto:</label>
                        <input type="text" value="<?php echo $getproductInfo->id_product; ?>" name="id_product" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" value="<?php echo $getproductInfo->Name; ?>" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="text" id="price" name="price" value="<?php echo $getproductInfo->Price; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha:</label>
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly required> <!-- Fecha de hoy -->
                    </div>
                    <div class="form-group">
                        <label for="category">Categoría:</label>
                        <input type="text" id="category" value="<?php echo $getproductInfo->Category; ?>" name="category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Cantidad:</label>
                        <input type="number" id="amount" name="amount" value="<?php echo $getproductInfo->Amount; ?>" class="form-control" required>
                    </div>
                    
                    <!-- Botones de actualizar y eliminar -->
                    <div class="form-group text-center">
                        <button type="submit" name="update" class="btn btn-success" style="font-size: 14px;">Update</button>
                        <button type="submit" name="delete" class="btn btn-danger" style="font-size: 14px;">Remove</button>
                    </div>
                    
                    <!-- Botón de regreso -->
                    <div class="form-group text-center">
                        <a href="showProduct.php" class="btn btn-primary" style="font-size: 14px;">Back</a>
                    </div>

                </form>
            </div>
        <?php } else { ?>
            <div class="form-group text-center">
                <a class="btn btn-primary" href="index.php" style="font-size: 14px;">Ok</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php
// Finaliza y vacía el buffer de salida
ob_end_flush();
?>
</div>
