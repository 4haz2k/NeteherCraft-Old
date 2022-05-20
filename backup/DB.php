<?php
/**
 * Класс для работы с базой данных<br>
 * Author: Alexey Pavlov<br>
 * Contact: vk.com/zytia
 */
class DataBase {
    private $connect;
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "players";

    /**
     * DataBase конструктор.
     * Происходит подключение к базе данных
     * из указанных значений
     */
    public function __construct()
    {
        $this->connect = mysqli_connect("$this->host", "$this->username", "$this->password", "$this->database");
        mysqli_set_charset($this->connect, "utf8");
    }

    /**
     * Метод, возваращающий результат выборки из базы данных
     * @param $field_select - Индекс поля из базы, откуда будут выбираться данные
     * @param $table - таблица, с которой работаем
     * @param $field_where - Поле из строки, которую получили
     * @param $data - Данные, на которые ссылаемся из базы данных
     * @return bool|mysqli_result  возвращает результат выборки
     */

    function query_select($field_select, $table, $field_where, $data){
        $query = mysqli_query($this->connect, "SELECT ".$field_select." FROM ".$table." WHERE ".$field_where." = '".$data."'");
        return $query;
    }

    /**
     * Метод, записывающий данные в базу
     * @param $field_select - Индекс поля из базы, откуда будут выбираться данные
     * @param $table - таблица, с которой работаем
     * @param $data - Данные, на которые ссылаемся из базы данных
     * @return bool|mysqli_result  возвращает результат вставки
     */

    function query_insert($field_select, $table, $data){
        $query = @mysqli_query($this->connect, "INSERT INTO $table SET $field_select = '$data'");
        return $query;
    }

    /**
     * Метод, удаляющий данные из базы
     * @param $table - таблица, с которой работаем
     * @param $field_where - Поле из строки, которую получили
     * @param $data - Данные, на которые ссылаемся из базы данных
     * @return bool|mysqli_result  возвращает результат удаления
     */

    function query_delete($table, $field_where, $data){
        $query = @mysqli_query($this->connect, "DELETE FROM $table WHERE $field_where = '$data'");
        return $query;
    }

    /**
     * Метод, обнавляющий данные в базе
     * @param $field_select - Индекс поля из базы, куда будут вписываться данные
     * @param $table - таблица, с которой работаем
     * @param $field_update - Поле, в котором будем обновлять данные
     * @param $data - Данные, на которые ссылаемся из базы данных
     * @return bool|mysqli_result возвращает результат обновления
     */

    function query_update($field_select, $table, $field_update, $data){
        $query = @mysqli_query($this->connect, "UPDATE $table SET $field_select WHERE $field_update = '$data'");
        return $query;
    }

    /**
     * Метод для кастомного запроса
     * @param $sql - запрос
     * @return bool|mysqli_result возвращает результат запроса
     */

    function query($sql){
        $query = @mysqli_query($this->connect, $sql);
        return $query;
    }
}


