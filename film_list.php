<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cinema</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/page-base.css">
    <link rel="stylesheet" href="style/table.css">
    <script src="script/pagi.js"></script>
</head>
<body>
    <?php
        require_once "./header.php";
        require_once "./dbconex.php";
        require_once "./creatable.php";
        require_once "./creafilter.php";
    ?>
    <div class="page-content">
        <div class="sidebar">
            <form action="" method="post">
                <?php
                    try
                    {
                        $query = $pdo->query('SELECT movie.title AS \'movie title\',movie.rating AS \'movie rating\',genre.name AS \'genre name\',distributor.name AS \'distributor name\' FROM movie,movie_genre,genre,distributor WHERE rating LIKE \'%\' AND title LIKE \'%\' AND movie.id=movie_genre.id_movie AND movie_genre.id_genre=genre.id AND movie.id_distributor=distributor.id');
                        $results = $query->fetchAll();
                        $resun = $results[0];
                        creerfiltre($resun,$pdo);
                    }
                    
                    catch(Exception $e)
                    {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                ?>
            </form>
        </div>
        <div class="table">
            <?php
            try
            {
                $query = $pdo->prepare('SELECT movie.rating,movie.title,genre.name AS \'genre\',distributor.name AS \'distributor\' FROM movie,movie_genre,genre,distributor WHERE movie.id=movie_genre.id_movie AND movie_genre.id_genre=genre.id AND movie.id_distributor=distributor.id AND movie.rating LIKE :rtg AND movie.title LIKE :ttl AND genre.name LIKE :gnr AND distributor.name LIKE :dis');
                if ($_POST['movie_rating']=="") {
                    $query->bindValue(':rtg','%');
                } else {
                    $query->bindValue(':rtg',trim($_POST['movie_rating']));
                }
                $query->bindValue(':ttl','%'.trim($_POST['movie_title']).'%');
                $query->bindValue(':gnr',trim($_POST['genre_name']).'%');
                $query->bindValue(':dis',trim($_POST['distributor_name']).'%');
                $query->execute();
                $results = $query->fetchAll();
                // var_dump($results);
                creertable($results);
            }
            
            catch(Exception $e)
            {
                echo 'Une erreur est survenue ! : ' . $e->getMessage();
                die();
            }
            ?>
        </div>
    </div>
</body>
</html>