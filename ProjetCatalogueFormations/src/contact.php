<?php
   define( 'MAIL_TO', /* >>>>> */'nabil.abbach@.fr'/* <<<<< */ );  //ajouter votre courriel
   define( 'MAIL_FROM', 'Votre adresse mail' ); // valeur par d?faut
   define( 'MAIL_OBJECT', 'objet du message' ); // valeur par d?faut
   define( 'MAIL_MESSAGE', 'vofreetre message' ); // valeur par d?faut

   $mailSent = false; // drapeau qui aiguille l'affichage du formulaire OU du r?capitulatif
   $errors = array(); // tableau des erreurs de saisie
   
   if( filter_has_var( INPUT_POST, 'send' ) ) // le formulaire a ?t? soumis avec le bouton [Envoyer]
   {
       $from = filter_input( INPUT_POST, 'from', FILTER_VALIDATE_EMAIL );
       if( $from === NULL || $from === MAIL_FROM ) // si le courriel fourni est vide OU ?gale ? la valeur par d?faut
       {
           $errors[] = 'Vous devez renseigner votre adresse de courrier &eacute;lectronique.';
       }
       elseif( $from === false ) // si le courriel fourni n'est pas valide
       {
           $errors[] = 'L\'adresse de courrier &eacute;lectronique n\'est pas valide.';
           $from = filter_input( INPUT_POST, 'from', FILTER_SANITIZE_EMAIL );
       }

       $object = filter_input( INPUT_POST, 'object', FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW );
       if( $object === NULL OR $object === false OR empty( $object ) OR $object === MAIL_OBJECT ) // si l'objet fourni est vide, invalide ou ?gale ? la valeur par d?faut
       {
           $errors[] = 'Vous devez renseigner l\'objet.';
       }

       /*     pas besoin de nettoyer le message. 
       /    http://www.phpsecure.info/v2/article/MailHeadersInject.php
       /    Logiquement, les parties message, To: et Subject: pourraient servir aussi ? injecter quelque chose,     mais la fonction mail()
       /    filtre bien les deux derni?res, et la premi?re est le message, et ? partir du moment o? on a saut? une ligne dans l'envoi du mail,
       /    c'est consid?r? comme du texte; le message ne saurait donc rester qu'un message.*/
       $message = filter_input( INPUT_POST, 'message', FILTER_UNSAFE_RAW );
       if( $message === NULL OR $message === false OR empty( $message ) OR $message === MAIL_MESSAGE ) // si le message fourni est vide ou ?gale ? la valeur par d?faut
       {
           $errors[] = 'Vous devez &eacute;crire un message.';
       }

       if( count( $errors ) === 0 ) // si il n'y a pas d'erreurs
       {
           if( mail( MAIL_TO, $object, $message, "From: $from\nReply-to: $from\n" ) ) // tentative d'envoi du message
           {
               $mailSent = true;
           }
           else // ?chec de l'envoi
           {
               $errors[] = 'Votre message n\'a pas &eacute;t&eacute; envoy&eacute;.';
           }
       }
   }
   else // le formulaire est affich? pour la premi?re fois, avec les valeurs par d?faut
   {
       $from = MAIL_FROM;
       $object = MAIL_OBJECT;
       $message = MAIL_MESSAGE;
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
   <head>
       <title>Contact</title>
       <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
       <meta http-equiv="content-language" content="fr" />
       <style type="text/css">
html{ font-family:Geneva, Arial, Helvetica, sans-serif; margin:0; padding:0; font-size:.88em;}
body{ width:772px; margin:0 auto; padding:0; }
textarea{ width:772px; }
label{ display:block; font-weight:bold; }
p#welcome{ padding:10px 20px; border:1px dotted #00f; color:#00f; font-weight:bold; }
ul{ padding:10px 20px; border:1px dotted #f00; color:#f00; font-weight:bold; }
p#success{ padding:10px 20px; border:1px dotted #0f0; color:#0f0; font-weight:bold; }
p em{ display:block; font-weight:normal; }
       </style>
   </head>
   <body>
       <h1>Contact</h1>
       <hr />
<?php
   if( $mailSent === true ) // si le message a bien ?t? envoy?, on affiche le r?capitulatif
   {
?>
       <p id="success">Votre message a bien &eacute;t&eacute; envoy&eacute;.</p>
       <p><strong>Courriel pour la r&eacute;ponse&nbsp;:</strong><br /><?php echo( $from ); ?></p>
       <p><strong>Objet&nbsp;:</strong><br /><?php echo( $object ); ?></p>
       <p><strong>Message&nbsp;:</strong><br /><?php echo( nl2br( htmlspecialchars( $message ) ) ); ?></p>
<?php
   }
   else // le formulaire est affich? pour la premi?re fois ou le formulaire a ?t? soumis mais contenait des erreurs
   {
       if( count( $errors ) !== 0 )
       {
           echo( "\t\t<ul>\n" );
           foreach( $errors as $error )
           {
               echo( "\t\t\t<li>$error</li>\n" );
           }
           echo( "\t\t</ul>\n" );
       }
       else
       {
           echo( "\t\t<p id=\"welcome\"><em>Tous les champs sont obligatoires</em></p>\n" );
       }
?>
       <form id='contact' method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">
           <p>
               <label for="from">Courriel pour la r&eacute;ponse</label>
               <input type="text" name="from" id="from" value="<?php echo( $from ); ?>" />
           </p>
           <p>
               <label for="object">Objet</label>
               <input type="text" name="object" id="object" value="<?php echo( $object ); ?>" />
           </p> 
           <p>
               <label for="message">Message</label>
               <textarea name="message" id="message" rows="20" cols="80"><?php echo( $message ); ?></textarea>
           </p>
           <p>
               <input type="reset" name="reset" value="Effacer" />
               <input type="submit" name="send" value="Envoyer" />
           </p>
       </form>
<?php
   }
?>
   </body>
</html>