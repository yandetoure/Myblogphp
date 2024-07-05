<?php
include 'db.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    // Préparez la requête SQL avec des paramètres sécurisés
    $sql = "UPDATE post SET title=?, content=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Liaison des paramètres
    $stmt->bind_param("sssi", $title, $content, $image, $article_id);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Article mis à jour avec succès.</div>';
        header("Location: index.php");
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la mise à jour de l\'article : ' . $stmt->error . '</div>';
    }

    // Fermeture de la requête et de la connexion
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2>Modifier un article</h2>
        <?php
        // Récupérez les données de l'article à modifier
        if (isset($_GET['id'])) {
            $article_id = $_GET['id'];
            $sql = "SELECT * FROM post WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $article_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($row['image']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($row['content']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
                <?php
            } else {
                echo '<div class="alert alert-danger">Article non trouvé.</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="alert alert-danger">Identifiant d\'article non spécifié.</div>';
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
