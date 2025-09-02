<?php

include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

function checkPassword($conn, $email, $password) {
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
        echo "Preencha todos os campos";
        exit;
       }

    if (checkPassword($conn, $email, $password)) {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: ../views/test.php');
        exit;
    } else {
        echo "Email ou senha incorretos";
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
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Digite seu email</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            <div id="emailHelp" class="form-text">Digite sua senha</div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>