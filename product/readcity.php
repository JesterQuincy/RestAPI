<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение к базе данных будет здесь
// подключение базы данных и файл, содержащий объекты
include_once "../vendor/database.php";
include_once "../objects/product.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$product = new Product($db);

// чтение товаров будет здесь
// запрашиваем товары
$stmtc = $product->readc();
$num = $stmtc->rowCount();

// проверка, найдено ли больше 0 записей
if ($num > 0) {
    // массив товаров
    $products_arrar = array();
    $products_arrar["cities"] = array();



    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()
    while ($rows = $stmtc->fetch(PDO::FETCH_ASSOC)) {
        // извлекаем строку
        extract($rows);
        $product_items = array(
            "id" => $id,
            "name" => $city


        );
        array_push($products_arrar["cities"], $product_items);
    }


    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    echo json_encode($products_arrar);
}

// "товары не найдены" будет здесь
else {
    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Пользователь не найден."), JSON_UNESCAPED_UNICODE);
}