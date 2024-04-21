<!DOCTYPE html>
<html lang="en">
<?php
    require_once "/home/arnaud/acarepo/cinema/dbconex.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cinema</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/page-histo.css">
    <link rel="stylesheet" href="style/table.css">
    <script src="script/pagi.js"></script>
</head>
<body>
    <?php 
        require "/home/arnaud/acarepo/cinema/header.php";
        require_once "/home/arnaud/acarepo/cinema/creatable.php";
    ?>
    <div class="page-content">
        <div class="sidebar">
        </div>
        <div class="table">
            <form action="" method="post">
                <?php
                try
                {
                    $query = $pdo->query("SELECT firstname,lastname,id_user FROM membership,user WHERE user.id=membership.id_user ORDER BY firstname");
                    $results = $query->fetchAll();
    
                    echo '<input list="users" id="nom" name="nom" />';
                    echo '<datalist id="users">';
                    foreach ($results as $key => $value) {
                        if (is_array($value)) {
                            $fullname="";
                            $v = 0;
                            foreach ($value as $cle => $valeur) {
                                if (is_string($cle) && is_string($valeur)) {
                                    $fullname = $fullname ." ". $valeur;
                                }
                                if (is_string($cle) && is_int($valeur)) {
                                    $v = $valeur;
                                }
                            }
                            echo "<option value =\"$fullname\"></option>";
                        }
                    }
                    echo '</datalist>';
                }
                
                catch(Exception $e)
                {
                    echo 'Une erreur est survenue ! : ' . $e->getMessage();
                    die();
                }
                ?>
            </form>
            <?php
                try
                {
                    // nom du membre
                    $query = $pdo->prepare('SELECT firstname,lastname FROM user WHERE firstname = :fn_user and lastname = :ln_user');
                    if ($_POST['nom'] != "") {
                        $name = explode(" ",trim($_POST['nom']));
                        $fn = $name[0];
                        $ln = $name[1];
                        $query->bindValue(':fn_user',$fn);
                        $query->bindValue(':ln_user',$ln);
                        $query->execute();
                        $results = $query->fetchAll();
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                $fullname="";
                                $v = 0;
                                foreach ($value as $cle => $valeur) {
                                    if (is_string($cle) && is_string($valeur)) {
                                        $fullname = $fullname ." ". $valeur;
                                    }
                                    if (is_string($cle) && is_int($valeur)) {
                                        $v = $valeur;
                                    }
                                }
                                echo "<h2>$fullname's whatched list</h2>";
                            }
                        }
                    } else {
                        echo '<h2 align="center" style="color:#FF0000">entrer un membre</h2>';
                    }
    
                    // tableau histo
                    $query = $pdo->prepare('SELECT movie.title,movie_schedule.date_begin FROM movie,movie_schedule,membership_log,membership,user WHERE movie.id=movie_schedule.id_movie AND movie_schedule.id=membership_log.id_session AND membership_log.id_membership = membership.id AND membership.id_user=user.id AND user.firstname LIKE :fn_user AND user.lastname LIKE :ln_user');
                    if ($_POST['nom'] != "") {
                        $query->bindValue(':fn_user','%'.$fn.'%');
                        $query->bindValue(':ln_user','%'.$ln.'%');
                        $query->execute();
                        $results = $query->fetchAll();
                        // var_dump($results);
                        creertable($results);
                    }
                }
                
                catch(Exception $e)
                {
                    echo "lol";
                    echo '<br>';
                    var_dump($_POST['nom']);
                    echo '<br>';
                    echo 'Une erreur est survenue ! : ' . $e->getMessage();
                    die();
                }
            ?>
        </div>
    </div>
</body>
</html>