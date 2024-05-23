<?php
include '../../include/header.php';
include '../../include/config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="../../style/styleEditDelete.css">
    <title>Supprimer</title>
    
</head>
<body>
    <h1>Supprimer l'Article</h1>

    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
    
    <form method="POST" action="Delete.php">
        <label for="id">Article ID:</label>
        <input type="number" id="ArticleID" name="id" required>

        <div class="Supprimer">
            <button type="submit" class="Supp">Supprimer</button>
            <button class="annuler"><a href="index.php">Annuler</a></button>
        </div>
    </form>
</body>
</html>

<?php include '../../include/footer.php'; ?>