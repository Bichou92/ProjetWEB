<?php
if (isset($_SESSION['login_compte']) && isset($_SESSION['mdps_compte']))
{
$nom = $_SESSION['nom_compte'];
$id_compte = $_SESSION['id_compte'];
$type = $_SESSION['type_compte'];
echo"<h2> Bonjour ";
print("<a href=compte_detail.php?id=".$id_compte.">Mr. $nom</a>");

echo " / " ;
print("<a href=deconnection.php>Deconnexion</a></h2>");
}
else
{
echo"<h2>bonjour invite";
echo "<a href=login.php> Se connecter </a>";
echo " / " ;
print("<a href=inscription.php>S'inscrire</a></h2>");

}
?>