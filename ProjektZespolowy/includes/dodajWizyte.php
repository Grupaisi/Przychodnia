<?php
if (isset($_SESSION['pacjent'])) {
     $dane = explode("|", $_GET['dane']);
     ?>


     <?php
     if (isset($_POST['submit']) && (!empty($_POST['temat']))) {

          require_once 'class/wizyty.php';
          $userInfo = new authorization();

          $danePacjenta = $userInfo->_getUserInfo($_SESSION['pesel'], 'pacjenci');


          $daneWizyty['pacjentID'] = $danePacjenta['pacjentID'];
          $daneWizyty['dataWizyty'] = $dane[0];
          $daneWizyty['godzinaWizyty'] = $dane[3];
          $daneWizyty['nazwiskoLekarza'] = $dane[1];
          $daneWizyty['specjalizacja'] = $dane[2];
          $daneWizyty['tematWizyty'] = $_POST['temat'];


          $wizyta = new wizyty();
          $wizyta->dodajWizyte($daneWizyty);
     } elseif (isset($_POST['submit']) && (empty($_POST['temat']))) {
          echo '<div class="error">Nie podałeś powodu wizyty.</div>';
          require_once 'forms/dodajWizyte.php';
     } else {
          require_once 'forms/dodajWizyte.php';
     }
} else {
     echo '<div class="error">Nie masz uprawnien do tej strony</div>';
}
?>
