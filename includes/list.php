<?php



if (!isset($_GET['id'])){
     $body = 'home';
}else
{
     $body = $_GET['id'];
}
$titles = array(
    'PanelLogowaniaLekarzy' => 'Panel Logowania Lekarzy',
    'PanelLogowaniaPacjentow' => 'Panel Logowania Pacjentów',
    'RejestracjaLekarzy' => 'Rejestracja Lekarzy',
    'RejestracjaPacjentow' => 'Rejestracja Pacjentów',
    'Rejestracja_Lekarzy' => 'Rejestracja Lekarzy',
    'Rejestracja_Pacjentow' => 'Rejestracja Pacjentow',
    
);
if (!isset($body)) {
     include("includes/home.php"); //plik includowany jeśli body jest puste
} else {
     if (is_file("includes/$body.php")) {
          echo '<div class="naglowek_podstrony">' . $titles[$body] . '</div>';
          include("includes/$body.php");
     } else if (is_file("forms/$body.html")) {
          echo '<div class="naglowek_podstrony">' . $titles[$body] . '</div>';
          include("forms/$body.html");
     } else if (is_file("forms/$body.php")) {
          echo '<div class="naglowek_podstrony">' . $titles[$body] . '</div>';
          include("forms/$body.php");
     } else {
          echo"<h1>404</h1> Nie ma takiej strony!";
     }
}
?>