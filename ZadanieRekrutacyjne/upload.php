<?php
$upload_dir = 'transporty/uploads/';

if (isset($_POST['removefile'])) {
    $remove_file = $upload_dir . $_POST['removefile'];
    if (unlink($remove_file)) {
        echo $_POST['removefile'] . ': removed.';
    } else {
        echo $_POST['removefile'] . ': unable to remove.';
    }
    exit;
}

if (isset($_FILES['file']['name'])) {
    $file_unique_name = sha1_file($_FILES['file']['tmp_name']);
    $file_name = $_FILES['file']['name'];

    $destination = $upload_dir . $file_unique_name . '_' . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        echo 'File uploaded successfully';
    } else {
        echo 'Error: Uploaded file failed to be saved';
    }
}
?>
