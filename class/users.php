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
          $this->dane['imie'] = ucfirst($data['imie']);
          $this->dane['nazwisko'] = ucfirst($data['nazwisko']);
          $this->dane['pesel'] = $data['pesel'];
          $this->dane['password'] = md5($data['password']);
          $this->dane['email'] = $data['email'];
          $this->dane['nr_dowodu'] = $data['nr_dowodu'];
          $this->dane['adres'] = $data['adres'];
          $this->dane['nr_tel'] = $data['nr_tel'];
     }

     function add($connect, $table, $dane_dodatkowe, $specjalizacja = '') {

          $this->table = $table;
          $this->specjalizacja = $specjalizacja;
          $this->dane_dodatkowe = $dane_dodatkowe;
          try {

               $this->connect = $connect;
               if ($this->table == 'lekarze') {
                    $sql_query = "INSERT INTO `$this->table` 
             (`imie`, `nazwisko`, `pesel`, `password`, `email`, `nr_dowodu`, `adres`, `nr_tel`, `$this->dane_dodatkowe`, `specjalizacja`)    VALUES(
                                :imie,
                                :nazwisko,
                                :pesel,
                                :password,
                                :email,
                                :nr_dowodu,
                                :adres,
                                :nr_tel,
                                :$this->dane_dodatkowe,
                                :specjalizacja)   ";
               } else {

                    $sql_query = "INSERT INTO `$this->table` 
             (`imie`, `nazwisko`, `pesel`, `password`, `email`, `nr_dowodu`, `adres`, `nr_tel`, `$this->dane_dodatkowe`)    VALUES(
                                :imie,
                                :nazwisko,
                                :pesel,
                                :password,
                                :email,
                                :nr_dowodu,
                                :adres,
                                :nr_tel,
                                :$this->dane_dodatkowe)   ";
               }

               $stmt = $this->connect->prepare($sql_query);
               foreach ($this->dane as $this->key => $this->value) {
                    $stmt->bindValue(':' . $this->key . '', $this->value, PDO::PARAM_STR);
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

}

?>
