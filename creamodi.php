<?php
try
{
    function creermodi($array,$po) {
        foreach ($array as $key => $value) {
            if (is_string($key)) {
                if (strpos($key,"title")!==false) {
                    $tf = explode(" ",$key);
                    $tab = $tf[0];
                    $field = $tf[1];
                    $query = $po->query("SELECT DISTINCT $field from $tab");
                    $results = $query->fetchAll();
                    echo "<h3>$tab $field</h3>";
                    echo "<input list=\"$field $tab\" id=\"$tab $field\" name=\"$tab $field\"/>";
                    echo "<datalist id=\"$field $tab\">";
                    foreach ($results as $key => $value) {
                        if (is_array($value)) {
                            foreach ($value as $cle => $valeur) {
                                $distab = [];
                                if (is_string($cle)) {
                                    if (!in_array($valeur,$distab)) {
                                        array_push($distab,$valeur);
                                        $vf = str_replace("\"","",$valeur);
                                        echo "$vf";
                                        echo '<option value ="'.$vf.'"></option>';
                                    } else {
                                        array_push($distab,$valeur);
                                    }
                                }
                            }
                        }
                    }
                    echo '</datalist>';
                } else {
                    $tf = explode(" ",$key);
                    $tab = $tf[0];
                    $field = $tf[1];
                    $query = $po->query("SELECT DISTINCT $field from $tab");
                    $results = $query->fetchAll();
                    echo "<h3>$tab $field</h3>";
                    echo "<select id=\"$tab $field\" name=\"$tab $field\"/>";
                    echo '<option value="" selected>tous</option>';
                    foreach ($results as $key => $value) {
                        if (is_array($value)) {
                            foreach ($value as $cle => $valeur) {
                                $distab = [];
                                if (is_string($cle)) {
                                    if (!in_array($valeur,$distab)) {
                                        array_push($distab,$valeur);
                                        $st = array(" ");
                                        $rt = array("_");
                                        $vf = str_replace($st,$rt,$valeur);
                                        echo "$vf";
                                        echo "<option value ='$vf'>$vf</option>";
                                    } else {
                                        array_push($distab,$valeur);
                                    }
                                }
                            }
                        }
                    }
                    echo '</select>';
                }
            }
        }
        echo "<br>";
        echo "<br>";
        echo '<input class="btn-submit" type="submit" value="Valider"/>';
    }
}


catch(Exception $e)
{
    echo 'Une erreur est survenue ! : ' . $e->getMessage();
    die();
}
?>