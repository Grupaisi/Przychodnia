<form action="" method="post">
     <table>
          <tr><td>Data: </td><td><input type="text" name="data" value="<?php echo $dane[0] ?>"  disabled/></td></tr>
          <tr><td>Godzina: </td><td><input type="text" name="godzina" value="<?php echo $dane[3] ?>"  disabled/></td></tr>
          <tr><td>Nazwisko Lekarza: </td><td><input type="text" name="lekarz" value="<?php echo $dane[1] ?>"  disabled/></td></tr>
          <tr><td>Specjalizacja: </td><td><input type="text" name="specjalizacja" value="<?php echo $dane[2] ?>"  disabled/></td></tr>
          <tr><td>Temat Wizyty:  </td><td><textarea name="temat" value=""/></textarea></td></tr>
     </table>
     <input type="image" name="submit" value="Wyslij" src="images/zatwierdz.png" />
</form>
