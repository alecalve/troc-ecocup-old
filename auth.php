<?php
session_start();

include_once "utils/CAS.class.php";
include_once("conf.php");

if (isset($_SESSION['user'])) {
    http_redirect("index.php", array(), true, HTTP_REDIRECT_PERM);
}
else {
    $cas = new CAS($_CONF['cas_url'], $_CONF['url']);
    $user = $cas->authenticate();
    if ($user != -1) {
        $_SESSION['user'] = $user;
        http_redirect("index.php", array(), true, HTTP_REDIRECT_PERM);
    }
    else {
        $cas->login();
    }
}
