<?php

#require('db.php');
require('banking.php');
session_start();
if (!isset($_SESSION['username'])) {
    die("Unauthorized!");
}
if (isset($_REQUEST['amount']) and isset($_REQUEST['receiver_account'])) {
    transfere_money((int)$_REQUEST['amount'], (int)$_REQUEST['receiver_account']);
}
