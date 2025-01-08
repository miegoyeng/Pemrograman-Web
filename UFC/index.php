<?php

header("Content-Type: application/json; charset=UTF-8");

include "app/Routes/FighterRoutes.php"; // Menggunakan FighterRoutes

use app\Routes\FighterRoutes; // Menggunakan BookRoutes

// Mendapatkan metode HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Mendapatkan path URL dari request
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Membuat instance dari BookRoutes untuk menangani request
$fighterRoutes = new FighterRoutes(); // Menggunakan BookRoutes
$fighterRoutes->handle($method, $path); // Menangani rute berdasarkan metode dan path