<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
     <table>
          <tr><td>Temat:           </td><td><input type="text" name="tematChoroby" id="form_register" style="width:300px;" value=""/></td></tr>
          <tr><td>Opis Choroby:    </td><td><textarea          name="opisChoroby"  id="form_register" style="width:300px; height:100px"  value=""/></textarea></td></tr>
          <tr><td>Uwagi:           </td><td><textarea          name="uwagi" id="form_register" style="width:300px; height:100px" value=""/></textarea></td></tr>

     </table>
     <input type="image" name="submit" value="Wyslij" src="images/zatwierdz.png" />
</form>
