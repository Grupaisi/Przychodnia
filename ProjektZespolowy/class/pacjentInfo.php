<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pacjentInfo
 *
 * @author Admin
 */
class pacjentInfo {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }
     
     function getPacjent($pacjentID) {
          try {
               $sql_query = "SELECT * FROM pacjenci,danepacjentow WHERE pacjentID=:pacjentID && danepacjentowID=:pacjentID";
               $stmt = $this->connect->prepare($sql_query);
               $stmt->bindValue(':pacjentID', $pacjentID, PDO::PARAM_STR);
               $stmt->execute();

               return $stmt->fetch();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }
     
     function getPacjents($pacjentID) {
          try {
               $sql_query = "SELECT * FROM pacjenci WHERE pacjentID=:pacjentID";
               $stmt = $this->connect->prepare($sql_query);
               $stmt->bindValue(':pacjentID', $pacjentID, PDO::PARAM_STR);
               $stmt->execute();

               return $stmt->fetchAll();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }
     
     function wizytyPacjenta($pacjentID, $odbyta) {
          try {
               $sql_query = "SELECT * FROM wizyty WHERE pacjentID=:pacjentID AND odbyta=:odbyta GROUP BY  DataWizyty, godzinaWizyty ";
               $stmt = $this->connect->prepare($sql_query);
               $stmt->bindValue(':pacjentID', $pacjentID, PDO::PARAM_STR);
               $stmt->bindValue(':odbyta', $odbyta, PDO::PARAM_BOOL);
               $stmt->execute();

               return $stmt->fetchAll();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

     function odbytaWizyta ($wizytaID){
         try {
               $sql_query = "UPDATE wizyty SET odbyta=TRUE WHERE wizytaID=:wizytaID";
               $stmt = $this->connect->prepare($sql_query);
               $stmt->bindValue(':wizytaID', $wizytaID, PDO::PARAM_STR);
               $stmt->execute();
               return $stmt->fetchAll();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          } 
     }
}

?>
