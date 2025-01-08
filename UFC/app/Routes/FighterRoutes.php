<?php

namespace app\Routes;

include "app/Controller/FighterController.php";

use app\Controller\FighterController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

class FighterRoutes {
    public function handle($method, $path) {
        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/fighter'
        if ($method == "GET" && $path == '/api/fighter') {
            $controller = new FighterController();
            echo $controller->index();
        }

        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/fighter/{id}'
        if ($method == "GET" && strpos($path, "/api/fighter/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new FighterController();
            echo $controller->getById($id);
        }

        // JIKA REQUEST METHOD POST DAN PATH SAMA DENGAN '/api/fighter'
        if ($method == "POST" && $path == "/api/fighter") {
            $controller = new FighterController();
            echo $controller->insert();  // Menangani input JSON untuk insert
        }

        // JIKA REQUEST METHOD PUT DAN PATH SAMA DENGAN '/api/fighter/{id}'
        if ($method == "PUT" && strpos($path, "/api/fighter/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new FighterController();
            echo $controller->update($id);  // Menangani input JSON untuk update
        }

        // JIKA REQUEST METHOD DELETE DAN PATH SAMA DENGAN '/api/fighter/{id}'
        if ($method == "DELETE" && strpos($path, "/api/fighter/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new FighterController();
            echo $controller->delete($id);
        }
    }
}
