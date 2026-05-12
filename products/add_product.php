<?php 

require '..auth/checklogin.php';
require '../config/database.php';

if(isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = $conn->prepare(
        "INSERT INTO products(product_name, price, stock)
        VALUES(?,?,?)"
    );

    $query->execute([$product_name, $price, $stock]);

    header("Location: index.php");
}

?>

<?php include '../templates/header.php'; ?>

<h3>Tambah Produk</h3>

<form method="POST">
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="product_name" required>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" class="form-control" name="price"required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" class="form-control" name="stock" required>
    </div>
    <button type="submit" name="submit" class="btn btn-success">
        Simpan
    </button>
</form>

<?php include '../templates/footer.php'; ?>