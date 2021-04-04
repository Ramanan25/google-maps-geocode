<!DOCTYPE html> 
<html lang="fr"> 
 
	<head>	
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

		<title>Administration Google Maps</title>
		<meta name="description" content="test Google Map !">
		<meta name="keywords" content="Google Map !">
		<meta name="author" content="Ramanan Manmatharajah">
		<meta name="geo.placename" content="Aurillac-sur-Vendinelle">

		<link rel="stylesheet" href="css/html.css">
		<link rel="stylesheet" href="css/style.css" />
		<link href="css/default.css" rel="stylesheet">

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="js/util.js"></script>
	</head>

	<body>
		<div id="header"></div>
        <?php require('server.php');
            $server1 = new Server();
            //$server1->getplace();
        ?>


		<section id="content">
			<h1>Accueil Google Maps !</h1>
            <div><a href="admin/admin.php">Admin</a></div>
			<div>
				<div id="map-canvas"></div>

				<?php
                        $req = $server1->getplace();
                        foreach ($req as $cle => $val )
                        {
                            echo '<div class="comment">';
                            echo '<a class="delete" href="admin/delete.php?p=' . $val['id'] . '"><img src="../images/false.png" /></a>';
                            echo '<h3>' . stripslashes($val['ville']) . '</h3>';
                            echo '<p>Description : ' . stripslashes($val['description']) . '</p>';
                            echo '<p>Longitude : ' . stripslashes($val['longitude']) . '</p>';
                            echo '<p>Latitude : ' . stripslashes($val['latitude']) . '</p>';
                            echo '<p class="edit"><a href="admin/edit.php?p=' . $val['id'] . '">Editer cet article</a></p>';
                            echo '</div>';
                        }
                    require('map.php');
				?>
			</div>
		</section>

	</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
</html>
