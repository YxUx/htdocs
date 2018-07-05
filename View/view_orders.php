<?php include_once '../Config/database.php'; ?>
<?php include_once '../Model/Pizza.php'; ?>
<?php include_once '../Model/Session.php'; ?>

<!-- Widok zamówień -->

<?php include_once "header.php"; ?>
<?php
$user = new Session($pdo);
if($user->checkRole() == 1) {       //widok dostępny nie jest dostępny dla "zwykłego" użytkownika
    header("Location: ../index.php"); //innaczej

 }
?>

<body>
<div id="site_content">
    <div id="content">
        <h2>ZAMÓWIENIA</h2>
    <p>Podaj datę w formacie rok/miesiąc/dzień</p>
    <form class="form_settings" action="../Controller/controller.php?method=view_orders" method=post>
        <input type="text" placeholder="Od" name="from" class="data" required />
        <input type="text" placeholder="Do" name="to" class="data" required />
        <input type="submit" class="submit" id="id1" value="SPRAWDŹ" />
    </form>
    <table border="2px">
    <?php
if(isset($_SESSION['view_orders'])) {
    foreach($_SESSION['view_orders'] as $row) {
        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['surname'] . "</td><td>" . $row['date'] . "</td>
        <td>" . $row['name_p'] . "</td><td>" . $row['size'] . "</td><td>" . $row['price_total'] . "</td></tr>";
    }
}
    ?>
    </table>
    </div>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>