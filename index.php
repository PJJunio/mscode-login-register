<?php
include_once __DIR__ . '/config/showErros.php';
include_once __DIR__ . '/config/dbConn.php';
require_once __DIR__ . '/database/Database.php';

session_start();

if (empty($_SESSION)) {
    header('Location: view/login.php');
    exit;
}
$userEmail = $_SESSION['email'];

function getUser($conn, $userEmail)
{
    $sql = 'SELECT nome FROM user WHERE email = :email';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $userEmail]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

getUser($conn, $userEmail); //é pra printar o nome do usuario ta tela, se vira kkkkk

function deleteUser($conn, $userEmail)
{
    try {
        $sql = 'DELETE FROM users WHERE email = :userEmail';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['userEmail' => $userEmail]);
    } catch (\Throwable $throwable) {
        $conn->rollBack();

        echo 'Ocorreu um erro ao excluir o aluno.'
            . PHP_EOL .
            'Erro: ' . $throwable->getMessage();
        exit;
    }
}

function teste(){
    echo "teste";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br>
    <a href="./action/logoff.php">Deslogar</a>
    <br>
    <!-- <button>Deletar conta</button> -->
</body>

</html>