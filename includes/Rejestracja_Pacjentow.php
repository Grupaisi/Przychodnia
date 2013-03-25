<?php


     require_once '/class/pacjent.php';
     require_once '/class/database.php';
     require_once '/class/validation.php';

     if (isSet($_POST['submit'])) {
          $userArray['imie'] = $_POST['imie'];
          $userArray['nazwisko'] = $_POST['nazwisko'];
          $userArray['pesel'] = $_POST['pesel'];
          $userArray['password'] = $_POST['password'];
          $userArray['password_conf'] = $_POST['password_conf'];
          $userArray['email'] = $_POST['email'];
          $userArray['nr_dowodu'] = $_POST['nr_dowodu'];
          $userArray['ulica'] = $_POST['ulica'];
          $userArray['nr_domu'] = $_POST['nr_domu'];
          $userArray['nr_mieszkania'] = $_POST['nr_mieszkania'];
          $userArray['kod_pocztowy'] = $_POST['kod_pocztowy'];
          $userArray['nr_tel'] = $_POST['nr_tel'];
          $userArray['nr_ubezpieczenia'] = $_POST['nr_ubezpieczenia'];




          $db = new database();
          $walidacja = new Validation($userArray, 'pacjenci', $db->connect());

          if ($walidacja->Validacja()) {
               $user = new pacjent($userArray);
               $user->add($db->connect(), 'pacjenci', 'nr_ubezpieczenia');
          } else {
               $walidacja->FormPacjenci();
          }
     } else {
          header("Location: index.php?id=RejestracjaPacjentow");
     }

?>
