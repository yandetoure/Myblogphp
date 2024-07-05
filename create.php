<?php
include 'db.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    // Vérification que le contenu a au moins 100 caractères
    if (strlen($content) < 100) {
        echo '<div class="alert alert-danger">Le contenu doit comporter au moins 100 caractères.</div>';
    } else {
        // Préparation de la requête SQL sécurisée
        $sql = "INSERT INTO post (title, content, image, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $content, $image, $user_id);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Article créé avec succès.</div>';
            header("Location: index.php");
        } else {
            echo '<div class="alert alert-danger">Erreur lors de la création de l\'article : ' . $conn->error . '</div>';
        }

        // Fermeture de la requête et de la connexion
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2>Créer un article</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Publier</button>
        </f
