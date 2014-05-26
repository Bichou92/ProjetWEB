<?php
session_start ();  

// D?struction variables session
session_unset ();  

// D?struction session
session_destroy ();  

// Redirection vers page d'accueil
header ('location: index.php');
?>