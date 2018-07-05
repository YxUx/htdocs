<?php include_once '../Config/database.php'; ?>
<?php include_once '../Model/Pizza.php'; ?>
<?php include_once '../Model/Session.php'; ?>

<!-- widok koszyka: daje możliwość podglądu/usuwania produktów z zamówienia-->

<?php include_once "header.php"; ?>


<body>
<div id="site_content">
    <div id="content">
    <h2>ZAMÓWIENIE</h2>
    <table>
        <tr><th>Nazwa pizzy</th><th>Cena</th><th>Rozmiar</th><th></th></tr>


<?php
        if(isset($_SESSION['id_user'])) {
            if(isset($_SESSION['shoppingcart'])) {              //widok dostępny tylko dla zalogowanych użytkowników
                $s = $_SESSION['shoppingcart'];
                $price = 0;
                for ($row = 0; $row < count($s); ++$row) {
                    echo "<tr><td>" . $s[$row]['name'] . "</td><td>" . $s[$row]['price'] . "</td><td>" . $s[$row]['size'] . "</td>
              <td><input type='button' class='submit' value='USUN' onclick=\"location.href='../Controller/controller.php?method=removeItem&id=$row';\"/></td></tr>";
                    $price += $s[$row]['price'];
                }

                echo "</table><p>Do zapłaty: " . $price . "  <input type='button' class='submit' value='ZAMÓW' onclick=\"location.href='../Controller/controller.php?method=order&payment=$price';\"/></p>";
            }}else {
            echo "Koszyk jest pusty; aby coś dodać zamówienie, zaloguj się";
        }
?>
</div>
</div>
    <?php include_once "footer.php"; ?>
</body>
</html>
