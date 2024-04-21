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
        try
        {
            require_once "/home/arnaud/acarepo/cinema/header.php";
            require_once "/home/arnaud/acarepo/cinema/dbconex.php";
            require_once "/home/arnaud/acarepo/cinema/creatable.php";
            require_once "/home/arnaud/acarepo/cinema/creafilter.php";
        }
        
        catch(Exception $e)
        {
            echo 'Une erreur est survenue ! : ' . $e->getMessage();
            die();
        }
    ?>
    <div class="page-content">
        <div class="sidebar">
            <form action="" method="post">
                <?php
                    try
                    {
                        $query = $pdo->query('SELECT movie.title AS \'movie title\',movie.rating AS \'movie rating\',genre.name AS \'genre name\',distributor.name AS \'distributor name\', movie_schedule.date_begin AS \'movie_schedule date_begin\' FROM movie,movie_genre,genre,distributor,movie_schedule WHERE rating LIKE \'%\' AND title LIKE \'%\' AND date_begin LIKE \'%\' AND movie.id=movie_genre.id_movie AND movie_genre.id_genre=genre.id AND movie.id_distributor=distributor.id AND movie.id=movie_schedule.id_movie ORDER BY date_begin ASC, title ASC');
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
            <a class="a-btn" href="addsession.php">Progammer une session</a>
        </div>
        <div class="table">
            <?php
                try
                {
                    $query = $pdo->prepare('SELECT rating,title,genre.name,distributor.name,date_begin FROM movie,movie_genre,genre,distributor,movie_schedule WHERE movie.id=movie_genre.id_movie AND movie_genre.id_genre=genre.id AND movie.id_distributor=distributor.id AND movie.id=movie_schedule.id_movie AND rating LIKE :rtg AND title LIKE :ttl AND genre.name LIKE :gnr AND distributor.name LIKE :dis AND date_begin LIKE :dtb ORDER BY date_begin ASC, title ASC');
                    if ($_POST['movie_rating']=="") {
                        $query->bindValue(':rtg','%');
                    } else {
                        $query->bindValue(':rtg',trim($_POST['movie_rating']));
                    }
                    $query->bindValue(':ttl','%'.trim($_POST['movie_title']).'%');
                    $query->bindValue(':gnr','%'.trim($_POST['genre_name']).'%');
                    $query->bindValue(':dis','%'.trim($_POST['distributor_name']).'%');
                    $query->bindValue(':dtb','%'.trim($_POST['movie_schedule_date_begin']).'%');
                    $query->execute();
                    $results = $query->fetchAll();
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