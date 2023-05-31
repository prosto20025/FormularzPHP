<?php
    $upload_dir = 'transporty/';
    $file_name = 'transport_details.txt';
    $destination = $upload_dir . $file_name;

    $text = $_POST['text'];

    file_put_contents($destination, $text, FILE_APPEND | LOCK_EX);
    
    $response = array('status' => 'success', 'message' => 'Transport details saved successfully.');
    echo json_encode($response);
?>
