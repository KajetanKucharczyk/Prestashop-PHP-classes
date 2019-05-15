<?php

require_once(dirname(__FILE__)."/../../config/config.inc.php");
require_once(dirname(__FILE__)."/../../config/defines.inc.php");
require_once(dirname(__FILE__)."/../../config/settings.inc.php");
require_once(dirname(__FILE__)."/../../init.php");

$connection = Db::getInstance();

spl_autoload_register(function ($class_name) {
    include _KAJTEK_CLASSES_."/".$class_name . '.php';
});
$category = new _Category($connection);
$features = new _Features($connection);
$manufacturer = new _Manufacturer($connection);
$product = new _Product($connection);
$product_link = new _ProductLink($connection);
$reference = new _Reference($connection);

?>