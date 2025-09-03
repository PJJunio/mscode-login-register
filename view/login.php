<?php

include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

function checkPassword($conn, $email, $password)
{
    $sql = 'SELECT password FROM user WHERE email = :email';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $dbPassword = $stmt->fetchColumn();

    if ($dbPassword && $dbPassword === $password) {
        return true;
    }
    return false;
}

if (!empty($_POST)) {
    $email = $_POST['inputEmail'] ?? '';
    $password = $_POST['inputPassword'];

    if (empty($email) || empty($password)) {
        echo '<center><div class="alert alert-warning">Preencha todos os campos</div></center>';
        
    }else if (checkPassword($conn, $email, $password)) {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: ./test.php');
        exit;
    } else {
        echo '<center><div class="alert alert-warning">Credenciais inválidas</div></center>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 border border-3 rounded p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Digite seu email</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword">
                        <div id="emailHelp" class="form-text">Digite sua senha</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="./register.php" class="btn btn-primary">Criar uma conta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>