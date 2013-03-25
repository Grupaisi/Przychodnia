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
class pacjent extends users {

     function __construct($data) {
          parent::__construct($data);
          $this->dane['nr_ubezpieczenia'] = $data['nr_ubezpieczenia'];
     }

     function add($connect, $table, $dane_dodatkowe, $specjalizacja='') {          
          parent::add($connect, $table, $dane_dodatkowe, $specjalizacja);
     }



}

?>
