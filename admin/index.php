<?php
include '../include/header.php';
include '../include/config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article</title>
    <link rel="stylesheet" href="../css/index.css">
</head>

<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small>Ajouter Blog</small></a></h2>
    <?php 
    try {
        $stmt = $conn->query(          
        "SELECT articles.*, categories.nomCategorie AS category_name, user.name AS author_name
        FROM articles 
        JOIN categories ON articles.id_categories = categories.Id_categorie
        JOIN user ON articles.id_user = user.id
        ORDER BY articles.id_article DESC"
     );
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div style="clear: both; margin-bottom: 50px;">
            <div style="width: 100%;">
                <h3 style="color: #3883fc; margin: 0px;">
                    <a href="./view.php?id=<?php echo $row['Id_article']; ?>" style="color: #3883fc;"><?php echo htmlspecialchars($row['Titre']); ?></a>
                </h3>
                <small style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Category: <?php echo htmlspecialchars($row['category_name']); ?></small>
                <small style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <small class="article-author" style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars(substr($row['Contenu'], 0, 300)) . "..."; ?></p>
            </div>
            
            <p style="font-family: calibri;">
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="./view.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
            </p>
        </div>
        <br><hr><br>
    <?php
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
</div>

<?php include '../include/footer.php'; ?>