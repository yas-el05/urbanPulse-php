<?php
$ville = "Cergy";
$date = date("d/m/Y");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>UrbanPulse – <?= $ville ?></title>
</head>
<body>
    <h1>UrbanPulse</h1>
    <p>Bienvenue sur le portail de la ville de <?= $ville ?>.</p>
    <p>Nous sommes le <?= $date ?>.</p>
</body>
</html>