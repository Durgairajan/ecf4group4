<?php
include "../include/config.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the data from the form
    if (isset($_POST["contenu"], $_POST["article"], $_POST['user'])) {
        $user = $_POST['user'];
        $contenu = $_POST["contenu"];
        $article = $_POST["article"];
        $date = date('Y-m-d H:i:s');

        try {
            // Prepare an SQL statement with placeholders
            $requete = $conn->prepare(
                'INSERT INTO commentaires (Contenu, id_article, Date, id_user) 
                VALUES (?, ?, ?, ?)'
            );

            // Execute the prepared statement with actual values
            $requete->execute([$contenu, $article, $date, $user]);

            echo "Comment posted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} 

?>