<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recepty
 *
 * @author Admin
 */
class recepty {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }

     function dodajRecepte($array) {
          
         
          try {


               $sql_query = "INSERT INTO recepty 
             (`pacjentID`, `dataRecepty`, `nazwaLeku`, `dawka`, `postac`, `ilosc`, `sposobDawkowania`, `nazwiskoLekarza`)    VALUES(
                                :pacjentID,
                                :dataRecepty,
                                :nazwaLeku,
                                :dawka,
                                :postac,
                                :ilosc,
                                :sposobDawkowania,
                                :nazwiskoLekarza)   ";

               
               $stmt = $this->connect->prepare($sql_query);
               foreach ($array as $key => $value) {
                    $stmt->bindValue(':' . $key . '', $value, PDO::PARAM_STR);
               }


               $ilosc = $stmt->execute();

               if ($ilosc > 0) {
                    echo '<div class="succes">Recepta została dodana do bazy.</div>';
                    header('Refresh: 2; URL=index.php?id=pacjenci&pacjentid=' .$array['pacjentID'] . '');
               } else {
                    echo 'Wystąpił błąd podczas dodawania rekordów!';
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone:' . $e->getMessage();
          }
     }

     function getRecepty($pacjentID) {
          try {
               $sql_query = "SELECT * FROM recepty WHERE pacjentID=:pacjentID";
               $stmt = $this->connect->prepare($sql_query);
               $stmt->bindValue(':pacjentID', $pacjentID, PDO::PARAM_STR);
               $stmt->execute();
               return $stmt->fetchAll();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

}

?>
