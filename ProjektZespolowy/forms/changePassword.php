
          <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">
               <table style="width:360px; background-color:#f0f0f0;">
                    <tr><td> Stare Hasło: <input type="password" id="form_register" value="" name="oldPassword" /></td></tr>
                    <tr><td>  Nowe Hasło: <input type="password" id="form_register" value="" name="newPassword" /></td></tr>
                    <tr><td>  Potwierdź Nowe Hasło: <input type="password" id="form_register" value="" name="newPasswordConf" /></td></tr>
               </table>
               <input type="image" name="change" value="Zatwierdź" src="images/zatwierdz.png" />
          </form>
