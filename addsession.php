<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cinema</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/page-base.css">
    <link rel="stylesheet" href="style/table.css">
    <link rel="stylesheet" href="style/page-modi.css">
</head>

<body>
    <?php
    require "/home/arnaud/acarepo/cinema/header.php";
    require_once "/home/arnaud/acarepo/cinema/dbconex.php";
    require_once "/home/arnaud/acarepo/cinema/creatable.php";
    require_once "/home/arnaud/acarepo/cinema/creamodi.php";
    ?>
    <div class="page-content">
        <div class="div-flex">
            <section class="modify-member">
                <h1>Ajouter un nouveau membre</h1>
                <form action="" method="post">
                    <?php
                    try {
                        $query = $pdo->query("SELECT title,id FROM movie");
                        $results = $query->fetchAll();

                        echo '<select id="film" name="film">';
                        echo "<option value =\"\" selectedc>none</option>";
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                    $name = $value[0];
                                    $v = $value[1];
                                    echo "<option value =\"$v\">$name</option>";
                                    // print($value[0] ." ". $value[1]." ". $value[2]);
                                    // print("<br>");
                            }
                        }
                        echo '</select>';
                        echo '</select>';
                        $query = $pdo->query("SELECT name,id FROM room");
                        $results = $query->fetchAll();
                        echo '<select id="room" name="room">';
                        echo "<option value =\"\" selected>none</option>";
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                    $name = $value[0];
                                    $v = $value[1];
                                    echo "<option value =\"$v\">$name</option>";
                                    // print($value[0] ." ". $value[1]." ". $value[2]);
                                    // print("<br>");
                            }
                        }
                        echo '</select>';
                        echo '<input type="datetime-local" id="date" name="date" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}" step="1"/>';
                        echo '<input class="btn-submit" type="submit" value="valider"/>';
                    } catch (Exception $e) {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                    ?>
                </form>
                <?php
                    try {
                        if ($_POST['film']!=="" && $_POST['room']!=="" && $_POST['date']!=="") {
                            // $query = $pdo->query("insert into movie_schedule (id_movie,id_room,date_begin) values (:idm,:idr,:date)");
                            // $query->bindValue(':idm',$_POST['film']);
                            // $query->bindValue(':idr',$_POST['room']);
                            // $query->bindValue(':date',str_replace("T"," ",$_POST['date']));
                            // $query->execute();
                            var_dump($_POST);
                        }
                    } catch (Exception $e) {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                ?>
            </section>
        </div>
    </div>
</body>

</html>