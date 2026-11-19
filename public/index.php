<?php
$titre = 'Accueil';
$ville = 'Cergy';

require __DIR__ . '/../includes/db.php';
$nbLieux = $pdo->query('SELECT count(*) FROM lieux')->fetchColumn();

require __DIR__ . '/../includes/header.php';
?>
<h1> Bienvenue à <?= $ville ?></h1>
<p> <?=$nbLieux?> lieux sont référencés à <?= $ville ?>.</p>
<a href="/lieux.php">Découvrir les lieux -></a>
<p>UrbanPulse est le portail d'informations de la ville de <?= $ville ?>.</p>
<p>Nous sommes le <?= date('d/m/Y') ?>.</p>

<?php require __DIR__ . '/../includes/footer.php'; ?>