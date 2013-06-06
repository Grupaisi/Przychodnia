<?php


     require_once '/class/pacjent.php';
     require_once '/class/validation.php';

     if (isSet($_POST['submit'])) {
          $userArray['pesel'] = $_POST['pesel'];
          $userArray['password'] = $_POST['password'];
          $userArray['password_conf'] = $_POST['password_conf'];
          $userArray['imie'] = $_POST['imie'];
          $userArray['drugie_imie'] = $_POST['drugie_imie'];
          $userArray['nazwisko'] = $_POST['nazwisko'];                
          $userArray['email'] = $_POST['email'];
          $userArray['nr_dowodu'] = $_POST['nr_dowodu'];
          $userArray['ulica'] = $_POST['ulica'];
          $userArray['nr_domu'] = $_POST['nr_domu'];
          $userArray['nr_mieszkania'] = $_POST['nr_mieszkania'];
          $userArray['kod_pocztowy'] = $_POST['kod_pocztowy'];
          $userArray['miasto'] = $_POST['miasto'];
          $userArray['tel_kom'] = $_POST['tel_kom'];
          $userArray['tel_dom'] = $_POST['tel_dom'];
          
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
