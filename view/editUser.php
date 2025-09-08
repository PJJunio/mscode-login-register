<?php

include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

session_start();

if (empty($_SESSION)) {
    header('Location: view/login.php');
    exit;
}

$userName = $_GET['userName'];

if (!empty($_POST)) {
    $newEmail = $_POST['newEmail'];

    if (strlen($_POST['newPassword']) < 8) {
        $newPassword = $_POST['newPassword'];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editUser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 border border-3 rounded p-4">
                <form method="POST" action="../action/editUser.php">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Usuário</label>
                        <textarea class="form-control bg-secondary opacity-50" id="userName" readonly
                            style="resize: none; height: 38px;"><?= $userName ?></textarea>
                    </div>
                    <input type="hidden" name="userName" value="<?= htmlspecialchars($userName) ?>">
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Novo email</label>
                        <input type="email" class="form-control" id="newEmail" name="newEmail"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="newCidade" class="form-label">Nova cidade</label>
                        <input type="text" class="form-control" id="newCidade" name="newCidade">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nova senha</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Editar</button>
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