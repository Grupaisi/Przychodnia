<?php
require_once 'database.php';

class Validation {

     public $dane = Array(
         'imie' => '',
         'nazwisko' => '',
         'pesel' => '',
         'password' => '',
         'nr_ubezpieczenia' => '',
         'email' => '',
         'nr_dowodu' => '',
         'ulica' => '',
         'nr_domu' => '',
         'nr_mieszkania' => '',
         'kod_pocztowy' => '',
         'nr_tel' => '',
         'nr_licencji' => '',
     );
     public $error_flag = 0;
     public $errors = Array(
         'empty' => '',
         'login' => '',
         'password' => '',
         'email' => '',
         'pesel' => '',
         'imie' => '',
         'nazwisko' => '',
         'nr_ubezpieczenia' => '',
         'nr_licencji' => '',
     );

     function __construct($data, $table) {
          $this->dane['imie'] = $data['imie'];
          $this->dane['nazwisko'] = $data['nazwisko'];
          $this->dane['pesel'] = $data['pesel'];
          $this->dane['password'] = $data['password'];
          $this->dane['password_conf'] = $data['password_conf'];
          $this->dane['email'] = $data['email'];
          $this->dane['nr_dowodu'] = $data['nr_dowodu'];
          $this->dane['ulica'] = $data['ulica'];
          $this->dane['nr_domu'] = $data['nr_domu'];
          $this->dane['nr_mieszkania'] = $data['nr_mieszkania'];
          $this->dane['kod_pocztowy'] = $data['kod_pocztowy'];
          $this->dane['nr_tel'] = $data['nr_tel'];

          $this->table = $table;
          if ($this->table == 'pacjenci') {
               $this->dane['nr_ubezpieczenia'] = $data['nr_ubezpieczenia'];
          } else {
               $this->dane['nr_licencji'] = $data['nr_licencji'];
          }
          $db = new database();
          $this->connect = $db->connect();
     }

     public function FormPacjenci() {

          echo '<div class="error">';
          foreach ($this->errors as $key => $value) {
               echo $value;
          }
          echo '</div>';
          ?>
          <form method="POST" action="index.php?id=Rejestracja_Pacjentow">            
              <table width="360px">
       <tr><td>        Imię:                        <input type="text"         id="form_register"  name="imie" value="<?php echo $this->dane['imie']; ?>" /></td></tr>
       <tr><td>        Nazwisko:                    <input type="text"         id="form_register"  name="nazwisko" value="<?php echo $this->dane['nazwisko']; ?>" /></td></tr>
       <tr><td>        Pesel:                       <input type="text"         id="form_register"  name="pesel" value="<?php echo $this->dane['pesel']; ?>" /></td></tr>
       <tr><td>        Hasło:                       <input type="password"     id="form_register"  name="password" value="" /></td></tr>
       <tr><td>        Potwierdz hasło:             <input type="password"     id="form_register"  name="password_conf" value="" /></td></tr>
       <tr><td>        Numer Ubezpieczenia:         <input type="text"         id="form_register"  name="nr_ubezpieczenia" value="<?php echo $this->dane['nr_ubezpieczenia']; ?>" /></td></tr>
       <tr><td>        Email:                       <input type="text"         id="form_register"  name="email" value="<?php echo $this->dane['email']; ?>" /></td></tr>
       <tr><td>        Numer Dowodu:                <input type="text"         id="form_register"  name="nr_dowodu" value="<?php echo $this->dane['nr_dowodu']; ?>" /></td></tr>
       <tr><td>        Ulica:                       <input type="text"        id="form_register"   name="ulica" value="<?php echo $this->dane['ulica']; ?>" /></td></tr>
       <tr><td>        Numer Domu:                  <input type="text"        id="form_register"   name="nr_domu" value="<?php echo $this->dane['nr_domu']; ?>" /></td></tr>
       <tr><td>        Numer Mieszkania:            <input type="text"        id="form_register"   name="nr_mieszkania" value="<?php echo $this->dane['nr_mieszkania']; ?>" /></td></tr>
       <tr><td>        Kod Pocztowy:                <input type="text"        id="form_register"   name="kod_pocztowy" value="<?php echo $this->dane['kod_pocztowy']; ?>" /></td></tr>
       <tr><td>        Numer Telefonu:              <input type="text"         id="form_register"  name="nr_tel" value="<?php echo $this->dane['nr_tel']; ?>" /></td></tr>              
              </table>
               <input type="image" name="submit" value="Wyslij" src="images/zatwierdz.png" />
          </form>

          <?php
     }

     public function FormLekarze() {
          echo '<div class="error">';
          foreach ($this->errors as $key => $value) {
               echo $value;
          }
          echo '</div>';
          ?>
          <form method="POST" action="<?php $_SERVER['REQUEST_URI'] ?>">            
               <table width="360px">
                    <tr><td>         Imię:                        <input type="text"      id="form_register"     name="imie" value="<?php echo $this->dane['imie']; ?>" /></td></tr>
                    <tr><td>         Nazwisko:                    <input type="text"      id="form_register"     name="nazwisko" value="<?php echo $this->dane['nazwisko']; ?>" /></td></tr>
                    <tr><td>         Pesel:                       <input type="text"      id="form_register"     name="pesel" value="<?php echo $this->dane['pesel']; ?>" /></td></tr>
                    <tr><td>         Hasło:                       <input type="password"  id="form_register"     name="password" value="" /></td></tr>
                    <tr><td>         Potwierdz hasło:             <input type="password"  id="form_register"     name="password_conf" value="" /></td></tr>
                    <tr><td>         Numer Licencji:              <input type="text"      id="form_register"     name="nr_licencji" value="<?php echo $this->dane['nr_licencji']; ?>" /></td></tr>
                    <tr><td>         Specjalizacja:               <input type="text"      id="form_register"     name="specjalizacja" value="" /></td></tr>
                    <tr><td>         Email:                       <input type="text"      id="form_register"     name="email" value="<?php echo $this->dane['email']; ?>" /></td></tr>
                    <tr><td>         Numer Dowodu:                <input type="text"      id="form_register"     name="nr_dowodu" value="<?php echo $this->dane['nr_dowodu']; ?>" /></td></tr>
                    <tr><td>         Ulica:                       <input type="text"        id="form_register"   name="ulica" value="<?php echo $this->dane['ulica']; ?>" /></td></tr>
                    <tr><td>         Numer Domu:                  <input type="text"        id="form_register"   name="nr_domu" value="<?php echo $this->dane['nr_domu']; ?>" /></td></tr>
                    <tr><td>         Numer Mieszkania:            <input type="text"        id="form_register"   name="nr_mieszkania" value="<?php echo $this->dane['nr_mieszkania']; ?>" /></td></tr>
                    <tr><td>         Kod Pocztowy:                <input type="text"        id="form_register"   name="kod_pocztowy" value="<?php echo $this->dane['kod_pocztowy']; ?>" /></td></tr>
                    <tr><td>         Numer Telefonu:              <input type="text"      id="form_register"     name="nr_tel" value="<?php echo $this->dane['nr_tel']; ?>" /></td></tr>              
               </table>
              <input type="image" name="submit" value="Wyslij" src="images/zatwierdz.png" />
          </form>

          <?php
     }

     public function checkEmpty() {

          $empty = 0;
          foreach ($this->dane as $this->key => $this->value) {

               if (empty($this->value)) {
                    $empty++;
               }
          }
          if ($empty > 1) {
               $this->errors['empty'] = "Musisz wypełnić wszystkie pola";
               $this->error_flag++;
          }
          else
               return true;
     }

     public function checkPass() {
          if (strlen($this->dane['password']) < 6) {
               $this->errors['password'] = "Hasło musi mieć conajmniej 6 znaków.<br />";
               $this->error_flag++;
          } else if ($this->dane['password'] == $this->dane['password_conf']) {
               return true;
          } else {
               $this->errors['password'] = "Hasła wpisane różnią się od siebie.<br />";
               $this->error_flag++;
          }
     }

     public function checkUserExist() {

          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE pesel=:pesel";
          $bindValue = array(
              ':pesel' => array($this->dane['pesel'], PDO::PARAM_STR),);
          if ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['pesel'] = "Podany pesel istnieje już w bazie.<br />";
               $this->error_flag++;
          }
     }

     public function checkEmail() {

          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE email=:email";
          $bindValue = array(
              ':email' => array($this->dane['email'], PDO::PARAM_STR),);
          if ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['email'] = "Podany email istnieje już w bazie.<br /> ";
               $this->error_flag++;
          }
     }

     public function checkPesel() {

          if (!preg_match('/^[0-9]{11}$/', $this->dane['pesel'])) {
               $this->errors['pesel'] = "Pesel składa się z 11 cyfr.<br />";
               $this->error_flag++;
          }
     }

     public function checkNameLastname() {

          if (!preg_match("/[A-Za-z]+/", $this->dane['imie'])) {
               $this->errors['imie'] = "Imie może składać się tylko z liter.<br />";
               $this->error_flag++;
          }
          if (!preg_match("/[A-Za-z]+/", $this->dane['nazwisko'])) {
               $this->errors['nazwisko'] = "Nazwisko może składać się tylko z liter.<br />";
               $this->error_flag++;
          }
     }

     public function Validacja() {

          if ($this->checkEmpty()) {
               $this->checkUserExist();
               $this->checkEmail();
               $this->checkNameLastname();
               $this->checkPass();
               $this->checkPesel();
          }
          if ($this->error_flag == 0) {
               return true;
          } else {
               return false;
          }
     }

     function checkChangePass($newPassword, $newPasswordConf) {
          $this->newPassword = $newPassword;
          $this->newPasswordConf = $newPasswordConf;


          if ($this->newPassword != $this->newPasswordConf) {
               echo 'Nowe Hasła różnią się od siebie';
               return;
          }
          if (length($this->newPassword) < 6) {
               echo 'Nowe Hasło musi mieć co najmniej 6 znaków';
               return;
          }
     }

     public function checkNrLicencji($nrLicencji) {


          $this->dane['nr_licencji'] = $nrLicencji;
          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE nr_licencji=:nr_licencji";

          $bindValue = array(
              ':nr_licencji' => array($this->dane['nr_licencji'], PDO::PARAM_STR),);

          if (empty($this->dane['nr_licencji'])) {
               $this->errors['empty'] = "Musisz wypełnić wszystkie pola";
               $this->error_flag++;
          } elseif ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['nr_licencji'] = "Podany numer licencji już istnieje";
               $this->error_flag++;
          } else {
               return true;
          }
     }

     public function checkNrUbezpieczenia($nrUbezpieczenia) {


          $this->dane['nr_ubezpieczenia'] = $nrUbezpieczenia;
          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE nr_ubezpieczenia=:nr_ubezpieczenia";
          echo $sql_query;
          $bindValue = array(
              ':nr_ubezpieczenia' => array($this->dane['nr_ubezpieczenia'], PDO::PARAM_STR),);

          if (empty($this->dane['nr_ubezpieczenia'])) {
               $this->errors['empty'] = "Musisz wypełnić wszystkie pola";
               $this->error_flag++;
          } elseif ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['nr_ubezpieczenia'] = "Podany numer licencji już istnieje";
               $this->error_flag++;
          } else {
               return true;
          }
     }

}
?>
