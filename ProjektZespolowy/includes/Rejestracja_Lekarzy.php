<?php


     require_once '/class/lekarz.php';
     require_once '/class/database.php';
     require_once '/class/validation.php';

     if (isSet($_POST['submit'])) {
          $userArray['imie'] = $_POST['imie'];
          $userArray['nazwisko'] = $_POST['nazwisko'];
          $userArray['pesel'] = $_POST['pesel'];
          $userArray['password'] = $_POST['password'];
          $userArray['password_conf'] = $_POST['password_conf'];
          $userArray['drugie_imie'] = $_POST['drugie_imie'];
          $userArray['email'] = $_POST['email'];
          $userArray['nr_dowodu'] = $_POST['nr_dowodu'];
          $userArray['ulica'] = $_POST['ulica'];
          $userArray['nr_domu'] = $_POST['nr_domu'];
          $userArray['nr_mieszkania'] = $_POST['nr_mieszkania'];
          $userArray['kod_pocztowy'] = $_POST['kod_pocztowy'];
          $userArray['miasto'] = $_POST['miasto'];
          $userArray['tel_dom'] = $_POST['tel_dom'];
          $userArray['tel_kom'] = $_POST['tel_kom'];
          

          $userArray['nr_licencji'] = $_POST['nr_licencji'];
          $userArray['specjalizacja'] = $_POST['specjalizacja'];




          $db = new database();
          $walidacja = new Validation($userArray, 'lekarze');

          if ($walidacja->Validacja() && $walidacja->checkNrLicencji($userArray['nr_licencji'])) {
               $user = new lekarz($userArray);
               $user->add($db->connect(), 'lekarze', 'nr_licencji', $userArray['specjalizacja']);
          } else {
               $walidacja->FormLekarze();
          }
     } else {
          header("Location: index.php?id=RejestracjaLekarzy");
     }

?>

