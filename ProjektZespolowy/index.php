﻿<?php
session_start();

require_once '/library/komunikaty.php';
if (!isset($_GET['id'])){
     ("Header: index.php?id=home");
     
}
 else {
    require_once '/class/authorization.php';
$auth = new authorization();
$auth->timeExpire(); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

     <head>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>          
          <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
          <link rel="stylesheet" type="text/css" href="style.css" />
          <script type="text/javascript" src="javascripts/zwijanie.js"></script>
          <title>Klinika NFZ</title>
     </head>

     <body>
          <div id="wrapper">
               <div id="top">
                    <div id="akg_med">
                        
                    </div>
               
               </div>
               <div id="container">
                    <div id="left_column">                         c     

                              <ul class="menu">
                                   <?php if (isset($_SESSION['pacjent'])) { ?>  
                                        <li><a href="index.php?id=Panel_Pacjenta">Panel Użytkownika</a></li>
                                        <li><a href="index.php?id=rejestratorWizyt">Zarejestruj Na Wizytę</a></li>   
                                        <li><a href="index.php?id=logout"><div style="color:#e6bc14;">Wyloguj</div></a></li>
                                        <?php
                                   } elseif (isset($_SESSION['lekarz'])) {
                                        ?> 


                                        <li><a href="index.php?id=Panel_Lekarza">Panel Użytkownika</a></li>
                                        <li><a href="index.php?id=RejestracjaPacjentow">Dodaj Pacjenta</a></li>
                                        <li><a href="index.php?id=RejestracjaLekarzy">Dodaj Lekarza</a></li>
                                        <li><a href="index.php?id=search">Wyszukiwarka</a></li>
                                        <li><a href="index.php?id=logout"><div style="color:#e6bc14;">Wyloguj</div></a></li>
                                        <?php
                                   } else {
                                        ?>

                                        <li><a href="index.php?id=Panel_Logowania">Panel Logowania</a></li>
                                        <li><a href="index.php?id=OFirmie">O Firmie</a></li>
                                        <li><a href="index.php?id=Pomoc">Pomoc</a></li>
                                   </ul>
                              <?php } ?>
                         
                    </div>

                    <div id="right_column">
                         
                              <div class="content">
                                  
                                   <?php include("includes/list.php") ?>

                              </div>



                         </div>
                         

                    </div>

               </div>




          </div>
     </body>

</html>
