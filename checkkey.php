<?php
require_once('./database.php');

$key = '';
$machine = '';

if (isset($_POST['key'])) {
    $key = $_POST['key'];
    if (isset($_POST['machine'])) {
        $machine = $_POST['machine'];
    }
}

if ($key == '' || $machine == '') {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Invalid Params'
    ));
} else {
    $database = new Database();
    $result = $database->select()
        ->from('mykey')
        ->where('key_val = :key and machine_id = :machine')
        ->execute(array(
           'key' => $key,
           'machine' => $machine
        ))
        ->fetch();
    if ($result) {
        $expired = $result->expired;
        $currentTime = date('Y-m-d H:i:s');
        if ($currentTime >= $expired) {
            echo json_encode(array(
                'status' => 'expired',
                'message' => 'Key đã hết hạn!'
            )); 
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Key còn hạn!'
            ));
        }
    }
}