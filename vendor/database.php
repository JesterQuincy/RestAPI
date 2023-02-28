<?php
require __DIR__ . "/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
class Database
{

    // укажите свои учетные данные базы данных




    public $conn;

    // получаем соединение с БД
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $_ENV['HOST']. ";dbname=" . $_ENV['B_NAME'],  $_ENV['USR'], $_ENV['PASSWORD']);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}