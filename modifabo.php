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
                <h1>Modifier l'abonnement d'un membre</h1>
                <form action="" method="post">
                    <?php
                    try {
                        $query = $pdo->query("SELECT firstname,lastname,id_user FROM membership,user WHERE user.id=membership.id_user ORDER BY firstname");
                        $results = $query->fetchAll();
        
                        echo '<select id="member" name="member">';
                        echo "<option value =\"\" selectedc>none</option>";
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
                                echo "<option value =\"$v\">$fullname</option>";
                            }
                        }
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
                        // var_dump($results);
                    } catch (Exception $e) {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                    ?>
                </form>
                <?php
                    try {
                        if ($_POST['member']!=="" && $_POST['subscription']!=="") {
                            $query = $pdo->query("update membership set id_subscription=:ids where membership.id=:idm");
                            $query->bindValue(':idm',$_POST['member']);
                            $query->bindValue(':ids',$_POST['subscription']);
                            $query->execute();
                            // var_dump($_POST);
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