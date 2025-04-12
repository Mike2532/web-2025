<?php
    function translater(int $number) {
        switch ($number) {
            case 0:
                return 'ноль';
                break;
            case 1:
                return 'один';
                break;
            case 2:
                return 'два';
                break;
            case 3:
                return 'три';
                break;
            case 4:
                return 'четыре';
                break;
            case 5:
                return 'пять';
                break;
            case 6:
                return 'шесть';
                break;  
            case 7:
                return 'семь';
                break;
            case 8:
                return 'восемь';
                break;
            case 9:
                return 'девять';
                break;
            default:
                return 'введены неверные данные';   
        }     
    }     
    echo translater($_POST['numberToTranslate']);
?>