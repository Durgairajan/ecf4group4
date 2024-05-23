<?php
include '../../include/header.php';
include '../../include/config.php';


if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM articles WHERE identifiant = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Article deleted successfully.";
    } else {
        echo "Error deleting article.";
    }
}

include 'DeleteA.php';

