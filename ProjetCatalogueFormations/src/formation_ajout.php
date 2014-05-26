<?php
session_start();
include 'connexionBDD.php';	


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
print("<b><font color=red>BRAVO : formation ajouter</font></b>");

$sql = "INSERT INTO session VALUES ('', '".$date_debut."', '".$date_fin."')";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);
$sql = "SELECT @@identity";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);
$id_date = mysqli_fetch_array($query);
$sql = "INSERT INTO formation VALUES ('', '".$formateur."', '".$id_date[0]."', '".$libelle."', '".$desc."', '".$contenu."', '".$cout."')";
$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);

header( "refresh:2;url=formation.php" );
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
?>
       </header>

<?php
include 'menu.php';

if (isset($_SESSION['login_compte']) && ($_SESSION['type_compte']) == 1)
{
?>

<h3>Ajout de formation </h3>



<?php
include 'script.php';




$sql = "SELECT * FROM formateur";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);


?>

<div id='formation'>
<form action="formation_ajout.php" method="post">

<h4>libelle formation </h4>
<input type="text" name="libelle" />

<br>
<h4>description formation </h4>
<textarea rows="5" cols="50" name="desc" placeholder="Saisir votre texte"></textarea>

<br>
<h4>contenu formation </h4>
<textarea rows="5" cols="50" name="contenu" placeholder="Saisir votre texte"></textarea>
<br>
<h4>cout formation </h4>
<input type="text" id="recherche" name="cout" />
<br>

<h4>Veuillez entrez une date de début : </h4><input onclick="ds_sh(this);" name="date" readonly="readonly" style="cursor: text" />
<h4>Veuillez entrez une date de fin : </h4><input onclick="ds_sh(this);" name="date2" readonly="readonly" style="cursor: text" />
<br>
<h4>Formateur</h4>
<?php
echo'<select name="id_formateur">';
while ($result = mysqli_fetch_array($req))
{

$id_formateur = $result["id_formateur"];
$nom_formateur = $result["nom_formateur"];
$nom_formateur .= ' '.$result["prenom_formateur"];
?>	
<option value="<?php echo $id_formateur; ?>"><?php echo $nom_formateur; ?></option>
<?php
}
echo'</select>';

mysqli_close($db);  

?>
</div>
<input type="submit" id ='recherche_formation_bouton' value="Ajouter" />
</form>



<?php
}
else 
{
echo "<h4><font color='#FF0000'>Accès interdit</font></h4>";
header( "refresh:2;url=index.php" );
}
?>
</body>
</html>