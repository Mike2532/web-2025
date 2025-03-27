<?php
    function factorial(int $num) {
        if (($num == 1) || ($num == 0)) {
            return 1;
        }
        else {
            return $num * factorial($num - 1);
        }
    }

    $num = $_GET['numberFactorial'];
    echo factorial($num);
?>