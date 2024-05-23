<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article</title>
    <link rel="stylesheet" href="../css/style_newarticle.css">
</head>

<body>
<!-- modif temp envoi -> envoi-test -->
    <?php
    include "../include/envoi.php";
    include "../include/header.php"; ?>

    <h1>Nouvel article</article>
    </h1>

<!-- modif temp envoi -> envoi-test -->
    <form action="../include/envoi.php" method="POST">
        <!-- Structure de la page -->
        <label for="titre">Titre de l'article :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" required>
        <?php
            if (isset($categories)) {
                foreach ($categories as $row) {
                    echo '<option value="' . $row['Id_categorie'] . '">' . $row['nomCategorie'] . '</option>';
                }
            }
            ?>
             </select><br>
             <label for="user">Auteur</label>
        <select id="user" name="user" required>
            <?php
            if (isset($users)) {
                foreach ($users as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            ?>
        </select>
        
        

            <!-- La "value" correspond à l'"id_categorie" -->
        </select>

        <label for="article">Contenu :</label>
        <textarea id="article" name="article" required></textarea>

        <!-- La division ci dessous a un but décoratif -->
        <div class="sortie">
            <button type="submit" class="envoyer">Publier</button>
            <button class="annuler"><a href="index.php">Annuler</a></button>
        </div>
    </form>
    <?php include "../include/footer.php" ?>

</body>

</html>