<?php 

require 'auth/checklogin.php';
require 'config/database.php';

$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalTransactions = $conn->query("SELECT COUNT(*) FROM transactions")->fetchColumn();

?>

<?php include 'templates/header.php'; ?>

<h2>Dashboard Kasir</h2>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4>Total Produk</h4>
                <h2><?= $totalProducts; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h4>Total Transaksi</h4>
                <h2><?= $totalTransactions; ?></h2>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>