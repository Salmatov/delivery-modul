<?php


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


use models\DeliveryCompany;

require 'DeliveryService.php';
require 'deliveryCompany/DeliveryCompany.php';
require 'deliveryCompany/Mtransline.php';
require 'deliveryCompany/Sdec.php';
require 'models/Directions.php';
require 'models/DeliveryCompany.php';
require 'DeliveryDTO.php';


$request = json_decode(file_get_contents('php://input'));

try {
    $deliveryDTO = new DeliveryDTO();
    $deliveryDTO->load($request);
    $deliveryDTO->validate();
} catch (Exception $e) {
    header('Content-Type: application/json', true, 400);
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

$deliveryCompany = new DeliveryCompany();
$deliveryCompanyActiveList = $deliveryCompany->getDeliveryCompanyActive();
try {
    $deliveryService = new DeliveryService($deliveryCompanyActiveList);
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

$fastDeliveryResult = $deliveryService->fastDelivery($deliveryDTO->from, $deliveryDTO->to, $deliveryDTO->weight);
$result = json_encode($fastDeliveryResult, true);
header('Content-Type: application/json');
echo $result;