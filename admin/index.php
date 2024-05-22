<?php
include 'include/header.php';
include 'include/config.php';
session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit;
}
?>

<div class="more">
    <h2 class="h2admin">Votre poste <a href="post.php"><small>Ajouter Blog</small></a></h2>
    <?php 
    try {
        $stmt = $conn->query("SELECT * FROM articles ORDER BY Id_article DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div style="clear: both; margin-bottom: 50px;">
            <div style="width: 100%;">
                <h3 style="color: blue; margin: 0px;">
                    <a href="../post.php?id=<?php echo $row['Id_article']; ?>" style="color: blue;"><?php echo htmlspecialchars($row['Titre']); ?></a>
                </h3>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Category: <?php echo htmlspecialchars($row['id_categories']); ?></small>
                <small style="margin: 0px; background: blue; color: white; padding: 3px; font-size: 10px;">Date: <?php echo htmlspecialchars($row["Date"]); ?></small>
                <p style="color: black;"><?php echo htmlspecialchars(substr($row['Contenu'], 0, 300)) . "..."; ?></p>
            </div>
            
            <p style="font-family: calibri;">
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="../post.php?id=<?php echo $row['Id_article']; ?>">Read More</a>
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="edit.php?id=<?php echo $row['Id_article']; ?>">Edit Post</a>
                <a style="background: blue; padding: 5px; color: white; text-decoration: none;" href="delete.php?id=<?php echo $row['Id_article']; ?>">Delete</a>
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

<?php include 'include/footer.php'; ?>