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
<?php
include 'compte.php';
?>
       </header>
       
       <?php
include'menu.php';	
?>

<h3>Catalogue de formation 

<?php
$admin = false;
if(isset($_SESSION['login_compte']))
if ($type == 1){
$admin = true;	
echo " | <a href='formation_ajout.php'>  Ajouter formation </a>";
}
else{
$admin = false;
}
?>
</h3>

       
       <br>	
       
<center>
   <form name="recherche" action="formation.php" method="post">
           <input type="text" id="recherche_formation" name="recherche" placeholder="recherche"/>
<br>
           <input type="submit" id="recherche_formation_bouton" value="Rechercher" />
<input type="reset" id="recherche_formation_bouton" value="Effacer"/>
           </form>
</center>

           <?php
//moteur de recherche
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
           	$recherche = htmlentities($_POST['recherche']);
if (isset($recherche))
{
$sql = "SELECT * FROM formation, session WHERE libelle_formation LIKE '%".$recherche."%'";
           	 $req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

while ($result = mysqli_fetch_array($req))
{


$id_formation = $result["id_formation"];
$intitule = $result["libelle_formation"];
$id_date = $result["id_date"];

print("<a href=formation_detail.php?id=".$id_formation."><h4> $intitule </h4></a>").(($admin)? "<a href=formation_suppression.php?id=".$id_formation."> Supprimer</a> | <a href=formation_modification.php?id=".$id_formation."> Modifier</a>" : "" );

}
} 

}
else
{

// Affichage de toutes les formations, avec leur dates et les formateurs
$sql = "SELECT * FROM formation 
LEFT JOIN session ON formation.id_date = session.id_date 
LEFT JOIN formateur ON formation.id_formateur = formateur.id_formateur";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

//Affichage des résultats//

while ($result = mysqli_fetch_array($req))
{
$id_formation = $result["id_formation"];
$intitule = $result["libelle_formation"];
$id_date = $result["id_date"];
$date = $result["date_debut"];
$date2 = $result["date_fin"];
print("<a href=formation_detail.php?id=".$id_formation."> <h4> $intitule </h4></a>").(($admin)? "<a href=formation_suppression.php?id=".$id_formation."> Supprimer</a> | <a href=formation_modification.php?id=".$id_formation."> Modifier</a>" : "" );	
print($date);
print(' - ');
print($date2);
}

}


?>
           
   </body>
</html>