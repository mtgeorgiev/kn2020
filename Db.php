<?php

class Db {

    public static function getConnection() {

        $config = parse_ini_file("config.ini", true);

        return new PDO('mysql:host=' . $config['db']['host'] . ';charset=utf8;Collation=utf8mb4_unicode_ci;dbname=' . $config['db']['name'] . '',
            $config['db']['username'] . '', $config['db']['password'],
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
    }
}
