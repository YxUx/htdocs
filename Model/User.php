<?php
class User
{
    private $conn;

    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    function getUsers() {               //pobiera listę wszystkich zarejestrowanych użytkowników
        return $this->conn->query("SELECT * FROM user");
    }

    function getUser($id) {             //pobiera informacje tylko o użytkowniku o zadanym ID
        return $this->conn->query("SELECT u.id_user, a.name, a.surname FROM user u JOIN address a ON u.id_address=a.id_address WHERE id_user = $id;");
    }

    function insertUser()
    {             //rejestracja użytkownika w bazie
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $city = $_POST["city"];
        $zip = $_POST["zip"];
        $street = $_POST["street"];
        $house = $_POST["house"];
        $flat = $_POST["flat"];
        $phone = $_POST["phone"];


            $stmt = $this->conn->query("SELECT checkUser('$email')")->fetch(); //pobranie z funkcji informacji
            foreach ($stmt as $value){ if ($value === 0) {                              //if user exists

            if ($password === $password2) {
            $this->conn->beginTransaction();
            try {

                $stmt = $this->conn->prepare("INSERT INTO `address` (`name`, `surname`, `city`, `zip`, `street`, `house`, `flat`, `phone`)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($name, $surname, $city, $zip, $street, $house, $flat, $phone));
                $id = $this->conn->lastInsertId();
                $stmt = $this->conn->prepare("INSERT INTO `user` (`email`, `password`, `id_address`, `id_role`)
          VALUES (?, ?, ?, ?)");
                $stmt->execute(array($email, sha1($password), $id, 1));

                $this->conn->commit();

//opcjonalnie można przekazać wartości do funkcji SQL = mniej kodu

            } catch (Exception $e) {
                $this->conn->rollBack();
                echo "Failed: " . $e->getMessage();
            }

         }else {
            echo "Incorrect password!";
            die();
            }
        } else {
            echo "COŚ NIE TAK"; } }
    }
}
?>


