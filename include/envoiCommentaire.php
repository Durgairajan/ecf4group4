<?php
include "config.php";

// verification si la methode utilisee est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperations des infos du formulaire
    if (isset($_POST["contenu"], $_POST["article"], $_POST['user'])) {
        $user = $_POST['user'];
        $contenu = $_POST["contenu"];
        $article = $_POST["article"];
        $date = date('Y-m-d H:i:s');

        try {
            // Preparation de la requete SQL
            $requete = $conn->prepare(
                'INSERT INTO commentaires (Contenu, id_article, Date, id_user) 
                VALUES (?, ?, ?, ?)'
            );

            // Execution de la requete preparee
            $requete->execute([$contenu, $article, $date, $user]);

            // redicection vers view.php si tout est bon
            header("Location: ../admin/view.php?id=$article");
            exit(); // stop du code ici
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs requis ne sont pas remplis.";
    }
}
?>
