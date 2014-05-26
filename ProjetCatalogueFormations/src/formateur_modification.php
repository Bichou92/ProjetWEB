<?php
session_start();
include 'connexionBDD.php';	


if(isset($_GET["id"]))
{
$id = $_GET["id"];
}
else
{
echo"Erreur";
}




if (!empty($_POST))
{
$nom = $_POST['nom'];	
$prenom = $_POST['prenom'];

if ($nom == "")
{
print("<b><font color=red>Veuillez saisir votre nom</font></b>");
}
elseif ($prenom == "")
{
print("<b><font color=red>Veuillez saisir votre prenom</font></b>");
}	
else
{
print("<b><font color=red>Formateur modifier</font></b>");

$sql = "UPDATE formateur SET nom_formateur = '".$nom."', prenom_formateur = '".$prenom."' WHERE id_formateur = '".$id."'";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);
header( "refresh:2;url=formateur.php" );
}
}
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


<h3>Modification Formateur</h3>


<?php	

$sql = "SELECT * FROM formateur WHERE id_formateur = '".$id."'";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);
$data = mysqli_fetch_array($req);

$nom_formateur = $data['nom_formateur'];
$prenom_formateur = $data['prenom_formateur'];



if (isset($_SESSION['login_compte']) && ($_SESSION['type_compte']) == 1)
{ 

print("<form name='modification' action='formateur_modification.php?id=".$id."' method='post'>");

print("<h4>Nom</h4>");
print("<input type='text' name='nom' value='".$nom_formateur."'>");
print("<h4>Prenom</h4> ");
print("<input type='text' name='prenom' value='".$prenom_formateur."'>");
print("<br>"); 
print("<br>");
print("<input type='submit' name='valider' value='Valider' />");

print("</form>");

}
else
{
echo "<h4><font color='#FF0000'>Acc?s interdit</font></h4>";
header( "refresh:2;url=index.php" );
}	
?>

   </body>
</html>