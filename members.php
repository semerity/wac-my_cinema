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
        require "/home/arnaud/acarepo/cinema/header.php";
        require_once "/home/arnaud/acarepo/cinema/dbconex.php";
        require_once "/home/arnaud/acarepo/cinema/creatable.php";
        require_once "/home/arnaud/acarepo/cinema/creafilter.php";
    ?>
    <div class="page-content">
        <div class="sidebar">
            <form action="" method="post">
                <?php
                    try
                    {
                        $query = $pdo->query('SELECT user.firstname AS \'user firstname\', user.lastname AS \'user lastname\', CASE WHEN membership.id_subscription=1 THEN \'VIP\' WHEN membership.id_subscription=2 THEN \'GOLD\' WHEN membership.id_subscription=3 THEN \'Classic\' ELSE \'Pass Day\' END AS \'membership id_subscription\' FROM user,membership WHERE user.id=membership.id_user ORDER BY firstname');
                        $results = $query->fetchAll();
                        $resun = $results[0];
                        // var_dump($resun);
                        creerfiltre($resun,$pdo);
                    }
                    
                    catch(Exception $e)
                    {
                        echo 'Une erreur est survenue ! : ' . $e->getMessage();
                        die();
                    }
                    ?>
            </form>
            <a class="a-btn" href="modifabo.php">Modifier abonnés</a>
            <a class="a-btn" href="deletabo.php">Supprimer abonnés</a>
            <a class="a-btn" href="addabo.php">Ajouter abonnés</a>
        </div>
        <div class="table">
            <?php
                try
                {
                    $query = $pdo->prepare('SELECT firstname,lastname,CASE WHEN id_subscription=1 THEN \'1 soit VIP\' WHEN id_subscription=2 THEN \'2 soit GOLD\' WHEN id_subscription=3 THEN \'3 soit Classic\' ELSE \'4 soit Pass Day\' END AS \'Abonnement\' FROM user,membership WHERE user.id=membership.id_user AND user.firstname LIKE :ftn AND user.lastname LIKE :ltn AND membership.id_subscription LIKE :sub ORDER BY firstname');
                    $query->bindValue(':ftn','%'.trim($_POST['user_firstname']).'%');
                    $query->bindValue(':ltn','%'.trim($_POST['user_lastname']).'%');
                    $query->bindValue(':sub','%'.trim($_POST['membership_id_subscription']).'%');
                    $query->execute();
                    $results = $query->fetchAll();
                    // var_dump($_POST);
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