<?php
include '../include/header.php';
include '../include/config.php';
session_start();

?>

<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small>Ajouter Blog</small></a></h2>
    <?php 
    try {
        $idArticle = $_GET['id'];
        $stmt = $conn->query(          
        "SELECT articles.*, 
        categories.nomCategorie AS category_name, 
        user.name AS author_name 
        FROM articles 
        JOIN categories ON articles.id_categories = categories.Id_categorie
        JOIN user ON articles.id_user = user.id
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
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
    <h2>Commentaires</h2>
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
            </select>
            <input type="hidden" value="<?php echo $idArticle ?>" name="article" />
            <input type="submit" value="Poster">
        </form>
    </div>
    <?php 
    try {
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
    <?php
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
    <br><hr><br>
</div>

<?php include '../include/footer.php'; ?>