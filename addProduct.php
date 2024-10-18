<?php
include 'inc/header.php';
require_once 'classes/Product.php';
$product = new Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_product = $_POST['id_product'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $date = $_POST['date'];
  $category = $_POST['category'];
  $amount = $_POST['amount'];

  if ($product->addNewProduct($id_product, $name, $price, $date, $category, $amount)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false]);
  }
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
<h3 class='text-center'>Add Product</h3>

</div>




<div class="card-body">
<div style="width:600px; margin:0px auto">


<form class="" action="" method="post">

<div class="form-group pt-3"> 

<label for="id_product">ID del producto:</label>
<input type="text" id="id_product" name="id_product"  class="form-control" required>
</div>

<div class="form-group">
<label for="name">Nombre:</label>
<input type="text" id="name" name="name" class="form-control " required>
</div>
<div class="form-group">
<label for="price">Precio:</label>
<input type="text" id="price" name="price" class="form-control" required>
 
</div>
<div class="form-group">
<label for="date">Fecha:</label>
    <input type="date" id="date" name="date" class="form-control"  required>
</div>
<div class="form-group">
<label for="category">Categoría:</label>
<input type="text" id="category" name="category" class="form-control"required>

</div>
<div class="form-group">
  <div class="form-group">
  <label for="amount">Cantidad:</label>
  <input type="number" id="amount" name="amount" class="form-control" required><br><br>
  </div>
</div>
<div class="form-group">
  <button type="submit" name="addProduct" class="btn btn-success" >Añadir producto</button>
  <button type="reset" class="btn btn-danger">Resetear</button>
</div>


</form>

 





 
</div>

  

</div>
</div>


    <script>
      function addProduct() {
    const form = document.getElementById('productForm');
    const formData = new FormData(form);

    fetch('addProduct.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Se envió el formulario correctamente");
        if (data.success) {
            alert('Producto añadido exitosamente');
        } else {
            alert('Error al añadir el producto');
        }
    })
    .catch(error => console.error('Error:', error));
}
document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const form = document.getElementById('productForm');
    const formData = new FormData(form);

    fetch('addProduct.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Se envió el formulario correctamente");
        if (data.success) {
            alert('Producto añadido exitosamente');
        } else {
            alert('Error al añadir el producto');
        }
    })
    .catch(error => console.error('Error:', error));
});

    </script>





<br><br>
<?php
  include 'inc/footer.php';

  ?>

