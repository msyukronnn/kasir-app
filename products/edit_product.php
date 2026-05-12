<?php 

require '..auth/checklogin.php';
require '../config/database.php';

$id = $_GET['id'];

$data = $conn->prepare("SELECT * FROM products WHERE id=?");
$data->execute([$id]);
$row = $data->fetch();

if(isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = $conn->prepare(
        "UPDATE products
        SET product_name=?, price=?, stock=?
        WHERE id=?"
    );

    $query->execute([$product_name, $price, $stock, $id]);

    header("Location: index.php");
}

?>

<?php include '../templates/header.php'; ?>

<h3>Edit Produk</h3>

<form method="POST">
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="product_name" value="<?= $row['product_name'] ?>">
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" class="form-control" name="price" value="<?= $row['price'] ?>">
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" class="form-control" name="stock" value="<?= $row['stock'] ?>">
    </div>
    <button type="submit" name="update" class="btn btn-primary">
        Update
    </button>
</form>

<?php include '../templates/footer.php'; ?>