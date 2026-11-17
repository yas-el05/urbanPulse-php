<?php
$lieux = require __DIR__ . '/../data/lieux.php';

//Lire ce que l'utilisateur a demandé (vide si rien)
$motCle   = trim($_GET['q'] ?? '');
$quartier = $_GET['quartier'] ?? '';
$type     = $_GET['type'] ?? '';

//Préparer les listes déroulantes à partir des données
$quartiers = array_unique(array_column($lieux, 'quartier'));
$types     = array_unique(array_column($lieux, 'type'));
sort($quartiers);
sort($types);

//Garder seulement les lieux qui correspondent
$resultats = [];
foreach ($lieux as $id => $lieu) {
    if ($motCle !== '' && mb_stripos($lieu['nom'] . ' ' . $lieu['description'], $motCle) === false) {
        continue;
    }
    if ($quartier !== '' && $lieu['quartier'] !== $quartier) {
        continue;
    }
    if ($type !== '' && $lieu['type'] !== $type) {
        continue;
    }
    $resultats[$id] = $lieu;
}

$titre = 'Lieux';
require __DIR__ . '/../includes/header.php';
?>

<h1>Les lieux de Cergy</h1>

<form method="get" action="/lieux.php">
    <label>
        Mot-clé
        <input type="search" name="q" value="<?= htmlspecialchars($motCle) ?>" placeholder="gare, parc…">
    </label>

    <label>
        Quartier
        <select name="quartier">
            <option value="">Tous les quartiers</option>
            <?php foreach ($quartiers as $q): ?>
                <option value="<?= htmlspecialchars($q) ?>" <?= $q === $quartier ? 'selected' : '' ?>>
                    <?= htmlspecialchars($q) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Type
        <select name="type">
            <option value="">Tous les types</option>
            <?php foreach ($types as $t): ?>
                <option value="<?= htmlspecialchars($t) ?>" <?= $t === $type ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Rechercher</button>
    <a href="/lieux.php">Réinitialiser</a>
</form>

<p><?= count($resultats) ?> lieu(x) trouvé(s)</p>

<?php if (count($resultats) === 0): ?>
    <p>Aucun lieu ne correspond à votre recherche.</p>
<?php else: ?>
    <ul>
        <?php foreach ($resultats as $id => $lieu): ?>
            <li>
                <a href="/lieu.php?id=<?= $id ?>"><strong><?= htmlspecialchars($lieu['nom']) ?></strong></a>
                — <?= htmlspecialchars($lieu['type']) ?>
                — <?= htmlspecialchars($lieu['quartier']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>