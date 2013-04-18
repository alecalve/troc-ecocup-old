<?php
session_start();

include_once(dirname(__FILE__).'/conf.php');
include(dirname(__FILE__).'/library/SplClassAutoloader.php');
$loader = new SplClassLoader('App', 'src');
$loader->setFileExtension(".class.php");
$loader->register();

$cas = new App\Utils\Cas($_CONF['cas_url'], $_CONF['url']);

if (isset($_SESSION['user'])) {
    if (!empty($_POST)) {
        include_once(dirname(__FILE__).'/view/form.php');
    } else {
        include_once(dirname(__FILE__).'/view/index.php');
    }
} else {
    $user = $cas->authenticate();
    if ($user != -1) {
        $_SESSION['user'] = $user;
        unset($_GET['ticket']);
        header("Location: index.php");
    } else {
        $cas->login();
    }
}
