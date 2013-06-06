<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php


$auth = new authorization();
$db = new database();

if (isSet($_POST['submit'])) {
     $pesel = $_POST['pesel'];
     $password = $_POST['password'];
     $table = 'pacjenci';

     $userAuth = $auth->login($pesel, $password, $table);
     if (isset($_SESSION['pacjent'])) {          
          $_SESSION['pesel'] = $userAuth['pesel'];
          $_SESSION['intLastRefreshTime'] = time();
          header("Location: index.php?id=Panel_Pacjenta");
     } else {
          
          echo '<div class="error">'.$komunikaty[2].'</div>';
          require_once '/forms/PanelLogowaniaPacjentow.html';
         
     }
} else {
     require_once '/forms/PanelLogowaniaPacjentow.html';
     
     
}
?>
