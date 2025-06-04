<?php

function getPDO(): bool|PDO {
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $user = 'root';
    $password = '1872';
    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $exception) {
        error_log("Ошибка подключения к БД: " . $exception->getMessage());
        return false;
    }
}

?>