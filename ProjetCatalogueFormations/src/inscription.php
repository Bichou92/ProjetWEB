<?php
include("connexionBDD.php");

if (!empty($_POST))
{
$nom = $_POST['name'];	
$prenom = $_POST['surname'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$mail = $_POST['mail'];
$mail_confirm = $_POST['mail_confirm'];
$login = $_POST['login'];


if ($nom == "")
{
print("<b><font color=red>Veuillez saisir votre nom</font></b>");
}
elseif ($prenom == "")
{
print("<b><font color=red>Veuillez saisir votre prenom</font></b>");
}

elseif ($password == "")
{
print("<b><font color=red>Veuillez saisir votre mot de passe</font></b>");
}
elseif ($password_confirm == "")
{
print("<b><font color=red>Veuillez confirmer votre mot de passe</font></b>");
}
elseif ($password != $password_confirm)
{
print("<b><font color=red>error pass confirm</font></b>");
}
elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL))
{
print("<b><font color=red>Format mail invalide</font></b>");
}
elseif ($mail != $mail_confirm)
{
print("<b><font color=red>error mail confirm</font></b>");
}
else 
{
print("<b><font color=red>BRAVO : vous etes inscrit</font></b>");

$sql = "INSERT INTO compte VALUES ('', '".$login."', '".$mail."', '".$password."', '2', '".$nom."', '".$prenom."')";

$query = mysqli_query($db, $sql) or die ("Erreur" .$sql);
    mysqli_close();  
header("location: index.php");
}

}
mysqli_close($db);  
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
<h2> Inscription </h2>
       </header>
       
       <center>
            <form name="inscription" action="inscription.php" method="post">
               <div name="login" id="login">

                   <h4>Nom</h4> <br>
               	<input type="text" name="name" placeholder="Nom">
               	<br>
                   
               	<h4>Prénom</h4> <br>
               	<input type="text" name="surname" placeholder="Prénom">
               	<br>

               	
               	<h4>Login </h4> <br>
               	<input type="text" name="login" placeholder="Login">
               	<br>
                   
                   <h4>Mail </h4> <br>
               	<input type="email" name="mail" >
               	<br>
                   
                   <h4>Confirmer votre adresse mail </h4> <br>
               	<input type="email" name="mail_confirm" >
               	<br>
                   
                   <h4>Mots de passe </h4> <br>
               	<input type="password" name="password" >
               	<br>
                   
                   <h4>Confirmer votre mots de passe </h4> <br>
               	<input type="password" name="password_confirm" >
                  <br>
                   <br>  
                   <br>
               </div>
               <center><input type="submit" name="valider" value="Valider" /></center>
            </form>	

       <footer>Qui sommes-ous ? - Plan du site - Mentions légales - Contact</footer>
           
   </body>
</html>