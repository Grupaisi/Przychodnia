<?php
require_once 'library/komunikatyWalidacyjne.php';

class Validation {

   public  $komunikatyWalidacyjne = array(
          '1' => 'Musisz wypełnić wymagane pola.<br />',
          '2' => 'Hasło musi mieć conajmniej 6 znaków.<br />',
          '3' => 'Hasła wpisane różnią się od siebie.<br />',
          '4' => 'Podany pesel istenieje już w bazie.<br />',
          '5' => 'Podany email istenieje juz w bazie.<br />',
          '6' => 'Pesel składa sie z 11 cyfr.<br />',
          '7' => 'Imię posiada nieprawidłowe znaki.<br />',
          '8' => 'Nazwisko posiada nieprawidłowe znaki.<br />',
          '9' => 'Nowe hasła różnią się od siebie.<br />',
          '10' => '',
          '11' => 'Podany numer licencji już istenieje.<br />',
          '12' => 'Podany numer ubezpieczenia już istnieje.<br />',
        
     );
     
     public $dane = Array(
         'imie' => '',
         'nazwisko' => '',
         'pesel' => '',
         'password' => '',
         'drugie_imie' => '',
         'nr_ubezpieczenia' => '',
         'email' => '',
         'nr_dowodu' => '',
         'ulica' => '',
         'nr_domu' => '',
         'nr_mieszkania' => '',
         'kod_pocztowy' => '',
         'miasto' => '',
         'tel_kom' => '',
         'tel_dom' => '',
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
          $this->dane['drugie_imie'] = $data['drugie_imie'];
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
          $this->dane['miasto'] = $data['miasto'];
          $this->dane['tel_kom'] = $data['tel_kom'];
          $this->dane['tel_dom'] = $data['tel_dom'];

          $this->table = $table;
          if ($this->table == 'pacjenci') {
               $this->dane['nr_ubezpieczenia'] = $data['nr_ubezpieczenia'];
          } else {
               $this->dane['nr_licencji'] = $data['nr_licencji'];
               $this->dane['specjalizacja'] = $data['specjalizacja'];
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
       <tr><td><b>*</b>        Imię:                        <input type="text"         id="form_register"  name="imie" value="<?php echo $this->dane['imie']; ?>" /></td></tr>
       <tr><td>        Drugie imię:                 <input type="text"         id="form_register"   name="drugie_imie" value="<?php echo $this->dane['drugie_imie']; ?>" /></td></tr>
       <tr><td><b>*</b>        Nazwisko:                    <input type="text"         id="form_register"  name="nazwisko" value="<?php echo $this->dane['nazwisko']; ?>" /></td></tr>
       <tr><td><b>*</b>        Pesel:                       <input type="text"         id="form_register"  name="pesel" value="<?php echo $this->dane['pesel']; ?>" /></td></tr>
       <tr><td><b>*</b>        Hasło:                       <input type="password"     id="form_register"  name="password" value="" /></td></tr>
       <tr><td><b>*</b>        Potwierdz hasło:             <input type="password"     id="form_register"  name="password_conf" value="" /></td></tr>
       <tr><td><b>*</b>        Numer Ubezpieczenia:         <input type="text"         id="form_register"  name="nr_ubezpieczenia" value="<?php echo $this->dane['nr_ubezpieczenia']; ?>" /></td></tr>
       <tr><td><b>*</b>        Email:                       <input type="text"         id="form_register"  name="email" value="<?php echo $this->dane['email']; ?>" /></td></tr>
       <tr><td><b>*</b>        Numer Dowodu:                <input type="text"         id="form_register"  name="nr_dowodu" value="<?php echo $this->dane['nr_dowodu']; ?>" /></td></tr>
       <tr><td><b>*</b>        Ulica:                       <input type="text"         id="form_register"   name="ulica" value="<?php echo $this->dane['ulica']; ?>" /></td></tr>
       <tr><td><b>*</b>        Numer Domu:                  <input type="text"         id="form_register"   name="nr_domu" value="<?php echo $this->dane['nr_domu']; ?>" /></td></tr>
       <tr><td><b>*</b>        Numer Mieszkania:            <input type="text"         id="form_register"   name="nr_mieszkania" value="<?php echo $this->dane['nr_mieszkania']; ?>" /></td></tr>
       <tr><td><b>*</b>        Kod Pocztowy:                <input type="text"         id="form_register"   name="kod_pocztowy" value="<?php echo $this->dane['kod_pocztowy']; ?>" /></td></tr>
       <tr><td><b>*</b>        Miasto:                      <input type="text"         id="form_register"   name="miasto" value="<?php echo $this->dane['miasto']; ?>" /></td></tr> 
       <tr><td>                Telefon Domowy:              <input type="text"        id="form_register"   name="tel_dom" value="<?php echo $this->dane['tel_dom']; ?>" /></td></tr>   
       <tr><td><b>*</b>        Telefon Komórkowy:           <input type="text"        id="form_register"   name="tel_kom" value="<?php echo $this->dane['tel_kom']; ?>" /></td></tr>               
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
                    <tr><td><b>*</b>         Imię:                        <input type="text"      id="form_register"     name="imie" value="<?php echo $this->dane['imie']; ?>" /></td></tr>
                    <tr><td>         Drugie imię:                 <input type="text"      id="form_register"     name="drugie_imie" value="<?php echo $this->dane['drugie_imie']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Nazwisko:                    <input type="text"      id="form_register"     name="nazwisko" value="<?php echo $this->dane['nazwisko']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Pesel:                       <input type="text"      id="form_register"     name="pesel" value="<?php echo $this->dane['pesel']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Hasło:                       <input type="password"  id="form_register"     name="password" value="" /></td></tr>
                    <tr><td><b>*</b>         Potwierdz hasło:             <input type="password"  id="form_register"     name="password_conf" value="" /></td></tr>
                    <tr><td><b>*</b>         Numer Licencji:              <input type="text"      id="form_register"     name="nr_licencji" value="<?php echo $this->dane['nr_licencji']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Specjalizacja:               <input type="text"      id="form_register"     name="specjalizacja" value="" /></td></tr>
                    <tr><td><b>*</b>         Email:                       <input type="text"      id="form_register"     name="email" value="<?php echo $this->dane['email']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Numer Dowodu:                <input type="text"      id="form_register"     name="nr_dowodu" value="<?php echo $this->dane['nr_dowodu']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Ulica:                       <input type="text"      id="form_register"     name="ulica" value="<?php echo $this->dane['ulica']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Numer Domu:                  <input type="text"      id="form_register"     name="nr_domu" value="<?php echo $this->dane['nr_domu']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Numer Mieszkania:            <input type="text"      id="form_register"     name="nr_mieszkania" value="<?php echo $this->dane['nr_mieszkania']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Kod Pocztowy:                <input type="text"      id="form_register"     name="kod_pocztowy" value="<?php echo $this->dane['kod_pocztowy']; ?>" /></td></tr>
                    <tr><td><b>*</b>         Miasto:                      <input type="text"      id="form_register"     name="miasto" value="<?php echo $this->dane['miasto']; ?>" /></td></tr>        
                    <tr><td>         Telefon Domowy:              <input type="text"      id="form_register"     name="tel_dom" value="<?php echo $this->dane['tel_dom']; ?>" /></td></tr>   
                    <tr><td><b>*</b>         Telefon Komórkowy:           <input type="text"      id="form_register"     name="tel_kom" value="<?php echo $this->dane['tel_kom']; ?>" /></td></tr>              
                    </table>
              <input type="image" name="submit" value="Wyslij" src="images/zatwierdz.png" />
          </form>

          <?php
     }

     public function checkEmpty() {

          $empty = 0;

          if ((empty($this->dane['imie']) || 
              empty($this->dane['nazwisko']) ||    
              empty($this->dane['pesel']) ||    
              empty($this->dane['password']) ||    
              empty($this->dane['password_conf']) || 
              empty($this->dane['email']) || 
              empty($this->dane['nr_dowodu']) || 
              empty($this->dane['ulica']) ||     
              empty($this->dane['nr_domu']) ||     
              empty($this->dane['nr_mieszkania']) ||
              empty($this->dane['kod_pocztowy']) ||     
              empty($this->dane['miasto']) ||
              empty($this->dane['tel_kom']) )
                  || 
              ((
                      empty($this->dane['nr_licencji']) || 
                      empty($this->dane['specjalizacja']) 
              ) 
                      &&
              ( 
                      empty($this->dane['nr_ubezpieczenia']) ) 
              )
                  ){
               $empty++;
          }
          
          if ($empty > 0) {
               $this->errors['empty'] = $this->komunikatyWalidacyjne[1];
               $this->error_flag++;
               $empty = 0;
          }
          else
               return true;
     }

     public function checkPass() {
          if (strlen($this->dane['password']) < 6) {
               $this->errors['password'] = $this->komunikatyWalidacyjne[2];
               $this->error_flag++;
          } else if ($this->dane['password'] == $this->dane['password_conf']) {
               return true;
          } else {
               $this->errors['password'] = $this->komunikatyWalidacyjne[3];
               $this->error_flag++;
          }
     }

     public function checkUserExist() {

          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE pesel=:pesel";
          $bindValue = array(
              ':pesel' => array($this->dane['pesel'], PDO::PARAM_STR),);
          if ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['pesel'] = $this->komunikatyWalidacyjne[4];
               $this->error_flag++;
          }
     }

     public function checkEmail() {

          $db = new database();
          $sql_query = "SELECT * FROM `$this->table` WHERE email=:email";
          $bindValue = array(
              ':email' => array($this->dane['email'], PDO::PARAM_STR),);
          if ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['email'] = $this->komunikatyWalidacyjne[5];
               $this->error_flag++;
          }
     }

     public function checkPesel() {

          if (!preg_match('/^[0-9]{11}$/', $this->dane['pesel'])) {
               $this->errors['pesel'] = $this->komunikatyWalidacyjne[6];
               $this->error_flag++;
          }
          
     }

     public function checkNameLastname() {

          if (!preg_match("/[A-Za-z]+/", $this->dane['imie'])) {
               $this->errors['imie'] = $this->komunikatyWalidacyjne[7];
               $this->error_flag++;
          }
          if (!preg_match("/[A-Za-z-]+/", $this->dane['nazwisko'])) {
               $this->errors['nazwisko'] = $this->komunikatyWalidacyjne[8];
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
               echo $this->komunikatyWalidacyjne[9];
               return;
          }
          if (length($this->newPassword) < 6) {
               echo $this->komunikatyWalidacyjne[2];
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
               $this->errors['empty'] = $this->komunikatyWalidacyjne[1];
               $this->error_flag++;
          } elseif ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['nr_licencji'] = $this->komunikatyWalidacyjne[11];
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
               $this->errors['empty'] = $this->komunikatyWalidacyjne[1];
               $this->error_flag++;
          } elseif ($db->count($sql_query, $bindValue) > 0) {
               $this->errors['nr_ubezpieczenia'] = $this->komunikatyWalidacyjne[12];
               $this->error_flag++;
          } else {
               return true;
          }
     }

}
?>
