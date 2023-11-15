<?php


/**
 * Класс подключения к БД
 */
class DatabaseConnector
{
    /**
     * Метод, возвращающий объект PDO с валидным подключением
     *
     * @return PDO
     * @throws PDOException Если не удалось подключиться к базе данных
     */
    public static function connect(): PDO
    {
        $dbHost = 'localhost';
        $dbName = 'test';
        $username = 'mynewuser';
        $password = 'mypassword';

        try {
            return new PDO("pgsql:host=$dbHost;dbname=$dbName", $username, $password);
        } catch (PDOException $e){
            throw new PDOException("Error connecting to database: " . $e->getMessage(), 0, $e);
        }
    }
}