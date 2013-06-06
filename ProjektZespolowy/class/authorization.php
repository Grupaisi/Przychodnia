<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/class/database.php';

class authorization {

     public $intTimeoutSeconds = 1800;

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }

     public function loginForm() {
          ?>
          <form method="POST" action="index.php?id=Panel_Logowania">
               Podaj Pesel:<br />
               <input type="text" id="form_login" value="" name="pesel" /><br/>
               Hasło:<br />
               <input type="password" id="form_login" value="" name="password" /><br />
               <input type="submit" name="submit" value="Zaloguj!" />
          </form>
          <?php
     }

     public function login($pesel, $password, $table) {

          $check = $this->checkExist($pesel, $password, $table);

          if ($check === TRUE) {

               if ($table == 'pacjenci') {
                    if (!isset($_SESSION['auth'])) {

                         session_regenerate_id();
                         $_SESSION['pacjent'] = TRUE;
                         $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                         $user = $this->_getUserInfo($pesel, $table);
                         return $user;
                    }
               } else {
                    if (!isset($_SESSION['auth'])) {

                         session_regenerate_id();
                         $_SESSION['lekarz'] = TRUE;
                         $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                         $user = $this->_getUserInfo($pesel, $table);
                         return $user;
                    }
               }
          }
          else
               return $check;
     }

     public function checkExist($pesel, $password, $table) {

          $sql_query = "SELECT * from $table WHERE pesel=:pesel AND password=:password";
          $stmt = $this->connect->prepare($sql_query);
          $stmt->bindValue(':pesel', $pesel, PDO::PARAM_STR);
          $stmt->bindValue(':password', md5($password), PDO::PARAM_STR);
          $stmt->execute();

          return $stmt->rowCount() > 0 ? TRUE : FALSE;
     }

     public function logout() {

          unset($_SESSION);
          session_destroy();
          return;
     }

     public function _getUserInfo($pesel, $table) {
          try {
               $stmt = $this->connect->prepare("SELECT * FROM $table WHERE pesel=:pesel");
               $stmt->bindValue(':pesel', $pesel, PDO::PARAM_STR);
               $stmt->execute();

               return $stmt->fetch();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

     public function timeExpire() {
          if (isset($_SESSION['intLastRefreshTime'])) {
               if (($_SESSION['intLastRefreshTime'] + $this->intTimeoutSeconds) < time()) {
                    session_destroy();
                    
                    session_start();
               }
               else{
                    $_SESSION['intLastRefreshTime'] = time();
               }
          }
     }

}
?>
