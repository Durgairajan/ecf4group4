<?php
include '../include/header.php';
<<<<<<< HEAD

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid article ID.");
}

$idArticle = (int)$_GET['id'];  // Ensure the ID is an integer

?>

<link rel="stylesheet" href="../css/index.css">

=======
include '../include/config.php';
session_start();

?>

>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small>Ajouter Blog</small></a></h2>
    <?php 
    try {
<<<<<<< HEAD
        $stmt = $conn->prepare(
=======
        $idArticle = $_GET['id'];
        $stmt = $conn->query(          
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
        "SELECT articles.*, 
        categories.nomCategorie AS category_name, 
        user.name AS author_name 
        FROM articles 
        JOIN categories ON articles.id_categories = categories.Id_categorie
        JOIN user ON articles.id_user = user.id
<<<<<<< HEAD
        WHERE Id_article = :idArticle"
        );
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="article">
        <div class="article-content">
            <h2><?php echo htmlspecialchars($row['Titre']); ?></h2>
            <small class="category">Category: <?php echo htmlspecialchars($row['category_name']); ?></small>
            <small class="date">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
            <small class="author">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
            <p><?php echo htmlspecialchars($row['Contenu']); ?></p>
        </div>
        <p class="article-actions">
            <a class="btn" href="../post.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
            <a class="btn" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
            <a class="btn" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
        </p>
    </div>
    <?php
        } else {
            echo "Article not found.";
=======
        WHERE Id_article = $idArticle
        "
     );
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div style="clear: both; margin-bottom: 50px;">
        <div style="width: 100%;">
                <h2 style="text-align: center;">
                    <?php echo htmlspecialchars($row['Titre']); ?>
                </h2>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Category: <?php echo htmlspecialchars($row['category_name']); ?></small>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <small class="article-author" style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars($row['Contenu']); ?></p>
        </div>
        <br>
        <p style="font-family: calibri;">
            <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="../post.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
            <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
            <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
        </p>
    </div>
    <?php
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
    <h2>Commentaires</h2>
<<<<<<< HEAD
    <div class="comment-form">
        <form id="commentForm" action="../include/envoiCommentaire.php" method="post">
            <p>Ajouter un commentaire :</p>
            <textarea name="contenu" required></textarea>
            <select name="user" required>
            <?php 
                try {
                    $stmt = $conn->query("SELECT user.name, user.id FROM user");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $row['id']?>"><?php echo htmlspecialchars($row['name'])?></option>
            <?php
                    }
                } catch(PDOException $e) {
                    echo "Query failed: " . $e->getMessage();
                }
            ?>
=======
    <div style="margin-bottom: 25px;">
        <form action="../include/envoiCommentaire.php" method="post">
            <p>Ajouter un commentaire :</p>
            <textarea name="contenu"></textarea>
            <select name="user">
            <?php 
                try {
                    $idArticle = $_GET['id'];
                    $stmt = $conn->query(          
                    "SELECT user.name, user.id
                    FROM user"
                );
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
            </select>
            <input type="hidden" value="<?php echo $idArticle ?>" name="article" />
            <input type="submit" value="Poster">
        </form>
    </div>
    <?php 
    try {
<<<<<<< HEAD
        $stmt = $conn->prepare(
        "SELECT commentaires.*, user.name AS author_name
        FROM commentaires
        JOIN user ON commentaires.id_user = user.id
        WHERE id_article = :idArticle"
        );
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="comment">
        <small class="date">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
        <small class="author">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
        <p><?php echo htmlspecialchars($row['Contenu']); ?></p>
    </div>
=======
        $stmt = $conn->query(          
        "SELECT commentaires.*,
        user.name AS author_name
        FROM commentaires
        JOIN user ON commentaires.id_user = user.id
        WHERE id_article = $idArticle
        "
     );
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div style="clear: both; margin-bottom: 25px;">
            <div style="width: 100%;">
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <small class="article-author" style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Author: <?php echo htmlspecialchars($row["author_name"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars($row['Contenu']); ?></p>
            </div>
        </div>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
    <?php
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
    <br><hr><br>
</div>

<<<<<<< HEAD
<?php include '../include/footer.php'; ?>
=======
<?php include '../include/footer.php'; ?>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
