<?php

function getPDO(): bool|PDO {
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $user = 'root';
    $password = '1872';
    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

?>