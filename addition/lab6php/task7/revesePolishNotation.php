<?php
    function operation(int $a, int $b, string $operand) {
        switch ($operand) {
            case '+':
                return $a + $b;
                break;
            case '-':
                return $a - $b; 
                break;
            case '/': 
                return $a / $b;
                break;
            default:
                return $a * $b;
        }
    }

    $expression = preg_split('/\s+/', trim($_POST['expression']));
    $numbers = [];
   
    $error = true;
    if (isset($expression)) {

        foreach($expression as $element) {
            if (is_numeric($element)) {
                $numbers[] = (int)$element;
            } elseif (in_array($element, ['+', '-', '*', '/']))  {
                $number_size = count($numbers); 
                $numbers[$number_size - 2] = operation($numbers[$number_size - 2], $numbers[$number_size - 1], $element);
                array_splice($numbers, $number_size - 1);
            } else {
                break;
            }
        }
        if (count($numbers) == 1) {
            $error = false;
            echo $numbers[0];
        }
    }
    if ($error) {
        echo "something went wrong";
    }
?>