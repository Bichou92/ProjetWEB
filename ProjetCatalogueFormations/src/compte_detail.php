<?php
session_start();
include 'connexionBDD.php';	


if(isset($_GET["id"]))
{
$id = $_GET["id"];
}


// Affichage de toutes les formations, avec leur dates et les formateurq
$sql = "SELECT * FROM compte WHERE id_compte  = ".$id."";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

//Affichage des résultats//

while ($result = mysqli_fetch_array($req))
{
$intitule = $result["nom_compte"];
$description = $result["prenom"];
$contenu = $result["mail_compte"];

print($intitule);
print('<br>');

print($description);
print('<br>');

print($contenu);

print('<br>');
print('<br>');
print('<br>');
}
mysqli_close($db);  
?>