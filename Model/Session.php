<?php
class Session
{
    private $conn;

    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

     function login() {                 //metoda logowania i utworzenie sesji
        try {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $stmt = $this->conn->prepare("SELECT id_user FROM user WHERE email=? AND password=?");
            $stmt->execute(array($email, sha1($password)));
            $count = $stmt->rowCount();
            echo $count;
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if ($count) {
                $_SESSION['id_user'] = $data->id_user;
                setcookie('email', $email, time() + 1*24*60*60, '/');
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }

     function logout() {            //wylogowanie poprzez usunięcie sesji
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie('email', '', time() - 1*24*60*60);
    }

     function checkRole() {         //sprawdzenie roli (uprawnień) użytkownika na podstawie ID
        $s = $_SESSION['id_user'];
        if(isset($s)) {
            $stmt = $this->conn->query("SELECT checkRole($s)")->fetch();
            foreach($stmt as $row)
                return $row;
        }else {
            echo "Uzytkownik nie jest zalogowany";
        }

    }


}
