<?php
    try
    {
        function creertable($tabres) {
            if ($tabres == []) {
                echo '<h1 style="color:#FF0000" align="center">YA RIEN POUR CES TRUCS SALE MERDE</h1>';
            } else {
                $ANC = [];
                $len = 0;
                // var_dump($tabres);
                foreach ($tabres as $key => $value) {
                    // var_dump(is_array($value));
                    if (is_array($value)) {
                        foreach ($value as $cle => $val) {
                            // var_dump(${$cle} !== NULL);
                            if (${$cle} !== NULL) {
                                array_push(${$cle}, $val);
                                $len = count(${$cle});
                            } else {
                                // var_dump(!is_int($cle));
                                if (!is_int($cle)) {
                                    ${$cle} = [];
                                    array_push($ANC, $cle);
                                    array_push(${$cle}, $val);
                                    $len = count(${$cle});
                                }
                            }
                        }
                    } else {
                        var_dump($value);
                        echo "erreur <br>";
                    }
                }
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                foreach ($ANC as $key => $value) {
                    echo "<td colspan=\"1\">$value</td>";
                }
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                for ($i = 0; $i < $len; $i++) {
                    echo "<tr>";
                    foreach ($ANC as $key => $value) {
                        echo "<td>" . ${$value}[$i] . "</td>";
                        // echo ${$value}[$i];
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo '<div><button class="btn btn-back">←</button><button class="btn btn-numb">1</button><button class="btn btn-next">→</button></div>';
            }
        }
    }

    catch(Exception $e)
    {
        echo 'Une erreur est survenue ! : ' . $e->getMessage();
        die();
    }

?>