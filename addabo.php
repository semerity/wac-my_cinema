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
            <section class="add-member">
                <h1>Ajouter un nouveau membre</h1>
                <form action="" method="post">
                    <?php
                    try {
                        $query = $pdo->query("SELECT firstname,lastname,user.id,id_subscription FROM user LEFT JOIN membership ON user.id=membership.id_user ORDER BY id_subscription");
                        $results = $query->fetchAll();

                        echo '<select id="user" name="user">';
                        echo "<option value =\"\" selectedc>none</option>";
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                if ($value[3] === NULL) {
                                    $fullname = $value[0] ." ". $value[1];
                                    $v = $value[2];
                                    echo "<option value =\"$v\">$fullname</option>";
                                    // print($value[0] ." ". $value[1]." ". $value[2]);
                                    // print("<br>");
                                }
                            }
                        }
                        echo '</select>';
                        echo '</select>';
                        $query = $pdo->query("SELECT id,name FROM subscription ORDER BY id");
                        $results = $query->fetchAll();
                        echo '<select id="subscription" name="subscription">';
                        echo "<option value =\"\" selected>none</option>";
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                $subname="";
                                $v = 0;
                                foreach ($value as $cle => $valeur) {
                                    if (is_string($cle) && is_string($valeur)) {
                                        $subname = $valeur;
                                        print($subname);
                                    }
                                    if (is_string($cle) && is_int($valeur)) {
                                        $v = $valeur;
                                        print($v);
                                    }
                                }
                                echo "<option value =\"$v\">$subname</option>";
                            }
                        }
                        echo '</select>';
                        echo '<input class="btn-submit" type="submit" value="valider"/>';
                    } catch (Exception $e) {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                    ?>
                </form>
                <?php
                    try {
                        if ($_POST['user']!=="" && $_POST['subscription']!=="") {
                            // $query = $pdo->query("insert into membership (id_user,id_subscription,date_begin) values (:idu,:ids,:date)");
                            // $query->bindValue(':idu',$_POST['user']);
                            // $query->bindValue(':ids',$_POST['subscription']);
                            // $query->bindValue(':date',gmdate('Y-m-d h:i:s'));
                            // $query->execute();
                        }
                        // var_dump($_POST);
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