<?php

session_start();
require('db.php');
require('email.php');
if (isset($_REQUEST['username']) && !isset($_REQUEST['pin'])) {
    session_unset();
    $_SESSION['username'] = (int)$_REQUEST['username'];
    $_SESSION['reset_pin'] = random_int(0, 99999999);
    send_pin_by_email($_SESSION['reset_pin'] ); 
    echo '<br> Pin code should have been sent.';
    include('forgot-password-submit-pin.html');
    exit();
}

if ( isset($_REQUEST['pin'])) {

    $pin_code = (int)$_REQUEST['pin'];
    $id = (int)$_SESSION['username'];
    $password = random_int(0, 99999999);

    if ($_SESSION['reset_pin'] === $pin_code) {
        session_unset();
        $sql = "UPDATE users SET password=md5('" . $password . "') WHERE id=" . $id;

        if ($con->query($sql) === TRUE) {
            echo "Password Reset Successfully";
            echo "<br>Account ID: " . $id;
            echo "<br>Password:" . $password;
            echo "<br> <button onclick='history.back()'>Go Back</button>";
        } else {
            echo "Error reseting password! ";
        }
    } else {
        echo "Incorrect Pin";
    }
    exit();
}
header("Location: forgot-password.html");