<?php
$lieux = require __DIR__ . '/../data/lieux.php';

//Lire ce que l'utilisateur a demandé (vide si rien)
$motCle   = trim($_GET['q'] ?? '');
$quartier = $_GET['quartier'] ?? '';
$type     = $_GET['type'] ?? '';

//Préparer les listes déroulantes à partir des données
$quartiers = array_unique(array_column($lieux, 'quartier'));
$types     = array_unique(array_column($lieux, 'type'));
sort($quartiers); //trie par ordre alphabétique
sort($types);

//Garder seulement les lieux qui correspondent
$resultats = [];
foreach ($lieux as $id => $lieu) {
    if ($motCle !== '' && mb_stripos($lieu['nom'] . ' ' . $lieu['description'], $motCle) === false) {
        /*
        si un mot-clé est rempli (!== '') et qu’on ne le trouve ni dans le nom ni dans la description, 
        on écarte le lieu. 
        mb_stripos cherche un texte dans un autre sans tenir compte des majuscules. 
        Elle renvoie false si elle ne trouve rien. Le mb_ permet de bien gérer les accents.
        */
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
        <!-- q stocke ce que l'utilisateur tape (on le voit dans l'adresse aussi) -->
    </label>

    <label>
        Quartier <!-- c'est ce qui s'affiche à côté d'un input search  -->
        <select name="quartier"> <!-- crée une liste déroulante -->
            <option value="">Tous les quartiers</option> <!-- les <option> sont les options du menu déroulant, elles sont soit selected ou pas -->
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