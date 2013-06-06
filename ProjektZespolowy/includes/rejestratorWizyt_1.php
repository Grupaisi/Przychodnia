<?php

if (isset($_SESSION['pacjent'])) {


     if (isset($_POST['szukajDaty'])) {

          if (!empty($_POST['dataWizyty']) && !empty($_POST['nazwiskoLekarza'])) {
               if ($_POST['dataWizyty'] >= date("Y-m-d")){
               require_once 'forms/rejestracjaWizyt.php';
               require_once 'class/wizyty.php';
               $wizyty = new wizyty();
               $godziny = array('08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30');

               $date = explode("-", $_POST['dataWizyty']);
               $data = $date[2] . '-' . $date[1] . '-' . $date[0];
               $nazwisko = explode(' ',$_POST['nazwiskoLekarza']);
               $nazwiskoLekarza = $nazwisko[1];
               $specjalizacja = $_POST['specjalizacje'];

               $dane = $data . '|' . $nazwiskoLekarza . '|' . $specjalizacja;


               echo '<div class="naglowki">Terminy wizyt w dniu ' . $data . '. Nazwisko specjalisty: ' . $_POST['nazwiskoLekarza'] . '</div>';
               ?>
               <table style="width:400px; background-color:#f0f0f0;" cellspacing="0">  
                    <?php

                    foreach ($godziny as $value) {

                         if (!$wizyty->sprawdzTermin($data, $value, $nazwiskoLekarza)) {
                              echo '<tr  class="termin_zajety">';
                              echo '<td class="term_zajety">' . $value . '</td>';
                              echo '<td class="term_zajety">Zajęte</td>';
                              echo '<td class="term_zajety"></td>';
                         } else {
                              echo '<tr>';
                              echo '<td class="term_wolny">' . $value . '</td>';
                              echo '<td class="term_wolny">Wolne</td>';
                              echo '<td class="term_wolny">
                         <a href="index.php?id=dodajWizyte&dane=' . $dane . '|' . $value . '">                         
                         <img src="images/rezerwuj.png" alt=""></td></a>';
                         }
                         echo '</tr>';
                    }
                    echo' </table>';
               }
               else
               {
                    echo '<div class="error">Data nie może być przeszła</div>';
                    require_once 'forms/rejestracjaWizyt.php';
               }
               } else {
                    echo '<div class="error">Wszystkie pola muszą być wypełnione</div>';
                    require_once 'forms/rejestracjaWizyt.php';
               }
          } else {
               require_once 'forms/rejestracjaWizyt.php';
          }
     } else {
          echo '<div class="error">Nie masz uprawnien do tej strony</div>';
     }
     ?>
