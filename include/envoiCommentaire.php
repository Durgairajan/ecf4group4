<?php
<<<<<<< HEAD
include "config.php";
=======
include "../include/config.php";
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023

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

<<<<<<< HEAD
            // Redirect to view.php after successful insertion
            header("Location: ../admin/view.php?id=$article");
            exit(); // Ensure no further code is executed
=======
            echo "Comment posted successfully!";
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
<<<<<<< HEAD
}
?>
=======
} 

?>
>>>>>>> 48515ce37b34e94839c8a3a836203759237b3023
