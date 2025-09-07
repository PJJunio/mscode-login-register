<?php
include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

function checkEmail($conn, $email)
{
    $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $list = $stmt->fetchColumn();

    return $list > 0;
}

if (!empty($_POST)) {
    $name = $_POST['inputName'] ?? '';
    $email = $_POST['inputEmail'] ?? '';
    $cidade = $_POST['inputCidade'] ?? ';';
    $password = $_POST['inputPassword'] ?? '';

    if (empty($name) || empty($email) || empty($cidade) || empty($password)) {
        echo '<center><div class="alert alert-warning">Preencha todos os campos</div></center>';

    } else if (strlen($password) < 8) {
        echo '<center><div class="alert alert-warning">Sua senha deve ter no mínimo 8 caracteres!</div></center>';

    } else if (checkEmail($conn, $email)) {
        echo '<center><div class="alert alert-warning">Este email já existe</div></center>';
        
    } else {
        $sql = 'INSERT INTO user (nome, email, cidade, password) VALUES (
        :name,
        :email,
        :cidade,
        :password)';
        $stmt = $conn->prepare($sql);
        $stmt->execute(compact('name', 'email', 'cidade', 'password'));

        echo '<center><div class="alert alert-success">Usuário cadastrado com sucesso!</div></center>';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 border border-3 rounded p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="inputName" name="inputName"
                            aria-describedby="nameHelp">
                        <div id="nameHelp" class="form-text">Digite seu nome.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Endereço</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Digite seu email</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="inputCidade"
                            aria-describedby="cityHelp">
                        <div id="cityHelp" class="form-text">Digite sua cidade</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="InputPassword" name="inputPassword">
                        <div id="passwordHelp" class="form-text">Sua senha precisa de no mínimo 8 caracteres</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="./login.php" class="btn btn-primary">Fazer login</a>
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