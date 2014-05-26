<?php
session_start();
include 'connexionBDD.php';	
?>

<!DOCTYPE html>
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
<br>
<br>
<?php
include 'compte.php';
?>
       </header>

      
       
       <?php
if (isset($_SESSION['login_compte']) && isset($_SESSION['mdps_compte']))
{
include'menu.php';


// Affichage de touts les formateurs
$sql = "SELECT * FROM formateur";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);


// supprition des formation par admin 

$type = $_SESSION['type_compte'];

$admin = false;

if ( $type == 1 )
{
$admin = true;
}
else
{
$admin = false;
}

// ajout formateur

print("<h4><a href=formateur_ajout.php> Ajouter formateur </a></h4>");


//Affichage des résultats



while ($result = mysqli_fetch_array($req))
{
$formateur_nom = $result['nom_formateur'];
$formateur_prenom = $result["prenom_formateur"];
$id_formateur = $result["id_formateur"];
print("M. ".$formateur_nom);
// print(" ".$formateur_prenom. " ").(($admin)? "<input type='submit' value='Suprimer formation' onclick=SuppimerFormation($id_formateur)' />" : "Modifier" );
print(" ".$formateur_prenom. " ").(($admin)? "<a href=formateur_suppression.php?id=".$id_formateur."> Supprimer</a> | <a href=formateur_modification.php?id=".$id_formateur."> Modifier</a>" : "" );

print('<br>');
print($id_formateur);
print('<br>');
print('<br>');




}
}
else
{
// Erreur si on est pas connectés

echo "<h4><font color='#FF0000'>Accès interdit</font>";
echo " : Vous devez être connectés pour pouvoir accéder à cette rubrique</h4>";
echo "<br>";
echo "<a href=index.php> Accueil </a>";
}
    mysqli_close($db);  	
?>
           
   </body>
</html>