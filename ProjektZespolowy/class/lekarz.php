<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/class/users.php';
/**
 * Description of pacjent
 *
 * @author Admin
 */
class lekarz extends users {
     
     function __construct($data) {
          parent::__construct($data);
          $this->dane['nr_licencji'] = $data['nr_licencji']; 
          $this->dane['specjalizacja'] = $data['specjalizacja']; 

          }
     
     function add($connect, $table, $sql_query) { 
          $sql_query= "INSERT INTO `lekarze` (`pesel`,`password`,`imie`, `nazwisko`, `email`,`nr_licencji`, `specjalizacja`)    VALUES(
                                :pesel,
                                :password,
                                :imie,
                                :nazwisko,                               
                                :email,                               
                                :nr_licencji,
                                :specjalizacja)";
          $sql_Data= "INSERT INTO `danelekarzy` (`pesel`,`drugie_imie`,`nr_dowodu`, `tel_kom`, `tel_dom`,`ulica`,`nr_domu`,`nr_mieszkania`,`kod_pocztowy`,`miasto`)    VALUES(
                                :pesel,
                                :drugie_imie,
                                :nr_dowodu,
                                :tel_kom,                               
                                :tel_dom,                               
                                :ulica,
                                :nr_domu,
                                :nr_mieszkania,
                                :kod_pocztowy,
                                :miasto)";
          parent::add($connect, $table, $sql_query);
          parent::addData($connect, $table, $sql_Data);
     }
      
}

?>
