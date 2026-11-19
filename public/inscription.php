<?php 
$titre = 'Inscription';
require __DIR__ . '/../includes/db.php';
$erreurs = [];
$succes = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){ //savoir si le formulaire a été envoyé
    $login = trim($_POST['login'] ?? '');
    $mdp = ($_POST['mdp'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if($login === ''){
        $erreurs[] = 'Le login est obligatoire';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
        $erreurs[] = 'Adresse mail invalide ';
    }
    if(strlen($mdp)<8){
        $erreurs[]='Le mot de passe doit faire au moins 8 caractères';
    }

    if(count($erreurs)===0){
        $params = [];
        $sql ='SELECT COUNT(*) FROM utilisateurs WHERE (login = :login) OR (email = :email) ';
        $params['login'] = $login;
        $params['email'] = $email;

        $requete = $pdo->prepare($sql);
        $requete->execute($params);
        $nbComptes = $requete->fetchColumn();
        if($nbComptes>0){
            $erreurs[]='Ce login ou cette adresse email est déjà utilisé';
        }

        if(count($erreurs)===0){
            $mdpHache = password_hash($mdp, PASSWORD_DEFAULT);
            $params['mdp'] = $mdpHache ;

            $sql1 ='INSERT INTO utilisateurs(login, email, mdp) VALUES(:login, :email, :mdp)';
            $requete = $pdo->prepare($sql1);
            $requete->execute($params);
            $succes = 'Votre compte a été créé !';
        }
    }
}

require __DIR__ . '/../includes/header.php';
?>

<h1>Créer un compte</h1>
<?php if(count($erreurs) > 0 ):?>
    <?php foreach($erreurs as $erreur):?>
        <p><?= htmlspecialchars($erreur) ?></p>
    <?php endforeach;?>
<?php endif;?>
<?php if($succes !== ''): ?>
    <p><?= htmlspecialchars($succes)?> </p>
<?php endif; ?>


<form method="post" action="/inscription.php">
    <label>
        Login
        <input type="text" name="login" required>
    </label>
    <label>
        Email
        <input type="email" name="email" required>
    </label>
    <label>
        Mot de passe
        <input type="password" name="mdp" required>
    </label>
    <button type="submit">Créer un compte</button>

</form>


<?php 
require __DIR__ . '/../includes/footer.php';
?>