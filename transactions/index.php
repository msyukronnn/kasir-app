<?php 

require '..auth/checklogin.php';
require '../config/database.php';

$products = $conn->query("SELECT * FROM products");

?>

<?php include '../templates/header.php'; ?>

<h3>Transaksi Kasir</h3>

<form action="save_transaction.php" method="POST">

    <div class="mb-3">
        <label for="product">
            Pilih Produk
        </label>

        <select class="form-control" name="product_id" required>
            <option value="">-- Pilih Produk --</option>

            <?php while($p = $products->fetch()): ?>
                <option value="<?= $p['id'] ?>">
                    <?= $p['product_name'] ?>
                    - Rp <?= number_format($p['price']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" class="form-control" name="quantity" min="1" required>
    </div>
    <div class="mb-3">
        <label>Bayar</label>
        <input type="number" class="form-control" name="payment" min="1" required>
    </div>
    <button type="submit" class="btn btn-success">
        Simpan Transaksi
    </button>
</form>

<?php include '../templates/footer.php'; ?>

