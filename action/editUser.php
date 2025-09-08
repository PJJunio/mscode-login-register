<?php

include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

session_start();

if (empty($_SESSION)) {
    header('Location: ../view/login.php');
    exit;
}

if (!empty($_POST)) {
    $userName = $_POST['userName'];
    $newEmail = !empty($_POST['newEmail']) ? $_POST['newEmail'] : null;
    $newCidade = !empty($_POST['newCidade']) ? $_POST['newCidade'] : null;
    $newPassword = !empty($_POST['newPassword']) ? $_POST['newPassword'] : null;

    if (empty($newEmail) && empty($newPassword)) {
        header('Location: ../index.php');
        exit;
    }

    try {
        $updates = [];
        $params = ['nome' => $userName];

        if (!empty($newEmail)) {
            $updates[] = 'email = :email';
            $params['email'] = $newEmail;
        }
        if (!empty($newEmail)) {
            $updates[] = 'cidade = :cidade';
            $params['cidade'] = $newCidade;
        }

        if (!empty($newPassword) && strlen($newPassword) >= 8) {
            $updates[] = 'password = :password';
            $params['password'] = $newPassword;
        } else {
            echo '<center><div class="alert alert-warning">Sua senha deve ter no mínimo 8 caracteres!</div></center>';
            echo '<script>setTimeout(function() {window.location.href = document.referrer;}, 3000);</script>';
            exit;
        }

        if (count($updates) > 0) {
            $sql = "UPDATE user SET " . implode(', ', $updates) . " WHERE nome = :nome";
            $stmt = $conn->prepare($sql);

            $stmt->execute($params);
        }
        echo '<center><div class="alert alert-success">Usuário atualizado com sucesso!</div></center>';
        echo '<script>setTimeout(function() { window.location.href = "../index.php"; }, 3000);</script>';
        exit;

    } catch (\Throwable $throwable) {
        echo $throwable->getMessage();
    }
}
