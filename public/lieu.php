<?php
require __DIR__ . '/../includes/db.php';
$lieux = $pdo->query('SELECT id, nom, type, quartier, description FROM lieux ORDER BY nom')->fetchAll(PDO::FETCH_UNIQUE);

// On lit le numéro dans l'adresse (lieu.php?id=...)
$id = (int) ($_GET['id'] ?? 0);
/*
lit le paramètre id. Si l’adresse n’en contient pas 
(quelqu’un tape juste lieu.php), on prend 0 à la place. 
Le ?? veut dire « sinon ».
*/

// Si ce lieu n'existe pas, on affiche une page d'erreur
if (!isset($lieux[$id])) {
    http_response_code(404);
    $titre = 'Lieu introuvable';
    require __DIR__ . '/../includes/header.php';
    echo '<h1>Lieu introuvable</h1>';
    echo '<p><a href="/lieux.php">← Retour à la liste</a></p>';
    require __DIR__ . '/../includes/footer.php';
    exit;
}

$lieu = $lieux[$id]; //récupère le tableau avec les elements d'un lieu 
$titre = $lieu['nom']; // récupère le nom du lieu séléctionné (on l'utilise pour le fichier header)
require __DIR__ . '/../includes/header.php';
?>

<h1><?= htmlspecialchars($lieu['nom']) ?></h1>
<p><strong>Type :</strong> <?= htmlspecialchars($lieu['type']) ?></p>
<p><strong>Quartier :</strong> <?= htmlspecialchars($lieu['quartier']) ?></p>
<p><?= htmlspecialchars($lieu['description']) ?></p>
<p><a href="/lieux.php">← Retour à la liste</a></p>

<?php require __DIR__ . '/../includes/footer.php'; ?>