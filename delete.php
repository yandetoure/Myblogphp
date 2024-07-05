<?php include('db.php'); ?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM post WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    $error = "Erreur lors de la suppression: " . $conn->error;
}
?>
