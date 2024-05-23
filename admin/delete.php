<?php
$con = mysqli_connect("localhost", "root", "", "ecf4") or die();
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM articles WHERE Id_article='$id' ");
mysqli_query($con, "DELETE FROM commentaires WHERE id_article='$id' ");
echo "<script>window.location.href='javascript:history.go(-1)'</script>";
?>