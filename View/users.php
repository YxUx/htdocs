<?php include_once '../Config/database.php'; ?>
<?php include_once '../Model/User.php'; ?>
<?php include_once '../View/header.php'; ?>

<?php include_once "header.php"; ?>
<?php
$user = new Session($pdo);
if($user->checkRole() == 1) {       //widok dostępny nie jest dostępny dla "zwykłego" użytkownika
    echo "<script>alert('Strona dostępna tylko dla administratorów'); window.location = 'home.php';</script>";
}
?>

<!-- Widok pokazuje wszystkich zarejestrowanych użytkowników -->

<body>
<div id="site_content">
    <div id="content">
        <table>
        <thead>
        <tr>
        <th>#</th>
        <th>EMAIL</th>
        <th>PASSWORD</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $user = new User($pdo);
        $list = $user->getUsers();
        foreach ($list as $row) {
            echo '<tr><td>' . $row['id_user'] . '</td><td>' . $row['email'] . '</td><td>' . $row['password'] . '</td><tr>';
        }?>
    </tbody>
    </table>
    </div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>