<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author Admin
 */
class users {

     protected $dane = Array(
         'imie' => '',
         'nazwisko' => '',
         'pesel' => '',
         'password' => '',
         'email' => '',
         'nr_dowodu' => '',
         'adres' => '',
         'nr_tel' => ''
     );

     function __construct($data) {
          $this->dane['pesel'] = $data['pesel'];
          $this->dane['password'] = md5($data['password']);
          $this->dane['imie'] = ucfirst($data['imie']);
          $this->dane['drugie_imie'] = ucfirst($data['drugie_imie']);
          $this->dane['nazwisko'] = ucfirst($data['nazwisko']);                  
          $this->dane['email'] = $data['email'];
          $this->dane['nr_dowodu'] = $data['nr_dowodu'];    
          $this->dane['ulica'] = $data['ulica'];
          $this->dane['nr_domu'] = $data['nr_domu'];
          $this->dane['nr_mieszkania'] = $data['nr_mieszkania'];
          $this->dane['kod_pocztowy'] = $data['kod_pocztowy'];
          $this->dane['miasto'] = $data['miasto'];
          $this->dane['tel_kom'] = $data['tel_kom'];
          $this->dane['tel_dom'] = $data['tel_dom'];
     }

     function add($connect, $table, $sql_query) {
          
          $this->sql_query = $sql_query;
          $this->table = $table;

          try {

               $this->connect = $connect;
               
               if ($this->table == 'pacjenci') {
                    
                   
                    $pacjenci = Array('pesel','password','imie','nazwisko','email','nr_ubezpieczenia');
                    $lekarze = Array('pesel','password','imie','nazwisko','email','nr_licencji','specjalizacja');
                    $daneUzytkownikow = Array('pesel','drugie_imie','nr_dowodu','tel_kom','tel_dom','ulica','nr_domu','nr_mieszkania','kod_pocztowy','miasto');
                    
                     $stmt = $this->connect->prepare($this->sql_query);
                     $stmt->bindValue(':pesel',    $this->dane['pesel'], PDO::PARAM_STR);
                     $stmt->bindValue(':password', $this->dane['password'], PDO::PARAM_STR);
                     $stmt->bindValue(':imie',     $this->dane['imie'], PDO::PARAM_STR);
                     $stmt->bindValue(':nazwisko', $this->dane['nazwisko'], PDO::PARAM_STR);
                     $stmt->bindValue(':email',    $this->dane['email'], PDO::PARAM_STR);
                     $stmt->bindValue(':nr_ubezpieczenia', $this->dane['nr_ubezpieczenia'], PDO::PARAM_STR);
               } else {
                     $stmt = $this->connect->prepare($this->sql_query);
                     $stmt->bindValue(':pesel',        $this->dane['pesel'], PDO::PARAM_STR);
                     $stmt->bindValue(':password',     $this->dane['password'], PDO::PARAM_STR);
                     $stmt->bindValue(':imie',         $this->dane['imie'], PDO::PARAM_STR);
                     $stmt->bindValue(':nazwisko',     $this->dane['nazwisko'], PDO::PARAM_STR);
                     $stmt->bindValue(':email',        $this->dane['email'], PDO::PARAM_STR);
                     $stmt->bindValue(':nr_licencji',  $this->dane['nr_licencji'], PDO::PARAM_STR);
                     $stmt->bindValue(':specjalizacja', $this->dane['specjalizacja'], PDO::PARAM_STR);
                     }

              

               $ilosc = $stmt->execute();

               if ($ilosc > 0) {
                    if ($table == 'pacjenci') {
                         echo '<div class="succes">Konto pacjenta zostało dodane.</div>';
                         header('Refresh: 1; URL=index.php?id=RejestracjaPacjentow');
                    } else {
                         echo '<div class="succes">Konto lekarza zostało dodane.</div>';
                         header('Refresh: 1; URL=index.php?id=RejestracjaLekarzy');
                    }
               } else {
                    echo 'Wystąpił błąd podczas dodawania rekordów!';
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone:' . $e->getMessage();
          }
     }
        
     function addData($connect, $table, $sql_Data) {
          
          $this->sql_Data = $sql_Data;
          $this->table = $table;

          try {

               $this->connect = $connect;
               $stmt = $this->connect->prepare($this->sql_Data);
                     $stmt->bindValue(':pesel',         $this->dane['pesel'],        PDO::PARAM_STR);
                     $stmt->bindValue(':drugie_imie',   $this->dane['drugie_imie'],     PDO::PARAM_STR);
                     $stmt->bindValue(':nr_dowodu',     $this->dane['nr_dowodu'],         PDO::PARAM_STR);
                     $stmt->bindValue(':tel_kom',       $this->dane['tel_kom'],     PDO::PARAM_STR);
                     $stmt->bindValue(':tel_dom',       $this->dane['tel_dom'],        PDO::PARAM_STR);
                     $stmt->bindValue(':ulica',         $this->dane['ulica'],  PDO::PARAM_STR);
                     $stmt->bindValue(':nr_domu',       $this->dane['nr_domu'],PDO::PARAM_STR);
                     $stmt->bindValue(':nr_mieszkania', $this->dane['nr_mieszkania'],        PDO::PARAM_STR);
                     $stmt->bindValue(':kod_pocztowy',  $this->dane['kod_pocztowy'],     PDO::PARAM_STR);
                     $stmt->bindValue(':miasto',        $this->dane['miasto'],         PDO::PARAM_STR);
                    
                     $stmt->execute();
                     } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone:' . $e->getMessage();
          }
     }

}

?>
