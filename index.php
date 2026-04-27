<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Product;

// Instanciación
$usuario = new User(1, "Kelly Beitia", "kelly.beitia@utp.ac.pa");
$producto = new Product(101, "Laptop", 850.00);

// Uso de métodos Get
echo "Usuario: " . $usuario->getUsername() . " (" . $usuario->getEmail() . ")" . PHP_EOL;
echo "Producto: " . $producto->getName() . " - Precio: $" . $producto->getPrice() . PHP_EOL;