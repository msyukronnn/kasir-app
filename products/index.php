<?php 

require '..auth/checklogin.php';
require '../config/database.php';

$data = $conn->query("SELECT * FROM products ORDER BY id DESSC");

?>

<?php include '../templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Produk</h2>
    <a href="add_product.php" class="btn btn-primary">
        Tambah Produk
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; while($row = $data->fetch()): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['product_name'] ?></td>
            <td>Rp <?= number_format($row['price']) ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                    Edit
                </a>
                <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>