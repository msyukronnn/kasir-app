<?php 

require '..auth/checklogin.php';

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$pay_amount = $_POST['pay_amount'];

$product = $conn->prepare("SELECT * FROM products WHERE id=?");
$product->execute([$product_id]);
$p = $product->fetch();

$subtotal = $p['price'] * $quantity;
$change_amount = $pay_amount - $subtotal;

$conn->prepare(
    "INSERT INTO transactions(total, pay_amount, change_amount) VALUES (?, ?, ?)"
)->execute([$subtotal, $pay_amount, $change_amount]);

$transaction_id = $conn->lastInsertId();

$conn->prepare(
    "INSERT INTO transaction_details(transaction_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)"
)->execute([$transaction_id, $product_id, $quantity, $subtotal]);

$newStock = $p['stock'] - $quantity;
$conn->prepare(
    "UPDATE products SET stock=? WHERE id=?"
    )->execute([$newStock, $product_id]);

    header("Location: receipt_transaction.php?id=" . $transaction_id);

?>