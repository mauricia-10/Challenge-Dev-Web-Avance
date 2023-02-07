<?php 

require_once 'db.php';

try{
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

if (isset($_POST['envoyer'])) {
    $nom = $_POST['name'];
    $request = ("INSERT INTO `argonaute`(`nom`) VALUES (:nom)");
    $statement = $pdo->prepare($request);
    $statement->bindParam(':nom', $nom);
    $statement->execute();
    header('Location:/');exit();
}

$query = $pdo->query('SELECT * FROM argonaute');
$argonautes = $query->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Challenge Dev Web Avancé</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>

    <body>

        <!-- Header section -->
        <header>
            <h1>
                <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
                Les Argonautes
            </h1>
        </header>

        <!-- Main section -->
        <main>
        
            <div class="container">
                <!-- New member form -->
                <h2>Ajouter un(e) Argonaute</h2>

                <form class="new-member-form" action="" method="POST">
                    <label for="name">Nom de l&apos;Argonaute</label>
                    <input id="name" name="name" type="text" placeholder="Charalampos" />
                    <button type="submit" name="envoyer">Envoyer</button>
                </form>
                
                <!-- Member list -->
                <h2>Membres de l'équipage</h2>

                <section class="member-list">
                    <?php foreach ($argonautes as $argonaute) : ?>
                        <div class="member-item"><?= $argonaute->nom ?></div>
                    <?php endforeach ?>
                </section>
            </div>

        </main>

        <footer>
            <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
        </footer>
        
    </body>
</html>