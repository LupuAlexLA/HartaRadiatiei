<?php
header('Content-Type: application/json; charset=utf-8');
include('db.php');

$sql = "SELECT * FROM events";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $key => $eventData) {
        $returnData[] = [
            'type' => 'Feature'.$eventData['id'],
            'properties' => [
                'description' => '<strong>'.$eventData['denumire'].'</strong><p>Peak: '.$eventData['peak']." V/m Average: ".$eventData['average'].' uW/m2</p>',
                'icon' => 'communications-tower-15'
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [$eventData['lat'], $eventData['lng']]
            ]
        ];
    }
} catch (Exception $e) {
    die($e);
}

echo json_encode($returnData);