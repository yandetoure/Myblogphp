<?php
include 'db.php';
include 'navbar.php';

// Vérifie si l'id de l'article est présent dans l'URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Requête pour récupérer les détails de l'article
    $sql = "SELECT * FROM post WHERE id = $article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .article-container {
            background-color: #f8f9fa; /* Couleur de fond gris clair */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }
        .article-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .article-content {
            font-size: 18px;
            line-height: 1.6;
        }
        img.img-fluid{
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Ombre légère */
            overflow: hidden; /* Pour ne pas dépasser la largeur de l'image */
            object-fit: cover; /* Pour que l'image se redimensionne pour occuper toute la largeur de la colonne */
        }
        .article-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="article-container">
                    <div class="article-center">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger ml-2">Supprimer</a>
                        <a href="index.php" class="btn btn-secondary ml-2">Retour à la liste</a>
                    </div>
                    <h1 class="article-center"><?php echo $row['title']; ?></h1>
                    <div class="image"><?php echo '<img src="' . $row['image'] . '" class="img-fluid" alt="Image">'; ?></div>
                    <p class="text-muted">Publié le <?php echo date('d/m/Y', strtotime($row['created_at'])); ?></p>
                    <p class="article-content"><?php echo $row['content']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        echo '<p class="text-muted">Aucun article trouvé avec cet identifiant.</p>';
    }
} else {
    echo '<p class="text-muted">Identifiant d\'article non spécifié.</p>';
}
?>
