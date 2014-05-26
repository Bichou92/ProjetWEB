<?php
session_start();
include 'connexionBDD.php';	


if (!empty($_POST))
{
$nom = $_POST['nom'];	
$prenom = $_POST['prenom'];

if ($nom == "")
{
print("<b><font color=red>Veuillez saisir un nom</font></b>");
}
elseif ($prenom == "")
{
print("<b><font color=red>Veuillez saisir un prénom</font></b>");
}
else
{
print("<b><font color=red>BRAVO : Formateur ajouter</font></b>");


$sql = "INSERT INTO formateur VALUES ('', '".$nom."', '".$prenom."')";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);

header( "refresh:2;url=formateur.php" );
}
}
// mysqli_close($db);  
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

<h3>Ajout de formateur </h3>

<form action="formateur_ajout.php" method="post">

Nom du formateur <br>	
<input type="text" id="recherche" name="nom" placeholder="nom"/>

<br>
Prénom du formateur <br>	
<input type="text" id="recherche" name="prenom" placeholder="prenom"/>
<br>




<input type="submit" value="Envoyer" />
</form>
</body>
</html>
<?php	
mysqli_close($db);  
?>