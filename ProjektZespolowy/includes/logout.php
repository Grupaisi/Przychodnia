<?php

require_once '/class/authorization.php';
require_once '/class/database.php';

$auth = new authorization();
$auth->logout();
echo '<div class="succes">'.$komunikaty[3];'</div>';

header('Refresh: 1; URL=index.php?id=home');
?>
