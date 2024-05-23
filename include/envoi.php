<?php
include "../include/config.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the data from the form
    if (isset($_POST["titre"], $_POST["categorie"], $_POST["article"], $_POST["user"])) {
        $titre = $_POST["titre"];
        $categorie = $_POST["categorie"];
        $article = $_POST["article"];
        $id_user = $_POST["user"];
        $date = date('Y-m-d H:i:s');

        try {
            // Prepare an SQL statement with placeholders
            $requete = $conn->prepare(
                'INSERT INTO articles (Titre, Contenu, id_user, Date, id_categories) 
                VALUES (?, ?, ?, ?, ?)'
            );

            // Execute the prepared statement with actual values
            $requete->execute([$titre, $article, $id_user, $date, $categorie]);

            // Redirect to view.php after successful insertion
            header("Location: ../admin/index.php?id=$article");
            exit(); // Ensure no further code is executed
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} else {
    try {
        // Fetch category names and user names for the form
        $categories = $conn->query("SELECT Id_categorie, nomCategorie FROM categories")->fetchAll(PDO::FETCH_ASSOC);
        $users = $conn->query("SELECT id, name FROM user")->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

?>