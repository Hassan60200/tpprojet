<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../views/connexion.php");
exit();
?>
