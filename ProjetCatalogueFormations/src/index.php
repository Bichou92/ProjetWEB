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

<h3>Catalogue de formation</h3>

<p>
Bienvenue

</p>

<center>
Vous trouverez dans notre catalogue le descriptif détaillé de chacune des formations que la maison des ligues de Lorraine vous propose.
<br>
Vous aurez aussi la possibilité  de vous inscrire à ces formations par le biais de votre compte. Si vous en disposez pas vous pouvez vous inscrire.
<br>
Pour tous renseignements ou problèmes n'hésitez pas à nous contacter via la page contact.
</center>







       <footer>Cataloge de formation © 2013 Emmanuel BISCHOFF. All rights reserved.	</footer>
           
   </body>
</html>