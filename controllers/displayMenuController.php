<?php

include_once '../models/menuModels.php';
include_once '../models/types.php';

if (checkForm()) {
    $display = new Menu();
    $displayMenu = $display->getAllMenu();
}

function checkForm() {
    global $title, $type, $price;
    $title = $_POST['title'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    return TRUE;
}

if (empty($_SESSION)) {
    header('Location: ../views/login.php');
}