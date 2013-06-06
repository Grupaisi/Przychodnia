<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wizyty
 *
 * @author Admin
 */
class wizyty {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }

     function sprawdzTermin($data, $godzina, $nazwiskoLekarza) {

          try {
               $stmt = $this->connect->prepare("SELECT * FROM wizyty WHERE dataWizyty=:data AND godzinaWizyty=:godzina AND nazwiskoLekarza=:nazwisko");
               $stmt->bindValue(':data', $data, PDO::PARAM_STR);
               $stmt->bindValue(':godzina', $godzina, PDO::PARAM_STR);
               $stmt->bindValue(':nazwisko', $nazwiskoLekarza, PDO::PARAM_STR);
               $stmt->execute();

               if ($stmt->fetch() > 0) {
                    return FALSE;
               }
               else
                    return TRUE;
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

     function dodajWizyte($array) {
          try {


               $sql_query = "INSERT INTO wizyty 
             (`pacjentID`, `dataWizyty`, `godzinaWizyty`, `nazwiskoLekarza`, `specjalizacja`, `tematWizyty`, `odbyta`)    VALUES(
                                :pacjentID,
                                :dataWizyty,
                                :godzinaWizyty,
                                :nazwiskoLekarza,
                                :specjalizacja,
                                :tematWizyty,
                                :odbyta)   ";


               $stmt = $this->connect->prepare($sql_query);
               foreach ($array as $key => $value) {
                    $stmt->bindValue(':' . $key . '', $value, PDO::PARAM_STR);
               }
               $stmt->bindValue(':odbyta', FALSE, PDO::PARAM_BOOL);

               $ilosc = $stmt->execute();

               if ($ilosc > 0) {
                    echo '<div class="succes">Wizyta została dodana.</div>';                    
                    header('Refresh: 1; URL=index.php?id=rejestratorWizyt');
               } else {
                    echo 'Wystąpił błąd podczas dodawania rekordów!';
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone:' . $e->getMessage();
          }
     }

}

?>
