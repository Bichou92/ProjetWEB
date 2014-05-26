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

$libelle = $_POST['libelle'];	
$desc = $_POST['desc'];
$contenu = $_POST['contenu'];
$cout = $_POST['cout'];
$date_debut = $_POST['date'];
$date_fin = $_POST['date2'];
$formateur = $_POST['id_formateur'];

if ($libelle == "")
{
print("<b><font color=red>Veuillez saisir un libelle</font></b>");
}
elseif ($desc == "")
{
print("<b><font color=red>Veuillez saisir une description</font></b>");
}
elseif ($contenu == "")
{
print("<b><font color=red>Veuillez saisir un contenu</font></b>");
}
elseif ($cout == "")
{
print("<b><font color=red>Veuillez saisir un cout</font></b>");
}
elseif (!is_numeric($cout))
{
print("<b><font color=red>Veuillez saisir un nombre pour le cout</font></b>");
}
elseif ($date_debut == "")
{
print("<b><font color=red>Veuillez selectionner une date de début </font></b>");
}
elseif ($date_fin == "")
{
print("<b><font color=red>Veuillez selectionner une date de fin</font></b>");
}
elseif ($formateur == "")
{
print("<b><font color=red>Veuillez choisir un formateur</font></b>");
}	
elseif ($cout == "")
{
print("<b><font color=red>Veuillez saisir un cout</font></b>");
}
elseif ($date_debut > $date_fin)
{
print("<b><font color=red>Date incorecte</font></b>");
}
else
{

$sql = "UPDATE formation SET id_formateur = '".$formateur."', libelle_formation = '".$libelle."', desc_formation = '".$desc."', contenu_formation = '".$contenu."', cout_formation = '".$cout."' WHERE id_formation = '".$id."' ";	
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);

$sql = "UPDATE session SET date_debut = '".$date_debut."', date_fin = '".$date_fin."' WHERE id_date = (SELECT id_date FROM formation WHERE id_formation = '".$id."' ) ";	
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);

print("<b><font color=red>BRAVO : formation modifier</font></b>");




header( "refresh:2;url=formation.php" );
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


<h3>Modification Formation</h3>


<?php	
$sql = "SELECT * FROM formation
LEFT JOIN session ON formation.id_date = session.id_date
WHERE id_formation = ".$id."";

$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql); 
$data = mysqli_fetch_array($req);

$titre = $data['libelle_formation'];
$description = $data['desc_formation'];
$contenu = $data['contenu_formation'];
$cout = $data['cout_formation'];
$date = $data['date_debut'];
$date2 = $data['date_fin'];
$id_formateur = $data['id_formateur'];

$sql = "SELECT * FROM formateur";

$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql); 





include 'script.php';

if (isset($_SESSION['login_compte']) && ($_SESSION['type_compte']) == 1)
{ 
print("<div id='formation'");
print("<form name='modification' action='formation_modification.php?id=".$id."' method='post'>");

print("<h4>Titre</h4>");
print("<input type='text' name='libelle' value='".$titre."'>");
print("<h4>Description</h4> ");
print("<textarea rows='5' cols='50' name='desc' >".$description."</textarea>");
print("<h4>Contenu</h4> ");
print("<textarea rows='5' cols='50' name='contenu' >".$contenu."</textarea>");
print("<h4>Cout</h4> ");
print("<input type='text' name='cout' value='".$cout."'>");
print("<h4>Date début</h4> ");
print("<input onclick='ds_sh(this);' name='date' value='".$date."' readonly='readonly' style='cursor: text' />");
print("<h4>Date fin</h4> ");
print("<input onclick='ds_sh(this);' name='date2' value='".$date2."' readonly='readonly' style='cursor: text' />");	
print("<h4>Formateur</h4>");

echo"<select name='id_formateur'>";
while ($data = mysqli_fetch_array($req))
{
$id_formateur = $data["id_formateur"];
$formateur = $data["nom_formateur"];
$formateur .= ' '.$data["prenom_formateur"];
print("<option value ='".$id_formateur."'> ".$formateur." </option>");
}
echo'</select>';
print("</div>");

print("<input type='submit' id ='recherche_formation_bouton' name='valider' value='Valider' />");

print("</form>");

}
else
{
echo "<h4><font color='#FF0000'>Accès interdit</font></h4>";
header( "refresh:2;url=index.php" );
}	
?>

   </body>
</html>