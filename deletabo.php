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
            <section class="delete-member">
                <h1>Supprimer un membre</h1>
                <form action="" method="post">
                    <?php
                    try {
                        $query = $pdo->query("SELECT firstname,lastname,membership.id FROM user JOIN membership ON user.id=membership.id_user");
                        $results = $query->fetchAll();

                        echo '<select id="member" name="member">';
                        echo "<option value =\"\" selectedc>none</option>";
                        foreach ($results as $key => $value) {
                            if (is_array($value)) {
                                if ($value[2] !== NULL) {
                                    $fullname = $value[0] ." ". $value[1];
                                    $v = $value[2];
                                    echo "<option value =\"$v\">$fullname</option>";
                                    // print($value[0] ." ". $value[1]);
                                    // print("<br>");
                                }
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
                        if ($_POST['member']!=="") {
                            // $query = $pdo->query("DELETE FROM membership WHERE id = :idm");
                            // $query->bindValue(':idm',$_POST['user']);
                            // $query->execute();
                            print($_POST['member']);
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