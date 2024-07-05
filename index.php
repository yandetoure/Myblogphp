<?php
include 'db.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .carousel-item {
            height: 500px;
            position: relative;
        }
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        .carousel-caption {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 20px;
            width: 80%;
            border-radius: 10px;
        }
        .carousel-caption h1 {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .titre {
            margin-top: 15px;
            font-weight: 600;
        }
        .text {
            margin-top: 10px;
        }
        .article-image {
            max-height: 400px; /* Définir la hauteur maximale souhaitée pour les images */
            object-fit: cover;
            width: 100%; /* Assure que la largeur s'adapte à la taille du conteneur */
        }
        .carousel{
            margin-top: -40px;
        }
        h3{
            text-align: center;
            margin-bottom: 15px;
            margin-top: -20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Carrousel -->
        <div id="carouselExampleSlidesOnly" class="carousel slide mb-5" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/téléchargement (3).jpeg" alt="Slide 1">
                    <div class="carousel-caption">
                        <h1>Les femmes au cœur du monde de la technologie</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/téléchargement (4).jpeg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption">
                        <h1>Le Grand Magal de Touba un Pélérinage typiquement sénégalais</h1>
                    </div>
                </div>
                <!-- Ajoutez d'autres slides ici -->
            </div>
        </div>

        <!-- Liste des articles par paire -->
        <h3>Articles</h3>
        <?php if (isset($_SESSION['user_id'])): ?>
        <?php endif; ?>
        <div class="row">
            <?php
            $sql = "SELECT * FROM post";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6 mb-4">';
                    echo '<a href="more.php?id=' . $row['id'] . '" class="list-group-item list-group-item-action">';
                    echo '<img src="' . $row['image'] . '" class="img-fluid article-image" alt="Image">';
                    echo '<h5 class="mb-1 titre">' . $row['title'] . '</h5>';
                    echo '<p class="mb-1 text">' . substr($row['content'], 0, 100) . '...</p>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-muted">Aucun article trouvé.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>