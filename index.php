<?php
session_start();

include_once(dirname(__FILE__).'/utils/CAS.class.php');
include_once(dirname(__FILE__).'/conf.php');

if (isset($_SESSION['user'])) {
    include_once(dirname(__FILE__).'/view/index.php');
}
else {
    $cas = new CAS($_CONF['cas_url'], $_CONF['url']);
    $user = $cas->authenticate();
    if ($user != -1) {
        $_SESSION['user'] = $user;
        unset($_GET['ticket']);
        header("Location: index.php");
    }
    else {
        $cas->login();
    }
}
