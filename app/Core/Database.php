<?php

namespace App\Core;

use mysqli;

class Database
{
    private static ?mysqli $connection = null;

    public static function connect(): mysqli
    {
        if (self::$connection === null) {

            self::$connection = new mysqli(
                "localhost",
                "root",
                "",
                "school",
                3307
            );

            if (self::$connection->connect_error) {
                die("Database Connection Failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}