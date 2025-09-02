<?php
include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

function checkEmail($conn, $email) {
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $list = $stmt->fetchColumn();

        if ($list > 0) {
            return true;
        }
        return false;
}

if (!empty($_POST)) {
    $name = $_POST['inputName'] ?? '';
    $email = $_POST['inputEmail'] ?? '';
    $password = $_POST['inputPassword'] ?? '';

    if (checkEmail($conn, $email)) {
        echo "Email já existe, tente novamente";
        exit;
    }

    if (empty($name) || empty($email) || empty($password)) {
        echo "Preencha todos os campos!";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Sua senha deve ter no mínimo 8 caracteres!";
        exit;
    }

    if (checkEmail($conn, $email)) {
        echo "email já existe";
        exit;
    }

    $sql = 'INSERT INTO user (nome, email, password) VALUES (
    :name,
    :email,
    :password)';
    $stmt = $conn->prepare($sql);
    $stmt->execute(compact('name', 'email', 'password'));
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputName" name="inputName" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">Digite seu nome.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="inputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Digite seu email</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="InputPassword" name="inputPassword">
            <div id="passwordHelp" class="form-text">Sua senha precisa de no mínimo 8 caracteres</div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>