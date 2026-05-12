<?php

session_start();
require '../config/database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $query->execute([$username, $password]);

    if ($query->rowCount() > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        header("Location: ../dashboard.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">LOGIN KASIR</h3>

                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST"> 
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="login">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>