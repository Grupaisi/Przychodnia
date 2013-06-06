
<?php
session_start();

if (isSet($_POST['submit'])) {
     $pesel = $_POST['pesel'];
     $password = $_POST['password'];
     $table = 'lekarze';

     $userAuth = $auth->login($pesel, $password, $table);
     if (isset($_SESSION['lekarz'])) {
          $_SESSION['pesel'] = $userAuth['pesel'];
          $_SESSION['intLastRefreshTime'] = time();
          header("Location: index.php?id=Panel_Lekarza");
     } else {         
          
          
     echo '<div class="error">'.$komunikaty[2].'</div>';

         
          require_once '/forms/PanelLogowaniaLekarzy.html';
         

     }
} else {
     require_once '/forms/PanelLogowaniaLekarzy.html';
     
     
}
?>
