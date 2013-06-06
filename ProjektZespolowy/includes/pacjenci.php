<?php
if (isset($_SESSION['lekarz'])) {
     require_once 'class/pacjentInfo.php';


     $pacjentID = $_GET['pacjentid'];
     if (isset($_GET['wizyta'])) {
          $pacjent = new pacjentInfo();
          $pacjent->odbytaWizyta($_GET['wizyta']);
          header("Location: index.php?id=pacjenci&pacjentid=$pacjentID");
     }


     $pacjent = new pacjentInfo();
     $dane = $pacjent->getPacjent($pacjentID);
     ?>        
     <a id="myHeader1-4" href="javascript:showonlyonev2('newboxes1-4');" ><image src="images/informacje_ogolne.png"></a>
     <a id="myHeader2-4" href="javascript:showonlyonev2('newboxes2-4');" ><image src="images/wizyty.png"></a>
     <a id="myHeader3-4" href="javascript:showonlyonev2('newboxes3-4');" ><image src="images/recepty.png"></a>
     <a id="myHeader4-4" href="javascript:showonlyonev2('newboxes4-4');" ><image src="images/historia_chorob.png"></a>



     <div class="newboxes-4" id="newboxes1-4" style=" display: block;">	
          <div class="naglowki">Ogólne informacje o pacjencie</div>

          <table style="width:400px; background-color:#f0f0f0;">    
               <tr ><td>Imię:               </td><td> <?php echo $dane['imie']; ?> </td></tr>
               <tr style="background-color: #dedddd;"><td>Nazwisko:           </td><td> <?php echo $dane['nazwisko']; ?></td></tr>
               <tr><td>Pesel:              </td><td> <?php echo $dane['pesel']; ?></td></tr>
               <tr style="background-color: #dedddd;"><td>Email:              </td><td> <?php echo $dane['email']; ?></td></tr>
               <tr><td>Numer dowodu:       </td><td> <?php echo $dane['nr_dowodu']; ?></td></tr>
               <tr style="background-color: #dedddd;"><td>Adres:              </td><td> <?php echo $dane['ulica']." ".$dane['nr_domu']."/".$dane['nr_mieszkania']." ". $dane['miasto']." ".$dane['kod_pocztowy']; ?></td></tr>
               <tr><td>Numer telefonu:     </td><td> <?php echo $dane['tel_kom']; ?></td></tr>
               <tr style="background-color: #dedddd;"><td>Numer ubezpieczenia:</td><td> <?php echo $dane['nr_ubezpieczenia']; ?></td></tr>
          </table>
     </div> 
     <div class="newboxes-4" id="newboxes2-4" style=" display: none;">

          <!-- *****************  Ostatnie Wizyty  *****************  -->

          <div class="naglowki">Ostatnie wizyty pacjenta w klinice</div>
          <?php
          $wizyty = $pacjent->wizytyPacjenta($pacjentID, TRUE);
          $ilosc_rekordow = count($wizyty);
          ?>
          <table style="width:717px">
               <tr>
                    <td class="user_info">Data Wizyty</td>
                    <td class="user_info">Godzina</td>
                    <td class="user_info">Nazwisko Lekarza</td>
                    <td class="user_info">Specjalizacja</td>
                    <td class="user_info">Temat Wizyty</td>
               </tr>
               <?php
               for ($i = 0; $i < $ilosc_rekordow; $i++) {
                    if ($i % 2 == 0) {
                         ?>
                         <tr>
                         <?php } else { ?>
                         <tr style="background-color:#e7e7e7;">
                         <?php } ?>
                         <td><?php echo $wizyty[$i]['dataWizyty'] ?></td>
                         <td><?php echo $wizyty[$i]['godzinaWizyty'] ?></td>
                         <td><?php echo $wizyty[$i]['nazwiskoLekarza'] ?></td>
                         <td><?php echo $wizyty[$i]['specjalizacja'] ?></td>
                         <td><?php echo $wizyty[$i]['tematWizyty'] ?></td>
                    </tr>
               <?php } ?>
          </table>

          <!-- *****************  Zaplanowane Wizyty  *****************  -->
          <div class="naglowki">Zaplanowane Wizyty</div>
          <?php
          $wizyty = $pacjent->wizytyPacjenta($pacjentID, FALSE);
          $ilosc_rekordow = count($wizyty);
          ?>
          <table style="width:717px">
               <tr>
                    <td class="user_info">Data Wizyty</td>
                    <td class="user_info">Godzina</td>
                    <td class="user_info">Nazwisko Lekarza</td>
                    <td class="user_info">Specjalizacja</td>
                    <td class="user_info">Temat Wizyty</td>
                    <td class="user_info">Odbyta</td>
               </tr>
               <?php
               for ($i = 0; $i < $ilosc_rekordow; $i++) {
                    if ($i % 2 == 0) {
                         ?>
                         <tr>
                         <?php } else { ?>
                         <tr style="background-color:#e7e7e7;">
                         <?php } ?>
                         <td><?php echo $wizyty[$i]['dataWizyty'] ?></td>
                         <td><?php echo $wizyty[$i]['godzinaWizyty'] ?></td>
                         <td><?php echo $wizyty[$i]['nazwiskoLekarza'] ?></td>
                         <td><?php echo $wizyty[$i]['specjalizacja'] ?></td>
                         <td><?php echo $wizyty[$i]['tematWizyty'] ?></td>
                         <td><a href="index.php?id=pacjenci&pacjentid=<?php echo $pacjentID . '&wizyta=' . $wizyty[$i]['wizytaID']; ?>"><image src="images/zatwierdz.png"></a></td>
                    </tr>
               <?php } ?>
          </table>
     </div>

     <!-- *****************  Wykaz RECEPT  *****************  -->
     <div class="newboxes-4" id="newboxes3-4" style=" display: none;">	
          <div class="naglowki">Wykaz recept pacjenta.</div>

          <?php
          require_once 'class/recepty.php';
          $recepta = new recepty();
          $recepty = $recepta->getRecepty($dane['pacjentID']);
          $ilosc_rekordow = count($recepty);
          ?>
          <table style="width:717px">
               <tr>
                    <td class="user_info">DataRecepty</td>
                    <td class="user_info">Nazwa Leku</td>
                    <td class="user_info">Dawka</td>
                    <td class="user_info">Postać</td>
                    <td class="user_info">Ilość</td>
                    <td class="user_info">Sposób Dawkowania</td>
                    <td class="user_info">Nazwisko Lekarza</td>
               </tr>
               <?php
               for ($i = 0; $i < $ilosc_rekordow; $i++) {
                    if ($i % 2 == 0) {
                         ?>
                         <tr>
                         <?php } else { ?>
                         <tr style="background-color:#e7e7e7;">
                         <?php } ?>
                         <td><?php echo $recepty[$i]['dataRecepty'] ?></td>
                         <td><?php echo $recepty[$i]['nazwaLeku'] ?></td>
                         <td><?php echo $recepty[$i]['dawka'] ?></td>
                         <td><?php echo $recepty[$i]['postac'] ?></td>
                         <td><?php echo $recepty[$i]['ilosc'] ?></td>
                         <td><?php echo $recepty[$i]['sposobDawkowania'] ?></td>
                         <td><?php echo $recepty[$i]['nazwiskoLekarza'] ?></td>
                    </tr>
               <?php } ?>
          </table>
          <a href="index.php?id=formularzRecept&pacjentid=<?php echo $dane['pacjentID'] ?>" ><image src="images/generuj_recepte.png"></a>
     </div>


     <div class="newboxes-4" id="newboxes4-4" style=" display: none;">	
          <div class="naglowki">Chistoria chorób pacjenta.</div>
          <?php
          require_once 'class/historiaChorob.php';
          $historiaChorob = new historiaChorob();
          $choroby = $historiaChorob->getChoroby($_GET['pacjentid']);
          $ilosc_rekordow = count($choroby);

          $auth = new authorization();
          ?>
          <table style="width:717px">

               <?php for ($i = 0; $i < $ilosc_rekordow; $i++) { ?>

                    <tr><td class="user_info" style="background-color:#b6b8b5; height:35px;">Temat:<b><?php echo $choroby[$i]['temat'] ?></b></td></tr>
                    <tr><td class="user_info">Data Wpisu: <?php echo $choroby[$i]['dataWpisu'] ?></td></tr>
                    <tr><td class="user_info">Opis Choroby:</td></tr>
                    <tr><td><?php echo $choroby[$i]['opis'] ?></td></tr>
                    <tr><td class="user_info">Uwagi dotyczące pacjenta/choroby:</td></tr>
                    <tr><td><?php echo $choroby[$i]['uwagi'] ?></td></tr>
                    <tr>
                         <td class="user_info">
                              Dodane przez: 

                              <?php
                              $lekarz = $auth->_getUserInfo($_SESSION['pesel'], 'lekarze');
                              echo $lekarz['imie'] . ' ' . $lekarz['nazwisko'];
                              ?>
                         </td></tr>
                    <tr style="height:30px"><td></td></tr>


               <?php } ?>
          </table>    



          <a href="index.php?id=historiaChoroby&pacjentid=<?php echo $_GET['pacjentid'] ?>" ><image src="images/dodajChorobe.png"></a>


     </div>

     <?php
} else {
     echo '<div class="error">Nie masz uprawnien do tej strony</div>';
}
?>