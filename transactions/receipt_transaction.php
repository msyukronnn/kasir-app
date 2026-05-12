<?php

$id = $_GET['id'];

$query = $conn->prepare(
    "SELECT
        transactions.*,
        transaction_details.quantity,
        transaction_details.subtotal,
        products.product_name
        
    FROM transactions
    
    JOIN transaction_details
    ON transactions.id = transaction_details.transaction_id

    JOIN products
    ON products.id = transaction_details.product_id

    WHERE transactions.id=?"
);

$query->execute([$id]);
$data = $query->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial;
            width: 300px;
            margin: auto;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="center">
        <h3>TOKO KASIR</h3>
        <p>=====================</p>
    </div>

    <p>
        Tanggal: <?= $data['date'] ?>
    </p>

    <hr>

    <p>
        Produk: <?= $data['product_name'] ?>
    </p>

    <p>
        Subtotal: Rp <?= number_format($data['subtotal']) ?>
    </p>

    <hr>

    <p>
        Total: Rp <?= number_format($data['total']) ?>
    </p>

    <p>
        Bayar: Rp <?= number_format($data['pay_amount']) ?>
    </p>

    <p>
        Kembalian: Rp <?= number_format($data['change']) ?>
    </p>

    <hr>

    <div class="center">
        <p>Terima Kasih</p>
    </div>
</body>

</html>