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
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

$userData = getUser($conn, $userEmail);

echo "<h1>Seja bem vindo " . $userData['nome'] . "!</h1>";

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
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
        </tbody>
    </table>
    <br>
    <a href="./action/logoff.php">Deslogar</a>
    <br>
    <a href="./action/deleteUser.php">Deletar Usuario</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>