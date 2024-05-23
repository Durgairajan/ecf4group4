<?php
include '../include/header.php';
<<<<<<< HEAD
?>
<link rel="stylesheet" href="../css/index.css">
<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small style="text-align: end;">Ajouter Blog</small></a></h2>
=======
include '../include/config.php';
session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit;
}
?>

<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small>Ajouter Blog</small></a></h2>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
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
<<<<<<< HEAD
                <h3 style="color: #3883fc; margin: 0px;">
                    <a href="../post.php?id=<?php echo $row['Id_article']; ?>" style="color: #3883fc;"><?php echo htmlspecialchars($row['Titre']); ?></a>
                </h3>
                <small style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Category: <?php echo htmlspecialchars($row['category_name']); ?></small>
                <small style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <small class="article-author" style="margin: 0px; background: #3883fc; color: white; padding: 3px; font-size: 10px;">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars(substr($row['Contenu'], 0, 300)) . "..."; ?></p>
            </div>
        <br>
            <p style="font-family: calibri;">
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="view.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
                <a style="background: #3883fc; padding: 5px; color: white; text-decoration: none;" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
=======
                <h3 style="color: blue; margin: 0px;">
                    <a href="../post.php?id=<?php echo $row['Id_article']; ?>" style="color: blue;"><?php echo htmlspecialchars($row['Titre']); ?></a>
                </h3>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Category: <?php echo htmlspecialchars($row['category_name']); ?></small>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <small class="article-author" style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars(substr($row['Contenu'], 0, 300)) . "..."; ?></p>
            </div>
            
            <p style="font-family: calibri;">
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="../post.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
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