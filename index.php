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

function listUsers($conn, $userEmail)
{
    $sql = 'SELECT id,nome,email,cidade FROM user WHERE email != :email ORDER BY id';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $userEmail]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

$userData = getUser($conn, $userEmail);

echo "<h1 class='mx-2'>Seja bem vindo " . $userData['nome'] . "!</h1><hr>";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">CRUD Database</h1>
                <hr>
                <div class="d-flex mt-4 my-3">
                    <button class="btn btn-success text-white">Adicionar</button>
                    <a href="/action/logoff.php" class="btn btn-success text-white ms-2">Sair da conta</a>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">Acao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach (listUsers($conn, $userEmail) as $user) {
                                        echo "<tr class='bg-light'>";
                                        echo "<td>" . $user['id'] . "</td>";
                                        echo "<td>" . $user['nome'] . "</td>";
                                        echo "<td>" . $user['email'] . "</td>";
                                        echo "<td>" . $user['cidade'] . "</td>";
                                        echo "<td>
                                                <a href='/view/editUser.php?userName=" . $user['nome'] . "' class='btn btn-warning btn-sm text-dark me-1'>Edit</a>
                                                <a href='/action/deleteUser.php?id=" . $user['id'] . "' class='btn btn-danger btn-sm'>Del</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>