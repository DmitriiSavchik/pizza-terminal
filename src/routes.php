<?php

return [
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^order/create$~' => [\MyProject\Controllers\OrderController::class, 'createOrder'],
];
