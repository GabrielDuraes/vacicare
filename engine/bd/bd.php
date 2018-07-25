<?php
    // define("DB_HOSTI","localhost"); // host 
    // define("DB_USERNAMEI","root"); // username
    // define("DB_PASSWORDI",""); // password
    // define("DB_DATABASEI","vacicare"); // db name

    define("DB_HOSTI","localhost"); // host 
    define("DB_USERNAMEI","root"); // username
    define("DB_PASSWORDI",""); // password
    define("DB_DATABASEI","vacicare"); // db name

    class DB {
        private $dbi;
        private $query;

        function __construct() {
            $this->dbi;
            $this->query;
        }

        function __destruct() {
            $this->dbi;
            $this->query;
        }

        // starts MYSQL
        function open() {
            $this->dbi = new PDO('mysql:host='.DB_HOSTI.';dbname='.DB_DATABASEI.';charset=utf8mb4',DB_USERNAMEI,DB_PASSWORDI);
            $this->dbi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbi->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        //close connection
        function close() {
            $this->dbi = NULL;
        }

        // executes a SQL string
        function query($sql) {
            try {
                //connect as appropriate as above
                $this->dbi->query($sql); //invalid query!
            } catch(PDOException $ex) {
                echo "An Error occured! $ex"; //user friendly message
            }
        }

        function fetchData($sql) {
            $stmt = $this->dbi->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        function lastId() {
            $lastId = $this->dbi->lastInsertId();
            return $lastId;
        }
    }
?>