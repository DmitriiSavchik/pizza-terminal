<?php

namespace MyProject\Controllers;

use MyProject\Models\Pizzas\Pizza;
use MyProject\Models\Sizes\Size;
use MyProject\Models\Sauces\Sauce;
use MyProject\Models\Orders\Order;

class OrderController
{
    public function createOrder()
    {
        header('Content-Type: application/json');

        $pizzaId = $_POST['pizza'] ?? null;
        $sizeId = $_POST['size'] ?? null;
        $sauceId = $_POST['sauce'] ?? null;

        if ($pizzaId === null || $sizeId === null || $sauceId === null) {
            return json_encode(['error' => 'Все поля обязательны для заполнения']);
        }

        $pizza = Pizza::getById($pizzaId);
        $size = Size::getById($sizeId);
        $sauce = Sauce::getById($sauceId);

        if (!$pizza || !$size || !$sauce) {
            return json_encode(['error' => 'Некорректный выбор']);
        }

        $summary = $pizza->getPrice() * $size->getPrice() / 10 + $sauce->getPrice();

        $order = new Order();
        $order->setPizzaId($pizzaId);
        $order->setSizeId($sizeId);
        $order->setSauceId($sauceId);
        $order->setSummary($summary);
        $order->save();

        $apiUrl = 'https://api.nbrb.by/exrates/rates/431';
        $response = file_get_contents($apiUrl);

        if ($response === FALSE) {
            return json_encode(['error' => 'Ошибка при получении данных валюты']);
        }

        $data = json_decode($response, true);

        if (isset($data['Cur_OfficialRate'])) {
            $officialRate = $data['Cur_OfficialRate'];
        } else {
            return json_encode(['error' => 'Ошибка при получении данных валюты']);
        }

        $finalSummary = $summary * $officialRate;

        echo json_encode([
            'receipt' => "<div class='receipt'>Вы заказали:<br> Пицца: {$pizza->getName()}<br> 
            Размер: {$size->getName()}<br> Соус: {$sauce->getName()}<br> Общая сумма: {$finalSummary} BYN </div>"
        ]);
    }
}
