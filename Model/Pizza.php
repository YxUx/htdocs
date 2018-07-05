<?php
class Pizza
{
    private $conn;

    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    function addTopping() {         //metoda dodająca nowe składniki do zamówienia
        $name = $_POST["name"];
        $price = $_POST["price"];

        try {
            $stmt = $this->conn->prepare("INSERT INTO `toppings` (`name_t`, `price_t`)
          VALUES (?, ?)");
            $stmt->execute(array($name, $price));
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    function updateTopping() {      //metoda aktualizująca wartości składników (ceny)
        $topping = $_POST["topping"];
        $price = $_POST["price_t"];
        try {
            $stmt = $this->conn->prepare("UPDATE `toppings` 
          SET `price_t` = ? WHERE `name_t` = ?");
            $stmt->execute(array($price, $topping));
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    function addPizza() {
        $pizzaName = $_POST['pizzaName'];
        $toppings = $_POST['toppings'];
        $toppings_id = array();
        $stmt = $this->conn->query("SELECT t.name_t, t.id_topping FROM toppings t")->fetchAll();

        for ($i=0;$i<count($toppings);++$i) {

            foreach ($stmt as $row2) {
                if ($toppings[$i] === $row2['name_t']) {
                    $toppings_id[$i] = array('name' => $toppings[$i], 'id' => $row2['id_topping']);
                }
            }
        }

        $this->conn->beginTransaction();
        try {
            $stmt_t = $this->conn->prepare("INSERT INTO `pizza_name` (`name_p`) VALUES (?)");
            $stmt_t->execute(array($pizzaName));
            $pizzaID = $this->conn->lastInsertId();

            foreach ($toppings_id as $row) {
                $stmt2 = $this->conn->prepare("INSERT INTO `pizza` (`id_pizza`, `id_topping`)
                                                         VALUES (?, ?)");
                $stmt2->execute(array($pizzaID, $row['id']));
            }
            $this->conn->commit();
        }catch (Exception $e) {
            echo "NIE POWIODLO SIE";
            echo $e;
            $this->conn->rollBack();
        }
    }

    function showPizzas() {
        return $this->conn->query("SELECT name_p FROM pizza_name"); //view
    }

    function showSizes() {
        return $this->conn->query("SELECT size FROM sizes");
    }

    function showToppings() {
        return $this->conn->query("SELECT name_t FROM toppings");
    }

    function toppingsSelection() {
        return $this->conn->query("SELECT * FROM toppings_list"); //view
    }
}
?>


