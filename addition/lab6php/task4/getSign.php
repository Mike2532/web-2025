<?php
    const minYear = 1900;

    function write_sign(int $day, int $month): void {
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

    function get_data(string $str, int $i, int $lengt): array {
        $stop_symbols = [' ', '.', '-', ',', 'г', '/'];
        $data = '';
        while ($i < $lengt) {
            $symbol = mb_substr($str, $i, 1);
            if (!in_array($symbol, $stop_symbols)) {
                $data .= $symbol;
                $i++;
            } else {
                break;
            }
        }
        return [
            'data' => $data,
            'i' => ++$i,
        ];
    }

    function get_word_month(string $str, int $i, int $lengt): array|bool {
        $monthsEng = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        $monthsRus = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    
        $data = get_data($str, $i, $lengt);
        $monthName = $data['data'];
        $monthNumber = array_search($monthName, $monthsEng) | array_search($monthName, $monthsRus);
        if ($monthNumber != false) {
            return [
                'monthNumber' => (int) ++$monthNumber,
                'i' => $data['i'],
            ];
        }
            
        return false;
    }

    function get_number_month(string $str, int $i, int $lengt): array|bool {
        $data = get_data($str, $i, $lengt);
        $monthNumber = $data['data'];
        if (is_numeric($monthNumber) && ($monthNumber >= 0) && ($monthNumber <= 12)) {
            return [
                'monthNumber' => (int) $monthNumber,
                'i' => $data['i'],
            ];
        }
        return false;
    }

    function get_day(string $str, int $i, int $lengt): array|bool {
        $data = get_data($str, $i, $lengt);
        $dayNumber = $data['data'];
        if (is_numeric($dayNumber) && ($dayNumber >= 1) && ($dayNumber <= 31)) {

            return [
                'dayNumber' => (int) $dayNumber,
                'i' => $data['i'],
            ];
        } 

        return false;
    } 

    function get_year(string $str, int $i, int $lengt): array|bool {
        $data = get_data($str, $i, $lengt);
        $yearNumber = $data['data'];

        if (is_numeric($yearNumber)) {
            if (($yearNumber >= minYear) && ($yearNumber <= (int) date('Y')) || (($yearNumber >= 0) && ($yearNumber <= (int) (date('Y') % 100)))) {
                return [
                    'yearNumber' => $yearNumber,
                    'i' => $data['i'],
                ];
            }
        }
        return false;
    }

    function split_validate(string $str, int $lengt): string|bool {
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

    function get_point_date(string $str, int $lengt): void {
        $day = get_day($str, 0, $lengt); 
        if ($day !== false) {
            $i = $day['i'];
            $day = $day['dayNumber'];
            $month = get_number_month($str, $i, $lengt);
            if ($month !== false) {
                $i = $month['i'];
                $month = $month['monthNumber'];
                if (get_year($str, $i, $lengt) !== false) {
                    write_sign($day, $month);
                }
            }
        } 
    }

    function get_slash_date(string $str, int $lengt, bool $checkYear = false, int $startPos = 0): void {
        $month = get_number_month($str, $startPos, $lengt);
        if ($month !== false) {
            $i = $month['i'];
            $month = $month['monthNumber'];
            $day = get_day($str, $i, $lengt);
            if ($day !== false) {
                $i = $day['i'];
                $day = $day['dayNumber'];
                if ((!$checkYear && (get_year($str, $i, $lengt) !== false)) || $checkYear) {
                    write_sign($day, $month);
                } 
            }
        }
    }

    function get_dash_date(string $str, int $lengt): void {
        $data = get_year($str, 0, $lengt);
        if ($data['yearNumber'] >= minYear){
            get_slash_date($str, $lengt, true, $data['i']);
        } else {
            get_point_date($str, $lengt);
        }
    }

    function get_space_date(string $str, int $lengt): void {
        $date = get_day($str, 0, $lengt);
        if ($date !== false) {
            $i = $date['i'];
            $day = $date['dayNumber'];
            $date = get_word_month($str, $i, $lengt);
            if ($date !== false) {
                $i = $date['i'];
                $month = $date['monthNumber'];
                if (get_year($str, $i, $lengt) !== false) {
                    write_sign($day, $month);
                }
            }
        } 
        $date = get_year($str, 0, $lengt);
        if ($date !== false) {
            $i = ++$date['i'];
            $date = get_day($str, $i ,$lengt);
            if ($date !== false) {
                $i = $date['i'];
                $day = $date['dayNumber'];
                $date = get_word_month($str, $i, $lengt);
                if ($date !== false) {
                    $month = $date['monthNumber'];
                    write_sign($day, $month);
                }
            }
        }
        $date = get_word_month($str, 0, $lengt);
        if ($date !== false) {
            $i = $date['i'];
            $month = $date['monthNumber'];
            $date = get_day($str, $i, $lengt); 
            if ($date !== false) {
                $i = ++$date['i'];
                $day = $date['dayNumber'];
                if (get_year($str, $i, $lengt) !== false) {
                    write_sign($day, $month);
                }
            }
        }
    }

    $unparsedDate = strtolower(trim($_POST['date']));
    $unparsedDate = preg_replace('/\s+/', ' ', $unparsedDate);
    $lengt = mb_strlen($unparsedDate);
    
    if (preg_match('/^[0-9a-zа-я.,\-\/ ]+$/u', $unparsedDate)) {
       
        $split = split_validate($unparsedDate, $lengt);
        if ($split !== false) {
            switch($split) {
                case '.':
                    get_point_date($unparsedDate, $lengt);
                    break;
                case '/':
                    get_slash_date($unparsedDate, $lengt);
                    break;
                case '-':
                    get_dash_date($unparsedDate, $lengt);
                    break;
                case ' ':
                    get_space_date($unparsedDate, $lengt);
                    break;
            }
        }
    } 
    die('some error occured');

?>