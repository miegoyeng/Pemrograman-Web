<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Fighter.php";

use app\Models\Fighter;
use app\Traits\ApiResponseFormatter;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

class FighterController {
    use ApiResponseFormatter;

    // Menampilkan semua fighter
    public function index() {
        $fighterModel = new Fighter();
        $response = $fighterModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    // Menampilkan fighter berdasarkan ID
    public function getById($id){
        $fighterModel = new Fighter();
        $response = $fighterModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    // Menambahkan fighter baru
    public function insert() {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        if (!isset($inputData["name"], $inputData["weight_class"], $inputData["record"], $inputData["country"])) {
            return $this->apiResponse(400, "Missing required fields", null);
        }

        $fighterModel = new Fighter();
        
        $response = $fighterModel->create([
            "name" => $inputData["name"],
            "weight_class" => $inputData["weight_class"],
            "record" => $inputData["record"],
            "country" => $inputData["country"],
        ]);

        return $this->apiResponse(200, "success", $response);
    }

    // Memperbarui data fighter
    public function update($id) {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        if (!isset($inputData["name"], $inputData["weight_class"], $inputData["record"], $inputData["country"])) {
            return $this->apiResponse(400, "Missing required fields", null);
        }

        $fighterModel = new Fighter();
        $response = $fighterModel->update([
            "name" => $inputData["name"],
            "weight_class" => $inputData["weight_class"],
            "record" => $inputData["record"],
            "country" => $inputData["country"],
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    // Menghapus fighter berdasarkan ID
    public function delete($id) {
        $fighterModel = new Fighter();
        $response = $fighterModel->delete($id);
        return $this->apiResponse(200, "success", $response);
    }
}
?>
