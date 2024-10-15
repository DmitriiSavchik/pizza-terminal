<?php

namespace MyProject\Controllers;

use MyProject\Models\Pizzas\Pizza;
use MyProject\Models\Sauces\Sauce;
use MyProject\Models\Sizes\Size;

class MainController extends AbstractController
{
    public function main()
    {
        $pizzas = Pizza::findAll();
        $sizes = Size::findAll();
        $sauces = Sauce::findAll();
        $this->view->renderHtml('main/main.php', [
            'pizzas' => $pizzas,
            'sizes' => $sizes,
            'sauces' => $sauces,
        ]);
    }
}
