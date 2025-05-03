<?php
    function summOfNumberDigit(int $a): int {
        return (int) ($a % 10) + (int) ($a % 100 / 10) + (int) ($a / 100);
    }

    $rangeStart = (int) $_POST['rangeStart'];
    $rangeEnd = (int) $_POST['rangeEnd'];

    for ($i = $rangeStart; $i < $rangeEnd; $i++ ) {
        if (summOfNumberDigit((int)($i % 1000)) == summOfNumberDigit((int)($i / 1000))) {
            echo "<p>$i</p>";
        }
    }

    echo ((int) (7.8))
?>

