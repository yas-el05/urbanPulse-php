<?php
$lieux = require __DIR__ . '/../data/lieux.php';

$titre = 'Lieux' ;
require __DIR__ . '/../includes/header.php';
?>

<h1>Les lieux de Cergy</h1>

<ul>
    <?php foreach ($lieux as $id => $lieu): ?>
        <li>
            <a href="/lieu.php?id=<?= $id ?>"><strong><?= htmlspecialchars($lieu['nom']) ?></strong></a>
            — <?= htmlspecialchars($lieu['type']) ?>
            — <?= htmlspecialchars($lieu['quartier']) ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php require __DIR__ . '/../includes/footer.php'; ?>