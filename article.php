<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
showarticle();
if (isset($_SESSION['role'])) {
	if ($_SESSION['role'] == 'admin') {
		ajoutarticle();
	}
}
footer();
echo "</body>";
?>