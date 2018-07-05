<?php include_once '../Config/database.php'; ?>
<?php include_once '../Model/Pizza.php'; ?>
<?php include_once '../Model/Session.php'; ?>

<!-- Dodawanie nowego składniku do bazy lub jego aktualizacja (ceny) -->

<?php include_once "header.php"; ?>
<?php
$user = new Session($pdo);
if($user->checkRole() == 1) {       //widok dostępny nie jest dostępny dla "zwykłego" użytkownika
    echo "<script>alert('Strona dostępna tylko dla administratorów'); window.location = 'home.php';</script>";
 }
?>

<body>
<div id="site_content">
    <div id="content">
    <h2>DODAJ SKŁADNIK</h2>

    <form class="form_settings" action="../Controller/controller.php?method=addTopping" method=post>
        <input type="text" placeholder="nazwa" name="name" class="data" required autofocus />
        <input type="text" placeholder="cena" name="price" class="data" required autofocus />

        <input type="submit" class="submit" value="DODAJ SKŁADNIK" />
    </form>

    <h2>POPRAW SKŁADNIK</h2>
    <form class="form_settings" action="../Controller/controller.php?method=updateTopping" method=post>
        <select name="topping">
                <?php
                $pizza = new Pizza($pdo);
                $list = $pizza->showToppings();
                foreach ($list as $row) {
                    echo '<option value=' . $row['name_t'] . '>' . $row['name_t'] . '</option>';
                }
                ?>
        </select>
        <input type="text" placeholder="Cena" name="price_t" class="data" required autofocus />

        <input type="submit" class="submit" value="AKTUALIZUJ" />
    </form>

    <h2>DODAJ PIZZĘ</h2>
    <form class="form_settings" action="../Controller/controller.php?method=addPizza" method=post>
        <input type="text" name="pizzaName"/>
            <?php
            $pizza = new Pizza($pdo);
            $list = $pizza->showToppings();
            foreach ($list as $row) {
                echo "<input type='checkbox' name='toppings[]' value=" . $row['name_t'] . ">" . $row['name_t'];
            }
            ?>
        <input type="submit" class="submit" value="DODAJ PIZZĘ" />
    </form>
    <?php include_once "footer.php"; ?>
</div>
</body>
</html>