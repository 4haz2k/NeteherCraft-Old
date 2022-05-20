<?php
    class Connect
    {
        private $host = "localhost";
        private $username = "root";
        private $password = "root";
        private $database = "minecraft";

        function data()
        {
            return $this->host . " " . $this->username . " " . $this->password . " " . $this->database;
        }
    }