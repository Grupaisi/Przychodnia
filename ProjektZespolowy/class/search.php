<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search
 *
 * @author Admin
 */
class search {

     public function __construct() {
          $db = new database();
          $this->connect = $db->connect();
     }



     function wyszukuj($pesel = ' ', $imie = ' ', $nazwisko = ' ') {
          try {
               $stmt = $this->connect->prepare("SELECT * FROM pacjenci WHERE pesel LIKE ? AND imie LIKE ? AND nazwisko LIKE ? GROUP BY nazwisko");
               $stmt->bindValue(1, "%$pesel%");
               $stmt->bindValue(2, "%$imie%");
               $stmt->bindValue(3, "%$nazwisko%");
               $stmt->execute();

               
               if (!$stmt->rowCount() == 0) {
                    return $stmt->fetchAll();
               } else {
                    
                    echo '<div class="error">Nie znaleziono żadnego rekordu.</div>';
          
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }
     
     
     function getUserID ($data, $nazwiskoLekarza){
          
         try {
               $query = "SELECT * FROM wizyty WHERE dataWizyty=:data AND nazwiskoLekarza=:nazwiskoLekarza";
               $stmt = $this->connect->prepare($query);              
               $stmt->bindValue(':data', $data,  PDO::PARAM_STR);
               $stmt->bindValue(':nazwiskoLekarza', $nazwiskoLekarza,  PDO::PARAM_STR);
               $stmt->execute();

               
               if (!$stmt->rowCount() == 0) {
                    return $stmt->fetchAll();
               } else {
                    
                    echo '<div class="error">Nie masz dziś żadnej wizyty.</div>';
          
               }
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          } 
          
     }

}

?>
