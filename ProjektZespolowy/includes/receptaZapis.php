

<?php

if (isset($_SESSION['lekarz'])) {
     require_once 'class/recepty.php';
     if (isset($_POST['submit'])) {


          require_once 'class/recepty.php';
          $userInfo = new authorization();
          $recepta = new recepty();
          $danePacjenta = $userInfo->_getUserInfo($_POST['pesel'], 'pacjenci');
          $daneLekarza = $userInfo->_getUserInfo($_SESSION['pesel'], 'lekarze');


          $danerecepty['pacjentID'] = $danePacjenta['pacjentID'];
          $danerecepty['dataRecepty'] = date("d-m-Y");
          $danerecepty['nazwaLeku'] = $_POST['nazwaLeku'];
          $danerecepty['dawka'] = $_POST['dawka'];
          $danerecepty['postac'] = $_POST['postac'];
          $danerecepty['ilosc'] = $_POST['ilosc'];
          $danerecepty['sposobDawkowania'] = $_POST['sposobDawkowania'];
          $danerecepty['nazwiskoLekarza'] = $daneLekarza['nazwisko'];



          $recepta->dodajRecepte($danerecepty);
     }
} else {
     echo '<div class="error">Nie masz uprawnien do tej strony</div>';
}
?>