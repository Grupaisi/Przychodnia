<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historiaChorob
 *
 * @author Admin
 */
class historiaChorob {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }

     function dodajChorobe($array) {
          try {


               $sql_query = "INSERT INTO historiachorob 
             (`pacjentID`, `dataWpisu`, `temat`, `opis`, `peselLekarza`, `uwagi`)    VALUES(
                                :pacjentID,
                                :dataWpisu,
                                :tematChoroby,
                                :opisChoroby,
                                :peselLekarza,
                                :uwagi )   ";

               echo $sql_query;
               $stmt = $this->connect->prepare($sql_query);
               foreach ($array as $key => $value) {
                    $stmt->bindValue(':' . $key . '', $value, PDO::PARAM_STR);
               }

               $ilosc = $stmt->execute();

               if ($ilosc > 0) {
                    echo '<div class="succes">Nowy rekord został dodany.</div>';
                    header('Refresh: 3; URL=index.php?id=pacjenci&pacjentid=' . $array['pacjentID'] . '');
               } else {
                    echo 'Wystąpił błąd podczas dodawania rekordów!';
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone:' . $e->getMessage();
          }
     }

     function getChoroby($pacjentID) {
          try {
               $stmt = $this->connect->prepare("SELECT * FROM historiaChorob WHERE pacjentID=:pacjentID");
               $stmt->bindValue(':pacjentID', $pacjentID, PDO::PARAM_STR);
               $stmt->execute();
               return $stmt->fetchAll();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

}

?>
