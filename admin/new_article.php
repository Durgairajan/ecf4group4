<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article</title>
    <link rel="stylesheet" href=".style/style_newarticle.css">
</head>

<body>
    <!-- Header non définitif -->
    <header>
        <a href="index.php">Accueil</a>
        <p>Blog - Groupe 4</p>
    </header>
    <h1>Nouvel article</article>
    </h1>
    <form action="envoi.php" method="POST">
        <!-- Structure de la page -->
        <label for="titre">Titre de l'article :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" required>


            <option value="">Choississez la catégorie</option>
            <option value="1">Sport</option>
            <option value="2">Voyage</option>
            <option value="3">Cuisine</option>

            <!-- La "value" correspond à l'"id_categorie" -->
            <!--  -->
        </select>

        <label for="article">Contenu :</label>
        <textarea id="article" name="article" required></textarea>

        <!-- La division ci dessous a un but décoratif -->
        <div class="sortie">
            <button type="submit" class="envoyer">Publier</button>
            <button class="annuler"><a href="index.php">Annuler</a></button>
        </div>
    </form>

    <!-- Footer non définitif -->
    <footer>
        <p>Copyright 2024 - Lucas, Mustapha, Rajan, Dan, Nanji.</p>
    </footer>
</body>

</html>















<?php
// include "envoi.php";
include "include/config.php" ?>