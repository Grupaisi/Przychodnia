<?php
if (isset($_SESSION['lekarz'])) {
     require_once 'class/pacjentInfo.php';
     $pacjentID = $_GET['pacjentid'];

     $pacjent = new pacjentInfo();
     $dane = $pacjent->getPacjent($pacjentID);

     $i = 0;
     $plik = fopen("library/daneKliniki.txt", "r");
     if ($plik === false) {
          echo "Error";
     } else {
          while (!feof($plik)) {
               $bufor = fgets($plik);
               $daneKliniki[$i] = $bufor;
               $i++;
          }
          fclose($plik);
     }
     ?>

     <form method="POST" action="includes/generatorRecept.php" name=f1>
          <table>
               <textarea name="daneKliniki"  hidden/>
               <?php
               foreach ($daneKliniki as $key)
                    echo $key;
               ?>
               </textarea>
               <tr><td>Imię: </td><td><input type="text" id="form_register" name="imie" value="<?php echo $dane['imie']; ?>" /></td></tr>
               <tr><td>Nazwisko: </td><td><input type="text" id="form_register" name="nazwisko" value="<?php echo $dane['nazwisko']; ?>" /></td></tr>
               <tr><td>Adres:  </td><td><textarea name="adres" id="form_register" /><?php echo $dane['ulica']." ".$dane['nr_domu']."/".$dane['nr_mieszkania']." ". $dane['miasto']." ".$dane['kod_pocztowy']; ?></textarea></td></tr>
               <tr><td>Pesel: </td><td><input type="text" id="form_register" name="pesel" value="<?php echo $dane['pesel']; ?>" /></td></tr>

               <tr><td>Nazwa Leku:</td><td><input type="text" id="form_register" name="nazwaLeku" value="" /></td></tr>
               <tr><td>Dawka:</td><td><input type="text" id="form_register" name="dawka" value="" /></td></tr>
               <tr><td>Postać</td><td><input type="text" id="form_register" name="postac" value="" /></td></tr>
               <tr><td>Ilość:</td><td><input type="text" id="form_register" name="ilosc" value="" /></td></tr>
               <tr><td>Sposób Dawkowania:</td><td><input type="text" id="form_register" name="sposobDawkowania" value="" /></td></tr>
          </table>

          <input type='submit' value='Wygeneruj Receptę do druku' onclick="this.form.target='_blank';return true;"> 
          <input type='submit' value='Zapisz do bazy' name="submit" onclick="f1.action='index.php?id=receptaZapis'; return true;">

     </form>

     <?php
} else {
     echo '<div class="error">Nie masz uprawnien do tej strony</div>';
}
?>