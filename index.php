<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

require __DIR__ . '/vendor/autoload.php'; // For Composer
require("config.php"); // All settings in the $config-Object
require("functions.php"); // Funtions

// Start session functions
session_start();

// Initialize template engine
$smarty = new Smarty;

// Check if the user is logged in
if (isset($_SESSION['logged-in']) && ($_SESSION['logged-in'] === true)) {
    // User is logged in

    $user = getUserInfo();

    $smarty->assign('user_has_picture', !$user["picture"]["is_silhouette"]);
    $smarty->assign('name', $user['name']);
    $smarty->assign('image', $user['picture']['url']);

    $smarty->display("logged-in.tpl");
}
else {
    // User is not logged in
    $smarty->assign('login_url', getFacebookLoginUrl());
    $smarty->display("logged-out.tpl");
}


?>