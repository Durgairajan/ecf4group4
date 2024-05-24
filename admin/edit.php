<?php
include "../include/config.php";
include "../include/header.php";

$updateMode = false;
$postId = null;
$titre = ''; // Initialiser $titre
$article = ''; // Initialiser $article

// Vérifier si nous sommes en mode édition
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $updateMode = true;

    // Récupérer les données existantes de l'article
    try {
        $stmt = $conn->prepare("SELECT * FROM articles WHERE Id_article = ?");
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            die("Error: Post not found.");
        }

        // Définir les champs du formulaire avec les données existantes de l'article
        $titre = $post['Titre'];
        $categorie = $post['id_categories'];
        $article = $post['Contenu'];
        $id_user = $post['id_user'];
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// Récupérer les noms des catégories et des utilisateurs pour le formulaire
try {
    $categories = $conn->query("SELECT Id_categorie, nomCategorie FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    $users = $conn->query("SELECT id, name FROM user")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_newarticle.css">
    <title></title>
</head>
<body>
    <h1>Modifier Article</article>
    </h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postId); ?>">

        <label for="titre">Titre de l'article :</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($titre); ?>" required><br><br>

        <label for="article">Contenu :</label>
        <textarea id="article" name="article" required><?php echo htmlspecialchars($article); ?></textarea><br><br>

        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
            <?php
            if (isset($categories)) {
                foreach ($categories as $row) {
                    $selected = ($row['Id_categorie'] == $categorie) ? 'selected' : '';
                    echo '<option value="' . $row['Id_categorie'] . '" ' . $selected . '>' . $row['nomCategorie'] . '</option>';
                }
            }
            ?>
        </select><br>

        <label for="user">Auteur :</label>
        <select id="user" name="user" required>
            <?php
            if (isset($users)) {
                foreach ($users as $row) {
                    $selected = ($row['id'] == $id_user) ? 'selected' : '';
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                }
            }
            ?>
        </select><br><br>

        <input type="submit" class="envoyer" value="Mise à jour ">
        <br><br>
    </form>
</body>
</html>
<?php
include "../include/footer.php";
?>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    if (isset($_POST["titre"], $_POST["categorie"], $_POST["article"], $_POST["user"], $_POST["post_id"])) {
        $titre = $_POST["titre"];
        $categorie = $_POST["categorie"];
        $article = $_POST["article"];
        $id_user = $_POST["user"];
        $postId = $_POST["post_id"];
        $date = date('Y-m-d H:i:s');

        try {
            // Préparer une déclaration SQL avec des espaces réservés
            $requete = $conn->prepare(
                'UPDATE articles SET Titre = ?, Contenu = ?, id_user = ?, Date = ?, id_categories = ? WHERE Id_article = ?'
            );

            // Exécuter la déclaration préparée avec les valeurs réelles
            $requete->execute([$titre, $article, $id_user, $date, $categorie, $postId]);

            echo "Article mis à jour avec succès !";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont requis.";
        

    }
}
?>
