<?php

namespace Core;


class Db {

    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    /**
     * @return null|\PDO
     */
    public static function getInstance()
    {
        if ( !isset(self::$instance) )
        {
            $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;

            $configs = require_once(BASE_DIR.'/app/Config/Configs.php');

            self::$instance = new \PDO(
                sprintf('mysql:host=%s;dbname=%s',
                    $configs['db']['host'],
                    $configs['db']['name']
                ),
                $configs['db']['user'],
                $configs['db']['password'],
                $pdo_options
            );
        }

        return self::$instance;
    }
}