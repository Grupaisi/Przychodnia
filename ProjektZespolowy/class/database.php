<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author Admin
 */
class database {

     private $dbname = 'projektzespolowy';
     private $dblogin = 'root';
     private $dbpass = '';
     private $host = '127.0.0.1';
     public $bindValue = Array();
     public $table, $column, $value;

     function __construct() {
          $this->connect = $this->connect();
     }
     public function connect() {

          try {
               $pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';', $this->dblogin, $this->dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
               $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               return $pdo;
          } catch (PDOException $e) {
               echo 'Błąd przy polaczeniu z bazą ' . $e->getMessage();
          }
     }

     public function count($sql_query, $bindValue) {          
          $this->sql_query = $sql_query;
          $this->bindValue = $bindValue;
          try {
               $stmt = $this->connect->prepare($this->sql_query);
               $this->PDOBindArray($stmt, $this->bindValue);
               $stmt->execute();
               return $stmt->fetchColumn();

               $stmt->closeCursor();
          } catch (PDOException $e) {
               echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
          }
     }

     private function PDOBindArray($stmt, $bindArray) {
          foreach ($bindArray as $key => $value) {
               $stmt->bindValue($key, $value[0], $value[1]);
          }
     }

}

?>
