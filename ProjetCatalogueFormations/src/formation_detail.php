<?php
session_start();
include 'connexionBDD.php';	

// te demerder pour que ca le fassse apres et pas du premier coup

if(isset($_POST['test']))
{
if (isset($_SESSION['login_compte']) && isset($_SESSION['mdps_compte']))
{
$idc = $_SESSION['id_compte'];
$id = $_GET["id"];

$sql = "INSERT INTO participant VALUES ('', '".$idc."', '".$id."')";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);
print("<b><font color=red>BRAVO : vous etes inscrit</font></b>");
header( "refresh:2;url=formation.php" );
}
else
{
print("<b><font color=red>Veuillez vous connectez pour vous inscrire à cette formation</font></b>");
}
}
?>

<html>
<head>
<meta charset="utf-8" />        
       <title>Catalogue de formation | M2L</title>        
       <link rel="stylesheet" href="assets/css/styles.css" />   
       <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />
       
       <!-- Enabling HTML5 support for Internet Explorer -->
       <!--[if lt IE 9]>
         <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
       <![endif]-->
</head>

<body>

       <header>
           <h1>  Catalogue de formation</h1>
<?php
include 'compte.php';
include 'menu.php';

?>
       </header>

<h3>Formation </h3>
<?php
if(isset($_GET["id"]))
{
$id = $_GET["id"];
}


// Affichage de toutes les formations, avec leur dates et les formateurq
$sql = "SELECT * FROM formation
LEFT JOIN session ON formation.id_date = session.id_date
LEFT JOIN formateur ON formation.id_formateur = formateur.id_formateur
WHERE id_formation = ".$id."";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

//Affichage des résultats//

while ($result = mysqli_fetch_array($req))
{
$intitule = $result["libelle_formation"];
$description = $result["desc_formation"];
$contenu = $result["contenu_formation"];
$cout = $result["cout_formation"];
$date = $result["date_debut"];
$date .= $result["date_fin"];
$formateur = $result["nom_formateur"];
$formateur2 = $result["prenom_formateur"];

print($intitule);
print('<br>');

print($description);
print('<br>');

print($contenu);
print('<br>');

print($cout);
print('<br>');
print($date);
print('<br>');
print($formateur);
print('<br>');
print($formateur2);

print('<br>');
print('<br>');

print(" <form action='' method='post'>");
echo"J'accepte  les conditions d'utilisation.";
print("<input type='checkbox' name='test' value='value1'>");
echo"<br>";
print("<input type='submit' value='Inscription' />");
print("</form>");
}
?>
</body>
</html>