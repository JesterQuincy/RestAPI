<?php

// HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключим файл для соединения с базой и объектом Product
include_once "../vendor/database.php";
include_once "../objects/product.php";

// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

// подготовка объекта

$user = new Product($db);


parse_str(file_get_contents('php://input', TRUE), $DEl);

if (!empty($DEL['id'])) {
    $user->id = $DEL['id'];

    if($user->delete()){
        http_response_code(200);
        echo json_encode(array("message" => "Пользователь удален."));

    }

    else{
        http_response_code(500);
        echo json_encode(array("message" => "Невозможно удалить пользователя."));
    }

}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Пользователь не найден."));
}