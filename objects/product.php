<?php

class Product
{
    // подключение к базе данных и таблице "products"
    private $conn;
    private $table_name = "user";

    // свойства объекта
    public $id;
    public $username;
    public $name;
    public $city_id;


    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // здесь будет метод read()
    // метод для получения товаров
     public function read()
    {
        // выбираем все записи
        $query = "SELECT 
         c.id,user.id, user.username, user.name, c.name AS city
    FROM user 
        INNER JOIN city c ON user.city_id = c.id;
";


        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();
        return $stmt;
    }
    public function readc()
    {
        // выбираем все записи
        $queryc = "SELECT 
         c.id,c.name AS city
    FROM city c ;
";


        // подготовка запроса
        $stmtc = $this->conn->prepare($queryc);

        // выполняем запрос
        $stmtc->execute();
        return $stmtc;
    }
    // метод для создания товаров
    function create()
    {
        // запрос для вставки (создания) записей
        $query = "INSERT INTO user
            
        SET
            username=:username, name=:name, city_id=:city_id";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));


        // привязка значений
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);


        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function update()
    {
        // запрос для обновления записи
        $query ="UPDATE user
                    SET name=:name, username=:username, city_id=:city_id  WHERE id=:id;";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->city_id = htmlspecialchars(strip_tags($this->city_id));

        $this->id = htmlspecialchars(strip_tags($this->id));

        // привязываем значения
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":city_id", $this->city_id);


        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // метод для удаления товара
    function delete()
    {
        // запрос для удаления записи (товара)
        $query = "DELETE FROM " . $this->table_name ." WHERE id=:id;";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->id = htmlspecialchars(strip_tags($this->id));

        // привязываем id записи для удаления
        $stmt->bindParam(1, $this->id);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return $stmt;
    }

}