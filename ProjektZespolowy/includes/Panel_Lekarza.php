<?php
require_once 'class/pacjentInfo.php';
require_once 'class/search.php';

$dzisiejszeWizyty = new search();

$auth = new authorization();
$_SESSION['intLastRefreshTime'] = time();

if (isset($_SESSION['lekarz'])) {

    
     $table = 'lekarze';

     $dane = $auth->_getUserInfo($_SESSION['pesel'], $table);

     echo 'Zalogowałeś się jako ' . $dane['imie'] . ' ' . $dane['nazwisko'] .
     '.<br /> Twój numer licencji to ' . $dane['nr_licencji'];
     ?>

     <div class="naglowki">Dzisiejsze wizyty pacjentów.</div>


     <?php
     $dzisiaj = date("d-m-Y");
     $wizyty = $dzisiejszeWizyty->getUserID($dzisiaj, $dane['nazwisko']);
     $danePacjenta = new pacjentInfo();
     $ilosc_rekordow = count($wizyty);
     ?>
     <table style="width:717px">
          <tr>
               <td class="user_info">Data Wizyty</td>
               <td class="user_info">Godzina</td>
               <td class="user_info">Nazwisko Pacjenta</td>
               <td class="user_info">Pesel Pacjenta</td>
               <td class="user_info">Temat Wizyty</td>
          </tr>
          <?php
          for ($i = 0; $i < $ilosc_rekordow; $i++) {
               $dane = $danePacjenta->getPacjents($wizyty[$i]['pacjentID']);
               if ($i % 2 == 0) {
                    ?>
                    <tr>
                    <?php } else { ?>
                    <tr style="background-color:#e7e7e7;">
                    <?php } ?>
                    <td><?php echo $wizyty[$i]['dataWizyty'] ?></td>
                    <td><?php echo $wizyty[$i]['godzinaWizyty'] ?></td>
                    <td><?php echo $dane[$i]['nazwisko'] ?></td>
                    <td><?php echo $dane[$i]['pesel'] ?></td>
                    <td><?php echo $wizyty[$i]['tematWizyty'] ?></td>                    
               </tr>
          <?php } ?>


     </table>









     <div id = "naglowki_password">Zmień Hasło (zwiń).</div>
     <div class = "content-password">
          <?php
          if (isSet($_POST['change'])) {
               require_once '/class/changePassword.php';
               $change = new changePassword();
               $oldPassword = $_POST['oldPassword'];
               $newPassword = $_POST['newPassword'];
               $newPasswordConf = $_POST['newPasswordConf'];

               if ($change->checkChangePass($newPassword, $newPasswordConf)) {
                    $change->changePass($dane['pesel'], $table, $oldPassword, $newPassword);
               }
          } else {
               require_once 'forms/changePassword.php';
          }
          ?>
     </div>




     <script type="text/javascript">
          $("#naglowki_password").click(function(){
               $("div.content-password").slideToggle("slow");
          });
     </script>




     <?php

} else {
          echo '<div class="error">'.$komunikaty[1];'</div>';
     }
?>
