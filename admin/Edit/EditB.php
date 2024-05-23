<?php
include '../include/header.php';
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire de modification
    if (isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['author'], $_POST['category_id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE articles SET titre = :title, contenu = :content, auteur = :author, categorie_id = :category_id WHERE identifiant = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Article modifié avec succès.";
        } else {
            $message = "Erreur lors de la modification de l'article.";
        }
    } else {
        $message = "Tous les champs sont requis.";
    }
} else {
    // Récupération des informations de l'article à modifier
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM articles WHERE identifiant = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$article) {
            die("Article non trouvé.");
        }
    } else {
        die("ID de l'article non spécifié.");
    }
}
include 'Edit.html';
