<?php
include '../include/header.php';
include '../include/config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l' Article</title>
    <link rel="stylesheet"  href="../../style/styleEditDelete.css">
    
</head>
<body>
   
    <h1>Modifier l' Article</h1>

    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
    
    <form action="Edit.php" method="POST" >
<!--         <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
 -->    <label for="title">Titre:</label>
        <input type="text" id="titre" name="title" required>

        <label for="content">Contenu:</label>
        <textarea name="content" id="content" required></textarea>

        <label for="author">Auteur:</label>
        <input type="text" id="auteur" name="author" required>

        <label for="category_id">categorie_id :</label>
        <input type="number" name="category_id" required>

<div class="sortie">
    <button type="submit" class="envoyer">Modifier</button>
    <button class="annuler"><a href="index.php">Annuler</a></button>
</div>
</form>
</body>
</html>

<?php include '../include/footer.php'; ?>