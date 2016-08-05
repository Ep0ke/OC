<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <title>Mon super site</title>
    </head>
 
    <body>
     <?php
    	 	include("connexion_test.php");
    ?>

    <!-- Ajout d'un commentaire-->
    
    <div id="conteneur_gauche">
	    <h1>JNo Messenger</h1>
	    <!--Formulaires pour tchater -->
	    <?php 
	    	if (empty($_SESSION['pseudo']))
	    	{
	    ?>
	    		<form method ="POST" action="miniChat_post.php">
	    		<h2>Bonjour bienvenue sur mon tchat!!  Veuillez saisir votre pseudo</h2>	    		
	    		<input type= "text" name="pseudo">
	    		<p> et votre premier message</p>
	    		<TEXTAREA name="messages" rows=4 cols=40></TEXTAREA><br /><br />
	    		<input type="submit" name="commencer" value="commencer le tchat">
	    		</form>
	    <?php	
	    	}
	    	else
	    	{ 
	    ?>
	    <h3>Vous envoyez actuellement des messages sous le nom de :<br /> <span id="couleurPseudo"><u>"<?php echo htmlspecialchars($_SESSION['pseudo']); ?>"</u></span></h3>
	    <p>Pour changer de pseudo, veuillez entrer un nouveau nom dans le champ "pseudo"</p>	    
	    <form method="POST"  action="miniChat_post.php" >
	    	 <a>pseudo : </a><input type ="text" name="pseudo" <?php echo 'value="'.$_SESSION['pseudo']. '"'; ?>><!--recupération du pseudo grace à une session pour préremplir le champ-->
	    	 <p>Message : </p> <TEXTAREA name="messages" rows=4 cols=40></TEXTAREA><br /><br />
	    	 <input type="submit" name="soumettre" value="tchatter">
	    </form>
	    <?php
	    	}
	    ?>
	    <!--Formulaires pour tchater -->
	    </div>
	    
	    <div id="conteneur_droite">
	    <!--Affichage des messages du tchat-->
	    <h2>Liste des derniers messages</h2>
	    	<?php
	    		$req=$bdd->query('SELECT DATE_FORMAT(date_message,\' %d / %m / %Y à %H h %i\') AS date_formate , pseudo , messages FROM t_message ORDER BY date_message DESC LIMIT 0,10');
	    	?>
	    		<table>
	    			<tr class="entete">
	    				<td class="largeurDate"><b>Date</b></td>
	    				<td class="largeurPseudo"><b>Pseudo</b></td>
	    				<td class="largeurMessages"><b>Message</b></td>
	    			</tr>
	    	<?php	while ($donnees=$req->fetch()) 
	    		{

	    			echo '<tr class="lignes"><td class="tailleDates">'.$donnees['date_formate'].'</td><td class="largeurPseudo">'.htmlspecialchars($donnees['pseudo']).'</td><td class="largeurMessages">'.htmlspecialchars($donnees['messages']).'</td></tr>';
	    		}
	    		echo '</table>';
	    	$req->closeCursor();
	    	?>
	    	<br /><br />
	    	<a href="historiq.php">Afficher l'historique des messages</a>
	    <!--Affichage des messages du tchat-->
	    </div>
	 
	    	<!--Ceci est une seconde partie-->


    </body>
</html>