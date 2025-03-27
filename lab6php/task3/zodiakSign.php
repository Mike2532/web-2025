<?php
    $sigsName = [
        'козерог',
        'водолей',
        'рыбы',
        'овен',
        'телец',
        'близнецы',
        'рак',
        'лев',
        'дева',
        'весы',
        'скорпион',
        'стрелец',
        'козерог'
    ];

    function signsBorder (int $month) {
        switch($month){
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                return 21;
                break;
            case 6:
            case 12: 
                return 22;   
                break;
            case 7:
            case 11:
                return 23; 
                break;
            case 8:
            case 9: 
            case 10: 
                return 24;  
        }
    }

    $date = $_POST['zodiakDate'];
    $day = (int)($date[0] . $date[1]);
    $month = (int)($date[3] . $date[4]); 

    if (($day >= signsBorder($month)) && (($day <= 31) && ($day >= 1) && ($month <= 12) && ($month >= 1))) {
        echo $sigsName[$month];
    }
    elseif (!(($day <= 31) && ($day >= 1) && ($month <= 12) && ($month >= 1))) {
        echo "неверно введены данные";
    }
    else {
        echo $sigsName[$month - 1];
    }
?>