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
<br>
           <h1>  Catalogue de formation</h1>
<br>


<?php	
if(isset($_GET["id"]))
{
$id = $_GET["id"];
}
else
{
echo"Erreur";
}	


if (isset($_SESSION['login_compte']) && ($_SESSION['type_compte']) == 1)
{ 

$sql = "DELETE FROM session WHERE id_date IN ( SELECT id_date FROM formation WHERE id_formateur= ".$id." )";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

$sql = "DELETE FROM formation WHERE id_formateur= ".$id."";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

$sql = "DELETE FROM formateur WHERE id_formateur = ".$id."";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);



echo "<h4><font color='#FF0000'>Formateur Supprimer</font></h4>";
header( "refresh:2;url=index.php" );

}
else
{
echo "<h4><font color='#FF0000'>Acc�s interdit</font></h4>";
header( "refresh:2;url=index.php" );
}	
    mysqli_close($db);  

?>

   </body>
</html>