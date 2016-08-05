<!DOCTYPE html>
<html>
	<head>
		<title>Minichat</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<meta charset="utf-8" />
	</head>
	
	<body>
		<h1> Voici mon minichat </h1>

		<!--  recherche du pseudo précédent dans un cookie-->
	
		<?php if (isset($_COOKIE['pseudo']))
		{ 
			$affichage=$_COOKIE['pseudo'];
		}
		else
		{
			$affichage='';
		}?>
		
		<!-- affichage du formulaire -->
		
		<div id="formulaire">
			<form action="minichat_post.php" method="post">
				<p> <label> Pseudo : <input type="text" name="pseudo" value=<?php echo $affichage ?> /> </label> </p>
				<p> <label> Message : <input type="text" name="message" /> </label> </p>
				<p> <input type="submit" value="Envoyer"  /> </p>
			</form>
		</div>
		
		<!-- affichage de tous les messages de la base de donnée -->
		
		<?php
			$bdd = new PDO('mysql:host=localhost;dbname=test3','root','');
			$reponse = $bdd -> query('SELECT pseudo,message,
				DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS date_creation
				FROM minichat ORDER BY id DESC LIMIT 0,10');
			while ($donnees = $reponse -> fetch())
			{
				echo '<p>' 	. htmlspecialchars($donnees['date_creation']). ' -  
							<strong>'. htmlspecialchars($donnees['pseudo']) . '</strong> : ' 
							. htmlspecialchars($donnees['message']) . '</p>';
			}
			
		?>
		
	</body>
</html>



