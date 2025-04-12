<?php
    function summOfNumberDigit(int $a) {
        return (int) substr((string) $a, 0, 1) + (int) substr((string) $a, 1, 1) +  (int) substr((string) $a, 2, 1); 
    }

    $rangeStart = (int) $_POST['rangeStart'];
    $rangeEnd = (int) $_POST['rangeEnd'];

    for ($i = $rangeStart; $i < $rangeEnd; $i++ ) {
        if (summOfNumberDigit($i % 1000) == summOfNumberDigit((int) substr((string) $i, 0, 3))) {
            echo "<p>$i</p>";
        }
    }

    echo (int) 40.1;
?>