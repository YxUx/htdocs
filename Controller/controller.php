<?php
include_once '../Config/database.php';
include_once '../Model/User.php';
include_once '../Model/Pizza.php';
include_once '../Model/Session.php';
include_once '../Model/Order.php';

//kontroler: przyjmuje poprzez GET nazwę metody do wywołania, wykonuje ją i dokonuje przekierować na określone widoki

      if (isset($_GET['method'])) {
          switch ($_GET['method']) {
              case "insertUser":                                    //tworzenie (rejestracja) nowego użytkownia
                  $user = new User($pdo);
                  $status = $user->insertUser();
                  if($status)
                      echo "<script>alert('Rejestracja nie powiodła się'); window.location = '../View/register.php';</script>";
                  else
                      echo "<script>alert('Rejestracja powiodła się, zostaniesz przekierowany na stronę logowania'); window.location = '../View/login.php';</script>";
                  break;
              case "addTopping":                                    //dodawnanie nowego składnika
                  $pizza = new Pizza($pdo);
                  $status = $pizza->addTopping();
                  if($status)
                      echo "<script>alert('Coś poszło nie tak...'); window.location = '../View/manage.php';</script>";
                  else
                      echo "<script>alert('Dodano nowy składnik'); window.location = '../View/manage.php';</script>";
                  break;
              case "updateTopping":                                 //aktualizacja składnika (ceny)
                  $pizza = new Pizza($pdo);
                  $status = $pizza->updateTopping();
                  if($status)
                      echo "<script>alert('Coś poszło nie tak...'); window.location = '../View/manage.php';</script>";
                  else
                      echo "<script>alert('Poprawiono dane składnika'); window.location = '../View/manage.php';</script>";
                  break;
              case "addPizza":                                    //dodawnanie nowego składnika
                  $pizza = new Pizza($pdo);
                  $status = $pizza->addPizza();
                  if($status)
                      echo "<script>alert('Coś poszło nie tak...'); window.location = '../View/manage.php';</script>";
                  else
                      echo "<script>alert('Dodano nową pizzę'); window.location = '../View/manage.php';</script>";
                  break;
              case "login":
                   $session = new Session($pdo);
                   $status = $session->login();
                   if(isset($_SESSION['id_user']))
                       echo "<script>alert('Jesteś już zalogowany'); window.location = '../View/home.php';</script>";
                   else if($status)
                       echo "<script>alert('Coś poszło nie tak...'); window.location = '../View/login.php';</script>";
                   else
                       echo "<script>alert('Zostałeś pomyślnie zalogowany'); window.location = '../View/home.php';</script>";
                  break;
              case "logout":
                  $session = new Session($pdo);
                  $session->logout();
                  echo "<script>alert('Zostałeś wylogowany'); window.location = '../View/home.php';</script>";
                  break;
              case "addItem":                                        //dodawanie nowego przedmiotu do zamówienia (koszyka)
                  if(isset($_SESSION['id_user'])) {
                      if(isset($_POST['pizzaName'])) {
                          $order = new Order($pdo);
                          $order->addItem();
                          echo "<script>alert('Dodano do koszyka'); window.location = '../View/pizzaList.php';</script>";
                      }else{
                          echo "<script>alert('Nie wybrano pizzy'); window.location = '../View/pizzaList.php';</script>";
                      }
                  }else{
                      echo "<script>alert('Nie jesteś zalogowany.'); window.location = '../View/login.php';</script>";
              }
                  break;
              case strpos($_GET['method'],"order"):          //realizacja zamówienia i przekazanie wyliczonego kosztu
                  $payment=$_GET['payment'];
                  if(isset($_SESSION['id_user'])) {
                      if (empty($_SESSION['shoppingcart'])) {
                          echo "<script>alert('Brak przedmiotów  w koszyku'); window.location = '../View/home.php';</script>";
                      } else {
                          $order = new Order($pdo);
                          $order->order($payment);
                          echo "<script>alert('Zamówienie zostało dokonane'); window.location = '../View/home.php';</script>";
                      }
                  }else {
                        echo "<script>alert('Nie jesteś zalogowany'); window.location = '../View/home.php';</script>";
                  }

                  break;
              case strpos($_GET['method'],"removeItem"):    //usuwanie elelemntu z zamówienia (koszyka)
                  $row=$_GET['id'];
                  $order = new Order($pdo);
                  $order->removeItem($row);
                  echo "<script>alert('Element został usunięty z koszyka'); window.location = '../View/cart.php';</script>";
                  break;
              case "view_orders":                                   //podgląd dokonanych przez użytkowników zamówień
                  $from=$_POST['from'];
                  $to=$_POST['to'];
                  $order = new Order($pdo);
                  $order->view_orders($from, $to);
                  header("Location: ../View/view_orders.php");
                  break;
          }
      }

?>