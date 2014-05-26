<?php
session_start();

if (!empty($_POST))
{
foreach($_POST as $key => $valeur)
{
$$key = $valeur;
}
// controle d'intégrité//
if(($login=="") or ($password==""))
{
$erreur="Merci de remplir les champs obligatoires !";
}

elseif(!empty($_POST))
{
// connexion à la base
//$db = mysql_connect('localhost', 'root', '')  or die('Erreur de connexion '.mysql_error());
// sélection de la base
//mysql_select_db('cdf',$db)  or die('Erreur de selection '.mysql_error());
include("connexionBDD.php");


// Recherche mot de passe du login
$sql = "SELECT * FROM compte WHERE login_compte = '".$login."' and mdps_compte = '".$password."' ";
$req = mysqli_query($db, $sql) or die('Erreur SQL : <br />'.$sql);

// Verif que l'utilisateur existe
if (mysqli_num_rows($req) > 0)
{
$data = mysqli_fetch_assoc($req);

$_SESSION['id_compte'] = $data['id_compte'];
$_SESSION['login_compte'] = $data['login_compte'];
$_SESSION['mail_compte'] = $data['mail_compte'];
$_SESSION['mdps_compte'] = $data['mdps_compte'];
$_SESSION['type_compte'] = $data['type_compte'];
$_SESSION['nom_compte'] = $data['nom_compte'];

// header("location: index.php");
// header("Location: " . $_SERVER["HTTP_REFERER"]);
// header ("Location: $_SERVER[HTTP_REFERER]");
// echo $_SERVER[HTTP_REFERER];

echo"<script type='text/javascript'>";
echo "history.go(-2)";
echo "</script>";
exit();
}
else
{
$erreur="L'identifiant ou le mot de passe est erroné !";
}

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
<h2>  <a href=index.php> Accueil </a> | <a href=inscription.php>S'inscrire</a></h2>

       </header>
    <form name="connexion" action="login.php" method="post">
       <?php if(isset($erreur))
{
echo "<h4><font color='#FF0000'>$erreur</font></h4>";
}
?>     
       <center>

           <div id="login" name="login">
               <h4>Login </h4> <br>
               <input type="text" name="login" placeholder="Login">
               <br>
               <br>
               <h4>Mot de passe </h4> <br>
               <input type="password" placeholder="Password" name="password">
               <br>
               <br>
   
           </div>
               <input type="submit" name="name" value="Valider" />
           </center>
       </form>
<footer>Qui sommes-ous ? - Plan du site - Mentions légales - Contact</footer>
           
   </body>
</html>