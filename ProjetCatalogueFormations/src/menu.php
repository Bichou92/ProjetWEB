<center>
<nav>
<ul class="fancyNav">
<li id="home"><a href="index.php" class="homeIcon">Accueil</a></li>
<li id="news"><a href="formation.php">Formation</a></li>
<?php
if (isset($_SESSION['login_compte']))
{
print("<li id=news><a href=formateur.php>Formateur</a></li>");	
}
?>
<li id="contact"><a href="contact.php">Contact </a></li>
</ul>
<br>
</nav>
</center>
