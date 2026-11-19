<?php
require __DIR__ . '/../includes/db.php';
$lieux = $pdo->query('SELECT id, nom, type, quartier, description FROM lieux ORDER BY nom')->fetchAll(PDO::FETCH_UNIQUE);

//Lire ce que l'utilisateur a demandé (vide si rien)
$motCle   = trim($_GET['q'] ?? '');
$quartier = $_GET['quartier'] ?? '';
$type     = $_GET['type'] ?? '';

//Préparer les listes déroulantes à partir des données
$quartiers = array_unique(array_column($lieux, 'quartier'));
$types     = array_unique(array_column($lieux, 'type'));
sort($quartiers); //trie par ordre alphabétique
sort($types);

$sql = 'SELECT id, nom, type, quartier, description FROM lieux WHERE 1=1';
$params = [];

if($motCle !== ''){
    $sql .= ' AND (nom LIKE :motCle1 OR description LIKE :motCle2)';
    $params['motCle1'] = '%' . $motCle . '%';
    $params['motCle2'] = '%' . $motCle . '%';
}

if($quartier !== ''){
    $sql .= ' AND quartier = :quartier';
    $params['quartier'] = $quartier;
}
if($type !== ''){
    $sql .= ' AND type = :type';
    $params['type'] = $type;
}

$sql .= ' ORDER BY nom';

$requete = $pdo->prepare($sql);
$requete->execute($params);
$resultats = $requete->fetchAll(PDO::FETCH_UNIQUE);


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
        Quartier <!-- c'est ce qui s'affsiche à côté d'un input search  -->
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