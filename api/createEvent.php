<?php
include('db.php');



if(isset($_POST['denumire'])){
    $sql = "INSERT into events (denumire, peak, average, lat, lng) VALUES (:denumire,:peak, :average, :lat, :lng)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'denumire'=>$_POST['denumire'],
            'peak'=>$_POST['peak'],
            'average'=>$_POST['average'],
            'lat'=>$_POST['lat'],
            'lng'=>$_POST['lng'],
        ]);

        echo json_encode('success');
    
    } catch (Exception $e) {
        die($e);
    }
}