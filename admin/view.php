<?php
include '../include/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID article invalide.");
}

$idArticle = (int)$_GET['id'];  // verifie que id est un integer

?>

<link rel="stylesheet" href="../css/index.css">

<div class="more">
    <h2 class="h2admin">Votre post<a href="post.php"><small>Ajouter Blog</small></a></h2>
    <?php 
    try {
        $stmt = $conn->prepare(
        "SELECT articles.*, 
        categories.nomCategorie AS category_name, 
        user.name AS author_name 
        FROM articles 
        JOIN categories ON articles.id_categories = categories.Id_categorie
        JOIN user ON articles.id_user = user.id
        WHERE Id_article = :idArticle"
        );
        $stmt->bindParam(':idArticle', $idArticle, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="article">
        <div class="article-content">
            <h2><?php echo htmlspecialchars($row['Titre']); ?></h2>
            <small class="category">Categorie : <?php echo htmlspecialchars($row['category_name']); ?></small>
            <small class="date">Date : <?php echo htmlspecialchars($row["Date"]); ?></small>
            <small class="author">Auteur : <?php echo htmlspecialchars($row["author_name"]); ?></small>
            <p><?php echo htmlspecialchars($row['Contenu']); ?></p>
        </div>
        <p class="article-actions">
            <a class="btn" href="../post.php?id=<?php echo $row['Id_article']; ?>">Voir plus </a>
            <a class="btn" href="edit.php?id=<?php echo $row['Id_article']; ?>">Editer le post</a>
            <a class="btn" href="delete.php?id=<?php echo $row['Id_article']; ?>">Supprimer</a>
        </p>
    </div>
    <?php
        } else {
            echo "Article non trouvé.";
        }
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
    ?>
    <h2>Commentaires</h2>
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
            </select>
            <input type="hidden" value="<?php echo $idArticle ?>" name="article" />
            <input type="submit" value="Poster">
        </form>
    </div>
    <?php 
    try {
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
        <small class="date">Date : <?php echo htmlspecialchars($row["Date"]); ?></small>
        <small class="author">Auteur : <?php echo htmlspecialchars($row["author_name"]); ?></small>
        <p><?php echo htmlspecialchars($row['Contenu']); ?></p>
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
