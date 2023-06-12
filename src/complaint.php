<?php
require("banking.php");

if (!isset($_SESSION["username"]) or !($_SESSION['authenticated'])) {
    header("Location: login.html");
    exit();
}

if (!is_vip()) {
    die("Unauthorized, this featuer is only for VIP customers");
}

include('complaint.html');


if ($_FILES["upload"]["name"]) {

    mkdir("uploads"); //mkdir if doesn't exist
    $name = $_FILES["upload"]["name"];
    $ext = end((explode(".", $name)));
    $target_dir = "uploads/";
    $target_file = $target_dir . sha1(super_random()) . "." . $ext;

    move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);

    if (checkFileType($target_file)) {
        echo "Thank you for contacting us, we will get back to you shortly";
    } else {
        unlink($target_file);
        echo "Sorry, there was an error uploading your file.";
    }
}
// My secret secure random generator
function super_random()
{
    $rand = rand(0, 100);
    for ($i = 0; $i < 100; $i++) {
        $rand = $rand * rand(0, 100);
    }
    return $rand;
}


// Only JPG and PNG are allowed 
function checkFileType($fileName)
{
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png") {
        echo "Sorry, only JPG & PNG files are allowed\n";
        return false;
    } else {
        return true;
    }
}
