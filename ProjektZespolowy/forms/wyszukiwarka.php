<?php if (isset($_SESSION['lekarz'])) { ?>
     <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">
          <table style="width:300px; background-color:#f0f0f0;">
               <tr><td>  Pesel:    <input type="text" id="form_register" value="" name="pesel" /></td></tr>
               <tr><td>  Imię:     <input type="text" id="form_register" value="" name="imie" /></td></tr>
               <tr><td>  Nazwisko: <input type="text" id="form_register" value="" name="nazwisko" /></td></tr>
          </table>
          <input type="image" name="search" value="Wyszukaj" src="images/szukaj.png"/>
     </form>

     <?php } else {
     ?>
     <div class="error">Nie posiadasz uprawnień do tej strony</div>
<?php }
?>
		