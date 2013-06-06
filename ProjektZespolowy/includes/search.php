<?php

if (isset($_SESSION['lekarz'])) {

     require_once 'forms/wyszukiwarka.php';




     if (isSet($_POST['search'])) {
          require_once 'class/search.php';
          $search_record = new search();
          $imie = $_POST['imie'];
          $nazwisko = $_POST['nazwisko'];
          $pesel = $_POST['pesel'];

          $dane = $search_record->wyszukuj($pesel, $imie, $nazwisko);



          $ilosc_rekordow = count($dane);
          echo '<table style="width:540px">';

          echo '<tr style="background-color:#dfdfdf;">';
          echo '<td style="padding-left:3px;">Imię</td>';
          echo '<td style="padding-left:3px;">Nazwisko</td>';
          echo '<td style="padding-left:3px;">Pesel</td>';
          echo '<td style="padding-left:3px;">Numer Ubezpieczenia</td>';
          echo '<td style="padding-left:3px;">Profil</td></tr>';

          for ($i = 0; $i < $ilosc_rekordow; $i++) {
               echo '<tr><td>' . $dane[$i]['imie'] . '</td>';
               echo '<td>' . $dane[$i]['nazwisko'] . '</td>';
               echo '<td>' . $dane[$i]['pesel'] . '</td>';
               echo '<td>' . $dane[$i]['nr_ubezpieczenia'] . '</td>';
               echo '<td><a href="index.php?id=pacjenci&pacjentid='.$dane[$i]['pacjentID'].'"><image src="images/profil.png"></a></td></tr>';
          }
          

          echo '</table>';
     }
} else {
     echo '<div class="error">'.$komunikaty[1];'</div>';
}
?>
