<?php
    define('MIN_YEAR', 1900);
    define('MAX_YEAR', 2025);
    define('MIN_SHORT_YEAR', 0);
    define('MAX_SHORT_YEAR', 25);
    define('MIN_DAY', 1);
    define('MAX_DAY', 31);
    define('MIN_MONTH', 1);
    define('MAX_MONTH', 12);
    define('DATE_PARTS', 3);
    define('FIRST_ELEM', 0);
    define('SECOND_ELEM', 1);
    define('THIRD_ELEM', 2);


    function writeSign(int $day, int $month): void {
        $signsBorder = function(int $month) {
          switch($month) {
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
        };

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
    

        if ($day >= $signsBorder($month)) {
            echo $sigsName[$month];
        } else {
            echo $sigsName[$month - 1];
        }

        die();
    }

    function getWordMonth(string $monthName): bool|int {
        $monthsEng = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        $monthsRus = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

        $monthNumber = array_search($monthName, $monthsEng) | array_search($monthName, $monthsRus);
        if ($monthNumber) {
            return ++$monthNumber;
        } else {
            return false;
        }
    }

    function getSpliterAndValidate(string $str, int $lengt): string|bool {
        $splits = ['.', '-', '/', ' '];
        for ($i = 0; $i < $lengt; $i++) {
            $symbol = mb_substr($str, $i, 1);
            if (in_array($symbol, $splits)) {
                if (substr_count($str, $symbol) == 2) {
                    $regularSymbol = preg_quote($symbol, '/');
                    if (preg_match("/^[a-zа-я0-9,{$regularSymbol}]+$/u", $str)) {
                        return $symbol;
                    }
                }
            }
        }
        return false;
    }
    
    function isValidDay($day) {
        return $day >= MIN_DAY && $day <= MAX_DAY;
    }

    function isValidMonth($month) {
        return $month >= MIN_MONTH && $month <= MAX_MONTH;
    }

    function isValidYear($year) {
        return ($year >= MIN_YEAR && $year <= MAX_YEAR) || ($year >= MIN_SHORT_YEAR && $year <= MAX_SHORT_YEAR);
    }



    if (isset($_POST['date'])) {
        $unparsedDate = strtolower(trim($_POST['date']));
        $unparsedDate = preg_replace('/\s+/', ' ', $unparsedDate);
        $unparsedDate = mb_strtolower($unparsedDate);
        $lengt = mb_strlen($unparsedDate);
        
        $spliter = getSpliterAndValidate($unparsedDate, $lengt);
    
        if ($spliter) {
            $unparsedDate = explode($spliter, $unparsedDate);
            if (count($unparsedDate) == DATE_PARTS) {
                $firstElem = $unparsedDate[FIRST_ELEM];
                $secondElem = $unparsedDate[SECOND_ELEM];
                $thirdElem = $unparsedDate[THIRD_ELEM];

                if (is_numeric($firstElem) && is_numeric($secondElem) && is_numeric($thirdElem)) {
                    $firstElem = (int) $firstElem;
                    $secondElem = (int) $secondElem;
                    $thirdElem = (int) $thirdElem;
                    //DD.MM.YYYY / DD.MM.YY
                    //DD-MM-YYYY / DD-MM-YY
                    //DD/MM/YYYY / DD/MM/YY
                    //DD MM YYYY / DD MM YY
                    if ( isValidDay($firstElem) && isValidMonth($secondElem) && isValidYear($thirdElem)) {
                        writeSign($firstElem, $secondElem);
                    } eslseif (isValidMonth($firstElem) && isValidDay($secondElem) && isValidYear($thirdElem)) {
                        //MM.DD.YYYY / MM.DD.YY
                        //MM-DD-YYYY / MM-DD-YY
                        //MM/DD/YYYY / MM/DD/YY
                        //MM DD YYYY / MM DD YY
                        writeSign($secondElem, $firstElem);
                    }
                } elseif (!is_numeric($firstElem) && is_numeric($secondElem) && is_numeric($thirdElem)) {
                    // Month.DD.YYYY / Month.DD.YY
                    // Month-DD-YYYY / Month-DD-YY
                    // Month/DD/YYYY / Month/DD/YY
                    // Month DD YYYY / Month DD YY
                    $firstElem = getWordMonth($firstElem);
                    if ($firstElem && isValidDay($secondElem) && isValidYear($thirdElem)) {
                        writeSign($secondElem, $firstElem);
                    }
                } elseif (is_numeric($firstElem) && !is_numeric($secondElem) && is_numeric($thirdElem)) {
                    // DD.Month.YYYY / DD.Month.YY
                    // DD-Month-YYYY / DD-Month-YY
                    // DD/Month/YYYY / DD/Month/YY
                    // DD Month YYYY / DD Month YY
                    $secondElem = getWordMonth($secondElem);
                    if (isValidDay($firstElem) && $secondElem && isValidYear($thirdElem)) {
                        writeSign($firstElem, $secondElem);
                    }
                }

            }
        }
    }
    echo('что-то пошло не так');
    
?>