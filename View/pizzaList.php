<?php include_once '../Config/database.php'; ?>
<?php include_once '../Model/Pizza.php'; ?>

<!-- zestawienie produktów (pizze) i możliwość dodania ich do koszyka (po jednym z uwzględnieniem zadanego rozmiaru-->

<?php include_once "header.php"; ?>

<body>
<div id="site_content">
    <div id="content">
    <h2>PIZZE</h2>
    <form class="form_settings" action="../Controller/controller.php?method=addItem" method=post>
                <?php
                echo "<table>";
                $pizza = new Pizza($pdo);
                $array = $pizza->showPizzas();
                $array2 = $pizza->toppingsSelection()->fetchAll();

                $keys = array_keys($array2);
                $k_ammount = count($keys);
                $array3 = $pizza->showSizes();
                foreach ($array as $row) {          //tworzenie tabeli z produktami i dodatkowymi informacjami (składniki)
                    echo "<tr><td><input type='radio' class='radio' name='pizzaName' value=" . $row['name_p'] . "></td><td>" . $row['name_p'] . "</td><td>";
                   for($i=0; $i < $k_ammount; ++$i){
                        if($row['name_p'] == $array2[$i]['name_p'])
                            echo $array2[$i]['name_t'] . ", ";
                    }
                    $i=0;

                    echo "</td>";
                }
                echo "</table>";

                echo "<br/><p>Wybierz rozmiar: </p><select name='size'>";
                foreach ($array3 as $row3) {
                    echo "<option value= " .$row3['size']. ">" .$row3['size']. "<option>";
                }
                echo "</select>   <input type='submit' class='submit' value='ZAMÓW' />";
                ?>
    </form>
    </div>
</div>
    <?php include_once "footer.php"; ?>
</body>
</html>
