<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

		<title>Administration Google Maps</title>
		<meta name="description" content="test Google Maps !">
		<meta name="keywords" content="Markitup !">
		<meta name="author" content="Ramanan Manmatharajah">
		<meta name="geo.placename" content="Aurillac-sur-Vendinelle">

		<link rel="stylesheet" href="css/html.css">
		<link rel="stylesheet" href="css/style.css" />
	</head>

	<body>
	<div id="header"></div>
	<section id="content">
		<?php
			require('../id_connexion.php');

			$sql='SELECT * FROM map';
			$req=$bdd->query($sql);

			$filename= "../xml/point.xml";

			if (file_exists($filename)){
				unlink($filename);
			}else{
				//echo "le fichier xml n'existe pas";
			}

			$xml = '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>';
			$xml .= '<markers>';
			while ($point = $req->fetch(PDO::FETCH_OBJ)){

				$xml .= "<marker id='".$point->id."' lng='".$point->longitude."' lat='".$point->latitude."' description='".nl2br("&lt;div class=\"window\"&gt;".$point->ville."&lt;br /&gt;&lt;br /&gt;".$point->description."&lt;/div&gt;")."' />";
			} //fin de la boucle while
			$xml .= '</markers>';

			file_put_contents("$filename",$xml); // ça me permet de créer le fichier xml
			header("location:admin.php"); //ça permet de revenir sur fichier admin pour éviter les clicks
            //header("Content-type: text/xml");
            echo $xml;

        ?>
	</section>

</body>
</html>
