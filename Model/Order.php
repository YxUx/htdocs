<?php
session_start();

class Order
{
    private $conn;
    private $price;

    public function __construct(\PDO $pdo) {            //konstruktor nawiązuje połączenie z bazą danych
        $this->conn = $pdo;
    }

     function addItem() {                               //dodawanie nowego produktu do koszyka i wyliczenie ceny
        if(empty($_SESSION['shoppingcart']))  {         //na podstawie wartości składników i wybranego rozmiaru pizzy
            $_SESSION['shoppingcart'] = array();
        }

            $pizza = $_POST['pizzaName'];
            $size = $_POST['size'];

            $stmt = $this->conn->query("SELECT * FROM pizzatoppings WHERE name_p='$pizza';");
            $item = $stmt->fetchAll();

            foreach($item as $row) {
              $this->price += $row['price_t'];
            }
            $this->price *= 0.2 * $size;
            array_push($_SESSION['shoppingcart'], ['name' => $item[0]['name_p'], 'price' => $this->price, 'size' => $size]);

        }

         function removeItem($row) {                    //usuwanie produktu z koszyka
            unset($_SESSION['shoppingcart'][$row]);
            sort($_SESSION['shoppingcart']);
            header("Location: ../View/Cart.php");
        }
         function order($payment) {                     //realizacja zamówienia: pobranie dodatkowych danych i
            echo $payment, $_SESSION['id_user'];        //identyfikatorów z bazy i przekazanie do tabel zamówień

                $this->conn->beginTransaction();

               try {
                    $order = $this->conn->prepare("INSERT INTO `orders` (`price_total`, `id_user`) VALUES (?, ?)");
                    $order->execute(array($payment, $_SESSION['id_user']));
                    $orderID = $this->conn->lastInsertId();

                    foreach ($_SESSION['shoppingcart'] as $row) {
                        $sizeID = $row['size'];
                        $temp= $this->conn->query("SELECT `id_size` FROM `sizes` WHERE `size`=$sizeID;");
                            $sizeID = $temp->fetch();
                        $pizzaID = $row['name'];
                        $temp = $this->conn->query("SELECT `id_pizza` FROM `pizza_name` WHERE `name_p`='$pizzaID';");
                            $pizzaID = $temp->fetch();
                        $order_details = $this->conn->prepare("INSERT INTO `order_details` (`id_pizza`, `id_size`) VALUES (?, ?)");
                        $order_details->execute(array($pizzaID['id_pizza'], $sizeID['id_size']));
                        $detailsID = $this->conn->lastInsertId();
                        $order_items = $this->conn->prepare("INSERT INTO `order_items` (`id_order`, `id_order_details`) VALUES (?, ?)");
                        $order_items->execute(array($orderID, $detailsID));
                    }

                    $this->conn->commit();

                } catch (Exception $e) {
                    $this->conn->rollBack();
                    echo "Failed: " . $e->getMessage();
                }
        }

        function view_orders($from, $to) {
            $_SESSION['view_orders'] = $this->conn->query("SELECT * FROM ViewOrders WHERE (`date` > '$from' AND `date` < '$to')")->fetchAll();
        }



}