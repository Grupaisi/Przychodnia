<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of changePassword
 *
 * @author Admin
 */
class changePassword {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }

     function changePass($pesel, $table, $oldPassword, $newPassword) {
          $this->userID = $pesel;
          $this->oldPassword = md5($oldPassword);
          $this->newPassword = md5($newPassword);

          try {

               $stmt = $this->connect->prepare("SELECT * FROM $table WHERE pesel = :pesel");
               $stmt->bindValue(':pesel', $pesel, PDO::PARAM_INT);
               $stmt->execute();

               if ($results = $stmt->fetch()) {
                    if ($results['password'] == $this->oldPassword) {

                         $this->sql = "UPDATE $table SET password = :newPassword WHERE pesel = :pesel";
                         $change = $this->connect->prepare($this->sql);
                         $change->bindValue(':newPassword', $this->newPassword, PDO::PARAM_STR);
                         $change->bindValue(':pesel', $pesel, PDO::PARAM_STR);

                         $ilosc = $change->execute();
                         if ($ilosc > 0) {
                              echo '<div class="succes">Twoje hasło zostało zmienione.</div>';
                              $_POST['change'] == NULL;
                              require_once 'forms/changePassword.php';
                         } else {
                              echo '<div class="succes">Wystąpił błąd podczas zmiany rekordu!</div>';
                         }
                    } else {

                         echo '<div class="error">Stare hasło nie jest zgodne z obecnym.</div>';
                         require_once 'forms/changePassword.php';
                    }
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

     function changePasswordForm() {
          ?>
          <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">
               Stare Hasło<br />
               <input type="text" id="form_login" value="" name="oldPassword" /><br/>
               Nowe Hasło:<br />
               <input type="password" id="form_login" value="" name="newPassword" /><br />
               Potwierdź Nowe Hasło:<br />
               <input type="password" id="form_login" value="" name="newPasswordConf" /><br />

               <input type="submit" name="change" value="Zatwierdź" />
          </form>


          <?php
     }

     public function checkChangePass($newPassword, $newPasswordConf) {
          $this->newPassword = $newPassword;
          $this->newPasswordConf = $newPasswordConf;
          $error = 0;

          if ($this->newPassword != $this->newPasswordConf) {
               echo '<div class="error">Nowe hasła różnią się od siebie</div>';
               require_once 'forms/changePassword.php';
               $error++;
          }
          if (strlen($this->newPassword) < 6) {
               echo '<div class="error">Nowe hasło musi mieć co najmniej 6 znaków</div>';
               require_once 'forms/changePassword.php';
               $error++;
          }

          if ($error == 0) {
               return true;
          }
     }

}
?>
