<?php
include_once '../Model/Session.php';
include_once '../Config/database.php';
include_once '../Model/User.php';

session_start();
if(isset($_SESSION['id_user'])) {                       //czy użytkownik jest zalogowany
    $id=$_SESSION['id_user'];
    $user = new User($pdo);
    $list = $user->getUser($id);
    $user = new Session($pdo);}?>
<!DOCTYPE html>
<html lang="pl">
<meta charset="UTF-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../Resources/css/style.css" rel="stylesheet">
    <title>Pizzeria</title>
</head>
<body>
<div id="header">
    <div id="menubar">
        <ul id="menu">
            <li><a href="../View/home.php">Home</a></li>
            <li><a href="../View/register.php">Rejestracja</a></li>
            <li><a href="../View/login.php">Logowanie</a></li>
            <li><a href="../View/pizzaList.php">Zamów pizzę</a></li>
            <li><a href="../View/cart.php">Koszyk</a></li>
<?php  if(isset($_SESSION['id_user'])) {
            if($user->checkRole() == 2) {                       //zakładki widoczna tylko dla administracji
                echo "<li><a href='../View/manage.php'>Zarządzanie</a></li>
                <li><a href='../View/view_orders.php'>Zamówienia</a></li>
                <li><a href='../View/users.php'>Użytkownicy</a></li>";
            }
        echo "<div id='logout'><form action='../Controller/controller.php?method=logout' method='post'>";
                foreach ($list as $row) {
                    echo "<p>Zalogowano jako użytkownik: ".$row['name'] . " " . $row['surname']; }
                echo "<br/><input type='submit' class='submit' value='WYLOGUJ' /></p>
           </form></div>"; }?>
            </div>
        </ul>
    </div>
</body>
</html>